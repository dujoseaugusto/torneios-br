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
				<h3>Inscrições</h3>
			</div>
			<?php 
				if(!verif_cpf($_SESSION['usuarioID'])){
					echo "<p class='alert-danger'>CPF INVALIDO. <br />
						 Foi identificado que seu número de CPF está invalido no sistema, desta forma sua inscrição não será efetivada, pois não é possível gerar o boleto de pagamento.<br /> <br />

						 Altere seu CPF <a href='cad_usuarioregistrado.php'>aqui</a>.</p>";
				}
			?>
			<script>
			function inscricao(m,n,o){
				$('.mostra_inc').html('');
				$('#load'+n).html("<img src='images/loading.gif'>");
				var url = 'funcao_ajax.php?fun=3&m='+m+'&o='+o;
				$.get(url, function(dataReturn) {
					$('#load'+n).html(dataReturn);
				});

			}
			function carrega(){
				$('#carrega').html("<p class='alert-success'>Preparando sistema para pagamento</p><img src='images/loading.gif'>");
				
			}
			</script>
            <?php
//include_once('menu.php');
if($nome = (isset($_POST['idetapa'])) ? dcript($_POST["idetapa"],'Erro no idetapa') : null){
	if(!verif_inadimp($_SESSION['usuarioID'])){
	
		$tipo 	= $_POST['passaro'];
		//$idmoda = dcript($_POST['idmoda'],'Erro no identificacao  da modalidade');

	   //echo "<br />".$numero." - ".$cont;

	    //rece os passaros selecionado para a incrição
	    //$numero = 1;*/
		//break;
		$cod_pagamento = null;
		$vetor_numeros_inscricao = array();
		foreach($tipo as $valor => $ak){
			$aprova_numero = false;
			$count_aporva  = 1;
			$verifica_ja_exite = new consulta();
								$verifica_ja_exite->campo 		= 'COUNT(*)';
								$verifica_ja_exite->tabela		= 'arpag_passaro_etapa';
								$verifica_ja_exite->parametro	= "id_pessoa = ".dcript($_SESSION['usuarioID'],'Erro no id usuario')."
																	AND id_passaro = ".dcript($ak,'Erro ao inserir passaro')."
																	AND id_etapa = ".$nome;
			$resp_verifica = select_db($verifica_ja_exite);
			$linha_ver = $resp_verifica->fetch_array();
			if($linha_ver[0] == 0){	
				if(!$cod_pagamento) $cod_pagamento = gera_pagamento();
				if (retorna_tipo_estaca($nome) == 'M') $numero_incricao = trocanome($_POST['est_'.$ak]);
				else{
					$numero_incricao = numero_inscricao_novo2($nome,retorna_mod(dcript($ak,'Erro ao inserir passaro')),dcript($_SESSION['usuarioID'],'Erro no id usuario'));
				}
				$inserir = new insercao();
				$inserir->campo	= 'id_pessoa,id_passaro,id_etapa, numero';
				$inserir->dados	= dcript($_SESSION['usuarioID'],'Erro no id usuario').",
									".dcript($ak,'Erro ao inserir passaro').",
									".$nome.",
									".$numero_incricao;
				$inserir->tabela = 'arpag_passaro_etapa';
				$executar = insert_bd_return_id($inserir);

				$inserir_pag = new insercao();
						$inserir_pag->campo	= 'id_passaro_etapa, id_pagamento';
						$inserir_pag->dados	= $executar.",".$cod_pagamento;
						$inserir_pag->tabela = 'arpag_pagamento_passaro_etapa';
				$executar_pag = insert_bd($inserir_pag);
			}
		}	
	 
		echo "<p class='alert-success'>Preparando sistema para pagamento</p><img src='images/loading.gif'>";
		//echo "<script> alert ('Inscrição realizada'); window.location='pos_inscricao.php?m=".cript($nome)."&o=".cript($idmoda)."';</script>"; 
		//echo " <meta http-equiv='refresh' content=1;url='pos_inscricao.php?m=".cript($nome)."&o=".cript($idmoda)."'>";
		echo "<script> carrega(); window.location='pagamento2.php?kj=".cript($cod_pagamento)."';</script>"; 
		echo " <meta http-equiv='refresh' content=1;url='pagamento2.php?kj=".cript($cod_pagamento)."'>";
	}else{

		$consulta = new consulta();
					$consulta->campo	= 'a.id, d.nome AS nomepessoa, a.status_transacao, a.cod_pagamento, e.nome AS nomepassaro, f.nome AS nomeetapa, h.valor AS valorinsc, c.id AS idinsc, a.valor AS valorpago, i.nome as nometemporada';
					$consulta->tabela	= 'arpag_pagamento AS a 
		                                    INNER JOIN arpag_pagamento_passaro_etapa AS b ON b.id_pagamento = a.id 
		                                    INNER JOIN arpag_passaro_etapa           AS c ON c.id = b.id_passaro_etapa 
		                                    INNER JOIN arpag_pessoa                  AS d ON d.id = c.id_pessoa
		                                    INNER JOIN arpag_passaro    			 AS e ON e.id = c.id_passaro
		                                    INNER JOIN arpag_etapa 					 AS f ON f.id = c.id_etapa
		                                    INNER JOIN arpag_temporada				 AS i ON i.id = f.id_temporada
		                                    INNER JOIN arpag_valor_inscricao_etapa	 AS h ON (h.id_etapa = f.id AND h.id_modalidade = e.id_modalidade)';
					$consulta->parametro= "DATE_ADD(a.data_gerado, INTERVAL 7 DAY) <= '".date('Y-m-d 00:00:00')."'
											 AND a.status_transacao < 3
                                    		AND d.id = ".dcript($_SESSION['usuarioID'],'falha usuario sessao');
		$executa = select_db($consulta);
		//$nome = $executa->fetch_array();
	?>
	  <div class="row">
	                <div class="col-md-12">
	                    <!-- Advanced Tables -->
	                    <div class="panel panel-default">

							<div class="panel-heading">
	                             <?php
	                             	echo "<p class='alert-danger'>Caro ".($_SESSION['usuarioNome'])." Foi identificado que as seguintes inscrições ainda estão em aberto, por esse motivo sua inscrição não está sendo permitida, casa já tenha pago essas etapas, saiba que o sistema pode levar a té 3  dias para dar baixa no pagamento. <br />Demais dúvidas entre em contato com o Administrador.</p>Obrigado";
	                             ?>
	                        </div>
	                        <div class="panel-body">
	                            <div class="table-responsive">
	                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	                                    <thead>
	                                     <tr>
	                                        <th>Func</th>
	                                        <th>Passaro</th>
	                                        <th>Etapa</th>
	                                        <th>temporada</th>
	                                        <th>Valor</th>
	                                        <th>valor Pago</th>
	                                    </tr>
	                                </thead>
	                                <tbody>
	<?php
		$cont = 1;
		$pag = null;
		while($linha = $executa->fetch_array()){
			echo
			"<tr class='odd gradeX'>
	        <td class='center'><a class='btn btn-warning btn-sm' href='pagamento3.php?kj=".cript($linha['id'])."' target='_blank'>Ger. Pagamento</a><br /></td>
	       	 <td class='center'>".($linha['nomepassaro'])."</td>
	        <td class='center'>".($linha['nomeetapa'])."</td>
	        <td class='center'>".($linha['nometemporada'])."</td>
	        <td class='center'>R\$ ".$linha['valorinsc']."</td>
	        <td class='center'>R\$ ".$linha['valorpago']."</td>
	    </tr>";
	    $cont++;
	}
		
	?>
       
                                       
                                    
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

               
        </div>
             <!-- /. PAGE INNER  -->
     <?php      
     exit;  
	}
}

?>

<br />
<table class="table table-hover" >

<?php
$lista = new consulta();
			$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local, a.status';
			//$lista->parametro	= "a.data_etapa >= '". date('Y-m-d H:i:s')."' AND b.fechada = 0 AND a.status = 0 GROUP BY a.id"; //antes de criar a função de imprimir inscrição mesmo depoid de fechada, tambem adicionou o campo a.status
			$lista->parametro	= "a.data_etapa >= '". date('Y-m-d H:i:s')."' AND b.fechada = 0 GROUP BY a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local, a.status";
			$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
if ($consulta = select_db($lista)){
	$cont = 1;
	while($resposta = $consulta->fetch_array()){
		if($resposta['status'] == 1)$botao = "Imprimir Ficha de Inscrição ";
		else $botao = "Realizar Inscrição";
		?>
		<tr><td><b>Temporada</b></td>
		<td><b>Etapa</b></td>
		<td><b>Local</b></td>
		<td><b>Data</b></td>
		<td><b>Cidade</b></td></tr>
		<tr>
		<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td>
		<td><?php echo ($resposta['descricao'])." </td><td> ". dtahoraela($resposta['data_etapa']);?></td>
		<td><?php echo ($resposta['local']);?></td></tr><tr><td colspan=5>

		<?php
		$vetor_mod = verifica_etapa($resposta['id']);
		/*for ($i=1;$i<=count($vetor_mod);$i++){
		?><a onClick="inscricao('<?php echo cript($resposta['id']);?>','<?php echo $cont;?>','<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
			<?php echo $vetor_mod[$i][2];?></a><?php
		}*/
		if (!verif_usuario_bloqueio($_SESSION['usuarioID'])){
			echo "<p class='alert-danger'>USUÁRIO BLOQUEADO<br />
						 Procure a Admistração do seu Clube para realizar o desbloqueio</p>";
		}else{
		 	?>
			<a onClick="inscricao('<?php echo cript($resposta['id']);?>','<?php echo $cont;?>')" class="btn btn-primary btn-primary">
			<?php echo $botao;?>
			</a>
			<?php 
		} ?>
		</td>
		</tr><tr><td colspan=5><div class="mostra_inc" id='load<?php echo $cont++;?>'></td></tr><?php
	}
}
?>
</table>

            </div>


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
	 /*ATUALIZA NUMERO DA ESTACA*/
	 $(document).on('change', '.atu_estaca', function(){		 
		var idp = $(this).attr('id');
		var numero  = $(this).val();
		if (confirm("Confirmar a escolha da estaca "+numero+"?")) {
			$('#load_carrega_ap').html("<img src='images/loading.gif'>");
			var url = 'funcao_ajax.php?fun=9&m='+idp+'&o='+numero;
			$.get(url, function(dataReturn) {
				$('#load_carrega_ap').html(dataReturn);
			});
		} 
	 });
	</script>
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>