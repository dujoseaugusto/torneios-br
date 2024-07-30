<?php
	include("../seguranca/seguranca.php");
	//protegePagina(1);
	require_once('../php/class.php');
	require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php');
?>

<?php
if($idetapa 		= (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
	$idmodalidade 	= dcript($_GET['jsdf'],'Erro na modalidade');
	$consulta 		= new consulta();
                $consulta->campo	= 'a.id, b.nome, c.nome, d.nome, b.anilha, a.numero, a.classificacao, a.final, a.pontuacao,
										c.data_etapa, c.id_temporada, b.id_modalidade, d.estado, d.cidade, c.local, c.descricao';
                $consulta->tabela	= "arpag_passaro_etapa AS a INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                                                INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                                                INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa";
                $consulta->parametro= "c.id = ".$idetapa." AND b.id_modalidade = ".$idmodalidade." ORDER BY a.numero limit 1";
				$executa = select_db($consulta);
				$li = $executa->fetch_array();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ficha</title>
<style type="text/css">
	body{margin:0; padding:0;}
	table{font-family:Arial, Helvetica, sans-serif; font-size:12px;}
</style>
</head>

<!---<body onload="window.print();">-->
	<body>
		
	<table width="837" border="1">
  <tr>
    <td colspan="3" style="text-align:center; font-weight:bold;">Lista de inscritos</td>
  </tr>
  <tr>
    <td><img src="../images/logotipo.jpg" width="100" /></td>
    <td width="519" style="font-weight:bold;">Data da etapa: <?php echo dtahoraela($li['data_etapa']);?><br />
      Evento: <?php echo utf8_encode(retorna_nome($li['id_temporada'],'arpag_temporada'));?><br />
      Etapa: <?php echo utf8_encode($li[2]);?><br />
      Modalidade: <?php echo utf8_encode(retorna_nome($li['id_modalidade'],'arpag_modalidade'));?></td>
    <td width="196" style="font-weight:bold;"><p><br />
    </p>
    <p>Local:<br />
	<?php echo utf8_encode($li['descricao']."<br />".$li['local']);?></p></td>
  </tr>
  
    </table>

<table width="837" style="border: solid 1px;">
	<tr style="border: solid 1px;">
		<td style="border: solid 1px;">inscri&ccedil;&atilde;o</td>
		<td style="border: solid 1px;">Estaca</td>		
		<td style="border: solid 1px;">Nome do Passaro</td>
		<td style="border: solid 1px;">Anilha</td>
		<td style="border: solid 1px;">Nome do Propietario</td>
		<td style="border: solid 1px;">Cidade</td>
		<td style="border: solid 1px;">Classifica&ccedil;&atilde;o</td>
		<td style="border: solid 1px;">Final</td>
		<td style="border: solid 1px;">Pontos</td>
	</tr>
	
	<?php
	$consulta 		= new consulta();
                $consulta->campo	= 'a.id, b.nome, c.nome, d.nome, b.anilha, a.numero, a.classificacao, a.final, a.pontuacao,
										c.data_etapa, c.id_temporada, b.id_modalidade, d.estado, d.cidade, c.local, c.descricao';
                $consulta->tabela	= "arpag_passaro_etapa AS a INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                                                INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                                                INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa";
                $consulta->parametro= "c.id = ".$idetapa." AND b.id_modalidade = ".$idmodalidade." ORDER BY a.numero";
				$executa = select_db($consulta);
	$cont = 1;
	while ($linha = $executa->fetch_array()){
		?>
		<tr style="border: solid 1px; height: 35px;">
			<td style="border: solid 1px;"><?php echo $cont;?></td>
			<td style="border: solid 1px;"><?php echo $linha['numero'];?></td>			
			<td style="border: solid 1px;"><?php echo utf8_encode($linha[1]);?></td>
			<td style="border: solid 1px;"><?php echo utf8_encode($linha['anilha']);?></td>
			<td style="border: solid 1px;"><?php echo utf8_encode($linha[3]);?></td>
			<td style="border: solid 1px;"><?php echo utf8_encode($linha['cidade'] ." ".$linha['estado']);?></td>			
			<td width="60" style="border: solid 1px;"></td>
			<td width="60" style="border: solid 1px;"></td>
			<td width="60" style="border: solid 1px;"></td>
		</tr>
		
		<?php
		$cont++;
	}
?>
</table>
</body>
</html>
<?php
  }
?>
