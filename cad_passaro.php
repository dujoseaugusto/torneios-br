<?php
include("seguranca/seguranca.php");
protegePagina(2);
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php');	
include_once('topo.php');
?>

<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link rel="stylesheet" href="css/lightbox.css">
<script src="js/jquery-1.11.1.min.js"> </script>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
	//Scrool
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
	
	//Dialog (Recuperar Senha)
	$(function() {
		$("#dialog").dialog({
				autoOpen: false,
				show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
	
		$( "#opener" ).click(function() {
			$("#dialog").dialog("open");
		});
		
	});
	
	$(".recupera").dialog("option", "width", 650);	
	
</script>	
	
</head>
<body>
		<table style="width: 100%; margin-top: 1%;">
	<tr><td><?php include_once("menu.php"); ?></td></tr>  
    <tr><td><?php include_once("banner_topo.php"); ?></td></tr>
    <tr><td><?php include("novo_menu.php"); ?></td></tr>
   	</table> 
    
 
 <!-- banner-bottom -->
	<div id="agenda" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
				<h3>Pássaros</h3>
			</div>
			
           <?php
include_once('menu.php');
?>
<script>
function exclui(m){
	if (confirm ('tem certeza disso?')) {
		var url = 'funcao_ajax.php?fun=2&m='+m;
		$.get(url, function(dataReturn) {
		 $('#load').html(dataReturn);
		});
	}
	
  }
  function adciona(){
		var nome = document.getElementById('nomepassaro').value;
		var pass = document.getElementById('modalidadepassaro').value;
		var anil = document.getElementById('nomeanilhia').value;
        var url = 'funcao_ajax.php?fun=1&m='+nome+'&n='+pass+'&o='+anil;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
		document.getElementById('nomepassaro').value = "";
		document.getElementById('nomeanilhia').value = "";
    }    

</script>
<br />
<?php 
if ($idpassaro = isset($_GET['t'])?dcript($_GET['t'],'Codigo passaro erro'):NULL){
?>
<table border='1'class='table table-bordered'>
	<tr class='titulo_tabela'>
			
			<td>Nome/anilha</td>
			<td>CPF do novo Propriet&aacute;rio</td>
			<td style="width: 100px"></td>
			</tr>
	<?php
	$lista = new consulta();
				$lista->campo		= 'id, nome, anilha, id_modalidade, ativo, id_modalidade, id_pessoa';
				$lista->parametro	= "id= ".$idpassaro;
				$lista->tabela		= 'arpag_passaro';
	if ($consulta = select_db($lista)){
		$cont = 1;
		if($resposta = $consulta->fetch_array()){
			?>
			<script>
				function altera(){		
					$('#load').html("<img src='images/loading.gif' style='width: 99px;'>");
					var url = 'funcao_ajax.php?fun=10';
					var a = '<?php echo $resposta['nome']; ?>';
					var b = '<?php echo $resposta['anilha']; ?>';
					var c = '1'; 
					var mn = '<?php echo cript($idpassaro);?>';  
					var d = $("#cpf").val();    
					$.post(url, {nome: a, anilha: b, ativo: c, cpf: d, mn: mn}, function(dataReturn) {
						$('#load').html(dataReturn);
					});
				}
			</script>
			<?php
			?><tr>
			<td><?php echo ($resposta['nome'])?><br />
			<?php echo ($resposta['anilha'])?></td>
			
		    <td>
			
            <input type="cpf" name="cpf" id="cpf" class="form-control" placeholder="Digite o cpf sem ponto" autofocus="autofocus" required />
                                    
			</td> 
			<td><div id='load'><a class='btn btn-primary btn-primary'  onclick="altera()">Transferir</a>
			   
			 </div></td>
			</tr><?php
			$cont++;
		}
	
	}

?>
</table>
<?php
}else{
?>
<label>Nome: </label><input type="text" nome="nomepassaro" id="nomepassaro" />
<label>Anilha: </label><input type="text" nome="nomeanilhia" id="nomeanilhia" />
<label>Modalidade</label>
<select name="modalidadepassaro" id="modalidadepassaro">
	<?php
			$modalidade 	= new consulta();
							$modalidade->campo		= 'id, nome';
							$modalidade->tabela 	= 'arpag_modalidade';
							$modalidade->parametro	= "nome";
			$resp_modalidade = select_db_2($modalidade);
			while($linha = $resp_modalidade->fetch_array()){
				echo "<option  value='".cript($linha['id'])."'>".$linha['nome']."</option>";
			}
			?>
        </select>

<a class="btn btn-primary btn-primary" onClick="adciona('<?php echo $_SESSION['usuarioID'];?>');">Adiciona pássaro</a>
<br />
<div id='load'>
<table class='table'>
	<tr>
		<td></td>
		<td>Nome</td>
		<td>Anilha</td>
		<td>Modalidade</td>
	</tr>
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, a.nome, b.nome, a.anilha';
			$lista->parametro	= "a.id_pessoa = ". dcript($_SESSION['usuarioID'],'Não usuario')." AND a.ativo = 1";
			$lista->tabela		= 'arpag_passaro AS a INNER JOIN arpag_modalidade AS b ON b.id = a.id_modalidade';
if ($consulta = select_db($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td>
		<a href="cad_passaro.php?t=<?php echo cript($resposta['id']);?>" class="btn btn-primary btn-info" title="Trasnferir">Transferir</a> 
		<a class="btn btn-primary btn-danger" onClick="exclui('<?php echo cript($resposta['id']);?>')" title="Ao inativar uma ave o proproet&aacute;rio n&atilde;o poderar mais usar esse n&aacute;mero de anilha ">Inativar</a></td>
		<td><?php echo $resposta[1]." </td><td>".$resposta['anilha']."</td><td> ". $resposta[2];?></td></tr><?php
	}
}
?>
</table>

            </div>
<?php
}
?>            
            
		</div>
		
	</div>
 
        
	<!-- footer -->
	
		<?php include('rodape.php'); ?>
	
	<!-- //footer -->
	<script type="text/javascript">
									$(document).ready(function() {
										/*
										var defaults = {
								  			containerID: 'toTop', // fading element id
											containerHoverID: 'toTopHover', // fading element hover id
											scrollSpeed: 1200,
											easingType: 'linear' 
								 		};
										*/
										
										$().UItoTop({ easingType: 'easeOutQuart' });
										
									});
								</script>
									<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- content-Get-in-touch -->
	<script src="js/responsiveslides.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
    
    
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>