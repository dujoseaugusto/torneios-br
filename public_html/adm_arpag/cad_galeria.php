<?php
	include("config.php");
	require_once('../../php/class.php');
	//require_once('../bd_funcao/maysql.php');
	require_once('../../php/funcao_0.2.php');
	
	include_once('topo.php');
?>

<?php
include_once('menu.php');
$nome  = $_POST["nome"];

if($nome != ""){
    $sql = "insert into arpag_galeria (nome)
            value ('$nome')";
    $rs  = mysql_query($sql);
    if ($rs){
        $idgal = mysql_insert_id();
        $ff    = mkdir("$idgal/",0777,true);
        if     ($ff) echo "<script>alert (\"Cadastrado Concluído!!!!!\");</script>";
        else   echo "<script>alert (\"Erro na criação do diretório!!!\");</script>";
    }else echo "Erro no Cadastro!!";
}
?>
<br />
<form id="form1" name="form1" method="post" action="cad_galeria.php" enctype="multipart/form-data" onSubmit="return validaForm()">
    <label>Nome da Galeria:</label><br />
    <input type="text"  name="nome" id="nome" />
    <br /><br />
    <input type="submit" name="Submit" id="button" value="Cadastrar" class="botao"/>

</form>
<br />
<h3>Lista de Galerias</h3>
<?php
$ex = $_GET['e'];
if($ex == 1){
    $di = $_GET['d'];
    $cod = "delete from arpag_galeria where id = $di";
    $sq  = mysql_query($cod);
    if($sq){
        function rrmdir($dir) {
            foreach(glob($dir . '/*') as $file) {
                if   (is_dir($file)) rmdir($file);
                else unlink($file);
            }
            rmdir  ($dir);
            return true;
        }
        $exc = rrmdir($di);
            if($exc ==1) echo "<script>alert (\"Exclusão Executada Com Sucesso!!!\");</script>";
    }else{
        $erro = substr(mysql_error(),0,6);
        if($erro == "Cannot") echo "<script>alert (\"Esta galeria não pode ser excluída, pois está ligada a uma ou mais tabelas\");</script>";
    }
}
echo "<br />";
    $sqll = "SELECT nome,id from arpag_galeria order by id desc";
    $rr   = mysql_query($sqll);
    while ($li = mysql_fetch_row($rr)) {
        echo "<a href=\"cad_galeria.php?d=$li[1]&e=1\" style=\"border=none\">Excluir</a> - $li[0] <br /><br />";
    }
?>
                    
</div>