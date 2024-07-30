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
		$('#load').html("<img src='../images/loading.gif'>");
        var url = 'funcao_ajax.php?fun=14&m='+m;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
    function fechar(m,n){
		$('#load').html("<img src='../images/loading.gif'>");
        var url = 'funcao_ajax.php?fun=15&m='+m+'&n='+n;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
</script>
<?php
include_once('menu.php');
if($nome = (isset($_POST['modalidade'])) ? trocanome($_POST["modalidade"]) : null){
    $mod_pont = trocanome($_POST["pontuacao"]);
	$insere = new insercao();
				$insere->campo	=	'nome, pontuacao';
				$insere->dados	=	"'".$nome."','".$mod_pont."'";
				$insere->tabela	=	'arpag_modalidade';
	if (insert_bd($insere)) echo "<script> alert ('Seu cadastro foi efetuado com sucesso !!!!'); window.location='cad_modalidade.php' </script>";
	else echo 'Erro';
}
?>
<h3>Cadastro de Modalidades:</h3>
<br />
<form name="cad_modalidade" method="post" action="cad_modalidade.php" onsubmit="return validaCadAve();">
	<label>Cadastro de uma nova modalidade: </label>&nbsp;<input type="text" name="modalidade" id="modalidade" />
    <br /><br />    

    <label>Modo de pontuação: </label>
   <select name="pontuacao" id="pontuacao">
    <option value="N">Número</option>
    <option value="T">Tempo</option>            
    </select>
    <br /><br />
    <input type="submit" value="Cadastrar" />
</form>
<br />
<br />
<div id='load'>
<table class='table'>
<tr>
    <td>#</td>
    <td>#</td>
    <td>Nome</td>
    <td>Tipo de Pontuação</td>
<?php
$lista = new consulta();
            $lista->campo		= ' arpag_modalidade.id, arpag_modalidade.nome, arpag_modalidade.ativo, arpag_modalidade.pontuacao';
			$lista->parametro	= 'arpag_modalidade.nome';
			$lista->tabela		= 'arpag_modalidade';
if ($consulta = select_db_2($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td style="width: 5%">
            <?php
                if(retorna_ex_pass_mod($resposta['id'])){
            ?><a class='btn btn-primary btn-danger' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>
             <?php
                }
             ?> </td>
				<td style="width: 5%"> 
				<?php
				if($resposta['ativo'] == 0){?>
					<a class='btn btn-success' href='#' onclick="fechar('<?php echo cript($resposta['id']);?>','<?php echo cript(1);?>')">Ativar</a></td>
				<?php
				}else{?>
					<a class='btn btn-info' href='#' onclick="fechar('<?php echo cript($resposta['id']);?>','<?php echo cript(0);?>')">Desativar</a></td>
				<?php
				}
				?>				
				<td><?php echo $resposta['nome'];?><br /></td>
                <td><?php echo $resposta['pontuacao'];?><br /></td>
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

