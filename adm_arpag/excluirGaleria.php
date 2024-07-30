<?php

	include("../seguranca/seguranca.php");
    protegePagina(1);
	include("conexao.php");	
	include("php/funcoes.php");	

	function ApagaDir($dir) {
	  if($objs = glob($dir."/*")){
	    foreach($objs as $obj) {
	      is_dir($obj)? ApagaDir($obj) : unlink($obj);
	    }
	  }
	  rmdir($dir);
	} 

	$id 		= $_GET['id'];	
	$nome_pasta = $_GET['i'];

	ApagaDir('fgaleria/'.$nome_pasta);

	$sql  = "DELETE FROM arpag_fotos WHERE arpag_fotos.id = $id";
	
	if($conn->query($sql) === TRUE){
		echo utf8_decode("<script> alert (\"Exclusão realizada com sucesso.\");</script>");
		echo utf8_encode('<script>window.location="cad_gal_fotos.php";</script>');
	}
	
	else{
		echo "Erro: " . $sql . "<br />" .$conn->error;
		echo utf8_encode('<script>window.location="cad_gal_fotos.php";</script>');
	}
	

?>