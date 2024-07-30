<?php
	include("../../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../../php/class.php');
	require_once('../../bd_funcao/maysql.php');
	require_once('../../php/funcao_0.2.php');
	//require_once('../config.php');
	include_once('topo.php');
	error_reporting(0);
?>
<html>
    <head>
        <title>Admin</title>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/fancy/jquery.fancybox.js"></script>
        <script type="text/javascript" src="js/fancy/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
        <script type="text/javascript" src = "js/uploadify/jquery-1.4.2.min.js" > </script>
		<script type="text/javascript" src = "js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src = "js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script> 
        <link href="js/fancy/jquery.fancybox.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />
    </head>
<body>

<?php
include_once('menu.php');

$idex = $_GET["e"];
if ($idex != ""){
    $fi    = "$idex";
    unlink ($fi);
}


if (!$idba  = isset($_GET["d"]) ? dcript($_GET["d"],'Erro na identificacao da galeria') : NULL){
    echo   "<h3>Excluir fotos galeria</h3> <br />";

     $listagaleria   = new consulta();
                $listagaleria->campo        = '*';
                $listagaleria->tabela       = 'arpag_galeria';
                $listagaleria->parametro    = 'id DESC';
    $listexect = select_db_2($listagaleria);
    while ($lin = $listexect->fetch_array()) {
        echo utf8_encode("<p><a href='exfoto.php?d=".cript($lin[0])."&n=".$lin[1]."&in=1&fi=12&&ll=0' class='btn btn-primary'>Ver Galeria</a>
                 ".$lin[1]." <br /> <br /></p>");
    }
}else{
    $nom   = $_GET["n"];
    echo    "<h3>Galeria: $nom </h3> <br />";
    //echo    "<p align='center'><a href='exfoto.php?d=$idba&n=$nom&in=1&fi=12&&ll=0' class='botao'>voltar</a><p>";
    $in     = $_GET["in"];
    $fi     = $_GET["fi"];
    $dn     = opendir ("$idba");
    $con    = 1;
    $numero = 1;
    echo    "<table width='100%' border='0'> ";
    
	while   ($file = readdir ($dn)) {
        $nomm  = substr($file, 0, 30);
        if     ($con <= $fi && $con >= $in){
            if     (($file != ".") && ($file != "..") && ($file != "Thumbs.db")){
                $del   = "$idba/$file";
                
				if     ($numero <= 2){
                    echo "<td width='180' height='180'><img src='".$idba."/".$file."' width='150' height='100' /><br />
                           <span class='datta'>$nomm</span><br /><a href='exfoto.php?d=".cript($idba)."&n=".$nom."&in=1&fi=12&&ll=0&e=".$del."' class='btn btn-primary btn-danger'>Excluir</a> </td>";
                    $numero += 1;
                }
				
				else {
                    echo "<td width='180'>
						<img src='$idba/$file' width='150' height='100' /><br />
                          <span class='datta '>$nomm</span><br /><a href='exfoto.php?d=".cript($idba)."&n=".$nom."&in=1&fi=12&&ll=0&e=".$del."' class='btn btn-primary btn-danger'>Excluir</a> </td></tr><tr>";
                    $numero = 1;
                }
            }
        }
		
		
        $con += 1;
        if ($con > $fi) {
            $in     += 12;
            $fi     += 12;
            $aparec  = 1;
            break;
        }
    }
    closedir($dn);
    echo "</tr></table>";
    if ($aparec == 1 ){
        $ll =$_GET["ll"];
        $ll += 1;
        echo "<p align='center'><a href='exfoto.php?d=$idba&n=$nom&in=$in&fi=$fi&ll=$ll'>Proximo</a></p>";
        if ($ll >= 2){
            $in -= 24;
            $fi -= 24;
            $ll -= 2;
            echo "<p align='center'><a href='exfoto.php?d=$idba&n=$nom&in=$in&fi=$fi&ll=$ll'>Anterior</a></p>";
        }
    }
?>
<?php
}
?>
                    
</div>
</body>
</html>