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
<script src="lytebox/lytebox.js" type="text/javascript" language="javascript"></script>
<script src="js/jquery-1.11.1.min.js"> </script>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
	//Scrool
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	
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
			<div class="banner-text">
            	
                    <h3>Vídeos</h3>
                    
                    
                    <?php

						$ex=$_GET["ex"];
						if($ex ==1){
							$v = $_GET["v"];
							 echo "<div id='fotosNoticia'>";
										echo "<iframe title='YouTube video player' width='950'
													  height='560' src='http://www.youtube.com/embed/$v'
													  frameborder='0' allowfullscreen  align='center' ></iframe>";
						}else{
							$listavideo  	= new consulta();
							                $listavideo->campo       = '*';
							                $listavideo->tabela      = 'arpag_video';
							                $listavideo->parametro   = 'id DESC';
							$listexect = select_db_2($listavideo);
							
							  echo "<div id='fotosNoticia'>";
							echo "<ul>";
							while ($lin = $listexect->fetch_array()) {
								$nd = cript(date("ss"));
								$id = cript($lin[0]);
								echo utf8_encode("<li><a href='videos.php?fg=$id&ed=$nd&ex=1&v=".$lin[2]."'>
									<img src='http://i1.ytimg.com/vi/".$lin[2]."/default.jpg' width='210' height='160' border='0'>
										<br />V&iacute;deo: ".$lin[1]."</a> </li>");
							}
							echo "</ul>";
			
						}
						 echo "</div>"; 
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