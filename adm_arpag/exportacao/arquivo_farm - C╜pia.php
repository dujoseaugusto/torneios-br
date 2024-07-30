<?php
    //include("../seguranca/seguranca.php");
	//protegePagina();
    //require ("includes/funphp/funcao_0.2.php");

    $arquivo = fopen ("farm/Documento.txt","r");
    $cont = 1;
    $parametro = 0;
    while(!feof($arquivo)) {
        $array=explode(";",fgets($arquivo));
        if ($array[2] == "0000000000.00") $array[2] = "0000000000.01";
        $array[2] = substr($array[2], -13);
        $array[1] = substr($array[1], -16);
        if($contrato[0] == NULL){
            $contrato[0] = $array[0];
            $contrato_conteudo[0] = str_pad($array[1], 16, "0", STR_PAD_LEFT)." ".str_pad($array[2], 13, "0", STR_PAD_LEFT)."
";
        }else{
            $on = 0;
            for ($i=0; $i<=$parametro; $i++)  {
                if($contrato[$i] == $array[0]){
                    $contrato_conteudo[$i] .= str_pad($array[1], 16, "0", STR_PAD_LEFT)." ".str_pad($array[2], 13, "0", STR_PAD_LEFT)."
";
                    $on = 1;
                }
            }
            if($on == 0 ){
            $contrato[$parametro+1] = $array[0];
            $contrato_conteudo[$parametro+1] .= str_pad($array[1], 16, "0", STR_PAD_LEFT)." ".str_pad($array[2], 13, "0", STR_PAD_LEFT)."
";
            $parametro++;
            }
        }
        $cont++;
    }
    fclose($arquivo);
    for ($i=0; $i<=$parametro; $i++)  {
    $arquivo_farm = fopen("farm/".$contrato[$i].".txt","w+");
    @fwrite($arquivo_farm,$contrato_conteudo[$i]);
    fclose($arquivo_farm);
    if ($contrato[$i] != NULL)echo "<a href=\"baixar.php?arquivo=".cript($contrato[$i])."\" target=\"blank\">".$contrato[$i].".txt</a>&nbsp;&nbsp;&nbsp;";
    }


?>
