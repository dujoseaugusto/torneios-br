 
<link href="lytebox/lytebox.css" type="text/css" media="screen" rel="stylesheet"/>
<script src="lytebox/lytebox.js" type="text/javascript" language="javascript"></script>


<?php
	if($idgaleria = isset($lin['idgaleria'])?$lin['idgaleria']:NULL){
        $cont = 0;
        $listafotos  = new consulta();
                    $listafotos->campo       = '*';
                    $listafotos->tabela      = 'arpag_galeria';
                    $listafotos->parametro   = "id = ".$idgaleria;
        $listexect  = select_db($listafotos);
        $no         = $listexect->fetch_array();
        $dn         = opendir ("adm_arpag/galeria/".$idgaleria."/");

        echo "imagens: <br /> ";
        while ($file = readdir ($dn)) {
            if (($file != ".") && ($file != "..") && ($file != "Thumbs.db") && ($file != "thumbnails") && ($file != "photothumb.db")){
                 $array[$cont]= "<a title='' rel='lytebox[vacation]' href='adm_arpag/galeria/$idgaleria/$file'>
                  <img src='adm_arpag/galeria/$idgaleria/$file' border='0' alt='' width='230' height='150' /></a> ";
            $cont++;
            }
        }
         echo "<br /><br />";
                        natsort($array);
                        foreach ($array as $chave => $valor) {
                            echo "<div id='thumb'>".$valor."\n</div>";
                        }

        echo "</div>";
    }
?>

