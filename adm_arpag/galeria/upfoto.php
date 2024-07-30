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

		

	if($idba = isset($_GET["d"]) ? dcript($_GET["d"],'Erro para identificar a galeria') : null){
		$nom  = trocanome($_GET["n"]);
    	echo "<p>Galeria: $nom <p><br /> ";
?>
<script type = "text/javascript" >
$(document).ready(function() {
$('#file_upload').uploadify({
uploader     : 'js/uploadify/uploadify.swf',
script       : 'js/uploadify/uploadify.php',
cancelImg    : 'js/uploadify/cancel.png',
folder       : <?php echo "'$idba'"; ?>,
fileExt      : '*.jpg;*.gif;*.png',
fileDesc     : 'Image Files',
multi        : true,
onAllComplete: function ( event,data ) {
alert ( data. filesUploaded + ' upload concluido!' ) ;
}
});
});
</script>
<input id = "file_upload" name = "file_upload" type = "file" / >   <br />
<a href = "javascript:$('#file_upload').uploadifyUpload();"  class="btn btn-success">Enviar as imagens selecionadas</a>
<?php
	}
	else{
    		echo  "<p><br /><br />Selecione abaixo as galeria cadastradas no sistema.</p><br /> ";

			$galeria = new consulta();
			$galeria->campo     = 'id, nome';
			$galeria->parametro	= 'id DESC';
			$galeria->tabela	= 'arpag_galeria';
			$resultado = select_db_2($galeria);	
				
			while($rs = $resultado->fetch_array()){
				echo utf8_encode("<p><a class='btn btn-primary btn-primary' href='upfoto.php?d=".cript($rs[id])."&n=".$rs[nome]."' class='botao'>Enviar fotos</a>
      					- $rs[nome] <br /> <br /></p>");
    		}
        
	}
?>
                    
</div>
</body>
</html>