<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');
?>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php
if (isset($_SESSION['usuarioNome'])) echo $_SESSION['usuarioNome'];
?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Data : <?php echo date('d/m/Y');?> &nbsp; <a href="../close.php" class="btn btn-danger square-btn-adjust">Sair</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
            <?php 
            include_once("menu.php");
            ?>
               
            </div>
            
        </nav>  
<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">

<?php
include_once('menu.php');
if($finaliza = (isset($_GET['dghf'])) ? dcript($_GET['dghf'],'Erro no id de identificacao da tabela de etapas') : null){
	$fecha_insc = new atualiza();
					$fecha_insc->campo		= 'status = 1';
					$fecha_insc->parametro	= "id = ". $finaliza;
					$fecha_insc->tabela		= 'arpag_etapa';
	$exevuta_at = update_bd($fecha_insc);
}

if($id_inscricao = (isset($_POST['inscricao'])) ? $_POST["inscricao"] : null){
	$idetapa	= dcript($_POST['etapa'],'Erro na identificacao da etapa');
	$idmoda 	= dcript($_POST['modalidade'],'Erro na identificacao da modalidade');
	$classifc	= str_replace(",", "",str_replace(":", "", $_POST['classific']));
	$final  	= str_replace(",", "",str_replace(":", "", $_POST['final']));
	

	if(count($classifc) != count($final)){
		echo "Erro no BD, favor informe ao administrador do sistema"; 
		exit;
	} 
	
    for($i=0;$i<count($id_inscricao);$i++){
    	$finali = NULL;
    	$classifica = NULL;
		$atualiza_insc = new atualiza();
		if($classifc[$i]) $classifica = "'".trocanome($classifc[$i])."'";
		else $classifica = 'NULL';
		if($final[$i]) $finali = "'".trocanome($final[$i])."'";
		else $finali = 'NULL';
		
		$atualiza_insc->campo		= "classificacao = ".$classifica.",final = ".$finali;// ',pontuacao = '".trocanome($ponto[$i])."'";
		$atualiza_insc->tabela		= 'arpag_passaro_etapa';
		$atualiza_insc->parametro	= "id = ".dcript($id_inscricao[$i], 'Erro na identificacao da incricao no BD');
		update_bd($atualiza_insc);
	}	

	$consulta = new consulta();
				$consulta->campo	= 'a.id, a.classificacao, a.final, a.numero, a.id_sub_categoria';
				$consulta->tabela	= "arpag_passaro_etapa AS a
	                                    INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
	                                    INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
	                                    INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa";
				$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." GROUP BY a.numero, a.id, a.classificacao, a.final
										ORDER BY a.id_sub_categoria , a.final DESC, a.classificacao DESC, a.pontuacao DESC";
	$executa = select_db($consulta);
	$pontuacao = retorna_vetor_pontucao($idetapa,$idmoda);
	$cod_pont = 0;
	$cont_pos = 0;
	while($linha = $executa->fetch_array()){
		if ($linha['id_sub_categoria'] != $cod_pont){
			$cont_pos = 0;
			$cod_pont = $linha['id_sub_categoria'];
		}	
		if(($linha['classificacao'] < 1) && ($linha['final'] < 1)) $valor_p = 0;
		else if(!isset($pontuacao[$cont_pos])) $valor_p = 0;
		else $valor_p = $pontuacao[$cont_pos];
		$altera = new atualiza();
		   				$altera->tabela		= 'arpag_passaro_etapa';
		 				$altera->parametro 	= "id = ".$linha['id'];
		 				$altera->campo 		= "pontuacao = ".$valor_p;
		$execut = update_bd($altera);		
		$cont_pos++;
	}
}
	
?>
<h3>Gerenciamento de inscrições abertas:</h3>

<table class="table">
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local, a.id_tipo_modalidade';
			$lista->parametro	= "a.status = 0 AND b.fechada = 0 GROUP BY a.data_etapa, a.id, b.nome, a.nome, a.descricao, a.local";
			$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
if ($consulta = select_db($lista)){
	$cont = 1;
	while($resposta = $consulta->fetch_array()){
		?>
		<tr >
			<td><b>Temporada</b></td>
			<td><b>Etapa</b></td>
			<td><b>Data</b></td>
			<td><b>Cidade</b></td>	
			<td><b>Descriçãoda da etapa</b></td>
		</tr>
		<tr>
		<td><?php echo ($resposta[1])." </td>
		<td> ". ($resposta[2]);?></td>
		<td> <?php echo dtahoraela($resposta['data_etapa']);?></td>
		<td><?php echo ($resposta['local']);?></td>
		<td><?php echo ($resposta['descricao']);?></td>
		</tr>
		<tr><td colspan='5'><?php
		$vetor_mod = verifica_etapa($resposta['id']);
		for ($i=1;$i<=count($vetor_mod);$i++){ 
			if($resposta['id_tipo_modalidade'] == 2 ) $mask_pontua = 'D';
			else $mask_pontua = $vetor_mod[$i][3];
			?><a onClick="inscricao('<?php echo cript($resposta['id']);?>',
			       '<?php echo $cont;?>',
			       '<?php echo cript($vetor_mod[$i][1]);?>',
			       '<?php echo $mask_pontua;?>')" 
				   class="btn btn-primary btn-primary">
				<?php echo $vetor_mod[$i][2];?></a> <?php	
		}
		?></tr><tr><td colspan=6><div class='limpa_load' id='load<?php echo $cont++;?>'><br /></div></td></tr><?php
	}
}
?>
</table>
    
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    <script src="assets/js/jquery.mask.min.js"></script>
   
   <script>
function inscricao(m,n,o,p){
	$('.limpa_load').html('');
	$('#load'+n).html("<img src='../images/loading.gif'>");
	var url = 'funcao_ajax.php?fun=4&m='+m+'&o='+o;
	$.get(url, function(dataReturn) {
		$('#load'+n).html(dataReturn);
		if(p == 'T'){
			$('.formato').mask('00:00:00', { reverse:true});	
		}else if(p == 'D'){
			$('.formato').mask('00,00', { reverse:true});			
		}else{
			$('.formato').mask('0000');	
		}
    	 	
	});

}
function cancela(m,n){
	$('#carrega'+n).html("<img src='../images/loading.gif'>");
	var url = 'funcao_ajax.php?fun=6&m='+m;
	$.get(url, function(dataReturn) {
	 $('#carrega'+n).html(dataReturn);
	});
	//alert  ('#carrega'+n);
}

	 /*ATUALIZA NUMERO DA ESTACA*/
	 $(document).on('change', '.atu_estaca', function(){		 
		var idp = $(this).attr('id');
		var numero  = $(this).val();
		if (confirm("Confirmar a escolha da estaca "+numero+"?")) {
			$('#load_carrega_ap'+idp).html("<img src='../images/loading.gif'>");
			var url = 'funcao_ajax.php?fun=16&m='+idp+'&o='+numero;
			$.get(url, function(dataReturn) {
				$('#load_carrega_ap'+idp).html(dataReturn);
			});
		} 
	 });

	 /*ATUALIZA SUB-MODALIDADE*/
	 $(document).on('change', '.atu_sub_modalidade', function(){		 
		var idp = $(this).attr('id');
		var numero  = $(this).val();
		//if (confirm("Confirmar alteração de sub-modalidade?")) {
			$('#load_carrega_sub'+idp).html("<img src='../images/loading.gif'>");
			var url = 'funcao_ajax.php?fun=17&m='+idp+'&o='+numero;
			$.get(url, function(dataReturn) {
				$('#load_carrega_sub'+idp).html(dataReturn);
			});
		//} 
	 });

</script>
   
</body>
</html>
