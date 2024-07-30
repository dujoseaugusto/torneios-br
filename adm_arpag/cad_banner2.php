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
            <div id="page-in
<?php
	require_once('menu.php');

	if ($nome = isset($_POST["nome"]) ? trocanome($_POST["nome"]) : null){
		$erro    = $config = array();
		$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
		$link    = trocanome(utf8_decode($_POST["link"]));
		if($arquivo){
			if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $arquivo["type"])){
				echo utf8_encode("<script> alert ('Arquivo em formato inválido! A imagem deve ser jpg, jpeg,
								  bmp, gif ou png. Cadastro não foi realizado.');</script>");
			}else{
				preg_match   ("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
				$dd          = date("msdYiH");
				$imagem_nome = $dd. "." . $ext[1];
				$imagem_dir  = "../banner2/" . $imagem_nome;
				$up          = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				if ($up){
					$insertanu 	= new insercao();
								$insertanu->campo 	= 'nome,imagem';
								$insertanu->tabela 	= 'arpag_banner2';
								$insertanu->dados 	= "'".$nome."','".$imagem_nome."'";
					if (insert_bd($insertanu))echo  utf8_encode("<script> alert ('Seu cadastro foi efetuado com sucesso !!!!');window.location='cad_banner2.php';</script> <br /><br />");
				}else echo utf8_encode("<script> alert ('Erro no Upload');</script> <br /><br />");
			}
		}else echo utf8_encode("<script> alert ('Erro no Arquivo Imagem');</script><br /><br />");
	}

?>


<h3>Cadastro de Banner (Associação)</h3> <br /><br />
<form id="form1" name="banner2" method="post" action="cad_banner2.php" enctype="multipart/form-data">
  <label>T&iacute;tulo:</label><br />
  <input type="text"  name="nome" id="nome" />
  <br /><br />
  <label>Foto:</label><br />
  <input type="file" name="foto" id="foto" />
  <br /><br />
  <input type="submit" name="Submit" id="button" value="Cadastrar" class="btn btn-primary" />
</form>
<br />
<b style="color:#FF0000 !important;">Obs.: A imagem deve conter o tamanho de 380px(largura) x 507px(altura). Também é aconselhável que seja revisto o tamanho final em KB/MB para que o site não fique lento.</b>
<br /><br />
<h3>Banners cadastrados (Associação)</h3>
<table class='table'>
<?php
if(($ex = isset($_GET['e']) ? dcript($_GET['e'],'Erro de indentificacao para a exclusao') : NULL) == 1){
    $di     	= dcript($_GET['d'],'Erro na identificacao do banner.');
    if($file   	= trocanome($_GET['f'])) unlink ("../banner2/".$file);
    $deletar 	= new exclui();
    			$deletar->tabela	='arpag_banner2';
    			$deletar->parametro = "id = ".$di;
    if (delete_db($deletar)) echo utf8_encode("<script> alert ('Exclusao executada com sucesso');window.location='cad_banner2.php';</script> ");
}
echo "<br />";
$listaanun	= new consulta();
				$listaanun->campo 		= 'nome,id,imagem';
				$listaanun->tabela		= 'arpag_banner2';
				$listaanun->parametro	= 'id DESC';
$listexect = select_db_2($listaanun);
while ($li = $listexect->fetch_array()) {
    echo "<tr><td>
    		<a href='cad_banner2.php?d=".cript($li['id'])."&e=".cript(1)."&f=".$li['imagem']."'class='btn btn-danger'>Excluir</a>
    		 - ".$li['nome']."<br /></td></tr>";
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
