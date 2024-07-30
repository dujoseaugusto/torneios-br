<?php 

		include("conexao.php");

		function clean($string) {
			$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";
			// Primeiro na variavel $a coloco todas as letras e os tipos de acentos que quero remover.

			$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr";
			// Depois disso na variavel $b coloco na mesma ordem por qual eu vou substituir.

			$string = utf8_decode($string);
			//Aqui eu pego a string e coverto para ISO-8859-1.

			$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
			$string = str_replace(" ","-",$string); // retira espaco
			$string = strtolower($string); // passa tudo para minusculo
			return utf8_encode($string); //finaliza, gerando uma saída para a funcao
		}

	    $nome_galeria	= $_GET["id"];
	    $nome_arquivo  	= $_GET["nome"];
	    $pasta  	= $_GET["nome_pasta"];

		$nome_pasta = clean($pasta);
			
	    $files = glob('fgaleria/'.$nome_pasta.'/' . $nome_arquivo, GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            self::deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }

        echo utf8_decode("<script>alert (\"Exclusão executada com sucesso!\");</script>");

	    echo '<script language="javascript">';
		echo 'window.history.go(-1)';
		echo '</script>';

	

?>