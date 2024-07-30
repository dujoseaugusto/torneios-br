<?php
	include("../../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../../php/class.php');
	require_once('../../bd_funcao/maysql.php');
	require_once('../../php/funcao_0.2.php'); 
//recebe via get um valor para selecionar qual sera a função usada
$fun = (isset($_GET['fun'])) ? $_GET['fun'] : '';
switch($fun){
	//exclui temporada 
	case 1: $exclui = new exclui();
						$exclui->tabela		= 'arpag_temporada';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista = new consulta();
			$lista->campo		= ' id, nome ';
			$lista->parametro	= ' nome';
			$lista->tabela		= 'arpag_temporada';
			if ($consulta = select_db_2($lista)){
				while($resposta = $consulta->fetch_array()){
					?><a class='btn btn-primary btn-danger' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>  <?php echo $resposta['nome'];?><br /><?php
				}
			}
			break;
			
	case 2:	$exclui = new exclui();
						$exclui->tabela		= 'arpag_etapa';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista = new consulta();
						$lista->campo		= 'a.id, a.nome, b.nome, a.data_etapa, a.local';
						$lista->parametro	= "id DESC LIMIT 15";
						$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
			if ($consulta = select_db_2($lista)){
				echo "<table class='table'>";
				while($resposta = $consulta->fetch_array()){
					?><tr><td><a class='btn btn-primary btn-danger' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a></td>
							<td><?php echo utf8_encode($resposta[1])." </td><td> ". utf8_encode($resposta[2]);?></td>
							<td><?php echo dtahoraela($resposta['data_etapa']); ?></td>
							</tr><?php
				}
			}
			echo '</table>';
			break;
	case 3: $exclui = new exclui();
						$exclui->tabela		= 'arpag_clube';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista = new consulta();
			$lista->campo		= ' id, nome ';
			$lista->parametro	= ' nome';
			$lista->tabela		= 'arpag_clube';
			if ($consulta = select_db_2($lista)){
				while($resposta = $consulta->fetch_array()){
					?><a class='btn btn-primary btn-primary' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>  <?php echo $resposta['nome'];?><br /><?php
				}
			}
			break;
			
	case 4: $idetapa  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$idmoda 	= dcript($_GET['o'],'Erro na identificacao da estapa');
            $consulta = new consulta();
    					$consulta->campo	= 'a.id, b.nome, c.nome, d.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." AND b.ativo = 1 GROUP BY a.numero";
    		$executa = select_db($consulta);
			echo "<a class='btn btn-primary btn-primary' href='ver_etapa.php?dghf=".cript($idetapa)."'>Fechar para inscri&ccedil;&atilde;o </a>  ";
            
			echo " Modalidade: " .utf8_encode(retorna_nome($idmoda, 'arpag_modalidade'));
			echo "<form name='veretapa' method='post' action='ver_etapa.php'>
					<table border='1'class='table table-bordered'> ";
            echo "<tr class='titulo_tabela'>
					<td>Inscricao</td>
					<td>Estaca</td>
					<td>Nome do Passaro</td>
					<td>Anilha</td>
					<td>Nome do Propietario</td>
					<td>Cidade</td>
					<td>Classifica&ccedil;&atilde;</td>
					<td>Final</td>
					<td>Pontos</td>
				 </tr>";
			$cont = 1;
    		while($linha = $executa->fetch_array()){
    			echo "<tr>
						<td>".$cont."</td>
						<td>".utf8_encode($linha['numero'])."</td>
						<td>".utf8_encode($linha['1'])."</td>
						<td>".utf8_encode($linha['anilha'])."</td>						
						<td>".utf8_encode($linha['2'])."</td>
						<td>".utf8_encode($linha['cidade']." ".$linha['estado'])."</td>
						<td> <input type='hidden' <input type='text' name='inscricao[]' value='".cript($linha['id'])."'/>
						     <input type='text' name='classific[]' size='3' value='".$linha['classificacao']."'/></td>
							 <td><input type='text' name='final[]' size='3' value='".$linha['final']."' /></td>
							 <td><input type='text' name='ponto[]' size='3' value='".$linha['pontuacao']."' /></td></tr>";
				$cont++;
			}
		    echo "</table class='table'><input type='submit' value='Atualizar' />
					</form><br /><br />";
			break;
			
	case 5: $idetapa  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
            $idmoda 	= dcript($_GET['o'],'Erro na identificacao da estapa');
			$consulta = new consulta();
    					$consulta->campo	= 'a.id, b.nome, c.nome, d.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." AND b.ativo = 1 GROUP BY a.numero ORDER BY a.pontuacao DESC";
    		$executa = select_db($consulta);
			echo "<a class='btn btn-primary btn-primary' href='ver_etapa_fech.php?dghf=".cript($idetapa)."'>Reabrir inscri&ccedil;&atilde;o </a>  ";
            echo "<a class='btn btn-primary btn-success' href='imprime_inscricao.php?kj=".cript($idetapa)."&jsdf=".cript($idmoda)."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir lista de Inscritos</a><br />";
			echo " Modalidade: " .utf8_encode(retorna_nome($idmoda, 'arpag_modalidade'));
			echo "<table border='1'class='table table-bordered'> ";
            echo "<tr class='titulo_tabela'>
					<td>Inscricao</td>
					<td>Estaca</td>					
					<td>Nome do Passaro</td>
					<td>Anilha</td>
					<td>Nome do Propietario</td>
					<td>Cidade</td>
					<td>Classifica&ccedil;&atilde;</td>
					<td>Final</td>
					<td>Pontos</td>
				  </tr>";
			$cont = 1;
    		while($linha = $executa->fetch_array()){
    			echo "<tr>
				<td>".$cont."</td>
				<td>".utf8_encode($linha['numero'])."</td>				
				<td>".utf8_encode($linha['1'])."</td>
				<td>".utf8_encode($linha['anilha'])."</td>
				<td>".utf8_encode($linha['2'])."</td>
				<td>".utf8_encode($linha['cidade'])."  ".$linha['estado']."</td>
				<td> <input type='hidden' <input type='text' name='inscricao[]' value='".cript($linha['id'])."'/>".$linha['classificacao']."</td>
				<td>".$linha['final']."</td>
				<td>".$linha['pontuacao']."</td></tr>";
			$cont++;
			}
		    echo "</table><br /><br />";
			break;
			
			case 6: $exclui = new exclui();
						$exclui->tabela		= 'arpag_galeria';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista = new consulta();
			$lista->campo		= ' id, nome ';
			$lista->parametro	= ' nome';
			$lista->tabela		= 'arpag_galeria';
			if ($consulta = select_db_2($lista)){
				while($resposta = $consulta->fetch_array()){
					?><a class='btn btn-primary btn-primary' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>  <?php echo $resposta['nome'];?><br /><?php
				}
			}
			break;
			
			case 7: $idpassaro	= dcript($_GET['mn'],'Erro id passaro, funcao ajax'); 
			$nome 		= trocanome($_POST['nome']);
			$anilha 	= trocanome($_POST['anilha']);
			$ativo		= trocanome($_POST['ativo']);
			//echo $idpassaro."  ".$nome." ".$anilha." ".$ativo;
			$atualiza_pass 	= new atualiza();
								$atualiza_pass->parametro 	= "id = ".$idpassaro;
								$atualiza_pass->tabela		= 'arpag_passaro';
								$atualiza_pass->campo 		= "nome = '".$nome."', anilha = '".$anilha."', ativo = ".$ativo;
			if(update_bd($atualiza_pass))echo "Alterado";
			else echo "Erro";
			break;
	
			
			case 8: $idgaleria	  = dcript($_GET['mn'],'Erro id galeria, funcao ajax'); 
					$nome 		  = trocanome($_POST['nome']);
					$atualiza_gal = new atualiza();
										$atualiza_gal->parametro 	= "id = ".$idgaleria;
										$atualiza_gal->tabela		= 'arpag_galeria';
										$atualiza_gal->campo 		= "nome = ".$nome;
					if(update_bd($atualiza_gal))echo "Alterado";
					else echo "Erro";
			break;
			
			

	default: echo 'Erro';

}

?>