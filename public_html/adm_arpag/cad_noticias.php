<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');
    error_reporting(0);
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
	

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head><title></title></head>

<body>

<div>
<?php
	require_once('menu.php');
	
	if ($nome = isset($_POST["nome"]) ? trocanome($_POST["nome"]) : null){
		$descricao = trocanome($_POST["descricao"]);
		$data = date('Y-m-d');
		$erro    = $config = array();
		$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
		//$link    = utf8_decode($_POST["link"]);
		if($arquivo){
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $arquivo["type"])){
				echo utf8_encode("<script> alert ('Arquivo em formato inválido! A imagem deve ser jpg, jpeg,
								  bmp, gif ou png. Cadastro não foi realizado.');</script>");
			}else{
				preg_match   ("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
				$dd          = date("msdYiH");
				$imagem_nome = $dd. "." . $ext[1];	
				$imagem_dir  = "../noticias/" . $imagem_nome;
				$up          = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
			}
		}
		$insertnot 	= new insercao();
					$insertnot->campo 	= 'titulo, imagem, descricao, data';
					$insertnot->tabela 	= 'arpag_noticias';
					$insertnot->dados 	= utf8_decode("'".$nome."','".$imagem_nome."','".$descricao."', '".$data."'");
		if (insert_bd($insertnot))echo  utf8_encode("<script> alert ('Seu cadastro foi efetuado com sucesso !!!!');window.location='cad_noticias.php';</script> <br /><br />");

	}

?>


<form id="form1" name="anuncios" method="post" action="cad_noticias.php" enctype="multipart/form-data">
  <label>T&iacute;tulo:</label><br />
  <input type="text"  name="nome" id="nome" />
  <br /><br />
  <label>Descricao:</label><br />
  <textarea name="descricao" rows="8" cols="45"></textarea>
  <br /><br />
  <label>Imagem:</label><br />
  <input type="file" name="foto" id="foto" />
  <br /><br />
  <input type="submit" name="Submit" id="button" value="Cadastrar" class="btn btn-primary" />
</form>
<br />
<b style="color:#FF0000 !important;">Obs.: A imagem deve conter o tamanho de 400 x 300px. Também é aconselhável que seja revisto o tamanho final em KB/MB para que o site não fique lento.</b>
<br /><br />
<h3>Avisos cadastradas</h3>
<table class='table'>
<?php
if(($ex = isset($_GET['e']) ? dcript($_GET['e'],'Erro de indentificacao para a exclusao') : NULL) == 1){
    $di     	= dcript($_GET['d'],'Erro na identificacao da noticia');
    if($file   	= trocanome($_GET['f'])) unlink ("../noticias/".$file);
    //$cod    	= "delete from arpag_noticias where id = $di";
    $deletar 	= new exclui();
    			$deletar->tabela	='arpag_noticias';
    			$deletar->parametro = "id = ".$di;
    if (delete_db($deletar)) echo utf8_encode("<script> alert ('Exclusao executada com sucesso');window.location='cad_noticias.php';</script> ");
}
echo "<br />";
//$sqll = "SELECT id, titulo, imagem from arpag_noticias order by id desc";
$listanoticia 	= new consulta();
				$listanoticia->campo 		= 'id, titulo, imagem';
				$listanoticia->tabela		= 'arpag_noticias';
				$listanoticia->parametro	= 'id DESC';
$listexect = select_db_2($listanoticia);
while ($li = $listexect->fetch_array()) {
    echo utf8_encode("
		<tr>
			<td>
				<a href='cad_noticias.php?d=".cript($li['id'])."&e=".cript(1)."&f=".$li['imagem']."'class='btn btn-danger'>Excluir</a>
				<a href='alt_noticias.php?d=".cript($li['id'])."' class='btn btn-warning'>Editar</a>
				&nbsp;&nbsp;$li[1]<br />
			</td>
		</tr>"
	);
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

