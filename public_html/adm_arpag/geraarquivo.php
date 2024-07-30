<?php
    include("../seguranca/seguranca.php");
       // Determina que o arquivo é uma planilha do Excel
   header("Content-type: application/vnd.ms-excel");  
   // Força o download do arquivo
   header("Content-type: application/force-download"); 
   // Seta o nome do arquivo
   header("Content-Disposition: attachment; filename=Arpag".date('d-m-Y').".xls");
   header("Pragma: no-cache");
   // Imprime o conteúdo da nossa tabela no arquivo que será gerado
   // protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    //include_once('topo.php');
?>

<body>
 <?php
 	$idetapa 	= dcript($_SESSION['idetapa'],'id etapa');
  	$idmoda 	= dcript($_SESSION['idmoda'],'id moda');
  	$consulta 	= new consulta();
    					$consulta->campo	= 'a.id, b.nome AS nomepassaro, c.nome, d.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado, f.status_transacao, f.id AS idpagamento, c.id AS idpessoa, f.cod_pagamento,
												f.valor';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa
                                                INNER JOIN arpag_pagamento_passaro_etapa AS e ON e.id_passaro_etapa = a.id 
                                                INNER JOIN arpag_pagamento AS f ON f.id = e.id_pagamento";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." GROUP BY a.numero  
    											ORDER BY a.pontuacao DESC, a.final DESC, a.classificacao DESC";
    		$executa = select_db($consulta); 


 $html = "
				
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                        Modalidade: " .retorna_nome($idmoda, 'arpag_modalidade')."
                        <br>
                        Etapa:  " .retorna_nome($idetapa, 'arpag_etapa')."
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>

					<table border='1'>
                    <thead>
                    <tr class='titulo_tabela'>
					<td>Pagamento</td>
					<td>Cod Pagamento</td>
					<td>Estaca</td>
					<td>Nome do Passaro</td>
					<td>Anilha</td>
					<td>Nome do Propriet&aacute;rio</td>
					<td>Cidade</td>
					<td>Classifica&ccedil;&atilde;o</td>
					<td>Final</td>
					<td>Pontos</td>
				 </tr>";
			$cont = 1;
    		while($linha = $executa->fetch_array()){
    			if (!$linha['status_transacao'])$bot_trasacao = 0;
    			else $bot_trasacao = $linha['status_transacao'];
    			$html .= "<tr>";
						
						$html .= "<td>";
						$html .=  retorna_nome($bot_trasacao,'arpag_status_pagseguro');						
						$html .= "</td>
						<td>".$linha['cod_pagamento']."</td>
						<td>".$linha['numero']."</td>
						<td>".$linha['nomepassaro']."</td>						
						<td>".$linha['anilha']."</td>						
						<td>".$linha['2']."</td>
						<td>".$linha['cidade']." ".$linha['estado']."</td>";
						//if ($linha['status_transacao'] == 7){
							$html .= "<td>".$linha['classificacao']."</td>
							 		<td>".$linha['final']."</td>";
						//}else 
						//{
							//$html .= "<td> </td>
							 	//	<td></td>";
									//$html .= "<td></td></tr>";
						//}
				$html .= "<td>".$linha['pontuacao']."</td></tr>";
				$cont++;
			}
		    $html .= "  </tbody>
                    </table>
                    </div>
                    </div>
                    </div>";


   echo $html;
?>



   

