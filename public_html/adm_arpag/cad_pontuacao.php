<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');

if($id_pontuacao = (isset($_POST['cod_pontuacao'])) ? dcript($_POST["cod_pontuacao"],'Erro Pontuação') : null){
    $sequencia = trocanome($_POST['sequencia']);
    
    $atualiza_insc 	= new atualiza();
    $atualiza_insc->parametro 	= "id = ".$id_pontuacao;
    $atualiza_insc->tabela		= 'arpag_pontuacao';
    $atualiza_insc->campo 		= "sequencia = '".$sequencia."'";
    if(!update_bd($atualiza_insc)) echo "Erro para atualizar pontuacao";
}
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
            <h3>Pontuação:</h3>       


<?php
include_once('menu.php');
if($nome = (isset($_POST['modalidade'])) ? trocanome($_POST["modalidade"]) : null){
	$insere = new insercao();
				$insere->campo	=	'nome';
				$insere->dados	=	"'".$nome."'";
				$insere->tabela	=	'arpag_temporada';
	if (insert_bd($insere)) echo "<script> alert ('Seu cadastro foi efetuado com sucesso !!!!'); window.location='cad_temporada.php' </script>";
	else echo 'Erro';
}


if($id_pontuacao = (isset($_GET['jdf'])) ? dcript($_GET["jdf"],'Erro identificação da pontuação') : null){
    $lista = new consulta();
    $lista->campo		= ' nome, sequencia';
    $lista->parametro	= ' id = '.$id_pontuacao ;
    $lista->tabela		= 'arpag_pontuacao';
    $consulta = select_db($lista); 
    $resposta = $consulta->fetch_array();
    ?>
   <form method="post" action="cad_pontuacao.php">
	<label><?php echo $resposta['nome'];?>:</label>&nbsp;
    <input type="hidden" name="cod_pontuacao" id="cod_pontuacao" value="<?php echo cript($id_pontuacao)?>"/>
    <input type="text" style="width:75%" name="sequencia" id="sequencia" placeholder="Ex 10,8,6,5,4,3,2,1" required value="<?php echo $resposta['sequencia']?>"/>
    <br /><br />
    <input type="submit" value="Atualizar pontuação" />
</form>
<?php
}
?>
<table class='table'>
<tr><td>#</td>
    <td style="width: 10%">Nome</td>
    <td>Pontuação</td>
</tr>
<?php
$lista = new consulta();
			$lista->campo		= ' id, nome, sequencia';
			$lista->parametro	= ' id';
			$lista->tabela		= 'arpag_pontuacao';
if ($consulta = select_db_2($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td style="width: 5%"> 				
			<a class='btn btn-info' href='cad_pontuacao.php?jdf=<?php echo cript($resposta['id'])?>'>Abrir</a></td>
			<td><?php echo $resposta['nome']?></td>
            <td><?php echo $resposta['sequencia']?></td>
        </tr><?php
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

