<?php
    include("seguranca/seguranca.php");
    //protegePagina(2);
    require_once('php/class.php');
    require_once('bd_funcao/maysql.php');
    require_once('php/funcao_0.2.php');



        if($id_pagamento = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
            $consulta = new consulta();
                    $consulta->campo    = 'a.id, b.nome AS nomepassaro, c.nome AS nomeetapa, d.nome AS nomepessoa, c.data_etapa, c.local, b.anilha, b.id_modalidade, c.id_temporada, d.id_clube, a.numero, d.email, d.cpf, e.valor AS valor_incricao, pgm.cod_pagamento';
                    $consulta->tabela   = "arpag_passaro_etapa AS a 
                                          INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro 
                                          INNER JOIN arpag_etapa AS c ON c.id = a.id_etapa 
                                          INNER JOIN arpag_pessoa AS d ON d.id = a.id_pessoa 
                                          INNER JOIN arpag_pagamento_passaro_etapa AS pg ON pg.id_passaro_etapa = a.id 
                                          INNER JOIN arpag_pagamento AS pgm ON pgm.id = pg.id_pagamento
                                          INNER JOIN arpag_valor_inscricao_etapa AS e ON (e.id_etapa = c.id) AND (e.id_modalidade = b.id_modalidade)";
                    $consulta->parametro= "pg.id_pagamento = ".$id_pagamento;
                    $executa = select_db($consulta);
                    $valor = 0; $nome_passaro = NULL;
                    while($linha = $executa->fetch_array()){
                        $valor = $linha['valor_incricao'] + $valor;
                        $nome_passaro .= $linha['nomepassaro']." - ";
                        $mial = $linha['email']; 
                        $nome_pessoa = $linha['nomepessoa'];
                        $cpf = $linha['cpf'];
                        $codpag = $linha['cod_pagamento'];
                    }
        }

$var =   "numCliente : '674737'
        , coopCartao : '3125'
        , chaveAcessoWeb : 'DC4CABCA-A1C5-4361-803A-DA8C0A9052F5'
        , numContaCorrente : '134520'
        , codMunicipio : '31646'
        , nomeSacado : '".strtoupper(remover_caracter($nome_pessoa))."'
        , cpfCGC : '".$cpf."'
        , dataNascimento : '20150101'
        , endereco : 'Avenida dos Inconfidentes,187'
        , bairro : 'Centro'
        , cidade : 'Guaxupe'
        , cep : '37800-000'
        , uf : 'mg'
        , telefone : '0'
        , ddd : '0'
        , ramal : '0'
        , bolRecebeBoletoEletronico : '1'
        , email : '".$mial."'
        , codEspDocumento : 'DM'
        , dataEmissao : '".date('Ymd')."'
        , seuNumero : '".$codpag."'
        , nomeSacador : 'Arpag'
        , numCGCCPFSacador : '09331650000194'
        , qntMonetaria : '1'
        , valorTitulo : '".formatomoeda_ponto($valor)."'
        , codTipoVencimento : '1'
        , dataVencimentoTit : '".date('Ymd', strtotime("+7 days"))."'
        , valorAbatimento : '0'
        , bolAceite : '1'
        , percTaxaMulta : '0'
        , dataPrimDesconto : ''
        , dataSegDesconto : ''
        , descInstrucao1 : 'pagamento de ".$nome_passaro." inscritos'"; 

//echo $var;

?>
<html>
            <body>
            <!-- As casas decimais devem ser separadas por ponto(.) Ex.: 1556.23 (Um mil e quinhentos e cinquenta e seis e vinte e três) -->
            <!-- Os campos de data devem ser preenchidos no padrão americano(aaaaMMdd) sem caractéres especiais. Ex.: 19840206 equivalente a (06/02/1984) -->
            
            <form method="post" action="https://geraboleto.sicoobnet.com.br/geradorBoleto/GerarBoleto.do" target="blank">
              <table width="100%" border="0">
                <tr>
                  <td colspan="2">**Verifique os dados de tipo "hidden" para a implementação do código.</td>
                </tr>
                <tr>
                  <td width="23%"><!-- Código Cliente:--> </td>
                  <td width="77%"><input name="numCliente" type="hidden" value="674737" size="15" />
                    <!-- Coop. cartão: --><input name="coopCartao" type="hidden" value="3125" size="15" /></td>
                </tr>
                <tr>
                  <td><!-- Chave acesso web: --></td>
                  <td><input name="chaveAcessoWeb" type="hidden" value="DC4CABCA-A1C5-4361-803A-DA8C0A9052F5" size="25" /></td>
                </tr>
                <tr>
                  <td><!-- Número Conta:--></td>
                  <td><input name="numContaCorrente" type="hidden" value="134520" size="15" /></td>
                </tr>
                <tr>
                  <td><!-- Código. Município:--> </td>
                  <td><input name="codMunicipio" type="hidden" value="31646" size="15" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr bgcolor="#CCCCCC">
                  <td colspan="2" bgcolor="339999"><strong>Sacado</strong></td>
                </tr>
                <tr>
                  <td><div align="right">Nome: </div></td>
                  <td><input size="25" maxlength="50" name="nomeSacado" type="text" value="<?php echo strtoupper(remover_caracter($nome_pessoa));?>" /></td>
                </tr>
                <tr>
                  <td><div align="right">CPF/CNPJ:
                      
                  </div></td>
                  <td><input size="10" maxlength="14" name="cpfCGC" type="text" value="<?php echo $cpf;?>"  />
                    Data de nascimento:
                      <input name="dataNascimento" type="text" size="5" value="20150101"  /></td>
                </tr>
                <tr>
                  <td><div align="right">Endereço: </div></td>
                  <td><input size="15" maxlength="20" name="endereco" type="text"  value="Avenida dos Inconfidentes,187" />
                    Bairro:
                      <input size="10" maxlength="15" name="bairro" type="text" value="CENTRO"  /></td>
                </tr>
                <tr>
                  <td><div align="right">Cidade:</div></td>
                  <td><input size="15" maxlength="15" name="cidade" type="text" value="GUAXUPE" />
                    <input size="8" maxlength="8" name="cep" type="text" value="37800000"  />
                    UF:
                    <input size="5" maxlength="2" name="uf" type="text" value="MG"  /></td>
                </tr>
                <tr>
                  <td><div align="right">Telefone:</div></td>
                  <td><input name="telefone" type="text" size="10"  value="0" /> 
                  DDD: 
                  <input name="ddd" type="text" size="5" value="35" value="0" />
                  Ramal: 
                  <input name="ramal" type="text" size="5" value="" /></td>
                </tr>
                <tr>
                  <td><!-- Recebe email: --> </td>
                  <td><input name="bolRecebeBoletoEletronico" type="hidden" value="1" size="3" /></td>
                </tr>
                <tr>
                  <td><div align="right">Email:</div></td>
                  <td><input name="email" type="text" size="25" value="<?php echo $mial;?>" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr bgcolor="#CCCCCC">
                  <td colspan="2" bgcolor="339999"><strong>Título</strong></td>
                </tr>
                <tr>
                  <td><!-- Código espécie documento: --> </td>
                  <td><input name="codEspDocumento" type="hidden" value="DM" size="5" /></td>
                </tr>
                
                <tr>
                  <td><!-- Data emissão: --></td>
                  <td><input name="dataEmissao" type="hidden" size="5" value="<?php echo date('Ymd');?>"   /></td>
                </tr>
                <tr>
                  <td><!-- Seu número:--> </td>
                  <td><input name="seuNumero" type="hidden" size="25"  value="<?php echo $codpag;?>" /></td>
                </tr>
                <tr>
                  <td><!-- Nome sacador: --></td>
                  <td><input name="nomeSacador" type="hidden" size="25" value="Arpag"  /></td>
                </tr>
                <tr>
                  <td><!-- CGC/CPF Sacador:--></td>
                  <td><input name="numCGCCPFSacador" type="hidden" size="25" value="09331650000194"  /></td>
                </tr>
                <tr>
                  <td><!-- Quantidade Monetária: --></td>
                  <td><input name="qntMonetaria" type="hidden" size="5"  value="1"  /></td>
                </tr>
                <tr>
                  <td><!-- Valor título:--> </td>
                  <td><input name="valorTitulo" type="hidden" size="5" value="<?php echo formatomoeda_ponto($valor);?>"  /></td>
                </tr>
                <tr>
                  <td><!-- Código tipo vencimento:--></td>
                  <td><input name="codTipoVencimento" type="hidden" value="1" size="5" /></td>
                </tr>
                <tr>
                  <td><!-- Data vencimento:--></td>
                  <td><input name="dataVencimentoTit" type="hidden" size="5"  value="<?php echo date('Ymd', strtotime("+7 days"));?>"  /></td>
                </tr>
                <tr>
                  <td><!-- Valor abatimento:--></td>
                  <td><input name="valorAbatimento" type="hidden" value="0" size="5" /> 
                    <!-- Valor IOF:--><input name="valorIOF" type="hidden" value="0" size="5" /></td>
                </tr>
                <tr>
                  <td><!-- Aceite:--></td>
                  <td><input name="bolAceite" type="hidden" value="1" size="5" /></td>
                </tr>
                <tr>
                  <td><!-- Percentual taxa multa: --></td>
                  <td><input name="percTaxaMulta" type="hidden" value="0" size="5" />
                    <!-- Percentual taxa mora: --><input name="percTaxaMora" type="hidden" value="0" size="5" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><!-- Data primeiro desconto:--> </td>
                  <td><input name="dataPrimDesconto" type="hidden" size="5" />
                    <!-- Valor primeiro desconto: --><input name="valorPrimDesconto" type="hidden" value="0" size="5" /></td>
                </tr>
                <tr>
                  <td><!-- Data segundo desconto:--> </td>
                  <td><input name="dataSegDesconto" type="hidden" size="5" />
                    <!-- Valor segundo desconto:--> <input name="valorSegDesconto" type="hidden" value="0" size="5" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><!-- Instrução 1: --></td>
                  <td><input name="descInstrucao1" type="hidden" size="25" value="<?php echo "pagamento de ".$nome_passaro." inscritos"; ?>"  /></td>
                </tr>
                <tr>
                  <td><!-- Instrução 2:--></td>
                  <td><input name="descInstrucao2" type="hidden" size="25" /></td>
                </tr>
                <tr>
                  <td><!-- Instrução 4:--></td>
                  <td><input name="descInstrucao4" type="hidden" size="25" /></td>
                </tr>
                <tr>
                  <td><!-- Instrução 3: --></td>
                  <td><input name="descInstrucao3" type="hidden" size="25" /></td>
                </tr>
                <tr>
                  <td><!-- Instrução 5: --></td>
                  <td><input name="descInstrucao5" type="hidden" size="25" /></td>
                </tr>
              
                <tr>
                  <td></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td></td>
                  <td><input name="submit" type="submit" value="Gerar Boleto"></td>
                </tr>
              </table>
            </form>
            </body>
        </html>

<?php