<?php
    //include("../seguranca/seguranca.php");
	//protegePagina();
    //require ("includes/funphp/funcao_0.2.php");

    $arquivo = fopen ("farm/Documento.ret","r");
    $cont = 1;
    $parametro = 0;
    while(!feof($arquivo)) {
       $linha = fgets($arquivo);
       echo substr($linha, 26, 4)."<br /><br /><br />";
       if($cont==1){
            if((substr($linha, 2, 7) != 'RETORNO') || (substr($linha, 26, 4) != '3125') || (substr($linha, 31, 9) != '000674737')){
                echo 'Arquivo contem erro!!!';
                exit;
            }
       } 

        $cont++;
    }
    fclose($arquivo);
   // for ($i=0; $i<=$parametro; $i++)  {
   // $arquivo_farm = fopen("farm/".$contrato[$i].".txt","w+");
   // @fwrite($arquivo_farm,$contrato_conteudo[$i]);
    //fclose($arquivo_farm);
   // if ($contrato[$i] != NULL)echo "<a href=\"baixar.php?arquivo=".cript($contrato[$i])."\" target=\"blank\">".$contrato[$i].".txt</a>&nbsp;&nbsp;&nbsp;";
   //}


?>
