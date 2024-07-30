<?php
	include("../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../php/class.php');
	require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php');
	//require_once('config.php');
	include_once('topo.php');
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head><title></title></head>

<body>

<div>

 <?php
 include_once('menu.php');
	$id   			= dcript($_POST['id'],'Erro na identificacao do aviso');
	$titulo		  	= trocanome($_POST['titulo']);
	$descricao 	  	= trocanome($_POST['descricao']);
	$atualiza_pass 	= new atualiza();
					$atualiza_pass->parametro 	= "id = ".$id;
					$atualiza_pass->tabela		= 'arpag_noticias';
					$atualiza_pass->campo 		= "titulo='".utf8_decode($titulo)."', descricao='".utf8_decode($descricao)."'";
	if(update_bd($atualiza_pass)) echo'<script>window.location="cad_noticias.php";</script>';
	else echo "Erro";
?>
 </div>
</body>
</html>
