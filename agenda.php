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

    <div class="container">  
            	
                    <h3>Agenda</h3>
                    <h5 class="caption">Confira nossos próximos torneios.</h5>
					<?php
					if (isset($_SESSION['usuarioNome'])) {echo "<a href='cad_inscricoes.php' title='Inscri&ccedil;&atilde;o'>Fa&ccedil;a a sua Inscri&ccedil;&atilde;o </a>";}
					else {echo "<a href='cad_usuario.php' title='Inscri&ccedil;&atilde;o'>Fa&ccedil;a seu cadastro para se inscrever </a>";}				
					echo "<br />";
					$agenda = new consulta();
								$agenda->campo		= 'nome, data_etapa, id_clube';
								$agenda->tabela		= 'arpag_etapa';
								$agenda->parametro	= "data_etapa >= '".date('Y-m-d h:i:s')."'";
					$execute = select_db($agenda);
					while($linha = $execute->fetch_array()){
						echo utf8_encode("<label>	".dtahoraela($linha['data_etapa'])." -
										 ".$linha['nome']." -
										 ". retorna_nome($linha['id_clube'],'arpag_clube')."</label><br />");
					}
					?>
            
			</div>
            
		</div>
		<!-- //container -->
	</div>
	<!-- Informações -->
    
		<!-- anunciantes -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">
			<div class="gallery-info">
				<h3>Parceiros</h3>
				<h5 class="caption">Veja alguns de nossos parceiros.</h5>
                
                <?php
				include_once('comercial.php');	     
				?>
                         
			</div><!--info-->
		</div>
		<!-- //container -->
	</div>
	<!-- //anunciantes -->
    
  
    
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