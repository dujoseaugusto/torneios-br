<?php
include("seguranca/seguranca.php");
//protegePagina(2);
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php');	
include_once('topo.php');
error_reporting(0);
//include_once('adm_arpag/config.php');
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
    </table>  
 <!-- Informações -->
    <div id="informacoes" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
					<h3>Pesquisa</h3>
					 
                     <?php
                     if($pesquisa = isset($_POST['pesquisa']) ? trocanome($_POST['pesquisa']) : NULL){
                     	if (strlen($pesquisa) < 3){echo "<p class='alert-danger'>O sistema n&atilde;o faz pesquisa com menos de 3 caracter!!!</p>";}
                     	else{
	                     	?><h5 class="caption">Busca por "<?php echo $pesquisa; ?>"</h5><?php
							$consulta = new consulta();
				    					$consulta->campo	= 'e.nome, d.nome, c.nome,b.nome, d.data_etapa, d.local, a.final, a.pontuacao, b.anilha';
				    					$consulta->tabela	= "arpag_passaro_etapa AS a 
														    	INNER JOIN arpag_passaro	AS b ON b.id = a.id_passaro
														        INNER JOIN arpag_pessoa		AS c ON c.id = a.id_pessoa
														        INNER JOIN arpag_etapa		AS d ON d.id = a.id_etapa
														        INNER JOIN arpag_temporada	AS e ON e.id = d.id_temporada";
				    					$consulta->parametro= "(c.nome LIKE '%".$pesquisa."%' 
															    OR b.nome LIKE '%".$pesquisa."%')
																AND d.data_etapa < '".date('Y-m-d 00:00:00')."'
																AND a.pontuacao > 0 
															   	GROUP BY a.id;";
				    		$executa = select_db($consulta);
							echo "<table border='1'class='table table-bordered'> ";
				            echo "<tr class='titulo_tabela'>
									<td>Temporada</td>
									<td>Etapa</td>
									<td>Propriet&aacute;rio</td>
									<td>P&aacute;ssaro</td>
									<td>Anilha</td>
									<td>Data</td>
									<td>Local</td>
									<td>Final</td>
									<td>Pontos</td>
								  </tr>";
							$cont = 1;
				    		while($linha = $executa->fetch_array()){
				    			echo "<tr>
										<td>".utf8_encode($linha[0])."</td>
										<td>".utf8_encode($linha[1])."</td>
										<td>".utf8_encode($linha[2])."</td>
										<td>".utf8_encode($linha[3])."</td>	
										<td>".utf8_encode($linha['anilha'])."</td>						
										<td>".dtahoraela($linha['data_etapa'])."</td>
										<td>".utf8_encode($linha['local'])."</td>
										<td>".$linha['final']."</td>
										<td>".$linha['pontuacao']."</td></tr>";
							$cont++;
							}
						    echo "</table><br /><br />";
						    ?>
						    <iframe src="arpag_old/pesquisa.php?avep=<?php echo $pesquisa; ?>" name="conteudo" height="1250" width="600" scrolling="yes" frameborder="0"></iframe>
						    <?php
					    }
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