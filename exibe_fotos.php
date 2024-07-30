<?php
include_once("seguranca/seguranca.php");
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php'); 
//require_once('adm_arpag/config.php');
include_once('topo.php');
error_reporting(0);
$banner = '#000';
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link href="lytebox/lytebox.css" type="text/css" media="screen" rel="stylesheet"/>
<link rel="stylesheet" href="css/lightbox.css">
<link href='css/simplelightbox.min.css' rel='stylesheet' type='text/css'>


<script src="lytebox/lytebox.js" type="text/javascript" language="javascript"></script>
<script src="js/jquery-1.11.1.min.js"> </script>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/simple-lightbox.min.js"></script>
<script type="text/javascript" src="js/lightbox-plus-jquery.js"></script>



<script type="text/javascript">
	//Scrool
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	
	lightbox.option({
      'albumLabel': "Imagem %1 de %2"
    })
	
	//Dialog (Recuperar Senha)
	$(function() {
		$("#dialog").dialog({
				autoOpen: false,
				show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
	
		$( "#opener" ).click(function() {
			$("#dialog").dialog("open");
		});
		
	});
	
	$(".recupera").dialog("option", "width", 650);	
	
</script>	
	
</head>
<body>
	<table style="width: 100%; margin-top: 1%;">
	<tr><td><?php include_once("menu.php"); ?></td></tr>  
    <tr><td><?php include_once("banner_topo.php"); ?></td></tr>
    <tr><td><?php include("novo_menu.php"); ?></td></tr>
   	</table>  
   	
    
 <!-- Informações -->
    <div id="informacoes" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text link">
            	
                    <h3>Fotos</h3>
                    
                  
                    
                   
                    
	<?php 

		           

					include_once('adm_arpag/conexao.php');

		            $id   = $_GET['id'];
		                          
	                $sql        = "SELECT 
		                                    arpag_fotos.id          AS 'id',
		                                    arpag_fotos.nome        AS 'nome', 
		                                    arpag_fotos.nome_pasta  AS 'pasta', 
		                                    arpag_fotos.data        AS 'data'
		                                 FROM arpag_fotos WHERE id = $id";
		                
		                $resultado  = $conn->query($sql);


		                if($resultado->num_rows > 0){
		                    while ($exibe = $resultado->fetch_assoc()){                                                                  

		                        $fotos = opendir ("adm_arpag/fgaleria/".$exibe['pasta']."/");
		                        $cont = 0;
		                         
		                        
		                            echo utf8_encode("

		                                    <h1>".$exibe['nome']."</h1>

		                                    <div class=\"descricao_noticia\">
		                                        
	
		                                        ".date("d/m/Y", strtotime($exibe['data']))."</b>
		                                        <br /><br /><br />

		                                    </div>                                             

		                            ");

		                                                                                                  
		    while ($file = readdir ($fotos)) {
		        
		        if (($file != ".") && ($file != "..") && ($file != "Thumbs.db") && ($file != "thumbnails") && ($file != "photothumb.db")){
		             $array[$cont]= "<a href=\"adm_arpag/fgaleria/".$idgaleria."/$file\" data-lightbox=\"roadtrip\">
		              <img class=\"img-responsive\" src=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" border=\"0\" alt=\"$no[0]\" style=\"width:240px !important; height: 180px !important;\" /></a> ";

		                echo "
		                    <div class=\"col-md-3 col-sm-3 n0 n1 min\">
		                        <a href=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" data-lightbox=\"roadtrip\">
		                            <img class=\"img-responsive thumbnail\" src=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" alt=\"\" title=\"\" style=\"width:240px !important; height: 180px !important;\"/> 
		                        </a> 
		                    </div>
		                ";
		        
		            $cont++;
		        }//if
		    }//while
		                
		                               

		                }

		            }

		            $conn->close();

      ?>

					</div>						  
				
            
		</div>
		<!-- //container -->
	</div>
	<!-- Informações -->
      
  
    
	<!-- footer -->
	<div class="footer">
		<!-- container -->
		<div class="container">
			<?php include_once("rodape_anun.php"); ?>
		</div>
		<!-- //container -->
	</div>
	<!-- //footer -->
	<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
									<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- content-Get-in-touch -->
	<script src="js/responsiveslides.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
    
    
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>