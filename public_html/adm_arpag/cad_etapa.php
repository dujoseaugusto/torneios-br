<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');
?>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><?php
if (isset($_SESSION['usuarioNome'])) echo $_SESSION['usuarioNome'];
?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">Data : <?php echo date('d/m/Y');?> &nbsp; <a href="../close.php" class="btn btn-danger square-btn-adjust">Sair</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
            <?php 
            include_once("menu.php");
            ?>
               
            </div>
            
        </nav>  
<!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
<script>
	function exclui(m){
		$('#load').html("<img src='../images/loading.gif'>");
        var url = 'funcao_ajax.php?fun=2&m='+m;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
</script>
<?php
include_once('menu.php');
if($nome = (isset($_POST['nome'])) ? trocanome($_POST["nome"]) : null){
	 $data 			= dtafor($_POST['data'])." ".trocanome($_POST['hora']);
	 $data_venc		= dtafor($_POST['data_venc']);
	 $local 		= trocanome($_POST['cidade']." ".$_POST['estado']);
	 $descricao		= trocanome($_POST['desc']);
	 $idtemporada	= dcript($_POST['temporada'],'Erro no id temporada');
	 $idclube		= dcript($_POST['clube'],'Erro no id clube');
	 $hora 			= trocanome($_POST['hora']);
	 $tip_modalidade = trocanome($_POST["tip_modalidade"]);
	 $modalidadeinsc = $_POST['modalidadeinsc']; 
	 $tip_estaca    = trocanome($_POST["tip_estaca"]);

	foreach($modalidadeinsc as $k => $v){ 
	$valores[$k] = dcript($v,'Erro vetor'); 
	} 
	$insere = new insercao();
				$insere->campo	=	'nome, id_temporada, data_etapa, descricao, local, id_clube, data_venc, id_tipo_modalidade, tipo_estaca';
				$insere->dados	=	("'".$nome."',".$idtemporada.",'".$data."','".$descricao."','".$local."',".$idclube.",
				                    '".$data_venc."','".$tip_modalidade."','".$tip_estaca."'");
				$insere->tabela	=	'arpag_etapa';

	//echo 'insert into'.$insere->tabela.' ('.$insere->campo.') value ('.$insere->dados.')'; 
	if ($id_etapa = insert_bd_return_id($insere)){
		$busca_exc = busca_modalidade();
		$query_valor_modalidade = null;
		while ($linha_b = $busca_exc->fetch_array()) {
			if (in_array($linha_b['id'],$valores)){
				tira_monetario(trocanome($_POST[tira_caracter($linha_b['nome'])]));
				$query_valor_modalidade .= $id_etapa.", ".$linha_b['id'].",
				 '".tira_monetario(trocanome($_POST[tira_caracter($linha_b['nome'])]))."',
				 '".dcript($_POST['sel_'.tira_caracter($linha_b['nome'])],'Erro')."',
				 '".$_POST['estaca_'.tira_caracter($linha_b['nome'])]."',
				 '".$_POST['estaca_2_'.tira_caracter($linha_b['nome'])]."'),(";
			}
		}
		$query_valor_modalidade = substr($query_valor_modalidade, 0, -3);
		$insere_valor = new insercao();
			$insere_valor->campo 	=	'id_etapa, id_modalidade, valor, id_pontuacao, n_estacas, n_estacas2';
			$insere_valor->tabela 	=	'arpag_valor_inscricao_etapa';
			$insere_valor->dados 	=	$query_valor_modalidade;
		if(insert_bd($insere_valor)) echo "<script> alert ('Seu cadastro foi efetuado com sucesso !!!!'); window.location='cad_etapa.php' </script>";
		else echo 'Erro modalidae';
	}else echo 'Erro';
}
?>
<script type="text/javascript">
        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        });
    </script>
<h3>Cadastro de Etapa:</h3>
<br />
<form name="CadastraEtapa" method="post" action="cad_etapa.php" onsubmit="return validaCadEtapa();">
<table class='table'  style="max-width: 600px;">
<tr><td>	
    <label><b>Temporada: </b></label><br />
    	<select name="temporada" id="temporada">
        	<option value="">Selecione uma temporada...</option>
			<?php
			$temporada 		= new consulta();
							$temporada->campo		= 'id, nome';
							$temporada->tabela 		= 'arpag_temporada';
							$temporada->parametro	= 'fechada = 0';
			$resp_temporada = select_db($temporada);
			while($linha = $resp_temporada->fetch_array()){
				echo "<option  value='".cript($linha['id'])."'>".$linha['nome']."</option>";
			}
			?>
         </select>
    </td><td> 
		<label><b>Tipo de Modalidade:</b></label><br />
		<select name="tip_modalidade" id="tip_modalidade">
			<option value="1">Fibra</option>
			<option value="2">Canto</option>            
    	</select>
    </td></tr><tr><td> 
	    <label><b>Nome da etapa:</b> </label><br /><input type="text" name="nome" id="nome" />
    </td><td> 
    	<label><b>Estacas:</b></label><br />
		<select name="tip_estaca" id="tip_estaca">
			<option value="A">Automática</option>
			<option value="M">Manual</option>            
    	</select>
	</td></tr><tr><td> 
    	<label><b>Data:</b></label><br /><input type="text" name="data" id="data" class="data" />
	</td><td> 
		<label><b>Horário:</label><br /><input type="text" name="hora" id="hora" />
    </td></tr><tr> <td> 
		<label><b>Clube:</b></label><br />
		<select name="clube">
			<option value="">Selecione um clube...</option>
				<?php
				$temporada 		= new consulta();
								$temporada->campo		= 'id, nome';
								$temporada->tabela 		= 'arpag_clube';
								$temporada->parametro	= 'nome';
				$resp_temporada = select_db_2($temporada);
				while($linha = $resp_temporada->fetch_array()){
					echo "<option  value='".cript($linha['id'])."'>".$linha['nome']."</option>";
				}
				?>
		</select>
	</td><td> <label><b>Estado:</b></label><br />
     	<select name="estado" id="estado">
			<option value="">Selecione um estado...</option>
        </select>
		
	</td></tr><tr><td> 
	   <label><b>Cidade:</b></label><br />
		<select name="cidade" id="cidade">
			<option value="">Selecione uma cidade...</option>
		</select>
	</td><td> 
    	<label><b>Vencimento do Boleto:</b></label><br /><input type="text" name="data_venc" id="data_venc" class="data" />
	</td></tr><tr><td colspan="2"> 
		<label><b>Informações:</b> </label><br />
		<textarea name="desc" cols="35" rows="5" id="desc" ></textarea>
	</td></tr><tr> <td 	colspan="2"> 
		<label>Valor das inscri&ccedil;&otilde;es: </label><br />
		<table>
		<tr><td><b>#</b></td><td><b>Pássaro</b></td><td><b>R$</b></td>
		<td><b>Pontuação</b></td><td><b>1º-Nº Estacas</b></td><td><b>2º-Nº Estacas</b></td></tr>
		<?php 
		$busca_exc = busca_modalidade();
		while ($linha_b = $busca_exc->fetch_array()) {
			?><tr><td><input type="checkbox" name="modalidadeinsc[]" id="<?php echo cript($linha_b['id']);?>" value="<?php echo cript($linha_b['id']);?>"></td>  
			<td><?php echo ($linha_b['nome']);?></td>
			<td><input type="text" class="dinheiro" name="<?php echo tira_caracter($linha_b['nome'])?>" id="<?php echo tira_caracter($linha_b['nome']) ?>" /> </td>
			<td><select name="sel_<?php echo tira_caracter($linha_b['nome'])?>" id="sel_<?php echo tira_caracter($linha_b['nome']) ?>" > 
			<?php
			echo retorna_pontucao();
			?>
			</select>
			</td>
			<td>
			<input style="max-width: 80px" type="number" placeholder="Nº Estaca" 
			       name="estaca_<?php echo tira_caracter($linha_b['nome'])?>" id="estaca_<?php echo tira_caracter($linha_b['nome']) ?>" > 
			</td>
			<td>
			<input style="max-width: 80px" type="number" placeholder="Nº Estaca" 
			       name="estaca_2_<?php echo tira_caracter($linha_b['nome'])?>" id="estaca_2_<?php echo tira_caracter($linha_b['nome']) ?>" > 
			</td>
			</tr><?php
		}
		?>
		</table>
	</td></tr><tr> <td colspan="2"> 
    <input class='btn btn-primary btn-warning' type="submit" value="Salvar" />
</table>
</form>
<br />
<div id='load'>
<table class='table'>
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, a.nome AS nomeetapa, b.nome AS nometemporada, 
			                       a.data_etapa, a.local, a.id_tipo_modalidade, 
								   (SELECT mm.nome FROM arpag_tipo_modalidade AS mm 
									WHERE mm.id = a.id_tipo_modalidade) modalidade';
			$lista->parametro	= "b.fechada =  0 ORDER BY id DESC";
			$lista->tabela		= 'arpag_etapa AS a 
									INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
if ($consulta = select_db($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td rowspan='2'><a class='btn btn-primary btn-danger' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a>
		    	<a href="alt_etapa.php?df=<?php echo cript($resposta['id']);?>" class='btn btn-primary btn-info'>Editar</a>
		     </td>
		<td><b>Etapa: </b><?php echo ($resposta['nomeetapa']);?></td>
		<td><b>Temporada: </b><?php echo ($resposta['nometemporada']);?></td>
		<td><b>Cidade: </b><?php echo ($resposta['local']); ?></td>
		<td><b>Modalidade: </b><?php echo ($resposta['modalidade']); ?></td>
		<td><b>Data: </b><?php echo dtahoraela($resposta['data_etapa']); ?></td>
		<td></tr>
		<tr>
		<td colspan='5'>
		<table class='table'>
		<tr><td><b>Pássaro</b></td>
		    <td><b>R$</b></td>
		    <td><b>Pontuação</b></td>
			<td><b>1º-Nº Estacas</b></td>
			<td><b>2º-Nº Estacas</b></td>
		</tr>
			<?php
			    $buscar_modalidade =  new consulta();
					  $buscar_modalidade->campo     = 'arpag_modalidade.nome, arpag_valor_inscricao_etapa.valor, arpag_pontuacao.nome AS nomepontuacao,
														arpag_valor_inscricao_etapa.n_estacas, arpag_valor_inscricao_etapa.n_estacas2';
					$buscar_modalidade->tabela    = 'arpag_modalidade 
														INNER JOIN arpag_valor_inscricao_etapa ON arpag_valor_inscricao_etapa.id_modalidade = arpag_modalidade.id
														INNER JOIN arpag_pontuacao on arpag_pontuacao.id = arpag_valor_inscricao_etapa.id_pontuacao';
					$buscar_modalidade->parametro = 'arpag_valor_inscricao_etapa.id_etapa = '.$resposta['id'];
				$exc_busca  = select_db($buscar_modalidade);
				while ($lina_e = $exc_busca->fetch_array()) {
					echo "<tr><td>".$lina_e['nome']."</td>
						<td>R$".$lina_e['valor']."</td>
						<td>".$lina_e['nomepontuacao']."</td>
						<td>".$lina_e['n_estacas']."</td>
						<td>".$lina_e['n_estacas2']."</td>
					</tr>";
				}
			?>
			</table>			
		</td></tr><?php
	}
}
?>
</table>
</div>
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
  <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>


