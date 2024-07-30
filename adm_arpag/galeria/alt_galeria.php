<?php
	include("../../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../../php/class.php');
	require_once('../../bd_funcao/maysql.php');
	require_once('../../php/funcao_0.2.php');
	//require_once('../config.php');
	include_once('topo.php');
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head><title></title></head>

<body>

<div>

 <?php
 include_once('menu.php');
	$id 	= dcript($_GET['d'],'Erro ao identificar a galeria');
	$listagaleria   = new consulta();
			  		$listagaleria->campo        = '*';
		            $listagaleria->tabela       = 'arpag_galeria';
		            $listagaleria->parametro    = "id = ".$id;
    $listexect = select_db($listagaleria);
    $rs = $listexect->fetch_array();	
		
		?>
        <h3>Alterar galeria</h3> <br />
       <form action="alt_galeria2.php" method="post" name="AlteraNoticias" >
       		
       		<input type="text" name="nome" value="<?php echo utf8_encode($rs['nome']); ?>" />
            <br />
            
            
            <input type="hidden" name="id" value="<?php echo cript($rs['id']); ?>" />                    
                                
            <br />
            
            <input type="submit" value="Alterar"/>
            
       </form>
 </div>
</body>
</html>
