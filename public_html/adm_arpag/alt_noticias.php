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
	$id = dcript($_GET['d'],'Erro na identificacao do aviso');
	$listaaviso  = new consulta();
			  		$listaaviso->campo        = '*';
			        $listaaviso->tabela       = 'arpag_noticias';
			        $listaaviso->parametro    = "id = ".$id;
    $listexect 	= select_db($listaaviso);
    $rs 		= $listexect->fetch_array();;
	?>
    <h3>Alterar notícias</h3> <br />
   	<form action="alt_noticias2.php" method="post" name="AlteraNoticias" >
   		
   		<input type="text" name="titulo" value="<?php echo utf8_encode($rs['titulo']); ?>" />
        <br />
        <label>Descrição:</label><br />
        <textarea rows="8" cols="45" name="descricao"><?php echo utf8_encode($rs['descricao']); ?></textarea>
        <input type="hidden" name="id" value="<?php echo cript($rs['id']); ?>" />                    
                            
        <br /><br /><br /><br />
        
        <input type="submit" value="Alterar notícia"/>
        
   </form>
 </div>
</body>
</html>
