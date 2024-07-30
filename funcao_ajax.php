<?php
	include("seguranca/seguranca.php");
	//protegePagina(2);
	require_once('php/class.php');
	require_once('bd_funcao/maysql.php');
	require_once('php/funcao_0.2.php'); 
//recebe via get um valor para selecionar qual sera a fun��o usada
$fun = (isset($_GET['fun'])) ? $_GET['fun'] : '';
switch($fun){
	case 1: 
			$idmodalidade	= dcript($_GET['n'],'Erro id modalidade, funcao ajax');
			$nomepassaro	= trocanome($_GET['m']);
			$nomeanilha 	= trocanome($_GET['o']);
			$numanilha 		= substr($nomeanilha, -6);
			if ((!is_numeric($numanilha)) || (strlen($numanilha) != 6)){
				echo "<p class='alert-danger'>O N&uacute;mero da Anilha est&aacute; incorreto. N&atilde;o coloque nem um car&aacute;cter 
							ap&oacute;s os 6 d&iacute;gitos da anilha. Siga o exemplo IBAMA OA 3,5 XXXXXX. 
							Apenas os 6 d&iacute;gitos s&atilde;o obrigat&oacute;rios</p>";
			    exit;
			}else if(verif_exite_anilha($numanilha)){
				echo "<p class='alert-danger'>Esse N&uacute;mero da Anilha j&aacute; se encontra cadastrado no sistema, entre em contato com o administrador e pe&ccedil;a para fazer a transfer&ecirc;cnia. </p>";
			    exit;
			}else{
				$insere = new insercao();
					$insere->campo	=	'nome,anilha,id_pessoa,id_modalidade,ativo,anilha_n';
					$insere->dados	=	("'".$nomepassaro."','".$nomeanilha."',".dcript($_SESSION['usuarioID'],'Não usuario').",".$idmodalidade.",1,".$numanilha);
					$insere->tabela	=	'arpag_passaro';
				if (insert_bd($insere)){
					echo ("<p class='alert-success'> Ok!!! P&aacute;ssaro Cadastrado</p>");
				}
			}
			$lista = new consulta();
			$lista->campo		= 'a.id, a.nome, b.nome';
			$lista->parametro	= "a.id_pessoa = ". dcript($_SESSION['usuarioID'],'Não usuario')." AND a.ativo = 1";
			$lista->tabela		= 'arpag_passaro AS a INNER JOIN arpag_modalidade AS b ON b.id = a.id_modalidade';
			if ($consulta = select_db($lista)){
				echo "<table class='table'>";
				while($resposta = $consulta->fetch_array()){
					?><tr><td><a class="btn btn-primary btn-danger" onclick="exclui('<?php echo cript($resposta['id']);?>')" title="Ao inativar uma ave o proproet&aacute;rio n&atilde;o poderar mais usar esse n&aacute;mero de 
									anilha ">Inativar P&aacute;sssaro</a></td>
					<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td></tr><?php
				}
				echo '<table>';
			}
			
			else echo 'Erro';
			break;
	case 2: 
			if(!retorna_passaro_incrito(dcript($_GET['m'],'Erro ao excluir'))){ 
				$exclui = new exclui();
							$exclui->tabela		= 'arpag_passaro';
							$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro id passaro, funcao ajax, excluir');
				$executa = delete_db($exclui);
				echo "<p class='alert-danger'> P&aacute;ssaro foi Exclu&iacute;do </p>";	
			}else{
				$atualiza = new atualiza();
							$atualiza->campo		= "ativo = 0";
							$atualiza->tabela		= 'arpag_passaro';
							$atualiza->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
				$executa = update_bd($atualiza);
				echo ("<p class='alert-success'> Ok!!! P&aacute;ssaro Desativado.<br />
									Se houver algum problema entre em contato com o administrador</p>");
			}
			$lista = new consulta();
			$lista->campo		= 'a.id, a.nome, b.nome';
			$lista->parametro	= "a.id_pessoa = ". dcript($_SESSION['usuarioID'],'Não usuario')." AND ativo = 1";
			$lista->tabela		= 'arpag_passaro AS a INNER JOIN arpag_modalidade AS b ON b.id = a.id_modalidade';
			if ($consulta = select_db($lista)){
				echo "<table class='table'>";
				while($resposta = $consulta->fetch_array()){
					?><tr><td><a class="btn btn-primary btn-danger" onclick="exclui('<?php echo cript($resposta['id']);?>')" title="Ao inativar uma ave o 
										proproet&aacute;rio n&atilde;o poderar mais usar esse n&aacute;mero de anilha ">Inativar P&aacute;sssaro</a></td>
					<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td></tr><?php
				}
				echo '</table>';
			}
			break;
	case 3: $idetapa  	= dcript($_GET['m'],'Erro id etapa, funcao ajax');
			//$idmoda 	= dcript($_GET['o'],'Erro na identificacao da modalidade'); quando se fazia a inscri��o por modalidade
			
			echo "<label>Passaros inscritos</label>";
			$consulta = new consulta();
							$consulta->campo	= 'b.id, b.nome, c.nome, b.anilha, a.id, d.id_pagamento as idpagamento, pag.status_transacao, 
							                      a.numero numero_estaca, c.id idmodalidade';
							$consulta->tabela	= 'arpag_passaro_etapa AS a
													INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro
													INNER JOIN arpag_modalidade AS c ON c.id = b.id_modalidade
													LEFT JOIN arpag_pagamento_passaro_etapa AS d ON d.id_passaro_etapa = a.id
													LEFT JOIN arpag_pagamento AS pag ON pag.id = d.id_pagamento';
							//$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." AND b.id_pessoa = ". dcript($_SESSION['usuarioID'],'N�o usuario')." AND b.ativo = 1 GROUP BY a.id"; Filta por modalidade
							$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_pessoa = ". dcript($_SESSION['usuarioID'],'N�o usuario')." AND b.ativo = 1 GROUP BY a.id, b.id, b.nome, c.nome, b.anilha, d.id_pagamento, pag.status_transacao";
				
				$executa = select_db($consulta);
				echo "<table border='1'class='table table-bordered'> ";
				echo "<tr><td style='width:50px;'></td><td>Nome</td><td>Anilha</td><td>Modalidade</td></tr>";
				$idjacadastrado 	= null;
				$pagamento_tabela	= null;
				$status_transacao	= null;
				while($linha = $executa->fetch_array()){
					if ($pagamento_tabela == null){$pagamento_tabela = $linha['idpagamento'];$status_transacao 	= $linha['status_transacao'];}

					if(($pagamento_tabela != $linha['idpagamento']) && ($status_transacao == 1)) {echo "<tr><td><a class='btn btn-primary btn-success' href='boleto.php?kj=".cript($pagamento_tabela)."'><span class='glyphicon'></span>Imprimir Boleto</a></td><td colspan='3'></td></tr></table>";
					echo "<br /><table border='1'class='table table-bordered'> ";
					echo "<tr><td style='width:50px;'></td><td>Nome</td><td>Anilha</td><td>Modalidade</td></tr>";
					} else if(($pagamento_tabela != $linha['idpagamento']) && ($status_transacao == 0)){
						echo "<tr><td><a class='btn btn-primary btn-success' href='pagamento2.php?kj=".cript($pagamento_tabela)."'><span class='glyphicon'></span>&nbsp;&nbsp;Gerar Pagamento</a></td><td colspan='3'></td></tr></table>";
						echo "<br /><table border='1'class='table table-bordered'> ";
						echo "<tr><td style='width:50px;'></td><td>Nome</td><td>Anilha</td><td>Modalidade</td></tr>";
					}

					if($linha['status_transacao'] > 0){
						echo "<tr><td>";
						if(($linha['numero_estaca'] == 0) && (retorna_tipo_estaca($idetapa) == 'M')){							
							echo "<b style='color:red'>Selecione a estaca:</b>
								 <br /><div id='load_carrega_ap'>
								 <select class='form-control atu_estaca' id='".cript($linha['id'])."'>";	
							$verificar = new consulta();
							$verificar->campo       = 'a.numero';
							$verificar->tabela      = 'arpag_passaro_etapa AS a
											INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
							$verificar->parametro   = "a.id_etapa = ".$idetapa. " 
														AND b.id_modalidade = ".$linha['idmodalidade']." ORDER BY numero";
							$executa_ver = select_db($verificar);
							$cont = 1;
							while($linha_ex = $executa_ver->fetch_array()){
								$vetor_count[$cont] = $linha_ex['numero'];
								$cont++;										
							}	
							echo "<option value='0'></option>";	
							for($i=1;$i<=retorna_nome_max_estacas($linha['idmodalidade'],$idetapa);$i++){
								if (!in_array($i, $vetor_count)){
									echo "<option value='".$i."'>".$i."</option>";	
								}
							}						
							echo "</select></div>";
						}else if (retorna_tipo_modalidade_etapa($idetapa) == 2){ 
						    echo "<a class='btn btn-primary btn-success' href='imprime2.php?kj=".cript($linha['id'])."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir inscri&ccedil;&atilde;o</a>";
						}else{
							echo "<a class='btn btn-primary btn-success' href='imprime.php?kj=".cript($linha['id'])."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir inscri&ccedil;&atilde;o</a>";
						}
						echo "</td><td>".($linha[1])."</td>
						<td>".($linha['anilha'])."</td>
						<td>".($linha[2])."</td>
						
						</tr>"; 

					}else{
						echo "<tr><td>N&atilde;o foi gerado Boleto</td>
						<td>".($linha[1])."</td>
						<td>".($linha['anilha'])."</td>
						<td>".($linha[2])."</td>
						
						</tr>"; 
					}
					
					$idjacadastrado 	.= $linha[0].",";
					$status_transacao 	= $linha['status_transacao'];
					$pagamento_tabela 	= $linha['idpagamento'];
					//echo $linha['idpagamento']." - ".$linha['status_transacao']."<br />";
				}
				if($status_transacao == 1){echo "<tr><td><a class='btn btn-primary btn-success' href='boleto.php?kj=".cript($pagamento_tabela)."'><span class='glyphicon'></span>Imprimir Boleto</a></td><td colspan='3'></td></tr></table>";
					echo "<br />";					
				}
				if(($status_transacao == 0) && ($pagamento_tabela)) {echo "<tr><td><a class='btn btn-primary btn-success' href='pagamento2.php?kj=".cript($pagamento_tabela)."'><span class='glyphicon'></span>&nbsp;&nbsp;Gerar Pagamento</a></td><td colspan='3'></td></tr></table>";
					echo "<br />";					
				}
				else echo '</table>';

				if (retorna_status($idetapa,'arpag_etapa') >=1){
					echo "<p class='alert-danger'>Inscri&ccedil;&otilde;es fechadas!!!</p>";
					break;
				} 

				
				//echo $idjacadastrado ."<br />". substr($idjacadastrado,0,-1)."<br />";
				$paramento1 = null ;
				if ($idjacadastrado) $paramento1 = "AND a.id NOT IN (".substr($idjacadastrado,0,-1).")";
				if (v_insc_aberta($idetapa)){
					echo "<label>Selecione os passaros para inscri&ccedil;&atilde;o</label>";
					echo "<form name='Inscricoes' method='post' action='cad_inscricoes.php' onsubmit='return validaInscricoes();'>";
					echo "<table border='1'class='table table-bordered'> ";
					$consulta = new consulta();
								$consulta->campo	= 'a.id, a.nome AS nomepassaro, b.nome AS nomemodalidade, a.anilha, b.id AS idmodalidade';
								$consulta->tabela	= 'arpag_passaro AS a
														INNER JOIN arpag_modalidade AS b ON b.id = a.id_modalidade';								
								$consulta->parametro= " a.id_pessoa = ". dcript($_SESSION['usuarioID'],'Não usuario')."
														AND a.ativo = 1
														AND b.ativo = 1 ".$paramento1." 
														AND b.id IN (SELECT arpag_valor_inscricao_etapa.id_modalidade 
																	 FROM arpag_valor_inscricao_etapa
																	 WHERE arpag_valor_inscricao_etapa.id_etapa = ".$idetapa." ) 
														ORDER BY a.id, a.nome, b.nome, a.anilha";
					$executa = select_db($consulta);
					echo "<tr><td style='width:100px;'></td>";
					if (retorna_tipo_estaca($idetapa) == 'M') echo "<td style='width:40px;'><b style='color:red'>Escolha o Nº estaca</b></td>";
					else echo "<td style='width:20px;'>Nº estaca</td>";
					echo "<td>Nome</td><td>Anilha</td><td>Modalidade</td></tr>";
					$count = 0;
					while($linha = $executa->fetch_array()){
						$cod_pass = cript($linha['id']);
						echo "<tr><td><input type='checkbox' name='passaro[]' id='procuro' value='".$cod_pass."' /> Inscrever</td>";
						if (retorna_tipo_estaca($idetapa) == 'M'){
							echo "<td><select name='est_".$cod_pass."'>";	
							$verificar = new consulta();
							$verificar->campo       = 'a.numero';
							$verificar->tabela      = 'arpag_passaro_etapa AS a
										  INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
							$verificar->parametro   = "a.id_etapa = ".$idetapa. " 
							                           AND b.id_modalidade = ".$linha['idmodalidade']." ORDER BY numero";
							$executa_ver = select_db($verificar);
							$cont = 1;
							while($linha_ex = $executa_ver->fetch_array()){
								$vetor_count[$cont] = $linha_ex['numero'];
								$cont++;										
							}	
							echo "<option value='0'></option>";	
							for($i=1;$i<=retorna_nome_max_estacas($linha['idmodalidade'],$idetapa);$i++){
								if (!in_array($i, $vetor_count)){
								 echo "<option value='".$i."'>".$i."</option>";	
								}
							}						
							echo "</select></td>";	
						} 
						else echo "<td>Automático</td>";
						echo "<td>".($linha['nomepassaro'])."</td>";
						echo "<td>".($linha['anilha'])."</td>";
						echo "<td> ".($linha['nomemodalidade'])."</td></tr>";
                        $count++;
					}
					if($count){
						echo "<tr><td colspan='2'><input type='submit' value='Realizar incri&ccedil;&atilde;o' /></td>
						<td><input type='hidden' name='idetapa' value='".cript($idetapa)."'  /></td><td>";
					}
					else{
						echo "<tr><td></td>
							<td></td><td>";
					}
					echo "</td></tr>
					</form>";
				}
				else  echo "<p class='alert-danger'>Inscri&ccedil;&otilde;es fechadas!!!</p>";
							
			break;
	case 4: $idetapa  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$idmoda 	= dcript($_GET['o'],'Erro na identificacao da estapa');

			$consulta_dis = new consulta();
    					$consulta_dis->campo	= 'distinct a.id_sub_categoria ';
    					$consulta_dis->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro";
						$consulta_dis->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda.'
												   AND a.pontuacao > 0  
						                           ORDER BY a.id_sub_categoria';
			$executa_dis = select_db($consulta_dis);
			while($linha_dis = $executa_dis->fetch_array()){			
				$consulta = new consulta();
							$consulta->campo	= 'a.id, b.nome, c.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
													c.cidade, c.estado, arpag_valor_inscricao_etapa.tipo_pontuacao AS p_modalidade';
							$consulta->tabela	= "arpag_passaro_etapa AS a
													INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
													INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
													INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa
													INNER JOIN arpag_modalidade ON arpag_modalidade.id = b.id_modalidade
													INNER JOIN arpag_valor_inscricao_etapa ON arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id 
																							AND arpag_valor_inscricao_etapa.id_etapa = d.id  ";
							$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." 
							                        AND a.id_sub_categoria = ".$linha_dis['id_sub_categoria']." AND a.pontuacao > 0 
													GROUP BY a.numero, a.id, b.nome, c.nome, b.anilha, a.classificacao, a.final, a.pontuacao, c.cidade, c.estado, arpag_modalidade.pontuacao
													ORDER BY a.pontuacao DESC, a.final DESC, a.classificacao DESC";
				$executa = select_db($consulta);
				echo " Modalidade: " .(retorna_nome($idmoda, 'arpag_modalidade'));
				if ($linha_dis['id_sub_categoria'] > 0) 
					echo " - ".retorna_nome($linha_dis['id_sub_categoria'],'arpag_sub_modalidade');
				echo "<table border='1'class='table table-bordered'> ";
				echo "<tr class='titulo_tabela'>
						<td>Posi&ccedil;&atilde;o</td>
						<td>Nome do Passaro</td>
						<td>Anilha</td>
						<td>Nome do Propriet&aacute;rio</td>
						<td>Cidade</td>
						<td>Classifica&ccedil;&atildeo;</td>
						<td>Final</td>
						<td>Pontos</td>
					</tr>";
				$cont = 1;
				while($linha = $executa->fetch_array()){
					switch($linha['p_modalidade']){
						case 'D': $numero_classifica = formata_decimal($linha['classificacao']);
								$numero_final = formata_decimal($linha['final']);
							break;
						case 'T': $numero_classifica = formata_tempo($linha['classificacao']);
								$numero_final = formata_tempo($linha['final']);
							break;
						default : $numero_classifica = formata_inteiro($linha['classificacao']);
								$numero_final = formata_inteiro($linha['final']);
					}
					echo "<tr>
							<td>".$cont."</td>
							<td>".($linha['1'])."</td>
							<td>".($linha['anilha'])."</td>						
							<td>".($linha['2'])."</td>
							<td>".($linha['cidade']." ".$linha['estado'])."</td>
							<td>".$numero_classifica ."</td>
							<td>".$numero_final."</td>
							<td>".$linha['pontuacao']."</td>
						</tr>";
				
				$cont++;
				}
				echo "</table><br /><br />";
		    }
			break;
	case 5: $idetapa  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
            $idmoda 	= dcript($_GET['o'],'Erro na identificacao da estapa');
			$consulta = new consulta();
    					$consulta->campo	= 'a.id, b.nome, c.nome, d.nome, a.numero, b.anilha, c.cidade, c.estado, c.id_clube, f.status_transacao';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro 					AS b ON b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa 					AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa 						AS d ON d.id = a.id_etapa
                                                LEFT JOIN arpag_pagamento_passaro_etapa 	AS e ON e.id_passaro_etapa = a.id
                                                LEFT JOIN arpag_pagamento 					AS f ON f.id = e.id_pagamento";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." AND
												b.ativo = 1 GROUP BY a.numero, a.id, b.nome, c.nome, d.nome, b.anilha, c.cidade, c.estado, c.id_clube, f.status_transacao
												ORDER BY a.numero";
    		$executa = select_db($consulta);
			echo " <label class='titulo_tabela2'>Modalidade: ".(retorna_nome($idmoda, 'arpag_modalidade'))."</label>";
			echo "<table border='1'class='table table-bordered'>";
            echo "<tr class='titulo_tabela'>	
            						
					<td>Incri&ccedil;&atildeo</td>
					<td>Estaca</td>
					<td>Nome do P&aacute;ssaro</td>
					<td>Anilha</td>	
					<td>Nome do Propriet&aacute;rio</td>					
					<td>Cidade</td>
					<td>Clube</td>
					<td>Status</td>
					</tr>";
    		$cont = 1;
			while($linha = $executa->fetch_array()){
				$status = verifica_pagamento($linha['id']);
    			echo 	"<tr>							
							<td>".$cont."<input type='hidden' <input type='text' name='inscricao[]' value='".cript($linha['id'])."'/></td>
							<td>".($linha['numero'])."</td>
							<td>".($linha[1])."</td>
							<td>".($linha['anilha'])."</td>
							<td>".($linha[2])."</td>
							<td>".($linha['cidade']." ".$linha['estado'])."</td>
							<td>".(retorna_nome($linha['id_clube'],'arpag_clube'))."</td>"; 
							if($linha['status_transacao']){
								echo "<td><img src='images/".retorna_imagem2($linha['status_transacao'],'arpag_status_pagseguro')."' width='20' title='".retorna_nome($linha['status_transacao'],'arpag_status_pagseguro')."' /></td>";
							}
							else echo "<td></td>";
							
						echo "</tr>";
				$cont++;
			}
		    echo "</table><br /><br />";
			break;
			
			//Excluir Galeria de Fotos
	case 6: $exclui = new exclui();
					$exclui->tabela	    = 'arpag_galeria';
					$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista   = new consulta();
			$lista -> campo		= ' id, nome ';
			$lista -> parametro	= ' nome';
			$lista -> tabela	= 'arpag_galeria';
			if ($consulta = select_db_2($lista)){
				while($resposta = $consulta->fetch_array()){
					?>
                    	<a class='btn btn-primary btn-primary' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">
                        	Excluir</a>  
					<?php echo $resposta['nome'];?><br /><?php
				}
			}
			break;
	case 7: $idmoda 	= dcript($_GET['n'],'Erro id modalidade, funcao ajax');
			$idtemp		= dcript($_GET['m'],'Erro na identificacao da temporada');
			
			$consulta_dis = new consulta();
			$consulta_dis->campo	= 'distinct a.id_sub_categoria';
			$consulta_dis->tabela	= "arpag_passaro_etapa AS a
										INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
										INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa";
			$consulta_dis->parametro= "d.id_temporada = ".$idtemp." AND b.id_modalidade = ".$idmoda." 
										AND a.pontuacao > 0  
										ORDER BY a.id_sub_categoria";
			$executa_dis = select_db($consulta_dis);
			while($linha_dis = $executa_dis->fetch_array()){
				$consulta 	= new consulta();
				$consulta->campo	= ' a.id_passaro,
										b.nome AS "nomepassaro", 
										c.nome AS "nomepessoa", 
										b.anilha,         
										c.cidade, 
										c.estado, 
										c.id_clube,
										SUM(a.pontuacao)';
				$consulta->tabela	= "arpag_passaro_etapa AS a
										INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
										INNER JOIN arpag_pessoa AS c ON c.id = b.id_pessoa
										INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa";
				$consulta->parametro= "d.id_temporada = ".$idtemp." AND b.id_modalidade = ".$idmoda."
										AND a.id_sub_categoria = ".$linha_dis['id_sub_categoria']." 
										AND a.pontuacao > 0 
										GROUP BY a.id_passaro,
											b.nome, 
											c.nome, 
											b.anilha, 
											c.cidade, 
											c.estado, 
											c.id_clube
										ORDER BY SUM(a.pontuacao) DESC";
				$executa = select_db($consulta);
				echo " Modalidade: " .(retorna_nome($idmoda, 'arpag_modalidade'));
				if ($linha_dis['id_sub_categoria'] > 0) 
					echo " - ".retorna_nome($linha_dis['id_sub_categoria'],'arpag_sub_modalidade');
				echo "<table border='1'class='table table-bordered'> ";
				echo "<tr class='titulo_tabela'>
						<td>Posi&ccedil;&atilde;o</td>
						<td>Nome do Passaro</td>
						<td>Anilha</td>
						<td>Nome do Propriet&aacute;rio</td>
						<td>Cidade</td>
						<td>Clube</td>
						<td>Pontos</td>
					</tr>";
				$cont = 1;
				while($linha = $executa->fetch_array()){
					echo "<tr>
							<td>".$cont."</td>
							<td>".($linha['nomepassaro'])."</td>
							<td>".($linha['anilha'])."</td>						
							<td>".($linha['nomepessoa'])."</td>
							<td>".($linha['cidade']." ".$linha['estado'])."</td>
							<td> ".retorna_nome($linha['id_clube'],'arpag_clube')."</td>
							<td>".$linha['SUM(a.pontuacao)']."</td></tr>";
				$cont++;
				}
				echo "</table><br /><br />";
			}
			break;		
	case 8: $idetapa  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$vetor_mod = verifica_etapa($idetapa);
			for ($i=1;$i<=count($vetor_mod);$i++){
				?><a onClick="inscricao('<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
					<?php echo $vetor_mod[$i][2];?></a>     <?php	
			}			
			break;	
	case 9: $idinsc  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$numero  = trocanome($_GET['o']);
			$atualiza = new atualiza();
							$atualiza->campo		= "numero = ".$numero;
							$atualiza->tabela		= 'arpag_passaro_etapa';
							$atualiza->parametro 	= "id = ".$idinsc." AND numero <> ".$numero;
			if($executa = update_bd($atualiza)) echo "Estaca Nº".$numero." <br /> Para imprimir a ficha recarregue a página. 
			                                          Clique <a href='cad_inscricoes.php'>aqui</a>";
			else echo "Erro na cadastrado da estaca ".$numero;			
			break;
	case 10:$idpassaro	= dcript($_POST['mn'],'Erro id passaro, funcao ajax'); 
			$nome 		= trocanome($_POST['nome']);
			$anilha 	= trocanome($_POST['anilha']);
			$ativo		= trocanome($_POST['ativo']);
			$cpf		= str_replace(['.','-'],'', trocanome($_POST['cpf']));
			//echo $cpf." - ".$nome." - ".$anilha." - ".$ativo;
			
			$numanilha 		= substr($anilha, -6);
			if ((!is_numeric($numanilha)) || (strlen($numanilha) != 6)){
			    echo "<p class='alert-danger'>O N&uacute;mero da Anilha est&aacute; incorreto. N&atilde;o coloque nem um car&aacute;cter 
							ap&oacute;s os 6 d&iacute;gitos da anilha. Siga o exemplo IBAMA OA 3,5 XXXXXX. 
							Apenas os 6 d&iacute;gitos s&atilde;o obrigat&oacute;rios</p>";
			}else if ($nomeNovo = retorna_cpf_nome($cpf)){
    			$atualiza_pass 	= new atualiza();
    								$atualiza_pass->parametro 	= "id = ".$idpassaro;
    								$atualiza_pass->tabela		= 'arpag_passaro';
    								$atualiza_pass->campo 		= "nome = '".$nome."', 
    								                                anilha = '".$anilha."',
    								                                anilha_n = '".$numanilha."', 
    								                                ativo = ".$ativo.",
																	id_pessoa = (SELECT arpag_pessoa.id from arpag_pessoa 
																	             WHERE arpag_pessoa.cpf = ".$cpf." )";
    			if(update_bd($atualiza_pass)){
    				$atualiza_insc 	= new atualiza();
    								$atualiza_insc->parametro 	= "a.id_passaro = ".$idpassaro." AND c.fechada = 0" ;
    								$atualiza_insc->tabela		= 'arpag_passaro_etapa AS a 
    																INNER JOIN arpag_etapa 		AS b ON b.id = a.id_etapa
    																INNER JOIN arpag_temporada 	AS c ON c.id = b.id_temporada';
    								$atualiza_insc->campo 		= "a.id_pessoa = (SELECT arpag_pessoa.id from arpag_pessoa 
																				  WHERE arpag_pessoa.cpf = ".$cpf." )";
    			update_bd($atualiza_insc);
    				echo "<p class='alert-info'>Transferido para ".$nomeNovo."</p>";
    			}
    			else echo "<p class='alert-danger'>Erro para atualizar etapas</p>";
			} else echo "<p class='alert-danger'>CPF incorreto</p>";
			break;
	default: echo 'Erro';			
}

?>