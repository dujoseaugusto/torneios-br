<?php
	include("../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../php/class.php');
	require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php');
	
	
$lista = new consulta();
				$lista->campo		= "id, anilha";
				$lista->parametro	= "id";
				$lista->tabela		= 'arpag_passaro';
	if ($consulta = select_db_2($lista)){
		while($resposta = $consulta->fetch_array()){
			//echo " - ".preg_replace("/[^0-9]/", "", $resposta['anilha'])."<br />";
			$anilha = preg_replace("/[^0-9]/", "", $resposta['anilha']);
			
			$atualiza_pass 	= new atualiza();							
							$atualiza_pass->tabela		= 'arpag_passaro';
							$atualiza_pass->campo 		= "anilha_n = '".substr($anilha, -6)."'";
							$atualiza_pass->parametro 	= "id = ".$resposta['id'];
			if(update_bd($atualiza_pass))echo "Alterado";
			else echo "Erro";
			//break;
		}
	}