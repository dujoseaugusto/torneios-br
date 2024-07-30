<?php

function data_pt_br($dt){
    $dia = substr($dt,0,2);
    $mes = substr($dt,3,2);
    $ano = substr($dt,6,4);
    $data = $ano."-".$mes."-".$dia;
  return $data;
}

// regra para escolhar estaca na incricao
  function escolhe_inicio($idpessoa,$idmoda,$numero_de_incricao){

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
    //descobre qual numero vago para iniciar ma nova inscrição
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

//recebe o id do pássaro e retorna se ele está inscrito em alguam estapa futura 
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
                if($list['mensagem'])return utf8_encode("<p class='alert-danger'>".$list['mensagem'].". Numero do erro:".$numero."</p>");
                else return "<p class='alert-danger'>Erro no Banco de Dados nao cadastrdo no sistema, numero: ".$numero."</p>";
}

//recebe o id e tabela e retorna o compo nome da mesma 
function retorna_nome($id,$tabela){
                $consulta = new consulta();
                                $consulta->campo		  = 'nome';
                                $consulta->parametro	= 'id = '.$id;
                                $consulta->tabela	    = $tabela;
                $lista = select_db($consulta);
                $list = $lista->fetch_array();
                return $list['nome'];
}

// retorna lista de modalidade de passaros 
function verifica_etapa(){
                $consulta = new consulta();
                                $consulta->campo		= 'id, nome';
                                $consulta->parametro	= 'nome';
                                $consulta->tabela		= 'arpag_modalidade';
                $lista = select_db_2($consulta);
                $i = 1;
                while($list = $lista->fetch_array()){
                                $vetor[$i][1] = $list['id'];
                                $vetor[$i][2] = utf8_encode($list['nome']);
                                $i++;
                }
                return $vetor;
}
function email_via($para,$contato,$mensagem,$headers){
                $paraa = "dujoseaugusto@gmail.com";
                $pagian = "Mensagem";
                mail($paraa,$contato,$pagian,$headers);
                //$envia =  mail($para,$contato,$pagian,$headers);
                //if(!$envia)echo "<script>alert (\"Email não foi enviado !!!!\");</script>";
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
//formata CPF ou CNPJ para print
function mcpfcnpj($cpf){
	$tamanho = strlen($cpf);
	if ( $tamanho == 11){
		$l1 = substr($cpf, 0, 3);
		$l2 = substr($cpf, 3, 3);
		$l3 = substr($cpf, 6, 3);
		$l4 = substr($cpf, 9, 2);
		return "CPF: $l1.$l2.$l3-$l4";
	}
	else if ( $tamanho == 14){
		$l1 = substr($cpf, 0, 2);
		$l2 = substr($cpf, 2, 3);
		$l3 = substr($cpf, 5, 3);
		$l4 = substr($cpf, 8, 4);
		$l5 = substr($cpf, 12, 2);
		return "CNPJ: $l1.$l2.$l3/$l4-$l5";
	}
	else return "CPF ou CNPJ incorreto";
	}


//função numero de diaas entre duas datas
function dataemnumdias($data_inicial,$data_final){


// Usa a função strtotime() e pega o timestamp das duas datas:
$time_inicial = strtotime($data_inicial);
$time_final = strtotime($data_final);

// Calcula a diferença de segundos entre as duas datas:
$diferenca = $time_final - $time_inicial; // 19522800 segundos

// Calcula a diferença de dias
$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
// Exibe uma mensagem de resultado:
return $dias;
}

//FUNÇÃO DIA ÚTIL
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

  $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
  $dia_pascoa = date('j', $pascoa);
  $mes_pascoa = date('n', $pascoa);
  $ano_pascoa = date('Y', $pascoa);

  $feriados = array(
    // Tatas Fixas dos feriados Nacionail Basileiras
    mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 11,  30,  $ano), // Anivesario de muzambinho
    mktime(0, 0, 0, 12,  24,  2012), //
    mktime(0, 0, 0, 12,  31,  2012), //
    mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
    mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
    mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

    // These days have a date depending on easter
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºferia Carnaval
    mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa
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

//MÊS ESCRITO  PARA MÊS NUMERO
function mesDia($mm){
switch($mm){  case "Janeiro": $me = "01";     break;
              case "Fevereiro": $me = "02";   break;
              case "Março": $me = "03";       break;
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

//MÊS NUMERO PARA MÊS ESCRITO
function diaMes($mm){
 switch($mm){ case "01": $me = "Janeiro";     break;
              case "02": $me = "Fevereiro";   break;
              case "03": $me = "Março";       break;
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

//MOSTRA MÊS E ANO
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

//FORMATA DATA COM O MÊS ESCRITO PARA PRINT
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
          	if(checkdate($mes,$dia,$ano)) {

        $dat = "$dia/$mes/$ano";
          return $dat;
	}
	else {
		return 1;
	}

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

//função para colocar ifen
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

//RETORNA MÊS E ANO PARA PRINT
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
          return "$dia/$mes/$ano ás $hora:$minuto:00 Horas";
       // $dat = "$dia/$mes/$ano";
        //  return $dat;
}

//calcula data, dias e valores
function calcular2($dchec, $ndia, $valor){
if(($dchec == "") || ($ndia == "") || ($valor == "")) return utf8_encode("
									Prencha os campos Data, Bom Para e Valor do Cheque");

//converte a a data em numero de dias
$in = dtapcal($dchec);
$fi = dtapcal($ndia);
	if($in == 1)return utf8_encode("Data do Cheque Inválida");
	if($fi == 1)return utf8_encode("Data do Bom Para Inválida");
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


/*$ret = utf8_encode("
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
    $string = preg_replace("/[áàâãä]/", "a", $string);
    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
    $string = preg_replace("/[éèê]/", "e", $string);
    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
    $string = preg_replace("/[íì]/", "i", $string);
    $string = preg_replace("/[ÍÌ]/", "I", $string);
    $string = preg_replace("/[óòôõö]/", "o", $string);
    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
    $string = preg_replace("/[úùü]/", "u", $string);
    $string = preg_replace("/[ÚÙÜ]/", "U", $string);
    $string = preg_replace("/ç/", "c", $string);
    $string = preg_replace("/Ç/", "C", $string);
    $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
    $string = preg_replace("/ /", "_", $string);
    return $string;
}
?>