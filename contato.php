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

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

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
    
<!-- contact -->
	<div id="contact" class="contact">
		<!-- container -->
		<div class="container">
			<div class="contact-info">
				<h3>Contato</h3>
				<!--<h5 class="caption">Entre em contato conosco pelos meios abaixo.</h5>-->
			</div>
			<div class="contact-grids">
				<div class="col-md-4 contact-grid">
					<div class="contact-grid-info">
						<h3>Fale Conosco</h3>
					</div>
					<div class="contact-grid-list">
						<ul>
							<li>Filiação<li>
                            <li>Anúncios<li>
                            <li>Dúvidas<li>
							<li>Sugestões<li>
                            <li>Críticas<li>
							<li>Inscrições<li>
							<li>Pagamentos<li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 contact-grid">
					<div class="contact-grid-info">
						<h3>Endereço</h3>
					</div>
					<div class="contact-grid-list">
						<h4>Guaxupé/MG</h4>						
						<p><span>Celular: (35) 9 9149-8378 <i class="fab fa-whatsapp"></i></span>
							E-mail : <a href="mailto:wlcelani@gmail.com">wlcelani@gmail.com</a>
						</p>
					</div>
				</div>
				<div class="col-md-4 contact-grid">
					<div class="contact-grid-info">
						<h3>Escreva para nós</h3>
					</div>
					<div class="contact-grid-list">
						<form method="get" action="index.php">
							<input type="text" name="nome" placeholder="Nome" required>
							<input type="text" name="email" placeholder="E-mail" required><br />
							<textarea name="mensagem" placeholder="Mensagem" required></textarea>
							<input type="submit" value="Enviar">
						</form>
                        <?php
                            	if($_GET) {
									$nome           		= $_GET['nome'];
									$email					= $_GET['email'];
									$mensagem    			= $_GET['mensagem'];
									
									$headers = "Content-type:text/html; charset=iso-8859-1";
									$para = "juninhogpe@gmail.com";
									
									$mensagem .= "<br>Nome: $nome<br>";
									$mensagem .= "E-mail: $email<br>";
									$mensagem = "Mensagem: $mensagem<br>";								
									
									$envia =  mail($para,"Contato",$mensagem,$headers);
									echo   "<script> alert (\"Mensagem enviada.\"); window.location=\"index.php\"; </script>";
								}
                        ?>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //contact -->      
  
    
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