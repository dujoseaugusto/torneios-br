<?php
    include("../seguranca/seguranca.php");
	protegePagina();
    require ("includes/funphp/funcao_0.2.php");

ini_set('max_execution_time', 1000);
?>
<html>
<head>

<script>
function validaForm(){

var d = document.form1;
if (d.doc.value == ""){
    alert("O campo \"Documento\" deve ser preenchido!");
    d.doc.focus();
    return false;
}

    return true;
}
</script>
</head>

<body>
<br /><br />
<?php
// Prepara a variável do arquivo
$arquivo = isset($_FILES["doc"]) ? $_FILES["doc"] : FALSE;
$titulo = $_POST["nome"];
$desc = $_POST["desc"];
if ($titulo == 123){

  if($arquivo)
  {
        unlink("farm/Documento.txt");
        unlink("farm/arquivo.txt");
        $dd = "Documento";
        $imagem_nome = substr_replace($arquivo["name"], $dd,0,strrpos($arquivo["name"], "."));
       // preg_match("/\.([-.a-zA-Z]|[1-9]){1,10}/", $imagem_nome, $ext);
        if(substr($imagem_nome, -3) == "txt"){
            $imagem_dir = "farm/" . $imagem_nome;
            // Faz o upload da imagem
            $up = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
            if ($up){
                require_once ('arquivo_farm.php');

            }else echo "<script> alert (\"Erro no Upload\");</script> <br /><br />";
        }else echo "<script> alert (\"Extensão não confere\");</script> <br /><br />";
  }else echo "<script> alert (\"Erro no Arquivo Imagem\");</script><br /><br />";


}



?>
<h3>Arquivo Farmácia</h3> <br /><br />
<form id="form1" name="form1" method="post" action="arquivofarm.php" enctype="multipart/form-data" onSubmit="return validaForm()">
    <!---<label>Nome:</label><br />
  <input type="text"  name="nome" id="nome" />
  <br />  <br />  -->

  <label>Documento:</label><br />
  <input type="file" name="doc" id="doc" />
  <br />  <br />
  <input type="hidden"  name="nome" id="nome"  value="123"/>
  <input type="submit" name="Submit" id="button" value="Enviar Arquivo" class="botao" />
</form>
<br /><br />

</body>
</html>
