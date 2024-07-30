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
    echo    "<h3>Galeria: ".utf8_encode(retorna_nome($idba ,'arpag_galeria'))." </h3> <br />";
        ?>
        <script type = "text/javascript" >
            $(document).ready(function() {
                $('#file_upload').uploadify({
                    uploader     : 'galeria/js/uploadify/uploadify.swf',
                    script       : 'galeria/js/uploadify/uploadify.php',
                    cancelImg    : 'galeria/js/uploadify/cancel.png',
                    folder       : <?php echo "'galeria/".$idba."'"; ?>,
                    fileExt      : '*.jpg;*.gif;*.png',
                    fileDesc     : 'Image Files',
                    multi        : true,
                    onAllComplete: function ( event,data ) {
                        alert ( data. filesUploaded + ' upload concluido!' ) ;
                    }
                });
            });
        </script>
        <input id = "file_upload" name = "file_upload" type = "file" / >
        <span style="color: red;">O nome do arquivo não deve conter acentos, caracter especial ou espaço</span>   <br />
        <a href = "javascript:$('#file_upload').uploadifyUpload();"  class="btn btn-success">Enviar as imagens selecionadas</a>
        <?php
	}
	else{
    		echo  "<p>Adcionar Imagens .</p>";

			$galeria = new consulta();
			$galeria->campo     = 'id, nome';
			$galeria->parametro	= 'id DESC';
			$galeria->tabela	= 'arpag_galeria';
			$resultado = select_db_2($galeria);	
			?>
             <div class="panel panel-default">
                    <div class="panel-heading">
                         Lista de Not&iacute;cias.
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th width="20%"></th>
                                        <th>T&iacute;tulo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                while ($lin = $resultado->fetch_array()) {
                                  ?><tr class="odd gradeX">
                                      <td><a href="upfoto.php?d=<?php echo cript($lin['id'])?>" class="botao">Enviar fotos</a></td>
                                      <td><?php echo  utf8_encode($lin['nome']);?> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                   
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                  </div>
            <?php	

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