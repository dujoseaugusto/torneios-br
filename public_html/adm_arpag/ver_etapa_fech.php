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
           

<script>
function inscricao(m,n,o){    
	$('.limpa_load').html('');
	$('#load'+n).html("<img src='../images/loading.gif'>");
	var url = 'funcao_ajax.php?fun=5&m='+m+'&o='+o;
	$.get(url, function(dataReturn) {
	 $('#load'+n).html(dataReturn);
	});

}
</script>

<?php
include_once('menu.php');
if($finaliza = (isset($_GET['dghf'])) ? dcript($_GET['dghf'],'Erro no id de identificacao da tabela de etapas') : null){
	$fecha_insc = new atualiza();
					$fecha_insc->campo		= 'status = 0';
					$fecha_insc->parametro	= "id = ". $finaliza;
					$fecha_insc->tabela		= 'arpag_etapa';
	$exevuta_at = update_bd($fecha_insc);
}

?>
<h3>Inscrições Fechadas:</h3>
<table class="table" >
<tr >
    <td><b>Temporada</b></td>
    <td><b>Etapa</b></td>
    <td><b>Data</b></td>
    <td><b>Cidade</b></td>	
    <td><b>Descriçãoda da etapa</b></td>
</tr>
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local';
			$lista->parametro	= " a.status = 1 AND b.fechada = 0 GROUP BY a.data_etapa, a.id, b.nome, a.nome, a.descricao, a.local DESC";
			$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
if ($consulta = select_db($lista)){
	$cont = 1;
	while($resposta = $consulta->fetch_array()){
		?><tr>
		<td><?php echo ($resposta[1])." </td>
		<td> ". ($resposta[2]);?></td>
		<td> <?php echo dtahoraela($resposta['data_etapa']);?></td>
		<td><?php echo ($resposta['local']);?></td>
		<td><?php echo ($resposta['descricao']);?></td>
        </tr>
        <tr>
		<td colspan='5'>
		<?php
		$vetor_mod = verifica_etapa($resposta['id']);
		for ($i=1;$i<=count($vetor_mod);$i++){
		?><a onClick="inscricao('<?php echo cript($resposta['id']);?>','<?php echo $cont;?>','<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
			<?php echo $vetor_mod[$i][2];?></a><?php	
		}
		?></td>
		</tr><tr><td colspan=6><div class='limpa_load' id='load<?php echo $cont++;?>'><br /></div></td></tr><?php
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
   
   
</body>
</html>

