<?php
    include("../../seguranca/seguranca.php");
    protegePagina(1);
    //require_once('../../php/class.php');
    //require_once('../../bd_funcao/maysql.php');
    require_once('../../php/funcao_0.2.php');

   $num     = dcript($_GET["arquivo"],'erro no arquivo');
   $nome    = str_pad($num, 6, "0", STR_PAD_LEFT);

   $arquivo = "farm/".$nome.".txt";

//echo "farm/".$num.".txt";


   if(isset($arquivo) && file_exists($arquivo)){ // faz o teste se a variavel não esta vazia e se o arquivo realmente existe

      $novoNome = $arquivo;
      $est = strtolower(substr(strrchr(basename($arquivo),"."),1));
      //echo $nome.'.'.$est;

      //exit;
      if(preg_match("/txt/i",$est))
      {
      header('Content-Description: File Transfer');
      header('Content-Disposition: attachment; filename='.$nome.'.'.$est.'');
      header('Content-Type: application/octet-stream');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($arquivo));
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header('Expires: 0');

      readfile($arquivo);
             }
      else{
        echo "<script>alert (\"Arquivo com formato invalido!\"); window.opener = window
          window.close()</script>";
      }



   } else echo "nao existe";

?>