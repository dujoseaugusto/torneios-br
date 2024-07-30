<?php
	include("seguranca/seguranca.php");
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
<link rel="stylesheet" href="css/lightbox.css">
<link href='css/simplelightbox.min.css' rel='stylesheet' type='text/css'>


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


	

    <!-- notícias -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">

			<div class="gallery-info">
		
			<h3>Notícias</h3>

			<br /><br />


			<!-- Notícias -->

			<?php 

			    include_once('adm_arpag/conexao.php');

			    $sql        = "SELECT * FROM arpag_noticia ORDER BY data DESC";
			    $resultado  = $conn->query($sql);

			    if($resultado->num_rows > 0){
			        while ($exibe = $resultado->fetch_assoc()){
			            echo utf8_encode("

			                    <div class=\"exibe_noticias\">

			                            ".date("d/m/Y", strtotime($exibe['data']))." -                                                     
			                            ".$exibe['titulo']." - <a href=\"exibe_noticia.php?id_noticia=".$exibe['id']."&f=".$exibe['idgaleria']."\">Ler</a>
			                            
			                        </a>
			                        <hr>
			                    </div>
			                
			            ");
			        }
			    }
			    
			    $conn->close();

			 ?>

			<!-- Notícias -->
			           
                                  
			</div><!--info-->
		</div>
		<!-- //container -->
	</div>
	<!-- //notícias -->
    
    
   </div>      
	<!-- footer -->
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
    

</body>
</html>