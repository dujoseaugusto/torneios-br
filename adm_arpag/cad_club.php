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
	function exclui(m){
        var url = 'funcao_ajax.php?fun=3&m='+m;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
</script>
<?php
include_once('menu.php');
if($nome = (isset($_POST['nome'])) ? trocanome($_POST["nome"]) : null){
	$insere = new insercao();
				$insere->campo	=	'nome';
				$insere->dados	=	 utf8_decode("'".$nome."'");
				$insere->tabela	=	'arpag_clube';
	if (insert_bd($insere)) echo "<script> alert ('Seu cadastro foi efetuado com sucesso !!!!'); window.location='cad_club.php' </script>";
	else echo 'Erro';
}
?>

<form name="cad_modalidade" method="post" action="cad_club.php" onsubmit="return validaCadAve();">
	<label>Nome:</label>&nbsp;<input type="text" name="nome" id="nome" />
    <br /><br />
    <input type="submit" value="Cadastrar Clube" />
</form>
<div id='load'>
<table class='table'>
<?php
$lista = new consulta();
			$lista->campo		= ' id, nome ';
			$lista->parametro	= ' nome';
			$lista->tabela		= 'arpag_clube';
if ($consulta = select_db_2($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td><a class='btn btn-primary btn-danger' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>  <?php echo $resposta['nome'];?><br /></td></tr><?php
	}
}
?>
</table>
</div>
       
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

