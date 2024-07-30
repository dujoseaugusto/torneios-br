<?php
	include("../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../php/class.php');
	//require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php');
	require_once('config.php');
	include_once('topo.php');
?>
<html>
<head><title></title></head>

<body>

<div>
<?php
	require_once('menu.php');
	$nome = $_POST["nome"];
	if ($nome != ""){
		$erro    = $config = array();
		$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
		$link    = utf8_decode($_POST["link"]);
		if($arquivo){
			if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"])){
				echo utf8_encode("<script> alert (\"Arquivo em formato inválido! A imagem deve ser jpg, jpeg,
								  bmp, gif ou png. Cadastro não foi realizado.\");</script>");
			}else{
				preg_match   ("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
				$dd          = date("msdYiH");
				$imagem_nome = $dd. "." . $ext[1];
				$imagem_dir  = "../anuncios/" . $imagem_nome;
				$up          = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
				if ($up){
					//$iduss      =  $_SESSION['usuarioID'];
					$titulo     = str_replace("'","",$titulo);
					$link       = str_replace("'","",$link);
					$sql        = "insert into arpag_comercial (nome,imagem,link)
								   value ('$nome','$imagem_nome','$link')";
					$rs         = mysql_query($sql);
					if ($rs)    echo  utf8_encode("<script> alert (\"Seu cadastro foi efetuado com sucesso !!!!\");</script> <br /><br />");
					else        mysql_error();
				}else echo utf8_encode("<script> alert (\"Erro no Upload\");</script> <br /><br />");
			}
		}else echo utf8_encode("<script> alert (\"Erro no Arquivo Imagem\");</script><br /><br />");
	}

?>


<h3>Cadastro de Anúncios</h3> <br /><br />
<form id="form1" name="anuncios" method="post" action="cad_anuncios.php" enctype="multipart/form-data">
  <label>T&iacute;tulo:</label><br />
  <input type="text"  name="nome" id="nome" />
  <br /><br />
  <label>Link:</label><br />
  <input type="text"  name="link" id="link" />
  <br /><br />
  <label>Foto:</label><br />
  <input type="file" name="foto" id="foto" />
  <br /><br />
  <input type="submit" name="Submit" id="button" value="Cadastrar" class="btn btn-primary" />
</form>
<br /><br />
<h3>Anunciantes cadastrados</h3>
<table class='table'>
<?php
$ex = $_GET['e'];
if($ex == 1){
    $di     = $_GET['d'];
    $file   = $_GET['f'];
    unlink  ("../anuncios/$file");
    $cod    = "delete from arpag_comercial where id = $di";
    $sq     = mysql_query($cod) or die (mysql_error());
    if($sq) echo utf8_encode("<script> alert (\"Exclusão executada com sucesso\");</script> ");
    else    echo utf8_encode("<script> alert (\"Erro na exclusão dos arquivos);</script>");
}
echo "<br />";
$sqll = "SELECT nome,id, imagem from arpag_comercial order by id desc";
$rr = mysql_query($sqll);
while ($li = mysql_fetch_row($rr)) {
    echo "<tr><td><a href=\"cad_anuncios.php?d=$li[1]&e=1&f=$li[2]\" class=\"btn btn-danger\">Excluir</a>&nbsp;&nbsp;
          $li[0]<br /></td></tr>";
}
?>
</table>
 </div>
</body>
</html>
