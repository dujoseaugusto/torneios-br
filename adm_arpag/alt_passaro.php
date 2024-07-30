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
           
<?php 
if($idpropietario = (isset($_GET['dghf'])) ? dcript($_GET['dghf'],'Erro no id de identificacao da tabela de etapas') : null){
?>	
<script>
	function altera(m,n){
		
		$('#load'+m).html("<img src='../images/loading.gif' style='width: 99px;'>");
		var url = 'funcao_ajax.php?fun=7&mn='+n;
		var a = $("input[name=nome"+m+"]").val();
		var b = $("input[name=anilha"+m+"]").val();
		var c = $("select[id^=ativo"+m+"]").val();
		var d = $("select[id^=propri"+m+"]").val();
		//data      : 'nome='+ $('#campo1').val();            
		$.post(url, {nome: a, anilha: b, ativo: c, propri: d}, function(dataReturn) {
			$('#load'+m).html(dataReturn);
		});
	}

	function apagar(m,n){
		
		$('#load'+m).html("<img src='../images/loading.gif' style='width: 99px;'>");
		var url = 'funcao_ajax.php?fun=10&mn='+n;
		
		//data      : 'nome='+ $('#campo1').val();            
		$.get(url, function(dataReturn) {
			$('#load'+m).html(dataReturn);
		});
	}
	
</script>
<div class="col-md-12"> 
    <h5><?php echo utf8_encode(retorna_nome($idpropietario,'arpag_pessoa')); ?></h5>                       
  </div>

	<table border='1'class='table table-bordered'>
	<tr class='titulo_tabela'>
			<td></td>
			<td>Modalidade</td>
			<td>Nome/anilha</td>
			<td>Ativo</td>
			<td>Alterar Propriet&aacute;rio</td>
			<td style="width: 100px"></td>
			</tr>
	<?php
	$lista = new consulta();
				$lista->campo		= 'id, nome, anilha, id_modalidade, ativo, id_modalidade';
				$lista->parametro	= "id_pessoa = ".$idpropietario." ORDER BY id_modalidade";
				$lista->tabela		= 'arpag_passaro';
	if ($consulta = select_db($lista)){
		$cont = 1;
		while($resposta = $consulta->fetch_array()){
			?><tr>
			<td><?php echo $cont;?> - <?php echo $resposta['id'];?></td>
			<td><?php echo utf8_encode(retorna_nome($resposta['id_modalidade'],'arpag_modalidade'));?></td>
			<td><input type="text" name="nome<?php echo $cont;?>" value='<?php echo utf8_encode($resposta['nome'])?>' /><br /><br />
			<input type="text" name="anilha<?php echo $cont;?>" value='<?php echo utf8_encode($resposta['anilha'])?>' /></td>
			<td><select name="ativo<?php echo $cont;?>" id="ativo<?php echo $cont;?>">
			<?php 
			if($resposta['ativo']){?>   <option  value="1">ativo</option>
										<option  value="0">desativado</option><?php
			}else {
				?><option  value="0">desativavar</option> 
				<option  value="1">ativo</option>
			<?php } ?>
			</select>
		    </td>
		    <td><select name="propri<?php echo $cont;?>" id="propri<?php echo $cont;?>">
			<?php
				echo "<option value='".cript($idpropietario)."'>".utf8_encode(retorna_nome($idpropietario,'arpag_pessoa'))."</option>";
				$consult 		= new consulta();
                $consult->campo	= 'id, nome';
                $consult->tabela	= "arpag_pessoa";
                $consult->parametro= "nome";
				$executa = select_db_2($consult);
				while ($li = $executa->fetch_array()){
					echo "<option value='".cript($li['id'])."'>".utf8_encode($li['nome'])."</option>";

				}
			?> 
			</select>
		    </td> 
			<td><div id='load<?php echo $cont;?>'><a class='btn btn-primary btn-primary'  onclick="altera('<?php echo $cont."','".cript($resposta['id']);?>')">Alterar</a>
			    <?php
			    $verifica_apaga		=	new consulta();
			    		$verifica_apaga->campo 		= 'id';
			    		$verifica_apaga->tabela		= 'arpag_passaro_etapa';
			    		$verifica_apaga->parametro  = "id_passaro = ".$resposta['id'];
			    $executa_ver = select_db($verifica_apaga);
			    if (!$li = $executa_ver->fetch_array()){
			    ?>
			    <br />
			    <br />
			    <a class='btn btn-primary btn-danger'  onclick="apagar('<?php echo $cont."','".cript($resposta['id']);?>')">Apagar</a>
			    <?php
			    }
			    ?>
			 </div></td>
			</tr><?php
			$cont++;
		}
	
	}
}
?>
</table>
               
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
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
