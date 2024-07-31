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
	<?php
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$host = $_SERVER['HTTP_HOST'];
		$requestUri = $_SERVER['REQUEST_URI'];
		$url = $protocol . $host . $requestUri;
	?>
         window.location.href = "<?php echo $url;?>resultados.php"; 
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
					
					<h3>Notícias</h3>
					<br />
					<?php 

					    include_once('adm_arpag/conexao.php');

					    $sql        = "SELECT * FROM arpag_noticia ORDER BY data DESC LIMIT 6";
					    $resultado  = $conn->query($sql);

					    if($resultado->num_rows > 0){
					        while ($exibe = $resultado->fetch_assoc()){
					            echo ("<div style=\"text-align:left;\"><a href=\"exibe_noticia.php?id_noticia=".$exibe['id']."&f=".$exibe['idgaleria']."\">".date("d/m/Y", strtotime($exibe['data']))." - ".$exibe['titulo']."</a>					                            
					                      
					                        <hr>
					          
					                
					            </div>");
					        }
					    }
					    
					    $conn->close();
					?>


					<br />
            	
                    <h3>Resultados dos Torneios</h3>
                    <h5 class="caption">Confira os resultados dos torneios.</h5>
					<div style="text-align:center !important; line-height:35px !important;">
					<?php
					echo "<br />";
					echo "<table border='1'class='table table-bordered'>";
           		    echo "<tr class='titulo_tabela'>
           		    <td>Inscritos</td>					
					<td>Resultado</td>
					<td>Ranking</td>
					</tr>";
					$agenda = new consulta();
								$agenda->campo		= 'id, nome';
								$agenda->tabela		= 'arpag_temporada';
								$agenda->parametro	= "fechada <> 2 ORDER BY id DESC";
					$execute = select_db($agenda);
					while($linha = $execute->fetch_array()){
						echo "<tr><td><a href='inscritos_total.php?hfg=".cript($linha['id'])."'>".$linha['nome']."</a> </td>	
											<td><a href='resultado_etapa.php?hfg=".cript($linha['id'])."'>".$linha['nome']."</a></td>";
						if($linha['nome'] == 'Temporada 2015') echo "<td><a href='ranking2015.php'>Visualizar</a></td>";
						else echo utf8_encode("<td><a href='ranking.php?hfg=".cript($linha['id'])."'>Visualiza</a></td>");
						echo "</tr>";
					}
					
					echo "</table>";
					?>
            	</div>
			</div>

			<br />

			<div style="text-align: center;">
				<?php include ("ct.php"); ?>Visitas
			</div>

			<br />
            
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
