<?php
	include("seguranca/seguranca.php");
	protegePagina(2);
	require_once('php/class.php');
	require_once('bd_funcao/maysql.php');
	require_once('php/funcao_0.2.php');	
	//include_once('topo.php');
?>

<?php
if($idetapa = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
	$consulta = new consulta();
                $consulta->campo	= 'a.id, b.nome nomepassaro, c.nome nomeetapa, d.nome nomepessoa, 
                                      c.data_etapa, c.local, b.anilha, b.id_modalidade, c.id_temporada, 
                                      d.id_clube, a.numero, arpag_clube.nome nomeclube, d.numero_socio,
                                      arpag_tipo_modalidade.nome nometipomodalidade';
                $consulta->tabela	= "arpag_passaro_etapa AS a 
                                        INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                        INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                        INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa
                                        LEFT OUTER JOIN arpag_clube      ON arpag_clube.id = d.id_clube
                                        LEFT OUTER JOIN arpag_tipo_modalidade ON arpag_tipo_modalidade.id = c.id_tipo_modalidade";
                $consulta->parametro= "a.id = ".$idetapa;
				$executa = select_db($consulta);
				$linha = $executa->fetch_array();

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

<body onload="window.print();">

<table width="837" border="1">

    <tbody>
        <tr style='height:39px;'>
            
            <td class="s0" colspan="10">FICHA DE INSCRIÇÃO / JULGAMENTO EM TORNEIOS </td>
             
        </tr>
        <tr style='height:18px;'>
            
            <td class="s2" colspan="3" rowspan="8"><img src="images/logotipo.jpg" width="70%"/></td>
            <td class="s3" colspan="4" rowspan="8">
            <p style="LINE-HEIGHT:200%;">
            Data do Torneio: <b><?php echo dtahoraela($linha['data_etapa']);?></b><br />
            Etapa: <b><?php echo ($linha['nomeetapa']);?></b><br />
            Evento: <b><?php echo (retorna_nome($linha['id_temporada'],'arpag_temporada'));?></b><br />
            Clube: <b><?php echo ($linha['nomeclube']);?></b><br />
            Sócio Nº: <b><?php echo ($linha['numero_socio']);?></b><br />
            Prova: <b><?php echo (retorna_nome($linha['id_modalidade'],'arpag_modalidade'));?> / 
            <?php echo $linha['nometipomodalidade'];?></b>
            </p>
            </td>
            <td class="s3" colspan="3" rowspan="4">Nº Inscrição: <br /><b><?php echo ($linha['numero']);?></b> </td>
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
           <!-- <td class="s3" colspan="4" rowspan="2">Etapa:<br /><b><?php echo ($linha['nomeetapa']);?></b> </td>-->
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
            <!--<td class="s3" colspan="4" rowspan="2">CLUBE:<br /><b><?php echo ($linha['nomeclube']);?></b></td>-->
            <td class="s3" colspan="3" rowspan="4">Nome da AVE:<br /><b><?php echo ($linha['nomepassaro']);?></b><br />
                                                   Anilha:<br /><b><?php echo ($linha['anilha']);?></b>
            </td></td>
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
            <!--<td class="s3" colspan="4" rowspan="2">SÓCIO Nº:<br /><b><?php echo ($linha['numero_socio']);?></b></td>-->
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
            <td class="s4" colspan="3" rowspan="2">Proprietário:</td>
            <td class="s2" colspan="7" rowspan="2"><br /><b><?php echo ($linha['nomepessoa']);?></b></td>
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:24px;'>
           
            <td class="s4" colspan="10">O EXPOSITOR DECLARA PARA TODOS OS FINS, QUE AS INFORMAÇÕES CONTIDAS </td>
             
        </tr>
        <tr style='height:24px;'>
           
            <td class="s4" colspan="10">NESTA INSCRIÇÃO SÃO VERIDICAS E DE SUA RESPONSABILIDADE.</td>
             
        </tr>
        <tr style='height:18px;'>
            
            <td class="s3" colspan="10" rowspan="7">TEMPO CLASSIFICATÓRIO:</td>
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
            <td class="s3" colspan="10" rowspan="7">TEMPO FINAL:</td>
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
            
            <td class="s3" colspan="7" rowspan="7">OBSERVAÇÕES:</td>
            <td class="s3" colspan="3" rowspan="7">CARIMBO:</td>
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
          
             
        </tr>
        <tr style='height:18px;'>
            
            <td class="s2" colspan="10" rowspan="2">( ) FORA DA PROVA ( ) Não Cantou ( ) Desclassificado ( ) Não Compareceu</td>
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
            <td class="s2" colspan="10" rowspan="5"></td>
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
          
             
        </tr>
        <tr style='height:18px;'>
            
             
        </tr>
        <tr style='height:18px;'>
           
             
        </tr>
        <tr style='height:18px;'>
             
        </tr>
        <tr style='height:18px;'>    
             
                  
            <td class="s4" colspan="5" rowspan="2">JUIZ</td>
            <td class="s4" colspan="5" rowspan="2">MESÁRIO</td>
             
        </tr>
        <tr style='height:18px;'>
         
             
        </tr>
        </tr>   
        
    </tbody>
</table>
<br />
<br />
<br />
</body>
</html>
<?php
  }
?>
