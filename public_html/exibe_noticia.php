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
		

			<?php
				
				include_once("adm_arpag/conexao.php");

				$id_noticia   = $_GET['id_noticia'];	
				$idgaleria    = $_GET['idgaleria'];            	           
                
                $sql        = "SELECT 
                                    arpag_noticia.titulo,
                                    arpag_noticia.autor,
                                    arpag_noticia.texto,
                                    arpag_noticia.foto,
                                    arpag_noticia.subti,
                                    arpag_noticia.data,
                                    arpag_noticia.idgaleria,
                                    arpag_fotos.nome   			AS 'galeria',
                                    arpag_fotos.nome_pasta   	AS 'pasta'
                                 FROM arpag_noticia 
                                    LEFT  JOIN arpag_fotos ON arpag_fotos.id = arpag_noticia.idgaleria
                                        WHERE 1=1
                                            AND arpag_noticia.id = $id_noticia";
                
                $resultado  = $conn->query($sql);

                if($resultado->num_rows > 0){
                    while ($exibe = $resultado->fetch_assoc()){

                        $galeria = $exibe['galeria'];                                                

                        if($galeria != 0 || $galeria != NULL){
                            $galeria = '<br /><br /><h1>Fotos</h1><br /><br /><br />';

		                        $fotos = opendir ("adm_arpag/fgaleria/".$exibe['pasta']."/");
		                        $cont = 0;
		                         
		                        
		                            echo utf8_encode("

	                                    <h3>".$exibe['titulo']."</h3>
		                                    		                                  
                                        <b>Por ".$exibe['autor']."</b> em ".date("d/m/Y", strtotime($exibe['data']))."

                                        <br /><br />
                                        
                                          <img src='adm_arpag/fotonoticia/".$exibe['foto']."' class=\"img-responsive imagem-noticia\" />

                                        
                                        <div class=\"txt-noticia\">
			                                        <b>Not&iacute;cia</b>".$exibe['texto']."
			                                    </div>"

			                                     .$galeria."

		                                    </div>                                             

		                            ");

                                                                                                  
						    	while ($file = readdir ($fotos)) {
							        
							        if (($file != ".") && ($file != "..") && ($file != "Thumbs.db") && ($file != "thumbnails") && ($file != "photothumb.db")){
							             $array[$cont]= "<a href=\"adm_arpag/fgaleria/".$idgaleria."/$file\" data-lightbox=\"roadtrip\">
							              <img class=\"img-responsive\" src=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" border=\"0\" alt=\"$no[0]\" style=\"widht:100px !important;\" /></a> ";

							                echo "
							                    <div class=\"col-md-3 col-sm-3 n0 n1 min\">
							                        <a href=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" data-lightbox=\"roadtrip\">
							                            <img class=\"img-responsive thumbnail\" src=\"adm_arpag/fgaleria/".$exibe['pasta']."/$file\" alt=\"\" title=\"\" style=\"width:210px !important; height:135px !important\"/> 
							                        </a> 
							                    </div>
							                ";
							        
							            $cont++;
							        }//if
							    }//while
						    }

						    else{
                            		//$galeria = 'Essa noticia nao possui fotos.';
                            		echo utf8_encode("

		                                    <h3>".$exibe['titulo']."</h3>

		                                    <div class=\"descricao_noticia\">
		                                        <b>Por ".$exibe['autor']."</b> em ".date("d/m/Y", strtotime($exibe['data']))."

		                                        <br /><br />
		                                        
		                                         <img src='adm_arpag/fotonoticia/".$exibe['foto']."' class=\"img-responsive imagem-noticia\" />
		                                         <div class=\"clear\"></div>


		                                        <div class=\"txt-noticia\">
			                                        <b>Not&iacute;cia</b>".$exibe['texto']."
			                                    </div>

			                                    

		                                    </div>                                             

		                            ");

                    		}
                
                               

                }

            }

            $conn->close();

	     	?> 

	

	     


			<!-- Últimas notícias -->
			           
                                  
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