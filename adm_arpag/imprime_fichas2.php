<?php
include("../seguranca/seguranca.php");
require_once('../php/class.php');
require_once('../bd_funcao/maysql.php');
require_once('../php/funcao_0.2.php');
$html = '';
if($idetapa 		= (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
	$idmodalidade 	= dcript($_GET['jsdf'],'Erro na modalidade');	
    $numero_inicio  = dcript($_GET['i'],'Erro no numero inicio');
	$consulta = new consulta();
                $consulta->campo	= 'DISTINCT a.id';
                $consulta->tabela	= "arpag_passaro_etapa AS a INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                                                INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa";
                $consulta->parametro= "c.id = ".$idetapa." 
                                        AND b.id_modalidade = ".$idmodalidade." 
                                        ORDER BY a.numero
                                        LIMIT ".$numero_inicio.", 50";
				$executa = select_db($consulta);
    $cont = 1;
	while ($linha = $executa->fetch_array()){
        $consulta_pess = new consulta();
        $consulta_pess->campo	= 'a.id, b.nome nomepassaro, c.nome nomeetapa, d.nome nomepessoa, 
                                      c.data_etapa, c.local, b.anilha, b.id_modalidade, c.id_temporada, 
                                      d.id_clube, a.numero, arpag_clube.nome nomeclube, d.numero_socio,
                                      arpag_tipo_modalidade.nome nometipomodalidade';
        $consulta_pess->tabela	= "arpag_passaro_etapa AS a 
                                        INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                        INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                        INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa
                                        LEFT OUTER JOIN arpag_clube      ON arpag_clube.id = d.id_clube
                                        INNER JOIN arpag_tipo_modalidade ON arpag_tipo_modalidade.id = c.id_tipo_modalidade";
        $consulta_pess->parametro= "a.id = ".$linha['id'];
        $executa_pess = select_db($consulta_pess);
        $linha_pess = $executa_pess->fetch_array();

		$html .= "<table width='837' height='900' border='1'>

            <tr style='height:39px;'>
                
                <td class='s0' colspan='10'>FICHA DE INSCRIÇÃO / JULGAMENTO EM TORNEIOS </td>
                 
            </tr>
            <tr style='height:18px;'>
                
                <td class='s2' colspan='3' rowspan='8'><img src='../images/logotipo.jpg' width='100' height='95' /><br /><b>torneios.net.br</b></td>
                <td class='s3' colspan='4' rowspan='8'>
                <p style='LINE-HEIGHT:200%;'>
                Data do Torneio: <b>". dtahoraela($linha_pess['data_etapa'])."</b><br />
                Etapa: <b>". ($linha_pess['nomeetapa'])."</b><br />
                Evento: <b>". (retorna_nome($linha_pess['id_temporada'],'arpag_temporada'))."</b><br />
                Clube: <b>". ($linha_pess['nomeclube'])."</b><br />
                Sócio Nº: <b>". ($linha_pess['numero_socio'])."</b><br />
                Prova: <b>". (retorna_nome($linha_pess['id_modalidade'],'arpag_modalidade'))." / 
                ". $linha_pess['nometipomodalidade']."</b>
                </p>
                </td>
                <td class='s3' colspan='3' rowspan='4'>Nº Inscrição: <br /><b>". ($linha_pess['numero'])."</b> </td>
                 
            </tr>
            <tr style='height:18px;'>
                
                 
            </tr>
            <tr style='height:18px;'>
               
               <!-- <td class='s3' colspan='4' rowspan='2'>Etapa:<br /><b>". ($linha_pess['nomeetapa'])."</b> </td>-->
                 
            </tr>
            <tr style='height:18px;'>
                
                 
            </tr>
            <tr style='height:18px;'>
               
                <!--<td class='s3' colspan='4' rowspan='2'>CLUBE:<br /><b>". ($linha_pess['nomeclube'])."</b></td>-->
                <td class='s3' colspan='3' rowspan='4'>Nome da AVE:<br /><b>". ($linha_pess['nomepassaro'])."</b><br />
                                                       Anilha:<br /><b>". ($linha_pess['anilha'])."</b>
                </td></td>
                 
            </tr>
            <tr style='height:18px;'>
               
                 
            </tr>
            <tr style='height:18px;'>
               
                <!--<td class='s3' colspan='4' rowspan='2'>SÓCIO Nº:<br /><b>". ($linha_pess['numero_socio'])."</b></td>-->
                 
            </tr>
            <tr style='height:18px;'>
               
                 
            </tr>
            <tr style='height:18px;'>
                           
                <td class='s4' colspan='3' rowspan='2'>Proprietário:</td>
                <td class='s2' colspan='7' rowspan='2'><br /><b>". ($linha_pess['nomepessoa'])."</b></td>
                 
            </tr>
            <tr style='height:18px;'>
               
                 
            </tr>
            <tr style='height:24px;'>
               
                <td class='s4' colspan='10'>O EXPOSITOR DECLARA PARA TODOS OS FINS, QUE AS INFORMAÇÕES CONTIDAS </td>
                 
            </tr>
            <tr style='height:24px;'>
               
                <td class='s4' colspan='10'>NESTA INSCRIÇÃO SÃO VERIDICAS E DE SUA RESPONSABILIDADE.</td>
                 
            </tr>
            <tr style='height:18px;'>
                
                <td class='s3' colspan='10' rowspan='7'>TEMPO CLASSIFICATÓRIO:
                
                <table>                    
                    <tr>
                    <td height='110'></td>
                    </tr>
                </table>

                </td>
                 
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
               
                <td class='s3' colspan='10' rowspan='7'>TEMPO FINAL:
                <table border='1'>                    
                <tr>
                <td height='110'></td>
                </tr>
            </table>
            </td>
                 
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
                
                <td class='s3' colspan='7' rowspan='7'>OBSERVAÇÕES:</td>
                <td class='s3' colspan='3' rowspan='7'>CARIMBO:</td>
                 
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
                
                <td class='s2' colspan='10' rowspan='2'>( ) FORA DA PROVA ( ) Não Cantou ( ) Desclassificado ( ) Não Compareceu</td>
                 
            </tr>
            <tr style='height:18px;'>
                
                 
            </tr>
            <tr style='height:18px;'>
               
                <td class='s2' colspan='10' rowspan='5'></td>
                 
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
                 
                      
                <td class='s4' colspan='5' rowspan='2'>JUIZ</td>
                <td class='s4' colspan='5' rowspan='2'>MESÁRIO</td>
                 
            </tr>
            <tr style='height:18px;'>
             
                 
            </tr>
            </tr>  
    </table>";
        $cont++;

	}    
  }
  //echo $html;
  include("../pdf/mpdf60/mpdf.php"); 
  $mpdf=new mPDF('pt','A4',10,'',8,8,5,14,9,9,'P');
  $mpdf->WriteHTML($html);
  $mpdf->Output();
  exit();

?>
