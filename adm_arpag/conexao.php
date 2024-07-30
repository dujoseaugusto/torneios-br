<?php
	$servidor = "localhost";
	$usuario  = "arpagc45_user1";
	$senha    = "197592";
	$dbname   = "arpagc45_arpag";
	
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
				
	if(!$conn){
		die("Falha na conexao: " . mysqli_connect_error());
	}
?>