<?php
//include("../../../seguranca/seguranca.php");

function email_via($para,$contato,$mensagem,$headers){
                $paraa = "joseaugusto@unimedguaxupe.coop.br";
                $pagian = "

                <body style=\"margin:10px; padding:0; color:#F2451D; font-family:Arial, Helvetica, sans-serif; font-size:13px;background:url(http://192.168.21.38/intranet/email/img/bg.jpg);\">
                 <h2>Avalia&ccedil;&atilde;o de Desempenho</h2>
                    <img src=\"http://192.168.21.38/intranet/email/img/logo.png\" width=\"389\" height=\"154\"  title=\"Avalia&ccedil;&atilde;o de Desempenho\" /><br><br>
                    <div class=\clear\"></div>" . $mensagem . "</div>
                    <br><br><br>
                 <div id=\"rodape\"> <img src=\"http://192.168.21.38/intranet/email/img/rodape.jpg\" width=\"620\"   title=\"Avalia&ccedil;&atilde;o de Desempenho\" /></div>
                ";
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

    $valor[1] =  invertnum($valor[1]);
    $valor[3] =  invertnum($valor[3]);
    if($valor[7]  != null)$valor[7]  =  invertnum($valor[7]);
    if($valor[4]  != null)$valor[4]  =  invertnum($valor[4]);
    if($valor[6]  != null)$valor[6]  =  invertnum($valor[6]);
    if($valor[10] != null)$valor[10] =  invertnum($valor[10]);
    if($valor[11] != null)$valor[11] =  invertnum($valor[11]);
    if($valor[13] != null)$valor[13] =  invertnum($valor[13]);
    if($valor[15] != null)$valor[15] =  invertnum($valor[15]);
    if($valor[17] != null)$valor[17] =  invertnum($valor[17]);
    if($valor[21] != null)$valor[21] =  invertnum($valor[21]);
    if($valor[22] != null)$valor[22] =  invertnum($valor[22]);
    if($valor[23] != null)$valor[23] =  invertnum($valor[23]);
    if($valor[27] != null)$valor[27] =  invertnum($valor[27]);
    if($valor[30] != null)$valor[30] =  invertnum($valor[30]);
    if($valor[32] != null)$valor[32] =  invertnum($valor[32]);
    if($valor[33] != null)$valor[33] =  invertnum($valor[33]);


    $valor =  "$valor$tip$vl";
    $valor =  $valor  = str_replace(" ","",$valor );
    return $valor;
}
function dcript($valor){
    if($valor == null){echo "Erro na URL da Pagina"; exit;}
    $val = substr($valor, -3, 3);
    $va = substr($valor, -4, 1);
    $valor = substr($valor, 0, -4);
    $valor = "$valor";
    $valor[1] =  desinvertnum($valor[1]);
    $valor[3] =  desinvertnum($valor[3]);
    if($valor[7]  != null)$valor[7]  =  desinvertnum($valor[7]);
    if($valor[4]  != null)$valor[4]  =  desinvertnum($valor[4]);
    if($valor[6]  != null)$valor[6]  =  desinvertnum($valor[6]);
    if($valor[10] != null)$valor[10] =  desinvertnum($valor[10]);
    if($valor[11] != null)$valor[11] =  desinvertnum($valor[11]);
    if($valor[13] != null)$valor[13] =  desinvertnum($valor[13]);
    if($valor[15] != null)$valor[15] =  desinvertnum($valor[15]);
    if($valor[17] != null)$valor[17] =  desinvertnum($valor[17]);
    if($valor[21] != null)$valor[21] =  desinvertnum($valor[21]);
    if($valor[22] != null)$valor[22] =  desinvertnum($valor[22]);
    if($valor[23] != null)$valor[23] =  desinvertnum($valor[23]);
    if($valor[27] != null)$valor[27] =  desinvertnum($valor[27]);
    if($valor[30] != null)$valor[30] =  desinvertnum($valor[30]);
    if($valor[32] != null)$valor[32] =  desinvertnum($valor[32]);
    if($valor[33] != null)$valor[33] =  desinvertnum($valor[33]);


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
        $dat = "$ano$mes$dia";
          return $dat;
	}
	else {
		return 1;
	}

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

//calcula data, dias e valores
function calcular2($dchec, $ndia, $valor){
if(($dchec == "") || ($ndia == "") || ($valor == "")) return utf8_encode("
									Prencha os campos Data, Bom Para e Valor do Cheque");

//converte a a data em numero de dias
$in = dtapcal($dchec);
$fi = dtapcal($ndia);
	if($in == 1)return utf8_encode("Data do Cheque Inv�lida");
	if($fi == 1)return utf8_encode("Data do Bom Para Inv�lida");
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
?>