<?php
	include("../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../php/class.php');
	require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php');
	//require_once('../config.php');
	include_once('topo.php');
	error_reporting(0);
?>
<body>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php
if (isset($_SESSION['usuarioNome'])) echo $_SESSION['usuarioNome'];
?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Data : <?php echo date('d/m/Y');?> &nbsp; <a href="../close.php" class="btn btn-danger square-btn-adjust">Sair</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
            <?php 
            include_once("menu.php");
            ?>
               
            </div>
            
        </nav>  
<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="galeria/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="galeria/js/fancy/jquery.fancybox.js"></script>
        <script type="text/javascript" src="galeria/js/fancy/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
        <script type="text/javascript" src = "galeria/js/uploadify/jquery-1.4.2.min.js" > </script>
		<script type="text/javascript" src = "galeria/js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src = "galeria/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="galeria/js/main.js"></script> 
        <link href="galeria/js/fancy/jquery.fancybox.css" rel="stylesheet" />
<?php
		

	if($idba = isset($_GET["d"]) ? dcript($_GET["d"],'Erro para identificar a galeria') : null){
		$nom  = trocanome($_GET["n"]);
    	echo "<p>Galeria: $nom <p><br /> ";
?>
<script type = "text/javascript" >
$(document).ready(function() {
$('#file_upload').uploadify({
uploader     : 'galeria/js/uploadify/uploadify.swf',
script       : 'galeria/js/uploadify/uploadify.php',
cancelImg    : 'galeria/js/uploadify/cancel.png',
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
				echo utf8_encode("<p><a class='btn btn-primary btn-primary' href='upfoto2.php?d=".cript($rs[id])."&n=".$rs[nome]."' class='botao'>Enviar fotos</a>
      					- $rs[nome] <br /> <br /></p>");
    		}
        
	}
?>
                    
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>