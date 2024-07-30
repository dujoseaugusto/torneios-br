<?php
	include("../seguranca/seguranca.php");
	protegePagina(1);
	require_once('../php/class.php');
	require_once('../bd_funcao/maysql.php');
	require_once('../php/funcao_0.2.php'); 
//recebe via get um valor para selecionar qual sera a função usada
$fun = (isset($_GET['fun'])) ? $_GET['fun'] : '';
switch($fun){
	//exclui temporada 
	case 1: $exclui = new exclui();
						$exclui->tabela		= 'arpag_temporada';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			?>
			<table class='table'>
			<?php
			$lista = new consulta();
						$lista->campo		= ' id, nome, fechada ';
						$lista->parametro	= '  fechada <> 2 order by fechada, id desc ';
						$lista->tabela		= 'arpag_temporada';
			if ($consulta = select_db($lista)){
				while($resposta = $consulta->fetch_array()){
					?><tr><td style="width: 5%"><a class='btn btn-primary btn-danger' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a> </td>
							<td style="width: 5%"> 
							<?php
							if($resposta['fechada'] == 0){?>
								<a class='btn btn-success' href='#' onclick="fechar('<?php echo cript($resposta['id']);?>','<?php echo cript(1);?>')">Fechar</a></td>
							<?php
							}else{?>
								<a class='btn btn-info' href='#' onclick="fechar('<?php echo cript($resposta['id']);?>','<?php echo cript(0);?>')">Abrir</a></td>
							<?php
							}
							?>				
							<td><?php echo $resposta['nome'];?><br /></td></tr><?php
				}
			}
			?>
			</table>
			<?php
			break;
	case 2:	$exclui = new exclui();
						$exclui->tabela		= 'arpag_etapa';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			$executa = delete_db($exclui);
			$lista = new consulta();
						$lista->campo		= 'a.id, a.nome, b.nome, a.data_etapa, a.local';
						$lista->parametro	= " b.fechada <> 2 order by id DESC LIMIT 15";
						$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
			if ($consulta = select_db($lista)){
				echo "<table class='table'>";
				while($resposta = $consulta->fetch_array()){
					?><tr><td><a class='btn btn-primary btn-danger' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a></td>
							<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td>
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
	case 4: $idetapa  = dcript($_GET['m'],'Erro no id da etapa, funcao ajax');
			$idmoda 	= dcript($_GET['o'],'Erro na identificacao da modalidade');
			$_SESSION['idetapa'] 	= $_GET['m'];
  			$_SESSION['idmoda'] 	= $_GET['o'];
            $consulta = new consulta();
    					$consulta->campo	= 'a.id, b.nome, c.nome, d.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado, f.status_transacao, f.id AS idpagamento, c.id AS idpessoa, 
												arpag_modalidade.pontuacao AS p_modalidade, arpag_valor_inscricao_etapa.tipo_pontuacao,
												a.id_sub_categoria';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa
                                                INNER JOIN arpag_pagamento_passaro_etapa AS e ON e.id_passaro_etapa = a.id 
                                                INNER JOIN arpag_pagamento AS f ON f.id = e.id_pagamento
												INNER JOIN arpag_modalidade ON arpag_modalidade.id = b.id_modalidade
												INNER JOIN arpag_valor_inscricao_etapa ON arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id 
		                                                                                  AND arpag_valor_inscricao_etapa.id_etapa = d.id  ";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." GROUP BY a.numero,a.id, b.nome, c.nome, d.nome, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado, f.status_transacao, f.id, c.id, arpag_modalidade.pontuacao, arpag_valor_inscricao_etapa.tipo_pontuacao 
    											ORDER BY a.pontuacao DESC, a.final DESC, a.classificacao DESC";
			
			$executa = select_db($consulta);
    		
			echo "<a class='btn btn-primary btn-primary' href='ver_etapa.php?dghf=".cript($idetapa)."'>Fechar inscri&ccedil;&atilde;o </a>  ";
			echo "<a class='btn btn-primary btn-primary' href='geraarquivo.php' target='_blank'>Gerar arquivo Excel</a>  ";
            
			
			echo "
				<form name='veretapa' method='post' action='ver_etapa.php'>
					<input type='hidden' name='etapa' value='".$_GET['m']."'/>
					<input type='hidden' name='modalidade' value='".$_GET['o']."'/>
					
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
						<b>Modalidade:</b> ".(retorna_nome($idmoda, 'arpag_modalidade'))."<br />
						<b>Pontuação:</b> ".retorna_nome_pontuacao($idmoda,$idetapa)."
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>

					<table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                    <thead>";
			if(retorna_tipo_estaca($idetapa) == 'M'){
			 echo "<tr class='titulo_tabela'>
					<td>Cancelar</td>
					<td>Pag</td>
					<td>Inscricao</td>
					<td>Estaca</td>
					<td>Passaro / Anilha</td>
					<td>Sub-Modalidade</td>
					<td>Nome do Propriet&aacute;rio</td>
					<td>Cidade</td>
					<td>Classifica&ccedil;&atilde;o</td>
					<td>Final</td>
					<td>Pontos</td>
				 </tr>";
			}else{
				echo "<tr class='titulo_tabela'>
				<td>Cancelar</td>
				<td>Pag</td>
				<td>Inscricao</td>
				<td>Estaca</td>
				<td>Nome do Passaro</td>
				<td>Anilha</td>
				<td>Nome do Propriet&aacute;rio</td>
				<td>Cidade</td>
				<td>Classifica&ccedil;&atilde;o</td>
				<td>Final</td>
				<td>Pontos</td>
			 </tr>";	
			}
			$cont = 1;
    		while($linha = $executa->fetch_array()){
				switch($linha['tipo_pontuacao']){
					case 'D': $numero_formata = 4;
						break;
					case 'T': $numero_formata = 6;
						break;
					default : $numero_formata = 4;
				}
    			if (!$linha['status_transacao'])$bot_trasacao = 0;
    			else $bot_trasacao = $linha['status_transacao'];
    			if($linha['p_modalidade'] == 'T'){
    				$linha['classificacao'] = formata_tempo($linha['classificacao']);
    				$linha['final'] = formata_tempo($linha['final']);
				}
    			echo "<tr>
						<td><div id='carrega".$cont."'>
							<a class='btn btn-danger btn-sm' onclick=\"cancela('".cript($linha['id'])."','".$cont."')\">Cancelar</a>";
						if ($bot_trasacao == 0) echo "<br /><br /><a class='btn btn-warning btn-sm' href='../pagamento2.php?kj=".cript($linha['idpagamento'])."' target='_blank'>Ger. Pagamento</a>";
						if ($bot_trasacao < 3 ) echo "<br /><br /><a class='btn btn-success btn-sm' href='lib_pagamento.php?mjf=".cript($linha['idpessoa'])."' target='_blank'>Lib. Pagamento</a>";
						echo "</div></td>
						<td>";
						echo  "<img src='../images/".retorna_imagem($bot_trasacao,'arpag_status_pagseguro')."' width='20' title='".retorna_nome($bot_trasacao,'arpag_status_pagseguro')."' />";
						echo "</td>
						<td>".$cont."</td>";
                        if(retorna_tipo_estaca($idetapa) == 'M'){
							
						echo "<td>";

							$id_atu_estaca = cript($linha['id']);					
							echo "<b style='color:red'>Selecione outra estaca:</b>
								 <br /><div id='load_carrega_ap".$id_atu_estaca."'>
								 <select class='form-control atu_estaca' id='".$id_atu_estaca."'>";	
							$verificar = new consulta();
							$verificar->campo       = 'a.numero';
							$verificar->tabela      = 'arpag_passaro_etapa AS a
											INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
							$verificar->parametro   = "a.id_etapa = ".$idetapa. " 
														AND b.id_modalidade = ".$idmoda." ORDER BY numero";
							$executa_ver = select_db($verificar);
							$cont_fun = 1;
							while($linha_ex = $executa_ver->fetch_array()){
								$vetor_count[$cont_fun] = $linha_ex['numero'];
								$cont_fun++;										
							}	
							echo "<option value=".($linha['numero']).">".($linha['numero'])."</option>";	
							for($i=1;$i<=retorna_nome_max_estacas($idmoda,$idetapa);$i++){
								if (!in_array($i, $vetor_count)){
									echo "<option value='".$i."'>".$i."</option>";	
								}
							}						
							echo "</select></div>";
							echo "
							</td><td>".($linha['1'])."<br />".($linha['anilha'])."</td>";
							
							echo "<td>";
							echo "<b style='color:red'>Sub-Categória:</b>
								 <br /><div id='load_carrega_sub".$id_atu_estaca."'></div>
								 <select class='form-control atu_sub_modalidade' id='".$id_atu_estaca."'>";
							verifica_sub_modalidade($linha['id_sub_categoria']);									
							echo "</select>";
							echo "</td>";
						}else{
							echo 
							"<td>".($linha['numero'])."</td>
							<td>".($linha['1'])."</td>
							<td>".($linha['anilha'])."</td>";
						}												
						echo "<td>".($linha['2'])."</td>
						<td>".($linha['cidade']." ".$linha['estado'])."</td>";
						//if ($linha['status_transacao'] == 7){
							echo "<td>  <input type='hidden' <input type='text' name='inscricao[]' value='".cript($linha['id'])."'/>
						     		<input type='text' class='formato' name='classific[]' size='5' value='".str_pad($linha['classificacao'], $numero_formata, "0", STR_PAD_LEFT)."'/></td>
							 		<td><input type='text' class='formato' name='final[]' size='5' value='".str_pad($linha['final'], $numero_formata, "0", STR_PAD_LEFT)."' /></td>";
									//echo "<td><input type='text' name='ponto[]' size='3' value='".$linha['pontuacao']."' /></td></tr>";
						//}else 
						//{
							//echo "<td> </td>
							 	//	<td></td>";
									//echo "<td></td></tr>";
						//}
				echo "<td>".$linha['pontuacao']."</td></tr>";
				$cont++;
			}
		    echo "  </tbody>
                    </table>
                    </div>
                    </div>
					</div>
				<input type='submit' value='Atualizar' />
					</form><br /><br />";
			break;
	case 5: $idetapa  	= dcript($_GET['m'],'Erro id modalidade, funcao ajax');
            $idmoda 	= dcript($_GET['o'],'Erro na identificacao da estapa');
            $_SESSION['idetapa'] 	= $_GET['m'];
  			$_SESSION['idmoda'] 	= $_GET['o'];
			$consulta 	= new consulta();
    					$consulta->campo	= 'a.id, b.nome, c.nome, d.nome, a.numero, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado, arpag_modalidade.pontuacao AS p_modalidade, d.id_tipo_modalidade';
    					$consulta->tabela	= "arpag_passaro_etapa AS a
                                                INNER JOIN arpag_passaro AS b ON  b.id = a.id_passaro
                                                INNER JOIN arpag_pessoa AS c ON c.id = a.id_pessoa
                                                INNER JOIN arpag_etapa AS d ON d.id = a.id_etapa
                                                 INNER JOIN arpag_modalidade ON arpag_modalidade.id = b.id_modalidade";
    					$consulta->parametro= "a.id_etapa = ".$idetapa." AND b.id_modalidade = ".$idmoda." GROUP BY a.numero, a.id, b.nome, c.nome, d.nome, b.anilha, a.classificacao, a.final, a.pontuacao,
												c.cidade, c.estado, arpag_modalidade.pontuacao
												 ORDER BY a.pontuacao DESC, a.numero";
    		$executa = select_db($consulta);
			echo "<a class='btn btn-primary btn-primary' href='ver_etapa_fech.php?dghf=".cript($idetapa)."'>Reabrir inscri&ccedil;&atilde;o </a>  ";
			echo "<a class='btn btn-primary btn-primary' href='geraarquivo.php' target='_blank'>Gerar arquivo Excel</a>  ";
			echo "<a class='btn btn-primary btn-success' href='imprime_inscricao.php?kj=".cript($idetapa)."&jsdf=".cript($idmoda)."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir lista de Inscritos</a> ";
			if ( retorna_tipo_modalidade_etapa($idetapa) == '2'){
			    for($i=0;$i<retorna_num_incricoes_etapa_modalidade($idetapa,$idmoda);$i=$i+50){
				 echo "<a class='btn btn-primary btn-danger' href='imprime_fichas2.php?kj=".cript($idetapa)."&jsdf=".cript($idmoda)."&i=".cript($i)."' 
				 		target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;Fichas ".$i."-".($i+50)."</a> ";
				}
			}else{ 
				for($i=0;$i<retorna_num_incricoes_etapa_modalidade($idetapa,$idmoda);$i=$i+50){
					echo "<a class='btn btn-primary btn-danger' href='imprime_fichas.php?kj=".cript($idetapa)."&jsdf=".cript($idmoda)."&i=".cript($i)."' 
							target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;Fichas ".$i."-".($i+50)."</a> ";
			   }
			} 
			echo "<br /> Modalidade: <b>" .(retorna_nome($idmoda, 'arpag_modalidade'));
			echo "</b><table border='1'class='table table-bordered'> ";
            echo "<tr class='titulo_tabela'>
					<td>Inscri&ccedil;&atilde;o</td>
					<td>Estaca</td>					
					<td>Nome do P&aacute;ssaro</td>
					<td>Anilha</td>
					<td>Nome do Propriet&aacute;rio</td>
					<td>Cidade</td>
					<td>Classifica&ccedil;&atilde;o</td>
					<td>Final</td>
					<td>Pontos</td>
				  </tr>";
			$cont = 1;
    		while($linha = $executa->fetch_array()){
    		if($linha['p_modalidade'] == 'T'){
    				$linha['classificacao'] = formata_tempo($linha['classificacao']);
    				$linha['final'] = formata_tempo($linha['final']);
				}
    			echo "<tr>
				<td>".$cont."</td>
				<td>".($linha['numero'])."</td>				
				<td>".($linha['1'])."</td>
				<td>".($linha['anilha'])."</td>
				<td>".($linha['2'])."</td>
				<td>".($linha['cidade'])."  ".$linha['estado']."</td>
				<td> <input type='hidden' <input type='text' name='inscricao[]' value='".cript($linha['id'])."'/>".$linha['classificacao']."</td>
				<td>".$linha['final']."</td>
				<td>".$linha['pontuacao']."</td></tr>";
			$cont++;
			}
		    echo "</table><br /><br />";
			break;
	case 6: $idinscricao	= dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$excluir_escr 	= new procid();
					$excluir_escr->variavel  = "'".$idinscricao."'";
					$excluir_escr->nome 	 = 'arpag_p_exclui_escricao';
			if(exec_procidure2 ($excluir_escr)) echo 'Excluido';
			else echo "Erro";
			break;
	case 7: $idpassaro	= dcript($_GET['mn'],'Erro id passaro, funcao ajax'); 
			$nome 		= trocanome($_POST['nome']);
			$anilha 	= trocanome($_POST['anilha']);
			$ativo		= trocanome($_POST['ativo']);
			$propri		= dcript($_POST['propri'],'Erro na ao receber proprietario, linha 177');
			//echo $idpassaro."  ".$nome." ".$anilha." ".$ativo;
			$numanilha 		= substr($anilha, -6);
			if ((!is_numeric($numanilha)) || (strlen($numanilha) != 6)){
			    echo "<p class='alert-danger'>O N&uacute;mero da Anilha est&aacute; incorreto. N&atilde;o coloque nem um car&aacute;cter 
							ap&oacute;s os 6 d&iacute;gitos da anilha. Siga o exemplo IBAMA OA 3,5 XXXXXX. 
							Apenas os 6 d&iacute;gitos s&atilde;o obrigat&oacute;rios</p>";
			}else{
    			$atualiza_pass 	= new atualiza();
    								$atualiza_pass->parametro 	= "id = ".$idpassaro;
    								$atualiza_pass->tabela		= 'arpag_passaro';
    								$atualiza_pass->campo 		= "nome = '".$nome."', 
    								                                anilha = '".$anilha."',
    								                                anilha_n = '".$numanilha."', 
    								                                ativo = ".$ativo.",
    																id_pessoa = ".$propri;
    			if(update_bd($atualiza_pass)){
    				$atualiza_insc 	= new atualiza();
    								$atualiza_insc->parametro 	= "a.id_passaro = ".$idpassaro." AND c.fechada = 0" ;
    								$atualiza_insc->tabela		= 'arpag_passaro_etapa AS a 
    																INNER JOIN arpag_etapa 		AS b ON b.id = a.id_etapa
    																INNER JOIN arpag_temporada 	AS c ON c.id = b.id_temporada';
    								$atualiza_insc->campo 		= "a.id_pessoa = ".$propri;
    			update_bd($atualiza_insc);
    				echo "Alterado";
    			}
    			else echo "Erro";
			}
			break;
	case 8: $idpassaro	= dcript($_GET['mn'],'Erro id passaro, funcao ajax'); 
			$etapa		= dcript($_POST['inscr'],'Erro na identifica~cao da etapa');
			//echo $idpassaro ."  ". $ativo;

				$consulta 	= new consulta();
	    					$consulta->campo	= 'id_pessoa, id_modalidade';
	    					$consulta->tabela	= "arpag_passaro";
	    					$consulta->parametro= "id = ".$idpassaro;
	    		$executa 			= select_db($consulta);
	    		$result_consulta 	= $executa->fetch_array();
			   //echo "<br />".$numero." - ".$cont;

			    //rece os passaros selecionado para a incrição
			    //$numero = 1;*/
					$verifica_ja_exite = new consulta();
										$verifica_ja_exite->campo 		= 'id';
										$verifica_ja_exite->tabela		= 'arpag_passaro_etapa';
										$verifica_ja_exite->parametro	= "id_passaro = ".$idpassaro."
																			AND id_etapa = ".$etapa;
					$resp_verifica = select_db($verifica_ja_exite);
					$linha_ver = $resp_verifica->fetch_array();
					if($linha_ver[0] == 0){	
						///Gera um pagamento
						$cod_pagamento = gera_pagamento();
						$inserir = new insercao();
								$inserir->campo	= 'id_pessoa,id_passaro,id_etapa, numero';
								$inserir->dados	= $result_consulta['id_pessoa'].",
													".$idpassaro.",".$etapa.",
													".numero_inscricao_novo2($etapa,$result_consulta['id_modalidade'],$result_consulta['id_pessoa']);
								$inserir->tabela = 'arpag_passaro_etapa';
						$executar = insert_bd_return_id($inserir);
						if($executar){
							$inserir_pag = new insercao();
								$inserir_pag->campo	= 'id_passaro_etapa, id_pagamento';
								$inserir_pag->dados	= $executar.",".$cod_pagamento;
								$inserir_pag->tabela = 'arpag_pagamento_passaro_etapa';
							$executar_pag = insert_bd($inserir_pag);

							$altera_estatus = new atualiza();
								$altera_estatus->campo 		= 'status_transacao = 10';
								$altera_estatus->tabela 	= 'arpag_pagamento';
								$altera_estatus->parametro  = "id = ".$cod_pagamento;
							if($alt_executa = update_bd($altera_estatus)){
								if (retorna_tipo_modalidade_etapa($etapa) == 2) echo "<script> alert ('Inscricao realizada'); window.open('../imprime2.php?kj=".cript($executar)."','_blank');</script>"; 
								else echo "<script> alert ('Inscricao realizada'); window.open('imprime.php?kj=".cript($executar)."','_blank');</script>"; 
								//echo " <meta http-equiv='refresh' content=1;url='imprime.php?kj=".cript($executar)."' target='_blank'>";
							}
						}
					}else {
						if (retorna_tipo_modalidade_etapa($etapa) == 2) echo "<script> alert ('Ja esta inscrito'); window.open('../imprime2.php?kj=".cript($linha_ver[0])."','_blank');</script>";
						else echo "<script> alert ('Ja esta inscrito'); window.open('imprime.php?kj=".cript($linha_ver[0])."','_blank');</script>"; 
						//echo " <meta http-equiv='refresh' content=1;url='imprime.php?kj=".cript($linha_ver[0])."' target='_blank'>";
					}			
			break;
	case 9: $altera = new atualiza();
						$altera->tabela		= 'arpag_temporada';
						$altera->parametro 	= "id = ".dcript($_GET['m'],'Erro na identificacao da tabela, linha 208');
						$altera->campo 		= "nome = '".trocanome($_GET['v'])."', fechada = ".dcript($_GET['n'],'Erro ao alterar, linha 209');
			$executa = update_bd($altera);
			?>
			<table class='table'>
			<?php
			$lista = new consulta();
						$lista->campo		= ' id, nome, fechada ';
						$lista->parametro	= '  fechada <> 2 order by fechada, id desc ';;
						$lista->tabela		= 'arpag_temporada';
			if ($consulta = select_db($lista)){
				while($resposta = $consulta->fetch_array()){
					$idtempo = cript($resposta['id']);
					?><tr><td style="width: 5%"><a class='btn btn-primary btn-danger' href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a> </td>
					<td style="width: 5%"> 
					<?php
					if($resposta['fechada'] == 0){?>
						<a class='btn btn-success' href='#' onclick="fechar('<?php echo $idtempo;?>','<?php echo cript(1);?>')">Fechar</a></td>
					<?php
					}else{?>
						<a class='btn btn-info' href='#' onclick="fechar('<?php echo $idtempo;?>','<?php echo cript(0);?>')">Abrir</a></td>
					<?php
					}
					?>				
					<td><input id="<?php echo $idtempo;?>" value="<?php echo $resposta['nome']?>" /><br /></td></tr><?php
				}
			}
			?>
			</table>
			<?php
			break;
	case 10: 
			$idpassaro	= dcript($_GET['mn'],'Erro id passaro, funcao ajax'); 
			$exclui = new exclui();
						$exclui->tabela		= 'arpag_passaro';
						$exclui->parametro 	= "id = ".dcript($_GET['mn'],'Erro id passaro, funcao ajax, excluir');
			$executa = delete_db($exclui);
			echo 'Exclusao efetuada';			
			break;
	case 11:  
			$item_buscado		= trocanome($_POST['nome']);
			
				$consulta 		= new consulta();
                $consulta->campo	= 'arpag_pessoa.id,
                                        arpag_pessoa.nome,
                                        arpag_pessoa.email,
                                        arpag_pessoa.cpf,
                                        arpag_pessoa.ctf,
                                        arpag_pessoa.cidade,
                                        arpag_pessoa.estado,
                                        arpag_pessoa.id_clube,
                                        arpag_pessoa.ativo
                                        ';
                $consulta->tabela	= "arpag_pessoa
                                        LEFT JOIN arpag_passaro ON arpag_passaro.id_pessoa =  arpag_pessoa.id";
                $consulta->parametro= "arpag_pessoa.nome LIKE '%".$item_buscado."%'
                                        OR arpag_passaro.anilha_n LIKE '%".$item_buscado."%' 
                                        OR arpag_pessoa.cpf LIKE '%".$item_buscado."%'
                                        GROUP BY arpag_pessoa.id,
			                                        arpag_pessoa.nome,
			                                        arpag_pessoa.email,
			                                        arpag_pessoa.cpf,
			                                        arpag_pessoa.ctf,
			                                        arpag_pessoa.cidade,
			                                        arpag_pessoa.estado,
			                                        arpag_pessoa.id_clube,
                                                    arpag_pessoa.ativo 
			                                ORDER BY arpag_pessoa.nome";
				$executa = select_db($consulta);
			?>
				<div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

						<div class="panel-heading">
                             <?php
	                             	echo $item_buscado;
                             ?>
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
				        <th></th>
				        <th>ID</th>
				        <th>Nome</th>
				        <th>Email</th>
				        <th>CPF</th>
				        <th>CTF</th>
				        <th>Cidade</th>
				        <th>Clube</th>
				        <th>Insc/P&aacute;ssaro</th>
						</tr>
						</thead>
                        <tbody>
				<?php
				$cont = 1;
				while ($linha = $executa->fetch_array()){
					?>
					<tr>
						<td><?php echo $cont;?></td>
						<td><?php echo $linha['id'];?></td>
						<td><?php echo ($linha['nome']);?></td>
						<td><?php echo ($linha['email']);?></td>
						<td><?php echo ($linha['cpf']);?></td>
						<td><?php echo ($linha['ctf']);?></td>
						 <td><?php echo ($linha['cidade'] ." ". $linha['estado'] );?></td>
						<td><?php echo (retorna_nome($linha['id_clube'],'arpag_clube'));?></td>
						<td>
						<div id='load<?php echo $cont;?>'>
						<a class='btn btn-primary btn-sm'  href="insc_passaro.php?dghf=<?php echo cript($linha['id']);?>" title='Fazer inscrição'>inscrição</a><br />
						<a class='btn btn-primary btn-sm'  href="alt_passaro.php?dghf=<?php echo cript($linha['id']);?>" title='Visualizar e trasferir pássaros'>Pássaro</a><br />
						<a class='btn btn-primary btn-sm'  href="lib_pagamento.php?mjf=<?php echo cript($linha['id']);?>" title='Visualizar pagamentos'>Pagamento</a><br />
						<a class='btn btn-primary btn-sm'  href="list_usuarios.php?hjd=<?php echo cript($linha['id']);?>" title='Resetar a senha para 123'>Senha</a><br />
						<?php
						if ($linha['ativo'] == 1){
						?>
							<a class='btn btn-primary btn-sm'  href="list_usuarios.php?erdf=<?php echo cript($linha['id']);?>" title='Bloquear Usuário'>Bloqueio</a>
						<?php
						}else{
						?>
						   <a class='btn btn-danger btn-sm'  href="list_usuarios.php?esdd=<?php echo cript($linha['id']);?>" title='Desbloquear Usuário'>Desbloqueio</a>
						<?php	
						}
						?>						
						<?php
									    $verifica_apaga		=	new consulta();
				    		$verifica_apaga->campo 		= 'id';
				    		$verifica_apaga->tabela		= 'arpag_passaro';
				    		$verifica_apaga->parametro  = "id_pessoa = ".$linha['id'];
						    $executa_ver = select_db($verifica_apaga);
						    if (!$li = $executa_ver->fetch_array()){
						    	?>
						    	<br />
						    	<a class='btn btn-primary btn-danger'  onclick="apagar('<?php echo $cont."','".cript($linha['id']);?>')">Excluir</a>
						    	<?php
						    }
						?></div></td>
					</tr>
					
					<?php
					$cont++;
				}
				if($cont == 1) echo "<tr><td><p class='alert-danger'>Item '".$item_buscado."' n&atilde;o encontrado</p></td></td>";

			?>
			</tbody>
            </table>
            </div>
                   
            </div>
            </div>
            </div>
            </div>
			<?php
		break;
	case 12: 
			$exclui = new exclui();
						$exclui->tabela		= 'arpag_pessoa';
						$exclui->parametro 	= "id = ".dcript($_GET['mn'],'Erro na identicacao da pessoa, funcao ajax, excluir');
			$executa = delete_db($exclui);
			echo 'Exclusao efetuada';			
			break;
	case 13: $idinscricao	= dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$altera_escr 	= new atualiza();
					$altera_escr->campo 	= 'status_transacao = 10';
					$altera_escr->tabela	= 'arpag_pagamento';
					$altera_escr->parametro = "id =".$idinscricao;
			if(update_bd($altera_escr)) echo 'Liberado';
			else echo "Erro";
			break;
	case 14: $exclui = new exclui();
						$exclui->tabela		= 'arpag_modalidade';
						$exclui->parametro 	= "id = ".dcript($_GET['m'],'Erro ao excluir');
			if ($executa = delete_db($exclui)){
				echo " <meta http-equiv='refresh' content='0.2'>";
			}else echo "Erro na Exclusão";			
			break;
	case 15: $altera = new atualiza();
						$altera->tabela		= 'arpag_modalidade';
						$altera->parametro 	= "id = ".dcript($_GET['m'],'Erro na identificacao da tabela, linha 462');
						$altera->campo 		= "ativo = ".dcript($_GET['n'],'Erro ao alterar, linha 209');
			if ($executa = update_bd($altera)){
				echo " <meta http-equiv='refresh' content='0.2'>";
			}else echo "Erro na Alteração";					
			break;
	case 16: $idinsc  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$numero  = trocanome($_GET['o']);
			$atualiza = new atualiza();
							$atualiza->campo		= "numero = ".$numero;
							$atualiza->tabela		= 'arpag_passaro_etapa';
							$atualiza->parametro 	= "id = ".$idinsc." AND numero <> ".$numero;
			if($executa = update_bd($atualiza)) echo "Estaca Nº".$numero." <br /> Para imprimir a ficha recarregue a página";
			else echo "Erro na cadastrado da estaca ".$numero;			
			break;
	case 17: $idinsc  = dcript($_GET['m'],'Erro id modalidade, funcao ajax');
			$sub_modalidade  = dcript($_GET['o'],'Erro sub-modalidade');
			$atualiza = new atualiza();
							$atualiza->campo		= "id_sub_categoria = ".$sub_modalidade;
							$atualiza->tabela		= 'arpag_passaro_etapa';
							$atualiza->parametro 	= "id = ".$idinsc;
			if(!$executa = update_bd($atualiza)) echo "Erro para alterar sub-modalidade ";			
			break;
	default: echo 'Erro default';
}




?>