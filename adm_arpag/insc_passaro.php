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
if($idpropietario = (isset($_GET['dghf'])) ? dcript($_GET['dghf'],'Erro no id de identificacao da tabela de etapas') : null){
?>	
<script>
	function altera(m,n){
		
		$('#load'+m).html("<img src='../images/loading.gif' style='width: 99px;'>");
		var url = 'funcao_ajax.php?fun=8&mn='+n;
		var c = $("select[id^=inscr"+m+"]").val();
		//data      : 'nome='+ $('#campo1').val();            
		$.post(url, {inscr: c}, function(dataReturn) {
			$('#load'+m).html(dataReturn);
		});
	}
	
</script>
<div class="col-md-12"> 
     <h3><b>Usuário:</b> <?php echo (retorna_nome($idpropietario,'arpag_pessoa')); ?></h3>
                       
  </div>
	<table border='1' class="table table-striped table-bordered table-hover" id="dataTables-example">
	<tr class='titulo_tabela'>
			<td></td>
			<td>Nome</td>
			<td>anilha</td>
			<td>Modalidade</td>
			<td>Etapa</td>
			<td style="width: 100px"></td>
			</tr>
	<?php
	$lista = new consulta();
				$lista->campo		= 'id, nome, anilha, id_modalidade, ativo';
				$lista->parametro	= "id_pessoa = ".$idpropietario." AND ativo = 1";
				$lista->tabela		= 'arpag_passaro';
	if ($consulta = select_db($lista)){
		$cont = 1;
		while($resposta = $consulta->fetch_array()){
			?><tr>
			<td><?php echo $cont;?> - <?php echo $resposta['id'];?></td>
			<td><?php echo ($resposta['nome'])?></td>
			<td><?php echo ($resposta['anilha'])?></td>
			<td><?php echo (retorna_nome($resposta['id_modalidade'],'arpag_modalidade'));?></td>
			<td><select name="inscr<?php echo $cont;?>" id="inscr<?php echo $cont;?>">
			<?php 
			$verifica_etapa = new consulta();
						$verifica_etapa->campo 		=  'arpag_etapa.id, arpag_etapa.nome';
						$verifica_etapa->tabela		=  'arpag_etapa  
														INNER JOIN arpag_temporada ON arpag_temporada.id = arpag_etapa.id_temporada   
														INNER JOIN arpag_valor_inscricao_etapa ON arpag_valor_inscricao_etapa.id_etapa = arpag_etapa.id';
						$verifica_etapa->parametro	=  "arpag_temporada.fechada = 0 
														AND arpag_etapa.status = 0      
														AND arpag_valor_inscricao_etapa.id_modalidade = ".$resposta['id_modalidade']." 
														GROUP BY arpag_etapa.id";
						//$verifica_etapa->parametro	= "a.data_etapa >= '". date('Y-m-d')." 00:00:00' AND b.fechada = 0 AND a.status = 0 GROUP BY a.id";
			$resp_verifica = select_db($verifica_etapa);
			$count = 0;
			while($linha_ver = $resp_verifica->fetch_array()){
				?>
				<option value="<?php echo cript($linha_ver['id']);?>"><?php echo ($linha_ver['nome']);?></option>
				<?php				
				$count++;
			}
			?>
			</select>
		    </td>
			<td><div id='load<?php echo $cont;?>'>
			<?php
			if($count > 0){
				?>
				<button class='btn btn-primary' onclick="altera('<?php echo $cont."','".cript($resposta['id']);?>')">Inscrever</button>
				<?php
			}
			?>			
			 </div></td>
			</tr><?php
			
			$cont++;
		}
	
	}
}
?>
</table>
               
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
