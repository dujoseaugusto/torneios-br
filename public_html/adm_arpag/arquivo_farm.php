<?php
    //include("../seguranca/seguranca.php");
	//protegePagina();
    //require ("includes/funphp/funcao_0.2.php");

    $arquivo = fopen ("farm/Documento.ret","r");
    $cont = 1;
    $log = null;
    while(!feof($arquivo)) {
       $linha = fgets($arquivo);

       if($linha[0]==0){
            if((substr($linha, 2, 7) != 'RETORNO') || (substr($linha, 26, 4) != '3125') || (substr($linha, 31, 9) != '000674737')){
                echo 'Arquivo contem erro!!!';
                exit;
            }
            $nome_log = substr($linha, 94, 6);
       } 
       else if(($linha[0] == 1)){            
           $atualiza_tra = new atualiza();
                $atualiza_tra->campo        = "valor = '".substr($linha, 253, 11).".".substr($linha, 264, 2)."', data_pago = '".dtaforb(substr($linha, 175, 6))."', status_transacao = ".status_mov_arqu(substr($linha, 108, 2));
                $atualiza_tra->tabela       = 'arpag_pagamento';
                $atualiza_tra->parametro    = "cod_pagamento = ".substr($linha, 116, 10);
            if(!update_bd($atualiza_tra))echo 'Erro<br />';
            $log .= "linha:".$cont." valor:".substr($linha, 253, 11).".".substr($linha, 264, 2)." data:".dtaforb(substr($linha, 175, 6))." movimentacao:".substr($linha, 108, 2)." cod:".substr($linha, 116, 10)." CPF/CNPJ:".substr($linha, 342, 14)." \n";  
        }
        else break;
              

        $cont++; 
    }
    fclose($arquivo);
    $arquivo_farm = fopen("exportacao/farm/".$nome_log.".txt","w+");
    @fwrite($arquivo_farm,$log);
    fclose($arquivo_farm);
    echo "Baixar o arquivo de log <a href='exportacao/baixar.php?arquivo=".cript($nome_log)."'target='blank'>Aqui</a>";
    


?>
