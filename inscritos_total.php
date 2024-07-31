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
					<script>
						function inscricao(o){
							$('#load').html("<img src='images/loading.gif'>");
							var m 	=  $("select[id^=etapa]").val();
							var url = 'funcao_ajax.php?fun=5&m='+m+'&o='+o;
							$.get(url, function(dataReturn) {
							 	$('#load').html(dataReturn);
							});
						
						}
						
						$(document).on('change','#etapa', function(){ 
							var m = $("select[id^=etapa]").val();			
							$.ajax({
								url: 'funcao_ajax.php?fun=8&m='+m,
								cache: false,
								contentType: false,
								processData: false,
								success: function(data){
									$('#carrega_modalidade').html(data);
								}
							})            
						});
					</script>
					 <h3 class="caption">Confira os participantes da <?php
					if($idtemporada = isset($_GET['hfg']) ? dcript($_GET['hfg'],'Erro na temporada') : NULL){
						echo (retorna_nome($idtemporada, 'arpag_temporada'));?></h3>
					</h5>
                     <br />
					 
					
						<table class="table" >
						<?php
						$lista = new consulta();
									$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local';
									$lista->parametro	= "a.id_temporada = ".$idtemporada ." GROUP BY a.data_etapa DESC";
									$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
						if ($consulta = select_db($lista)){
							$cont = 1;
							?>	
								<tr style="font-weight: bold; font-size: 16px;">
								<td style="font-size:16px; font-weight:bold;">
								<div class="form-group">
	                            	<label>Selecione a etapa</label>
	                            	<select id="etapa" nome="etapa" class="form-control">                                
	                            	
							<?php
							$id_etapa_temp = false;
							while($resposta = $consulta->fetch_array()){
								if(!$id_etapa_temp) $id_etapa_temp = $resposta['id'];
								echo "<option value='".cript($resposta['id'])."'> ".($resposta[2])." - ".dtahoraela($resposta['data_etapa'])." - ".($resposta['local'])."</option>";														
							}
							?></select>
	                        	</div>
	                        	</td>
								</tr>
								<tr><td>
	                        	<div id='carrega_modalidade'>
	                        	<?php
								if ($id_etapa_temp) {
									$vetor_mod = verifica_etapa($id_etapa_temp);
									for ($i=1;$i<=count($vetor_mod);$i++){
										?><a onClick="inscricao('<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
											<?php echo $vetor_mod[$i][2];?></a>     <?php	
									}
								}
								?></div></td></tr>
								<tr><td><div id='load'></div></td></tr><?php
						}
						
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