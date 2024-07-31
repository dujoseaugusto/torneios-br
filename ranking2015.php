<?php
include("seguranca/seguranca.php");
//protegePagina(2);
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php');	
include_once('topo.php');
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link rel="stylesheet" href="css/lightbox.css">
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
    </table>->            	        	
      	
    
 <!-- Informações -->
    <div id="informacoes" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
					<script>
						function inscricao(m,n){
							$('#load').html("<img src='images/loading.gif'>");
							var url = 'funcao_ajax.php?fun=7&m='+m+'&n='+n;
							$.get(url, function(dataReturn) {
							 $('#load').html(dataReturn);
							});
						
						}
					</script>
                    <h3>Ranking  da <?php
					if($idtemporada = 13){
						echo utf8_encode(retorna_nome($idtemporada, 'arpag_temporada'));?></h3>
					<br />
					<br />
						<table class="table" >
						<?php                       
							?><tr>
							<td colspan='3'></td></tr>
							<tr></tr><td colspan='3'>
							
							<a href="ranking/Ranking_AZULAO.html" class="btn btn-primary btn-primary" target="blank">Azul&atilde;o</a>
							<a href="ranking/Ranking_CANARIO.html" class="btn btn-primary btn-primary" target="blank">Can&aacute;rio</a>
							<a href="ranking/Ranking_COLEIRO.html" class="btn btn-primary btn-primary" target="blank">coleiro</a>
							<a href="ranking/Ranking_TRINCA_FERRO.html" class="btn btn-primary btn-primary" target="blank">Trinca Ferro</a>
							</td>
							</tr><tr><td colspan='6'><div id='load'><br /></div></td></tr><?php
							
						
						
						?>
						</table>
					<?php
					}
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