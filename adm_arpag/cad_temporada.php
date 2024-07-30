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
            <h3>Temporadas:</h3>     

<script>
	function exclui(m){
		$('#load').html("<img src='../images/loading.gif'>");
        var url = 'funcao_ajax.php?fun=9&m='+m+'&n=<?php echo cript(2);?>';
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
    function fechar(m,n){       
        var titulo = $("#"+m).val();;
        var url = 'funcao_ajax.php?fun=9&m='+m+'&n='+n+'&v='+titulo;        
        $('#load').html("<img src='../images/loading.gif'>"); 
        $.get(url, function(dataReturn) {
            $('#load').html(dataReturn);
        });
      }
</script>
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
?>


<form name="cad_modalidade" method="post" action="cad_temporada.php" onsubmit="return validaCadAve();">
	<label>Temporada:</label>&nbsp;<input type="text" name="modalidade" id="modalidade" />
    <br /><br />
    <input type="submit" value="Cadastrar Temporada" />
</form>
<div id='load'>
<table class='table'>
<?php
$lista = new consulta();
			$lista->campo		= ' id, nome, fechada ';
			$lista->parametro	= ' fechada <> 2 order by fechada, id desc';
			$lista->tabela		= 'arpag_temporada';
if ($consulta = select_db($lista)){
	while($resposta = $consulta->fetch_array()){
        $idtempo = cript($resposta['id']);
		?><tr><td style="width: 5%"><a class='btn btn-primary btn-danger' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a> </td>
				<td style="width: 5%"> 
				<?php
				if($resposta['fechada'] == 0){?>
					<a class='btn btn-success' href='#' onclick="fechar('<?php echo $idtempo;?>','<?php echo cript(1);?>')">Fechar</a></td>
				<?php
				}else{?>
					<a class='btn btn-info' href='#' onclick="fechar('<?php echo $idtempo;?>','<?php echo cript(0);?>')">Abrir</a></td>
				<?php
				}
				?>				
				<td><input id="<?php echo $idtempo;?>" value="<?php echo $resposta['nome']?>" /><br /></td></tr><?php
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

