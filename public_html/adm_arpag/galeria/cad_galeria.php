<?php
	include("../../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../../php/class.php');
	require_once('../../bd_funcao/maysql.php');
	require_once('../../php/funcao_0.2.php');
	//require_once('../config.php');
	include_once('topo.php');
	error_reporting(0);
?>
<script>
	function exclui(m){
        var url = 'funcao_ajax.php?fun=6&m='+m;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
</script>
<?php
include_once('menu.php');
$nome    = $_POST["nome"];
if($nome != ""){
    $sql = "insert into arpag_galeria (nome)
            values ('$nome')";
    $insertgal  = new insercao();
                $insertgal->campo   = 'nome';
                $insertgal->tabela  = 'arpag_galeria';
                $insertgal->dados   = utf8_decode("'".$nome."'");
    if ($idgal = insert_bd_return_id($insertgal)){
        $ff    = mkdir("$idgal/",0777,true);
        if     ($ff) echo "<script>alert ('Galeria cadastrada.');</script>";
        else   echo "<script>alert ('Erro na criação do diretório.'); window.location='cad_galeria.php';</script>";
    }else echo "Erro no Cadastro!!";
}
?>

<form name="cad_galeria" method="post" action="cad_galeria.php">
	<label>Nome:</label>&nbsp;<input type="text" name="nome" id="nome" />
    <br /><br />
    <input type="submit" value="Cadastrar Galeria" />
</form>
<div id='load'>
<table class='table'>
<?php
if(($ex = isset($_GET['e']) ? dcript($_GET['e'],'Erro de indentificacao para a exclusao') : NULL) == 1){
    $di         = dcript($_GET['d'],'Erro na identificacao da galeria');
    $deletar    = new exclui();
                $deletar->tabela    ='arpag_galeria';
                $deletar->parametro = "id = ".$di;
    if (delete_db($deletar)){
        function rrmdir($dir) {
            foreach(glob($dir . '/*') as $file) {
                if   (is_dir($file)) rmdir($file);
                else unlink($file);
            }
            rmdir  ($dir);
            return true;
        }
        $exc = rrmdir($di);
            if($exc == 1) echo "<script>alert ('Galeria removida com sucesso.');window.location='cad_galeria.php';</script>";
    }
}
echo "<br />";
 
    $listagaleria   = new consulta();
                $listagaleria->campo        = '*';
                $listagaleria->tabela       = 'arpag_galeria';
                $listagaleria->parametro    = 'id DESC';
    $listexect = select_db_2($listagaleria);
    while ($li = $listexect->fetch_array()) {
		 echo utf8_encode("
		 	<tr>
				<td>
					<a href='cad_galeria.php?d=".cript($li['id'])."&e=".cript(1)."' class='btn btn-primary btn-danger'>Excluir</a> 
					<a href='alt_galeria.php?d=".cript($li['id'])."&e=".cript(1)."' class='btn btn-warning'>Editar</a>
				&nbsp;&nbsp;".$li[1]."<br />
			</tr>");
    }
?>

</table>
</div>

