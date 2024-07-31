<?php
    include("seguranca/seguranca.php");
    //protegePagina(2);
    require_once('php/class.php');
    require_once('bd_funcao/maysql.php');
    require_once('php/funcao_0.2.php');
?><p class='alert-success'>Preparando sistema para pagamento</p><img src='images/loading.gif'><?php
       if($id_pagamento = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
            $consulta = new consulta();
                    $consulta->campo    = 'a.id, b.nome AS nomepassaro, c.nome AS nomeetapa, d.nome AS nomepessoa, c.data_etapa, c.local, b.anilha,             b.id_modalidade, c.id_temporada, d.id_clube, a.numero, d.email, d.cpf, e.valor AS valor_incricao, pgm.cod_pagamento,pgm.id AS idpagamento, c.data_venc, t.nome AS nometemporada';
                    $consulta->tabela   = "arpag_passaro_etapa AS a 
                                          INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro 
                                          INNER JOIN arpag_etapa AS c ON c.id = a.id_etapa 
                                          INNER JOIN arpag_temporada AS t ON t.id = c.id_temporada
                                          INNER JOIN arpag_pessoa AS d ON d.id = a.id_pessoa 
                                          INNER JOIN arpag_pagamento_passaro_etapa AS pg ON pg.id_passaro_etapa = a.id 
                                          INNER JOIN arpag_pagamento AS pgm ON pgm.id = pg.id_pagamento
                                          INNER JOIN arpag_valor_inscricao_etapa AS e ON (e.id_etapa = c.id) AND (e.id_modalidade = b.id_modalidade)";
                    $consulta->parametro= "pg.id_pagamento = ".$id_pagamento;
                    $executa = select_db($consulta);
                    $valor = 0; $nome_passaro = NULL;
                    while($linha        = $executa->fetch_array()){
                        $valor          = $linha['valor_incricao'] + $valor;
                        $nome_passaro   .= $linha['nomepassaro']." ";
                        $mial           = $linha['email']; 
                        $nome_pessoa    = $linha['nomepessoa'];
                        $cpf            = $linha['cpf'];
                        $codpag         = $linha['cod_pagamento'];
                        $data_venc      = str_replace('-', '', $linha['data_venc']); 
                        $nometemporada  = $linha['nometemporada'];
                        $nomeetapa      = $linha['nomeetapa'];
                    }
        }
$resultado = "<br /><br />Inscri&ccedil;&atilde;o realizada com Sucesso!!!<br /><br /> N&atilde;o h&aacute; cobran&ccedil;a para essa inscri&ccedil;&atilde;o";
$status_transacao = 3;
if ($valor >= 1){
    $status_transacao = 1;
    //as casa decimais devem ser separadas por ponto(.) Ex.: 1556.23 (Um mil e quinhentos e cinquenta e seis e vinte e três) 
    // Os campos de data devem ser preenchidos no padrão americano(aaaaMMdd) sem caractéres especiais. Ex.: 19840206 equivalente a (06/02/1984) 
    // Inicia o cURL
    $ch = curl_init();
    // Define a URL original (do formulário de login)
    curl_setopt($ch,CURLOPT_URL, 'https://geraboleto.sicoobnet.com.br/geradorBoleto/GerarBoleto.do');

    curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
    // Habilita o protocolo POST
    curl_setopt($ch,CURLOPT_POST, 1);
    // Define os parâmetros que serão enviados (usuário e senha por exemplo)
    curl_setopt($ch,CURLOPT_POSTFIELDS,  "numCliente=674737&coopCartao=3125&chaveAcessoWeb=DC4CABCA-A1C5-4361-803A-DA8C0A9052F5&numContaCorrente=134520&codMunicipio=31646&nomeSacado=".strtoupper(remover_caracter($nome_pessoa))."&cpfCGC=".$cpf."&dataNascimento=20150101&endereco=Avenida dos Inconfidentes,187&bairro=Centro&cidade=Guaxupe&cep=37800000&uf=mg&telefone=0&ddd=0&ramal=0&bolRecebeBoletoEletronico=1&email=".$mial."&codEspDocumento=DM&dataEmissao=".date('Ymd')."&seuNumero=".$codpag."&nomeSacador=Arpag&numCGCCPFSacador=09331650000194&qntMonetaria=1&valorTitulo=".formatomoeda_ponto($valor)."&codTipoVencimento=1&dataVencimentoTit=".date('Ymd', strtotime('+2 days'))."&valorAbatimento=0&bolAceite=1&percTaxaMulta=0&descInstrucao1=Passaros inscritos:&descInstrucao2=".$nome_passaro."&descInstrucao3=".$nomeetapa."&descInstrucao4=".$nometemporada ); 

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $resultado = curl_exec($ch);
    $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo  curl_error($ch);
    curl_close($ch);
}
if(strripos($resultado, 'Ocorreu um erro no sistema!')){echo "<br /><p class='alert-danger'>Erro no pagamento, Tente imprimir seu boleto mais tarde, pois o sistema pode estar temporariamente fora.</p> <p>Caso o problema persista entre em contato com a administrador do sistema </p><br />
                                                <a href='#' onclick='window.close()'>Sair</a> ";}   
else{
$atualizar_pag = new atualiza();
    $atualizar_pag->campo       = "boleto = '".(str_replace("'","\'",str_replace("\"","\\\"",$resultado)))."',status_transacao = ".$status_transacao.", cod_pagamento = ".$codpag;
    $atualizar_pag->tabela      = 'arpag_pagamento';
    $atualizar_pag->parametro   = "id = ".$id_pagamento;
    if (update_bd($atualizar_pag)) {
        echo "<script> carrega(); window.location='boleto2.php?kj=".cript($id_pagamento)."';</script>"; 
        echo " <meta http-equiv='refresh' content=1;url='boleto2.php?kj=".cript($id_pagamento)."'>";
    }
}