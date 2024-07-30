<?php
    include("../seguranca/seguranca.php");
    header("access-control-allow-origin: https://pagseguro.uol.com.br");
    //protegePagina(2);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    //include_once('adm_arpag/galeria/config.php');
    $texto = "Inicio ". date('Y-m-d H:i:s'). "\r\n";
    if( isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
        $email = 'wolgran-celani@hotmail.com';
        $token = '7440F9AF5284498DAC436A87D4D62AEF';
       // $token = '0EB8A85392B54612BB335BF6BEFD6258'; //sndbox
        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email. '&token=' . $token;
        $texto .= "Envio - codigo  ". $_POST['notificationCode'] . "\r\n";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $xml = curl_exec($curl);
        curl_close($curl);
       // $texto .= $xml ;
        $xml = simplexml_load_string($xml);
        $texto .= dcript($xml -> reference,'erro')." \r\n";
        $texto .= $xml -> reference ."\r\n";
        
        $atualiza = new atualiza();
                    $atualiza->campo        =   "status_transacao = ". $xml -> status.", valor = '".$xml -> grossAmount."', data_pago = '".str_replace("T"," ",substr($xml -> lastEventDate,0,19))."'";
                    $atualiza->tabela       =   'arpag_pagamento';
                    $atualiza->parametro    =   "cod_pagamento = ".dcript($xml -> reference,'erro')." and cod_pagseguro = '". str_replace('-', '',$xml -> code)."'";
        //$texto .= "\r\n". $atualiza->campo;
        if(update_bd($atualiza)){
            $texto .= "transação ". dcript($xml -> reference,'erro 1')." foi alterada para status". $xml -> status."\r\n";
        }else{$texto .= "Erro na notificação da transação ". dcript($xml -> reference,'erro2');}

     //$texto .= $xml ;

    }
    $dt = date('Y-m-d-H-i-s');
    $arquivo = fopen($dt.'.txt','a');
    if ($arquivo) {
        if (!fwrite($arquivo, $texto."\r\n"));
    fclose($arquivo);
    }
?>

