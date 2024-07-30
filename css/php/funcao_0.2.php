<?php
//retorna o numero de inscrições na etapa modalidade
function retorna_num_incricoes_etapa_modalidade($etapa,$modalidade){
    $consulta = new consulta();
                    $consulta->campo		= 'COUNT(DISTINCT arpag_passaro_etapa.numero) n_incricao';
                    $consulta->parametro	= "arpag_passaro.id_modalidade = ".$modalidade."
                                               AND arpag_passaro_etapa.id_etapa = ".$etapa;
                    $consulta->tabela	    = 'arpag_passaro_etapa
                                               INNER JOIN arpag_passaro on arpag_passaro.id = arpag_passaro_etapa.id_passaro';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['n_incricao'];
}

// retorna lista sub-modalidade
function verifica_sub_modalidade($selecionado){
    $consulta = new consulta();
                    $consulta->campo	= 'id, nome';
                    $consulta->parametro	= 'nome';
                    $consulta->tabela	= 'arpag_sub_modalidade';
    echo $consulta->campo."-".$consulta->tabela."-".$consulta->parametro;
    $lista = select_db_2($consulta);
    $retorno = false;
    $retorno .= "<option value=".cript(0).">Não tem Sub-Modalidade</option>"; 
    while($list = $lista->fetch_array()){
        if ($selecionado == $list['id'])
            $retorno .= "<option value=".cript($list['id'])." selected>".$list['nome']."</option>";   
        else 
          $retorno .= "<option value=".cript($list['id']).">".$list['nome']."</option>";
    }
    echo  $retorno;
}

//retorna tipo modalidade da etapa
function retorna_tipo_modalidade_etapa($etapa){
    $consulta = new consulta();
                    $consulta->campo		= 'id_tipo_modalidade';
                    $consulta->parametro	= "id = ".$etapa;
                    $consulta->tabela	    = 'arpag_etapa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['id_tipo_modalidade'];
}


//retorna o nome da pontuação
function retorna_nome_max_estacas($idmod,$etapa){
    $consulta = new consulta();
                    $consulta->campo		= 'arpag_valor_inscricao_etapa.n_estacas';
                    $consulta->parametro	= "arpag_valor_inscricao_etapa.id_modalidade = ".$idmod." 
                                               AND arpag_valor_inscricao_etapa.id_etapa = ".$etapa;
                    $consulta->tabela	    = 'arpag_valor_inscricao_etapa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['n_estacas'];
}


//retorna tipo da etapa
function retorna_tipo_estaca($etapa){
    $consulta = new consulta();
    $consulta->campo		= 'tipo_estaca';
    $consulta->parametro	= "id = ".$etapa;
    $consulta->tabela	    = 'arpag_etapa';
$lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['tipo_estaca'];
}

//retorna o nome da pontuação
function retorna_nome_pontuacao($idmod,$etapa){
    $consulta = new consulta();
                    $consulta->campo		= 'arpag_pontuacao.nome ';
                    $consulta->parametro	= "arpag_valor_inscricao_etapa.id_modalidade = ".$idmod." 
                                               AND arpag_valor_inscricao_etapa.id_etapa = ".$etapa;
                    $consulta->tabela	    = 'arpag_valor_inscricao_etapa
                                               INNER JOIN arpag_pontuacao ON arpag_pontuacao.id = arpag_valor_inscricao_etapa.id_pontuacao';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['nome'];
}


// retorna vetor de pontuação
function retorna_vetor_pontucao($id_etapa,$id_modalidade){
    $consulta = new consulta();
                    $consulta->campo	= 'arpag_pontuacao.sequencia';
                    $consulta->parametro= "arpag_valor_inscricao_etapa.id_modalidade = ".$id_modalidade."
                                           AND arpag_valor_inscricao_etapa.id_etapa = ".$id_etapa;
                    $consulta->tabela	= 'arpag_pontuacao
                                            INNER JOIN arpag_valor_inscricao_etapa 
                                            ON arpag_valor_inscricao_etapa.id_pontuacao = arpag_pontuacao.id ';
   //echo $consulta->campo."-".$consulta->tabela."-".$consulta->parametro;
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    $vetor = explode(",",$list['sequencia']);
    return $vetor;
}

// retorna option de pontuacao
function retorna_pontucao(){
    $consulta = new consulta();
    $consulta->campo	= 'id, nome';
    $consulta->parametro	= 'nome';
    $consulta->tabela	= ' arpag_pontuacao';
    $lista = select_db_2($consulta);
    $retorna = '';
    while($list = $lista->fetch_array()){ 
       $retorna .= "<option value='".cript($list['id'])."'>".$list['nome']."</option>"; 
    }
    return $retorna;
}

// retorna option de pontuacao com selected 
function retorna_pontucao_selected($pontuacao){
    $consulta = new consulta();
    $consulta->campo	= 'id, nome';
    $consulta->parametro	= 'nome';
    $consulta->tabela	= ' arpag_pontuacao';
    $lista = select_db_2($consulta);
    $retorna = '';
    while($list = $lista->fetch_array()){         
       $retorna .= "<option value='".cript($list['id'])."'";
       if ($pontuacao == $list['id']) $retorna .= " selected "; 
       $retorna .= ">".$list['nome']."</option>"; 
    }
    return $retorna;
}

//Verifica se j� existe anilha
function verif_exite_anilha($anilha){
    $consulta = new consulta();
        $consulta->campo      = '1';
        $consulta->parametro  = "anilha_n = ".$anilha;
        $consulta->tabela     = 'arpag_passaro';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    if($list[0] == 1)return true;
    else return false;
}

//Verifica usuario bloqueado
 // Retorna true caso o  usu�rio esteja inadimplente 
function verif_usuario_bloqueio($idusuario){
    $consulta = new consulta();
        $consulta->campo      = 'ativo';
        $consulta->parametro  = "id = ".dcript($idusuario,'falha usuario sessao verifica bloqueio');
        $consulta->tabela     = 'arpag_pessoa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    if($list['ativo'] == 1)return true;
    else return false;
}

//formatar compo hora 
function formata_tempo($tempo){
    $tempo = str_pad($tempo, 6, "0", STR_PAD_LEFT);
    $mil = substr($tempo, -2);
    $seg = substr($tempo, -4, -2);
    $min = substr($tempo,-6, -4);
    return $min.":".$seg.":".$mil;
}

//formatar compo decimal 
function formata_decimal($numero){
    $numero = str_pad($numero, 4, "0", STR_PAD_LEFT);
    $decimal = substr($numero, -2);
    $inteiro = substr($numero, 0, 2);
    return $inteiro.",".$decimal;
}

//formatar compo inteiro 
function formata_inteiro($numero){
    $numero = str_pad($numero, 4, "0", STR_PAD_LEFT);
    return $numero;
}

/*function ($p){
    return $p;

}
function ($p){
    return $p;

}*/
//retorna se ja existe algun p�ssaro inscrito namodalidade
function retorna_ex_pass_mod($id){
    $consulta = new consulta();
        $consulta->campo      = 'id';
        $consulta->parametro  = 'id_modalidade = '.$id;
        $consulta->tabela     = 'arpag_passaro';
        $lista  = select_db($consulta);
        $list = $lista->fetch_array();
    if($list['id']) return false;
    else return true;
}

function data_pt_br($dt){
    $dia = substr($dt,0,2);
    $mes = substr($dt,3,2);
    $ano = substr($dt,6,4);
    $data = $ano."-".$mes."-".$dia;
  return $data;
}
//retorna nome ao receber CPF  
function retorna_cpf_nome($cpf){
    $consulta = new consulta();
                    $consulta->campo      = 'nome';
                    $consulta->parametro  = 'cpf = '.$cpf;
                    $consulta->tabela     = 'arpag_pessoa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['nome'];
}
//retorna nome ao receber CPF  
function retorna_nome_id_cpf($cpf){
                $consulta = new consulta();
                                $consulta->campo      = 'nome, id';
                                $consulta->parametro  = 'cpf = '.$cpf;
                                $consulta->tabela     = 'arpag_pessoa';
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return "ID: ".$list['id']." - Nome:".$list['nome'];
}


//Fun��o que verifica se a inscri��o true para aberta, false para fechada 
function v_insc_aberta($id_etapa){
    $lista = new consulta();
        $lista->campo       = 'status';
        $lista->parametro   = "id = ".$id_etapa." and status = 0";
        $lista->tabela      = 'arpag_etapa';

    $consulta = select_db($lista);
    if($consulta->fetch_array()) return true;
    else return false;

  }

//fun��o retorna a modalidade
function retorna_mod($cod){
    $consulta = new consulta();
                    $consulta->campo        = 'a.id';
                    $consulta->parametro    = "b.id = ".$cod;
                    $consulta->tabela       = 'arpag_passaro AS b INNER JOIN arpag_modalidade AS a ON a.id = b.id_modalidade ';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return $list['id'];
}


//Fun��o que verifica se a inscri��o em aberto retorna true ou false
function insc_aberta(){
    $lista = new consulta();
        $lista->campo       = 'count(a.id)';
        $lista->parametro   = "b.fechada <> 2 AND a.data_etapa >='". date('Y-m-d')."' AND b.fechada = 0 GROUP BY a.id";
        $lista->tabela      = 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';

    $consulta = select_db($lista);
    if($consulta->fetch_array()) return true;
    else return false;

  }
// Retorna true  para cpf correto 
function verif_cpf($idusuario){
    $consulta = new consulta();
        $consulta->campo      = 'cpf';
        $consulta->parametro  = "id = ".dcript($idusuario,'falha usuario sessao');
        $consulta->tabela     = 'arpag_pessoa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    return validaCPF($list['cpf']);
}

// Retorna true caso o  usu�rio esteja inadimplente 
function verif_inadimp($idusuario){
    $consulta = new consulta();
        $consulta->campo      = 'arpag_pagamento.id ';
        $consulta->parametro  = "DATE_ADD(arpag_pagamento.data_gerado, INTERVAL 3 DAY) <= '".date('Y-m-d 00:00:00')."' 
                                AND arpag_pagamento.status_transacao < 3 AND arpag_pessoa.id = ".dcript($idusuario,'falha usuario sessao')."
                                AND arpag_etapa.status = 1";
        $consulta->tabela     = 'arpag_pagamento 
                                    INNER JOIN arpag_pagamento_passaro_etapa ON arpag_pagamento_passaro_etapa.id_pagamento = arpag_pagamento.id 
                                    INNER JOIN arpag_passaro_etapa ON arpag_passaro_etapa.id = arpag_pagamento_passaro_etapa.id_passaro_etapa 
                                    INNER JOIN arpag_pessoa ON arpag_pessoa.id = arpag_passaro_etapa.id_pessoa
                                    INNER JOIN arpag_etapa ON arpag_etapa.id = arpag_passaro_etapa.id_etapa';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    if($list['id'])return true;
    else return false;

}

//verifica status do pagamento apartir do id da movimenta��o 
function status_mov_arqu($cod){
    $consulta = new consulta();
        $consulta->campo      = 'status_pag';
        $consulta->parametro  = 'mov = '.$cod;
        $consulta->tabela     = 'arpag_movimentacao_status_pgto';
    $lista = select_db($consulta);
    $list = $lista->fetch_array();
    if($list['status_pag'])return $list['status_pag'];
    else return '';
}

//verifica se o estatus de pagamento da incri��o
function verifica_pagamento($incricao){
    $consulta = new consulta();
        $consulta->campo  = 'a.status_transacao, c.imagem, a.cod_pagamento, c.nome ';
        $consulta->tabela = "arpag_pagamento AS a
                                      INNER JOIN arpag_pagamento_passaro_etapa AS b ON  b.id_pagamento = a.id
                                      INNER JOIN arpag_status_pagseguro AS c ON c.cod = a.status_transacao";
        $consulta->parametro= "b.id_passaro_etapa = ".$incricao;
    $executa = select_db($consulta);
    $linha = $executa->fetch_array();
    return $linha;
}

//Cria um pagamento na tabela de arpag_pagamento, retorna o id desse pagamento 
function gera_pagamento(){
  $pagamento = new procid(); 
                $pagamento->nome = 'arpag_p_criapagamento()';               
                if($id_pagamento = exec_procidure($pagamento)){
                    $linha = $id_pagamento->fetch_array();
                    return $linha['@idpag'];
                }else ("<p class='alert-danger'>Erro ao criar pagamento</p>"); 
}
// calcula a nota dos participantes 
  function valor_pontuacao($idetapa){

  $consulta = new consulta();
        $consulta->campo  = 'valor';
        $consulta->tabela = "arpag_etapa AS a
                                      INNER JOIN arpag_temporada AS b ON  b.id = a.id_temporada
                                      INNER JOIN arpag_nota_temporada AS c ON c.id_temporada = a.id_temporada";
        $consulta->parametro= "b.fechada <> 2 AND a.id = ".$idetapa;
  $executa = select_db($consulta);
  $linha = $executa->fetch_array();
  return $linha['valor'];
  }
// regra para escolhar estaca na incricao
  function excolhe_inicio($idpessoa,$idmoda,$numero_de_incricao){

    $excolher_ini   = new consulta();
            $excolher_ini->campo    = 'COUNT(*)';
            $excolher_ini->tabela   = 'arpag_passaro';
            $excolher_ini->parametro  = "id_pessoa = ".$idpessoa." AND id_modalidade = ".$idmoda;
    $excolher_exe     = select_db($excolher_ini);
    $excolher_result  = $excolher_exe->fetch_array();
    if($excolher_result[0] < 2) return mt_rand(1,40+$numero_de_incricao);
    else if($excolher_result[0] < 3) return mt_rand(1,20+$numero_de_incricao);
    else if($excolher_result[0] < 5) return mt_rand(1,10+$numero_de_incricao);
    else if($excolher_result[0] < 7) return mt_rand(1,5+$numero_de_incricao);
    else return mt_rand(1,3);

  }

  function tira_caracter($palavra){
      $characteres = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', ' '=> '_'
      );
      return strtr($palavra, $characteres);
  }

    function tira_monetario($palavra){
      $characteres = array(
          'R'=>'', '$'=>'','.'=>''
      );
      return str_replace(',', '.', strtr($palavra, $characteres));
  }

 //lista as modalidade de uma etapa
function busca_modalidade_etapa($idetapa){
    $buscar_modalidade =  new consulta();
      $buscar_modalidade->campo     = ' arpag_modalidade.id,
                                        arpag_modalidade.nome,
                                        COALESCE(arpag_valor_inscricao_etapa.id_pontuacao, 0) id_pontuacao,
                                        COALESCE(arpag_valor_inscricao_etapa.valor, 0) valor,         
                                        arpag_valor_inscricao_etapa.n_estacas,       
                                        arpag_valor_inscricao_etapa.n_estacas2';
      $buscar_modalidade->tabela    = "arpag_modalidade
                                        LEFT JOIN arpag_valor_inscricao_etapa 
                                            ON arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id  
                                            AND arpag_valor_inscricao_etapa.id_etapa = ".$idetapa;
      $buscar_modalidade->parametro = 'arpag_modalidade.ativo = 1';
    return  select_db($buscar_modalidade);

  } 

//lista as modalidade 
function busca_modalidade(){
    $buscar_modalidade =  new consulta();
      $buscar_modalidade->campo     = 'id, nome';
      $buscar_modalidade->tabela    = 'arpag_modalidade';
      $buscar_modalidade->parametro = 'ativo = 1 ORDER BY nome';
    return  select_db($buscar_modalidade);

  }

//retorna vetor de numeros que não podem ser escolhido (mesmo proprietario)
function numeros_inscrocoes_nao_usados($etapa,$idmoda,$idpessoa,$num_escritos,$num_maximo) {
    $vetor_retorno = array();
    $numero_inscri = new consulta();
            $numero_inscri->campo     = 'arpag_passaro_etapa.numero';
            $numero_inscri->tabela    = 'arpag_passaro_etapa
                                        INNER JOIN arpag_passaro ON arpag_passaro.id = arpag_passaro_etapa.id_passaro ';
            $numero_inscri->parametro = "arpag_passaro_etapa.id_etapa = ".$etapa."
                                        AND arpag_passaro.id_modalidade = ".$idmoda."
                                        AND arpag_passaro_etapa.id_pessoa = ".$idpessoa;
    $resultado_ni   = select_db($numero_inscri);
    $vetor = array();
    while($result_ni  = $resultado_ni->fetch_array()){
        $vetor[] = $result_ni['numero'];      
    };
    if (count($vetor)==0) return $vetor_retorno;

    $temp_cont = 5;
    while($temp_cont > 0){
        if(($num_escritos+(count($vetor)*(($temp_cont*2)+1))-count($vetor)) < $num_maximo) break;
        $temp_cont--;
    }
     
    foreach ($vetor as $key => $value) {
        for($i = ($value-$temp_cont); $i <= ($value+$temp_cont); $i++){
            if ($i>0) $vetor_retorno[] = $i;
        }
    }    
    return$vetor_retorno;    
}


//regra para escolher numero de estaca na inscrição nova
function numero_inscricao_novo2($nome,$idmoda,$idpessoa){

    $numero_inscri  = new consulta();
            $numero_inscri->campo     = 'arpag_valor_inscricao_etapa.n_estacas, arpag_valor_inscricao_etapa.n_estacas2,
                                        (select COUNT(*) 
                                        from arpag_passaro_etapa 
                                            INNER JOIN arpag_passaro ON arpag_passaro.id = arpag_passaro_etapa.id_passaro              
                                        WHERE arpag_passaro_etapa.id_etapa = arpag_valor_inscricao_etapa.id_etapa
                                            and arpag_passaro.id_modalidade = arpag_valor_inscricao_etapa.id_modalidade) numero_inscritos';
            $numero_inscri->tabela    = 'arpag_valor_inscricao_etapa';
            $numero_inscri->parametro = "arpag_valor_inscricao_etapa.id_modalidade = ".$idmoda."
                                            AND arpag_valor_inscricao_etapa.id_etapa = ".$nome;
    //echo "<br />select ".$numero_inscri->campo." FROM ".$numero_inscri->tabela." where ".$numero_inscri->parametro;
    $resultado_ni   = select_db($numero_inscri);
    $result_ni  = $resultado_ni->fetch_array();
    
    $intervalo_sorteio_ini = 0;
    $intervalo_sorteio_fim = 0;
    if ($result_ni['n_estacas'] > $result_ni['numero_inscritos']){
        $intervalo_sorteio_ini = 1;
        $intervalo_sorteio_fim = $result_ni['n_estacas'];
    }else if (($result_ni['n_estacas'] + $result_ni['n_estacas2']) > $result_ni['numero_inscritos']){
        $intervalo_sorteio_ini = $result_ni['n_estacas'];
        $intervalo_sorteio_fim = $result_ni['n_estacas']+$result_ni['n_estacas2'];
    }else{
        echo "<p class='alert-danger'>O Sistema atingiu o limite de ".$result_ni['n_estacas'] + $result_ni['n_estacas2']." Inscrições.</p>";
        exit;
    }
    
    $vetor_pesso = array();
    $vetor_pesso = numeros_inscrocoes_nao_usados($nome,$idmoda,$idpessoa,$result_ni['numero_inscritos'],$intervalo_sorteio_fim);
    
    $verificar = new consulta();
    $verificar->campo       = 'a.numero';
    $verificar->tabela      = 'arpag_passaro_etapa AS a
                  INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
    $verificar->parametro   = "a.id_etapa = ".$nome. " AND b.id_modalidade = ".$idmoda ." ORDER BY numero";

    //echo "<br />select ". $verificar->campo ." FROM ".$verificar->tabela." where ".$verificar->parametro;
    $executa_ver = select_db($verificar);

    $vetor_numeros = Array();

    //carrega o vetor vetor_numero com os numeros que já estão sendo usados
    while($linha_ex = $executa_ver->fetch_array()){
        if($linha_ex['numero'] > 0) $vetor_numeros[] = $linha_ex['numero'];
    }   

    $vetor_numeros_escolha = Array();
    for ($i = $intervalo_sorteio_ini; $i <= $intervalo_sorteio_fim; $i++){
        if((!in_array($i, $vetor_numeros)) && (!in_array($i,$vetor_pesso))){
            $vetor_numeros_escolha[] = $i;
        }
    }
    return $vetor_numeros_escolha[mt_rand(0,(count($vetor_numeros_escolha)-1))];  
  }


//regra para escolher numero de estaca na inscrição nova
function numero_inscricao_novo($nome,$idmoda,$idpessoa){

    $numero_inscri  = new consulta();
            $numero_inscri->campo     = 'arpag_valor_inscricao_etapa.n_estacas, arpag_valor_inscricao_etapa.n_estacas2,
                                        (select COUNT(*) 
                                        from arpag_passaro_etapa 
                                            INNER JOIN arpag_passaro ON arpag_passaro.id = arpag_passaro_etapa.id_passaro              
                                        WHERE arpag_passaro_etapa.id_etapa = arpag_valor_inscricao_etapa.id_etapa
                                            and arpag_passaro.id_modalidade = arpag_valor_inscricao_etapa.id_modalidade) numero_inscritos';
            $numero_inscri->tabela    = 'arpag_valor_inscricao_etapa';
            $numero_inscri->parametro = "arpag_valor_inscricao_etapa.id_modalidade = ".$idmoda."
                                            AND arpag_valor_inscricao_etapa.id_etapa = ".$nome;
    //echo "<br />select ".$numero_inscri->campo." FROM ".$numero_inscri->tabela." where ".$numero_inscri->parametro;
    $resultado_ni   = select_db($numero_inscri);
    $result_ni  = $resultado_ni->fetch_array();
    
    $intervalo_sorteio_ini = 0;
    $intervalo_sorteio_fim = 0;
    if ($result_ni['n_estacas'] > $result_ni['numero_inscritos']){
        $intervalo_sorteio_ini = 1;
        $intervalo_sorteio_fim = $result_ni['n_estacas'];
    }else if (($result_ni['n_estacas'] + $result_ni['n_estacas2']) >= $result_ni['numero_inscritos']){
        $intervalo_sorteio_ini = $result_ni['n_estacas'];
        $intervalo_sorteio_fim = $result_ni['n_estacas']+$result_ni['n_estacas2'];
    }else{
        echo "<p class='alert-danger'>O Sistema atingiu o limite de ".$result_ni['n_estacas'] + $result_ni['n_estacas2']." Inscrições.</p>";
        exit;
    }
    
    //encotra o numero vago 
    $num_inicia = mt_rand($intervalo_sorteio_ini,$intervalo_sorteio_fim);
    $numero_escolhido = False;
    $rsultado_numero = false;
    
    //echo "<br />w  numero  - ".$num_inicia; 

    $verificar = new consulta();
          $verificar->campo       = 'a.numero';
          $verificar->tabela      = 'arpag_passaro_etapa AS a
                        INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
          $verificar->parametro   = "a.numero >= ".$num_inicia." AND a.id_etapa = ".$nome. " AND b.id_modalidade = ".$idmoda ." ORDER BY numero";
   
    //echo "<br />select ". $verificar->campo ." FROM ".$verificar->tabela." where ".$verificar->parametro;
    $executa_ver = select_db($verificar);
    $cont = $num_inicia;
    $numero = $num_inicia;

 
    //descobre qual numero vago para iniciar ma nova inscri��o
    while($linha_ex = $executa_ver->fetch_array()){
        $numero_escolhido = True;
       // echo "<br />numero banco / ecolha".$linha_ex['numero']." / ".$cont; 
        if($linha_ex['numero'] != $cont){ 
            //echo "<br />excolha -> ".$cont;
            return $cont; 
        }
       else{ $numero = $cont+1;$cont++;}
    }
    
    if(!$numero_escolhido) return $num_inicia;
    else if($numero <= $intervalo_sorteio_fim) return $numero;
    //caso não encontra o numero faz o processo ao contrário    
    //echo "<br />while 2 "; 
    $verificar = new consulta();
        $verificar->campo       = 'a.numero';
        $verificar->tabela      = 'arpag_passaro_etapa AS a
                        INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
        $verificar->parametro   = "a.numero < ".$num_inicia." AND a.id_etapa = ".$nome. " AND b.id_modalidade = ".$idmoda ." ORDER BY numero DESC";
    $executa_ver = select_db($verificar);
    $cont = $num_inicia-1;
    $numero = $num_inicia-1;
    //echo "<br />select ".$verificar->campo." FROM ".$verificar->tabela." where ".$verificar->parametro;
    //descobre qual numero vago para iniciar ma nova inscri��o
    while($linha_ex = $executa_ver->fetch_array()){
        $numero_escolhido = True;
        //echo "<br />numero banco / ecolha".$linha_ex['numero']." / ".$cont; 
        if($linha_ex['numero'] != $cont){ 
           // echo "<br />excolha -> ". $cont;
            return $cont; 
        }
        else{ $numero = $cont-1;$cont--;}
    }
    
    if($numero > 0) return $numero;    
    echo "<p class='alert-danger'>Erro do sistema para escolher número da estaca ".$num_inicia."</p>";
    exit;
       
  }

  
//regra para escolher numero de estaca na inscrição
  function numero_inscricao($nome,$idmoda,$idpessoa){

    $numero_inscri  = new consulta();
            $numero_inscri->campo     = 'COUNT(*)';
            $numero_inscri->tabela    = "arpag_passaro_etapa AS a
                            INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro";
            $numero_inscri->parametro = "a.id_etapa = ".$nome. "
                            AND b.id_modalidade = ".$idmoda;
    $resultado_ni   = select_db($numero_inscri);
    $result_ni  = $resultado_ni->fetch_array();

    $numero_de_incricao = $result_ni[0];

    $verifica_pass_pess = new consulta();
                $verifica_pass_pess->campo    = 'MAX(a.numero)';
                $verifica_pass_pess->tabela   = "arpag_passaro_etapa AS a
                                  INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro";
                $verifica_pass_pess->parametro  = "a.id_etapa = ".$nome. "
                                  AND b.id_modalidade = ".$idmoda ."
                                  AND b.id_pessoa = ".$idpessoa;
    $resultado_ver = select_db($verifica_pass_pess);
    $result_ver = $resultado_ver->fetch_array();
    if(($result_ver[0]) != null) $num_inicia = $result_ver[0] + mt_rand(8,13);
    else $num_inicia = excolhe_inicio($idpessoa,$idmoda,$numero_de_incricao);
    //echo "<br />".$num_inicia."<br />".$result_ver[0]."<br />";
    //verifica o numero no bd
    $verificar = new consulta();
          $verificar->campo       = 'a.numero';
          $verificar->tabela      = 'arpag_passaro_etapa AS a
                        INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
          $verificar->parametro   = "a.numero >= ".$num_inicia." AND a.id_etapa = ".$nome. " AND b.id_modalidade = ".$idmoda ." ORDER BY numero";
    $executa_ver = select_db($verificar);
    $cont = $num_inicia;
    $numero = $num_inicia;
    //descobre qual numero vago para iniciar ma nova inscri��o
    while($linha_ex = $executa_ver->fetch_array()){
      if($linha_ex['numero'] != $cont){ $numero = $cont; break;}
      else{ $numero = $cont+1;$cont++;}

    }
    //echo "<br />".$numero."<br />";
    return $numero;
  }

//retorna estatus de uma tabela 
function retorna_status($id,$tabela){
                $consulta = new consulta();
                                $consulta->campo      = 'status';
                                $consulta->parametro  = 'id = '.$id;
                                $consulta->tabela     = $tabela;
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return $list['status'];
}

//recebe o id do p�ssaro e retorna se ele est� inscrito em alguam estapa futura 
function retorna_passaro_incrito($id){
                $consulta = new consulta();
                                $consulta->campo      = 'a.id';
                                $consulta->parametro  = "a.id_passaro = ".$id." AND b.status < 2";
                                $consulta->tabela     = 'arpag_passaro_etapa as a
                                                          INNER JOIN arpag_etapa as b ON b.id = a.id_etapa';
                $lista  = select_db($consulta);
                $list = $lista->fetch_array();
                if($list['id']) return true;
                else return false;
}

//rebe um numero de erro do mysql e retorna uma mensagem, cadastrada na tanela de erros
function erro_bd($numero){
                $consulta = new consulta();
                                $consulta->campo        = 'mensagem';
                                $consulta->parametro    = 'numero = '.$numero;
                                $consulta->tabela       = 'arpag_errosbd';
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                if($list['mensagem'])return ("<p class='alert-danger'>".$list['mensagem'].". Numero do erro:".$numero."</p>");
                else return "<p class='alert-danger'>Erro no Banco de Dados nao cadastrdo no sistema, numero: ".$numero."</p>";
}

//recebe o id e tabela e retorna o compo nome da mesma 
function retorna_nome($id,$tabela){
                $consulta = new consulta();
                                $consulta->campo		= 'nome';
                                $consulta->parametro	= 'id = '.$id;
                                $consulta->tabela	    = $tabela;
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return $list['nome'];
}

//recebe o id e retorna imagem  
function retorna_imagem($cod,$tabela){
                $consulta = new consulta();
                                $consulta->campo        = 'imagem';
                                $consulta->parametro    = 'cod = '.$cod;
                                $consulta->tabela       = $tabela;
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return $list['imagem'];
}

//recebe o id e retorna imagem  
function retorna_imagem2($cod,$tabela){
                $consulta = new consulta();
                                $consulta->campo        = 'imagem2';
                                $consulta->parametro    = 'cod = '.$cod;
                                $consulta->tabela       = $tabela;
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return $list['imagem2'];
}

// retorna lista de modalidade de passaros 
function verifica_etapa($id_etapa){
                $consulta = new consulta();
                                $consulta->campo	= 'arpag_modalidade.id, 
                                                       arpag_modalidade.nome, 
                                                       arpag_modalidade.pontuacao';
                                $consulta->parametro	= "arpag_valor_inscricao_etapa.id_etapa = ".$id_etapa;
                                $consulta->tabela	= 'arpag_modalidade
                                                       INNER JOIN arpag_valor_inscricao_etapa ON 
                                                       arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id';
               //echo $consulta->campo."-".$consulta->tabela."-".$consulta->parametro;
                $lista = select_db($consulta);
                $vetor[1][1] = '';
                $vetor[1][2] = '';
                $vetor[1][3] = '';
                $i = 1;
                while($list = $lista->fetch_array()){
                                $vetor[$i][1] = $list['id'];
                                $vetor[$i][2] = ($list['nome']);
                                $vetor[$i][3] = $list['pontuacao'];
                                $i++;
                }
                return $vetor;
}

// retorna lista de temporada passaro
function verifica_temporada($id_temporada){
    $consulta = new consulta();
                    $consulta->campo	= ' DISTINCT arpag_modalidade.id, 
                                            arpag_modalidade.nome, 
                                            arpag_modalidade.pontuacao';
                    $consulta->parametro	= "arpag_etapa.id_temporada = ".$id_temporada;
                    $consulta->tabela	= ' arpag_modalidade
                                            INNER JOIN arpag_valor_inscricao_etapa ON arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id
                                            INNER JOIN arpag_etapa ON arpag_etapa.id = arpag_valor_inscricao_etapa.id_etapa';
   //echo $consulta->campo."-".$consulta->tabela."-".$consulta->parametro;
    $lista = select_db($consulta);
    $i = 1;
    $vetor = array();
    while($list = $lista->fetch_array()){
                    $vetor[$i][1] = $list['id'];
                    $vetor[$i][2] = ($list['nome']);
                    $vetor[$i][3] = $list['pontuacao'];
                    $i++;
    }
    return $vetor;
}
function email_via($para,$contato,$mensagem,$headers){
                $paraa = "dujoseaugusto@gmail.com";
                $pagian = "Mensagem";
                mail($paraa,$contato,$pagian,$headers);
                //$envia =  mail($para,$contato,$pagian,$headers);
                //if(!$envia)echo "<script>alert (\"Email n�o foi enviado !!!!\");</script>";
}

function servernamber($valor){
    $valor = substr($valor, -3, 1);
    switch($valor){
        case 0:
            $valor = 3546115;
            break;
        case 1:
            $valor = 2678742;
            break;
        case 2:
            $valor = 6321597;
            break;
        case 3:
            $valor = 2154755;
            break;
        case 4:
            $valor = 3145452;
            break;
        case 5:
            $valor = 4715718;
            break;
        case 6:
            $valor = 1357456;
            break;
        case 7:
            $valor = 2456329;
            break;
        case 8:
            $valor = 3351286;
            break;
        case 9:
            $valor = 4486212;
            break;

        default:
            echo "Erro";

    }
    return $valor;

}
//echo servernamber("gegerger1ft") . "<br>";
function invertnum($valor){
    $strin = array(0=>"a",1=>"c",2=>"m",3=>"j",4=>"x",5=>"p",6=>"q",7=>"t",8=>"e",9=>"r");
    $valor = $strin[$valor];
return $valor;
}
function desinvertnum($valor){
    $strin = array("a"=>0,"c"=>1,"m"=>2,"j"=>3,"x"=>4,"p"=>5,"q"=>6,"t"=>7,"e"=>8,"r"=>9);
    $valor = $strin[$valor];
return $valor;
}

function cript($valor){   
    $vl = substr(date("s"),1,1) . invertnum(str_replace(".","2", substr(gettimeofday("s"),-1))) . invertnum(str_replace(".","2", substr(gettimeofday("s"),-2, -1)));

    if($valor < 1000){
        $valor = $valor * servernamber($vl);
        $tip   = "4";
    }
    else if($valor > 999999999){
        $valor = $valor;
        $tip   = "7";
    }
    else{
        $valor = $valor + servernamber($vl);
        $tip   = "9";
    }

    $valor = "$valor";

    
    if(isset($valor[1]))$valor[1]  =  invertnum($valor[1]);
    if(isset($valor[3]))$valor[3]  =  invertnum($valor[3]);
    if(isset($valor[7]))$valor[7]  =  invertnum($valor[7]);
    if(isset($valor[4]))$valor[4]  =  invertnum($valor[4]);
    if(isset($valor[6]))$valor[6]  =  invertnum($valor[6]);
    if(isset($valor[10]))$valor[10] =  invertnum($valor[10]);
    if(isset($valor[11]))$valor[11] =  invertnum($valor[11]);
    if(isset($valor[13]))$valor[13] =  invertnum($valor[13]);
    if(isset($valor[15]))$valor[15] =  invertnum($valor[15]);
    if(isset($valor[17]))$valor[17] =  invertnum($valor[17]);
    if(isset($valor[21]))$valor[21] =  invertnum($valor[21]);
    if(isset($valor[22]))$valor[22] =  invertnum($valor[22]);
    if(isset($valor[23]))$valor[23] =  invertnum($valor[23]);
    if(isset($valor[27]))$valor[27] =  invertnum($valor[27]);
    if(isset($valor[30]))$valor[30] =  invertnum($valor[30]);
    if(isset($valor[32]))$valor[32] =  invertnum($valor[32]);
    if(isset($valor[33]))$valor[33] =  invertnum($valor[33]);


    $valor =  "$valor$tip$vl";
    $valor =  $valor  = str_replace(" ","",$valor );
    return $valor;
}
function dcript($valor, $erro){
    if($valor == null){echo $erro; exit;}
    $val = substr($valor, -3, 3);
    $va = substr($valor, -4, 1);
    $valor = substr($valor, 0, -4);
    $valor = "$valor";
    if(isset($valor[1]))$valor[1] =  desinvertnum($valor[1]);
    if(isset($valor[3]))$valor[3] =  desinvertnum($valor[3]);
    if(isset($valor[7]))$valor[7] =  desinvertnum($valor[7]);
    if(isset($valor[4]))$valor[4] =  desinvertnum($valor[4]);
    if(isset($valor[6]))$valor[6] =  desinvertnum($valor[6]);
    if(isset($valor[10]))$valor[10] =  desinvertnum($valor[10]);
    if(isset($valor[11]))$valor[11] =  desinvertnum($valor[11]);
    if(isset($valor[13]))$valor[13] =  desinvertnum($valor[13]);
    if(isset($valor[15]))$valor[15] =  desinvertnum($valor[15]);
    if(isset($valor[17]))$valor[17] =  desinvertnum($valor[17]);
    if(isset($valor[21]))$valor[21] =  desinvertnum($valor[21]);
    if(isset($valor[22]))$valor[22] =  desinvertnum($valor[22]);
    if(isset($valor[23]))$valor[23] =  desinvertnum($valor[23]);
    if(isset($valor[27]))$valor[27] =  desinvertnum($valor[27]);
    if(isset($valor[30]))$valor[30] =  desinvertnum($valor[30]);
    if(isset($valor[32]))$valor[32] =  desinvertnum($valor[32]);
    if(isset($valor[33]))$valor[33] =  desinvertnum($valor[33]);
    
    if($va == 4){
        $valor = $valor / servernamber($val);
    }
    else if($va == 7){
        $valor = $valor;
    }
    else{
        $valor = $valor - servernamber($val);
    }
    $valor = str_ireplace(",","",number_format($valor));

return $valor;
}
 /*
$crip = cript(9999999);
echo "$crip <br>";
$dcrip = dcript($crip);
echo "<br>$dcrip <br>";
*/
//Formato com duas casa decimais
function formatomoeda($valor){
	$valor = number_format($valor , 2, ',', '.');
	return $valor;
}
function formatomoeda_ponto($valor){
  $valor = number_format($valor , 2, '.', '.');
  return $valor;
}
/// Valida CPF
function validaCPF($cpf) {
 
    // Verifica se um n�mero foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = preg_replace('/[^0-9]/i', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados � igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequ�ncias invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF � v�lido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}


//formata CPF ou CNPJ para print
function mcpfcnpj($cpf){
	$tamanho = strlen($cpf);
	if ( $tamanho == 11){
		$l1 = substr($cpf, 0, 3);
		$l2 = substr($cpf, 3, 3);
		$l3 = substr($cpf, 6, 3);
		$l4 = substr($cpf, 9, 2);
		return "$l1.$l2.$l3-$l4";
	}
	else if ( $tamanho == 14){
		$l1 = substr($cpf, 0, 2);
		$l2 = substr($cpf, 2, 3);
		$l3 = substr($cpf, 5, 3);
		$l4 = substr($cpf, 8, 4);
		$l5 = substr($cpf, 12, 2);
		return "$l1.$l2.$l3/$l4-$l5";
	}
	else return "CPF ou CNPJ incorreto";
	}


//fun��o numero de diaas entre duas datas
function dataemnumdias($data_inicial,$data_final){


// Usa a fun��o strtotime() e pega o timestamp das duas datas:
$time_inicial = strtotime($data_inicial);
$time_final = strtotime($data_final);

// Calcula a diferen�a de segundos entre as duas datas:
$diferenca = $time_final - $time_inicial; // 19522800 segundos

// Calcula a diferen�a de dias
$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
// Exibe uma mensagem de resultado:
return $dias;
}

//FUN��O DIA �TIL
function diasemana($data) {
	$ano =  substr("$data", 0, 4);
	$mes =  substr("$data", 5, -3);
	$dia =  substr("$data", 8, 9);

	$diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

	switch($diasemana) {
		case"0": return 1;
		case"6": return 2;
		default: return 0;
	}

	echo "$diasemana";
}

//verifica feriados no ano
function dias_feriados($ano)
{
  //$ano  = 2013;

  $pascoa     = easter_date($ano); // Limite de 1970 ou ap�s 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
  $dia_pascoa = date('j', $pascoa);
  $mes_pascoa = date('n', $pascoa);
  $ano_pascoa = date('Y', $pascoa);

  $feriados = array(
    // Tatas Fixas dos feriados Nacionail Basileiras
    mktime(0, 0, 0, 1,  1,   $ano), // Confraterniza��o Universal - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 11,  30,  $ano), // Anivesario de muzambinho
    mktime(0, 0, 0, 12,  24,  2012), //
    mktime(0, 0, 0, 12,  31,  2012), //
    mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independ�ncia - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei n� 6802, de 30/06/80
    mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 11, 15,  $ano), // Proclama��o da republica - Lei n� 662, de 06/04/49
    mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei n� 662, de 06/04/49

    // These days have a date depending on easter
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2�feria Carnaval
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3�feria Carnaval
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6�feira Santa
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
  );

  sort($feriados);

  return $feriados;
}

//BLOQUEAR SQLINJECT
function trocanome($nome){
$nome  = str_replace("'","X",$nome );
$nome  = str_replace("\\","",$nome );
$nome  = str_replace("\""," ",$nome );
return $nome;
}

//M�S ESCRITO  PARA M�S NUMERO
function mesDia($mm){
switch($mm){  case "Janeiro": $me = "01";     break;
              case "Fevereiro": $me = "02";   break;
              case "Mar�o": $me = "03";       break;
              case "Abril": $me = "04";       break;
              case "Maio": $me = "05";        break;
              case "Junho": $me = "06";       break;
              case "Julho": $me = "07";       break;
              case "Agosto": $me = "08";      break;
              case "Setembro": $me = "09";    break;
              case "Outubro": $me = "10";     break;
              case "Novembro": $me = "11";    break;
              case "Dezembro": $me = "12";    break;

}
return $me;
}

//M�S NUMERO PARA M�S ESCRITO
function diaMes($mm){
 switch($mm){ case "01": $me = "Janeiro";     break;
              case "02": $me = "Fevereiro";   break;
              case "03": $me = "Mar�o";       break;
              case "04": $me = "Abril";       break;
              case "05": $me = "Maio";        break;
              case "06": $me = "Junho";       break;
              case "07": $me = "Julho";       break;
              case "08": $me = "Agosto";      break;
              case "09": $me = "Setembro";    break;
              case "10": $me = "Outubro";     break;
              case "11": $me = "Novembro";    break;
              case "12": $me = "Dezembro";    break;

}
return $me;
}

//MOSTRA M�S E ANO
function dtatelapres($data){
          $data = str_replace("-","",$data);
          $dia = substr($data, -2);
          $mes = substr($data, -5, -3);
          $ano = substr($data,0, 4);
           $me = diaMes($mes);
        $dat = "$me de $ano";
          return $dat;


}

//MOSTRA ANO
function dtatelaRpres($data){
         $data = str_replace("-","",$data);
          $dia = substr($data, -2);
          $mes = substr($data, -5, -3);
          $ano = substr($data,0, 4);
           $me = diaMes($mes);
        $dat = "$ano";
          return $dat;


}

//FORMATA DATA recebe do banco data hora
function dtatelamostra_data_hora($data,$modo){
    //2019-10-10 12:00:00
    $dia = substr($data,8,2);
    $mes = substr($data,5,2);
    $ano = substr($data,0, 4);
    $hora = substr($data,11);
    if ($modo == 'D') return $dia."/".$mes."/".$ano;
    else if ($modo == 'H') return $hora;
}

//FORMATA DATA COM O M�S ESCRITO PARA PRINT
function dtatelamostra($data){
		  $data = str_replace("-","",$data);
          $dia = substr($data, -2);
          $mes = substr($data, 4, 2);
          $ano = substr($data,0, 4);
          	if(checkdate($mes,$dia,$ano)) {
           $me = diaMes($mes);
        $dat = "$dia de $me de $ano";

          return $dat;
	}
	else {
		return 1;
	}

}

// FORMATA DATA PARA PTINT
function dtatela($data){
    $data = str_replace("-","",$data);
    $dia = substr($data, -2);
    $mes = substr($data, -4, -2);
    $ano = substr($data,0, 4);
    return "$dia/$mes/$ano";         	
}

//RETORNA ANO
function dtarpre($data){
          $dia = substr($data, -2);
          $mes = substr($data, -5, -3);
          $ano = substr($data,0, 4);
          	if(checkdate($mes,$dia,$ano)) {
        $dat = "$ano";
          return $dat;
	}
	else {
		return 1;
	}

}

// FORMATA DATA PARA O BD
function dtafor($data){
          $dia = substr($data, 0, 2);
          $mes = substr($data, -7, -5);
          $ano = substr($data,  -4);
          	if(checkdate($mes,$dia,$ano)) {
        $dat = "$ano-$mes-$dia";
          return $dat;
	}
	else {
		return 1;
	}

}

// FORMATA DATA PARA O BD vinda com a masca ddmmaa
function dtaforb($data){
          $dia = substr($data, 0, 2);
          $mes = substr($data, 2, 2);
          $ano = '20'.substr($data, 4, 2);
        $dat = "$ano-$mes-$dia 00:00";
          return $dat;
}

//fun��o para colocar ifen
function dtapcal($data){
          $dia = substr($data, 0, 2);
          $mes = substr($data, -7, -5);
          $ano = substr($data,  -4);
          	if(checkdate($mes,$dia,$ano)) {
        $dat = "$ano-$mes-$dia";
          return $dat;
	}
	else {
		return 1;
	}

}

function dtconvertbd($data){
		  $data = str_replace("-","",$data);
          $dia = substr($data, -2);
          $mes = substr($data, 4, 2);
          $ano = substr($data,0, 4);
          $dat = "$ano-$mes-$dia";
          return $dat;

}

//CONFERE LOGIN
function vlogin($login){

    $sql = "SELECT nome FROM usuario where nome = '$login'";
    $rs = mysql_query($sql);
    $lin = mysql_fetch_row($rs);
    if ($lin[0] != "")  return 1;
    else return 22;

	}


// RETORNA O PRIMEIRO ARQUIVO
function gafoto($idga){


$dn = opendir ("galeria/$idga/");

while ($file = readdir ($dn)) {
       if (($file != ".") && ($file != "..") && ($file != "Thumbs.db")){
           return $file ;


       }
}
closedir($dn);

}

//RETORNA IDADE APARTIR DE UMA DATA
function anivr($data){
        $data = str_replace("-","",$data);
        $dia = substr($data, -2);
        $mes = substr($data, -5, -3);
        $ano = substr($data,0, 4);
        $a = date("Y");
        $m = date("m");
        $d = date("d");
        $anv = $a - $ano;
        if ($m < $mes) $anv -=1;
        if ($m == $mes){
            if ($d < $dia) $anv -=1;
        }
        return $anv;
}

//RETORNA M�S E ANO PARA PRINT
function datapres($data){
        $data = str_replace("-","",$data);
        $dia = substr($data, -2);
        $mes = substr($data, -5, -3);
        $ano = substr($data,0, 4);
        $anv = "$mes/$ano";
        return $anv;
}

//RETORNA ANO PARA PRINT
function datapre($data){
        $data = str_replace("-","",$data);
        $dia = substr($data, -2);
        $mes = substr($data, -5, -3);
        $ano = substr($data,0, 4);
        $anv = "$ano";
        return $anv;
}

//RETORNA DATA E HORA PARA O PRINT
function dtahoraela($data){
          $data = str_replace("-","",$data);
          $dia = substr($data,6,2);
          $mes = substr($data,4,2);
          $ano = substr($data,0,4);
          $hora = substr($data,8,9);

          //return $data;
          return "$dia/$mes/$ano $hora";
       // $dat = "$dia/$mes/$ano";
        //  return $dat;
}
//RETORNA DATA E HORA PARA O PRINT
function dtahoraela2($data){
          $data     = str_replace("-","",$data);
          $dia      = substr($data,6,2);
          $mes      = substr($data,4,2);
          $ano      = substr($data,0,4);
          $hora     = substr($data,8,2);
          $minuto   = substr($data,11,2);

          //return $data;
          return "$dia/$mes/$ano �s $hora:$minuto:00 Horas";
       // $dat = "$dia/$mes/$ano";
        //  return $dat;
}


//calcula data, dias e valores
function calcular2($dchec, $ndia, $valor){
if(($dchec == "") || ($ndia == "") || ($valor == "")) return ("
									Prencha os campos Data, Bom Para e Valor do Cheque");

//converte a a data em numero de dias
$in = dtapcal($dchec);
$fi = dtapcal($ndia);
	if($in == 1)return ("Data do Cheque Inv�lida");
	if($fi == 1)return ("Data do Bom Para Inv�lida");
$ndia = dataemnumdias($in,$fi);

//a data final
$dt = dtapcal($dchec);

$dt = date('d/m/Y', strtotime("+$ndia days",strtotime($dt)));
$wh = 0;
While($wh == 0){
$wh = 1;
//varifica os feriados
//$ano_=date("Y");
$ano_= substr($dt, -4);
foreach(dias_feriados($ano_) as $a)
{
 $dat = date("d/m/Y",$a);

	if($dat == $dt)
	{$ndia++;
	$dt = dtapcal($dt);
	$dt = date('d/m/Y', strtotime("+1 days",strtotime($dt)));

	}

}

	//verifica dia da semna
	$dtm = dtapcal($dt);
	$funh = diasemana($dtm);
	if ($funh > 0){
		$ndia = $ndia + $funh;
		$wh = 0;

		$dt = dtapcal($dchec);
	$dt = date('d/m/Y', strtotime("+$ndia days",strtotime($dt)));
	}
}

$dtfinal = $dt;
//verifica a taxa de juro

$juro = $ndia * 0.002;

//valor ezato do cheque
$valor = $valor / (1 - $juro);

/*/verifica limite
	$datt = date("ymd");
	$ve = mysql_query("select limite from cliente where id = $idcli");
		$l = mysql_fetch_row($ve);
	$ver = mysql_query("select sum(valor) from cheque where datavenc >= $datt and idcli = $idcli");
		$li = mysql_fetch_row($ver);
		if ($l[0] <= ($li[0] + $valor)) $lim = "Ultrapassou o limite de $l[0]";
		else $lim = "Esta dentro do Limite de $l[0]";
		//return $lim;*/


//verifica o valor

$val = $valor * $juro;
$valcli = $valor - $val;
$ju = $juro*100;
$dtven = dtafor($dtfinal);
$val = formatomoeda($val);
$valcli = formatomoeda($valcli);
$valor = formatomoeda($valor);


/*$ret = ("
		Valor do Cheque: $valor<br />
		Data de Pagamento: $dtfinal<br />
		Data p/ dep cheque: $dchec<br />
		N de Dias: $ndia<br />
		Juros cobrado: %$ju<br />
		Valor do Juro: R/$ $val </br />
		Valor do Cliente: R/$ $valcli");*/


		$ret[0] = $valor;
		$ret[1] = $dtfinal;
		$ret[2] = $dchec;
		$ret[3] = $ndia;
		$ret[4] = $ju;
		$ret[5] = $val;
		$ret[6] = $valcli;

return array($ret[0],$ret[1],$ret[2],$ret[3],$ret[4],$ret[5],$ret[6]);

 }

 //status do atendimento
 function status_atendimento($status){
    switch ($status){
        case 0: return "Aguardando atendimento" ;
        case 1: return "Em atendimento";
        case 2: return "Fechado";
        case 3: return "Cancelado";
        default: return "Sem status";

    }
 }
 function remover_caracter($string) {
    $string = preg_replace("/[á]/", "a", $string);
    $string = preg_replace("/[Á]/", "A", $string);
    $string = preg_replace("/[é]/", "e", $string);
    $string = preg_replace("/[É]/", "E", $string);
    $string = preg_replace("/[í]/", "i", $string);
    $string = preg_replace("/[Í]/", "I", $string);
    $string = preg_replace("/[ó]/", "o", $string);
    $string = preg_replace("/[Ó]/", "O", $string);
    $string = preg_replace("/[ú]/", "u", $string);
    $string = preg_replace("/[Ú]/", "U", $string);
    $string = preg_replace("/ç/", "c", $string);
    $string = preg_replace("/Ç/", "C", $string);
    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
   // $string = preg_replace("/ /", "_", $string);
    return $string;
}
?>