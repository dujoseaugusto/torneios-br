<?php
    include("seguranca/seguranca.php");
	protegePagina(2);
	require_once('php/class.php');
	require_once('bd_funcao/maysql.php');
	require_once('php/funcao_0.2.php');
	include_once('topo.php');
	//include_once('adm_arpag/galeria/config.php');
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


<!-- banner-bottom -->
	<div id="agenda" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
				<h3>Imprima a ficha de Inscrições</h3>
			</div>
			<?php
			if ($idpagamento = isset($_GET['m']) ? dcript($_GET['m'],'Erro id pagamento') : null){
				echo "<label>Passaros inscritos</label>";
				$consulta = new consulta();
								$consulta->campo	= 'b.id, b.nome, c.nome, b.anilha, a.id, a.id_etapa, 
								                       a.numero numero_estaca, c.id idmodalidade';
								$consulta->tabela	= 'arpag_passaro_etapa AS a
														INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro
														INNER JOIN arpag_modalidade AS c ON c.id = b.id_modalidade
														INNER JOIN arpag_pagamento_passaro_etapa AS d ON d.id_passaro_etapa = a.id';
								$consulta->parametro= "d.id_pagamento = ".$idpagamento;								
					$executa = select_db($consulta);
					echo "<table border='1'class='table table-bordered'> ";
					echo "<tr><td></td><td>Nome</td><td>Anilha</td><td>Modalidade</td></tr>";
					$idjacadastrado = null;
					while($linha = $executa->fetch_array()){
						if(($linha['numero_estaca'] == 0) && (retorna_tipo_estaca($linha['id_etapa']) == 'M')){	
							echo "<tr><td> <span style='color:red'>Sua inscrição foi realizada com sucesso. 
							      Clique <a href='cad_inscricoes.php'>aqui</a> para voltar à página de incrição e confirmar o numero da estaca<br ></span>";						
							
						}
						else if (retorna_tipo_modalidade_etapa($linha['id_etapa']) == 2){ 
							echo "<tr><td><a class='btn btn-primary btn-success' href='imprime2.php?kj=".cript($linha['id'])."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir inscri&ccedil;&atilde;o</a>";
						}else{
							echo "<tr><td><a class='btn btn-primary btn-success' href='imprime.php?kj=".cript($linha['id'])."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir inscri&ccedil;&atilde;o</a>";
						}
						echo "</td>
						<td>".($linha[1])."</td>
						<td>".($linha['anilha'])."</td>
						<td>".($linha[2])."</td>
						
						</tr>";  
						$idjacadastrado .= $linha[0].",";
					}
					echo '</table>';
				}
				
				
			?>
			<h3><a href="cad_inscricoes.php">Volta para tela de Inscrições</a></h3>
		</div>

	</div>
  
    
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
    <script>

    
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>