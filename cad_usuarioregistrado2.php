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
<script type="text/javascript" src="js/cidades_estados.js" charset="iso-8859-1"></script>
<script type="text/javascript" src="js/maskedinput.js"></script>
<script type="text/javascript" src="js/funcoes.js"></script>


<script type="text/javascript">

function adciona(){
		var nome = document.getElementById('nomepassaro').value;
		var pass = document.getElementById('modalidadepassaro').value;
		var anil = document.getElementById('nomeanilhia').value;
        var url = 'funcao_ajax.php?fun=1&m='+nome+'&n='+pass+'&o='+anil;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
	 
	function exclui(m){
		if (confirm ('tem certeza disso?')) {
			var url = 'funcao_ajax.php?fun=2&m='+m;
			$.get(url, function(dataReturn) {
			 $('#load').html(dataReturn);
			});
		}
        
      } 

	
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
	<!-- banner-top -->
	<div id="home" class="banner-top">	
		<!-- container -->
		<div class="container">     
        
        <div class="header-top-left" style="font-size:12px !important; font-weight:bold !important;">
        		<br />
				<?php
					if (isset($_SESSION['usuarioNome'])) echo 'Usuário: '. ($_SESSION['usuarioNome']);
				?>
		</div>
        
            <div class="details" style="font-size:11px !important;">
					<?php include_once('menu.php'); ?>
			</div>
            
            <div class="clearfix"> </div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-top -->
    
	<!-- banner -->
	<div class="banner2">
		<!-- container -->
		<div class="container" style="height:80px !important;">
			<div class="top-nav">
				<ul class="nav1 cl-effect-1">
                    <br /><br />
                    <li><a href="index.php">Inicial</a></li>
					
				</ul>
				<!-- script-for-menu -->
					<script>
						 $( "span.menu" ).click(function() {
						$( "ul.nav1" ).slideToggle( 300, function() {
						// Animation complete.
							});
							});
					</script>
				<!-- /script-for-menu -->
			</div>

		</div>
		<!-- //container -->
	</div>
	<!-- //banner -->        
    
	
	<!-- banner-bottom -->
	<div id="agenda" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
				<h3>Inscrições</h3>
			</div>
			
           <?php
include_once('menu.php');
if($nome = (isset($_POST['nome'])) ? trocanome($_POST["nome"]) : null){
	 $cidade		= trocanome($_POST['cidade']);
	 $estado		= trocanome($_POST['estado']);
	 $email			= trocanome($_POST['email']);
	 $cpf			= trocanome(str_replace('-','',str_replace('.','',$_POST['cpff'])));
	 $ctf			= trocanome($_POST['ctf']);
	 $senha_oc		= trocanome($_POST['senhaor']);
	 $senha			= (($_POST['senha'] == $_POST['senhacof']) && ($_POST['senha'] != null)) ? "'".sha1($_POST['senha'])."'" : null ;
	 $idclube		= dcript($_POST['clube'],'Erro no id clube');
	if  (!$senha)$senha = "'".$senha_oc."'";
	$atualiza = new atualiza();
				$atualiza->campo	=	("nome='".$nome."',id_clube=".$idclube.", email='".$email."', cidade='".$cidade."'
										, estado='".$estado."', cpf='".$cpf."', ctf='".$ctf."', senha=".$senha);
				$atualiza->parametro	=	" id = ". dcript($_SESSION['usuarioID'],'Erro no id usuario');
				$atualiza->tabela	=	'arpag_pessoa';
	if (update_bd($atualiza)) echo "<script> alert ('Seu cadastro foi atualizado com sucesso !!!!'); window.location='cad_usuarioregistrado.php' </script>";
	else echo 'Erro';
}
?>
<?php
	$consulta = new consulta();
				$consulta->campo	= 'a.nome, a.email, a.cidade, a.estado, b.nome, a.cpf, a.ctf, a.id_clube, senha';
				$consulta->tabela	= 'arpag_pessoa AS a INNER JOIN arpag_clube AS b ON b.id = a.id_clube';
				$consulta->parametro= " a.id = ". dcript($_SESSION['usuarioID'],'Erro no usuario');
	$resp_usuario = select_db($consulta);
	$linha_us = $resp_usuario->fetch_array();
?>
<form name="CadastroUsuario" method="post" action="cad_usuarioregistrado.php" onsubmit="return validaCadastro();">
	<label>Nome:</label>&nbsp;<input type="text" name="nome" value="<?php echo ($linha_us[0]); ?>" />
    <br /><br />
    <label>E-mail:</label>&nbsp;<input type="text" name="email" value="<?php echo $linha_us['email']; ?>"  />
    <br /><br />
     <label>estado: </label>
     	<input type="text" name="estado" id="estado" value="<?php echo $linha_us['estado']; ?>" >
	<br /><br />
	<label>Cidade: </label>
	<input type="text" name="cidade" id="cidade" value="<?php echo ($linha_us['cidade']); ?>" >
	<br /><br />
	<label>Clube:&nbsp;</label>
    	<select name="clube">
        	<option value="<?php echo cript($linha_us['id_clube']); ?>" ><?php echo $linha_us[4]; ?></option>
			<?php
			$temporada 		= new consulta();
							$temporada->campo		= 'id, nome';
							$temporada->tabela 		= 'arpag_clube';
							$temporada->parametro	= "id <> ". $linha_us['id_clube'];
			$resp_temporada = select_db($temporada);
			while($linha = $resp_temporada->fetch_array()){
				echo "<option  value='".cript($linha['id'])."'>".$linha['nome']."</option>";
			}
			?>
        </select>
    <br /><br />
    <label>CPF:&nbsp;</label><input type="text" name="cpff" value="<?php echo $linha_us['cpf']; ?>"  />
    <br /><br />
    <label>CTF:&nbsp;</label><input type="text" name="ctf" value="<?php echo $linha_us['ctf']; ?>"  />
    <br /><br />
    <label>Senha:&nbsp;</label><input type="password" name="senha" />
	<br /><br />
	<label>confirma senha:&nbsp;</label><input type="password" name="senhacof" />
    <br /><br />
	<input type="hidden" name="senhaor" value="<?php echo $linha_us['senha']; ?>"  />
    <input type="submit" value="Atualizar Dados" />
</form>
<p>Lista de pássaros</p>
<a href="#" onclick="adciona('<?php echo $_SESSION['usuarioID'];?>');">Adiciona pássaro</a>
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
				echo "<option  value='".cript($linha['id'])."'>".($linha['nome'])."</option>";
			}
			?>
        </select>
<div id='load'>
<table>
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, a.nome, b.nome';
			$lista->parametro	= "a.id_pessoa = ". dcript($_SESSION['usuarioID'],'Não usuario')." AND ativo = 1";
			$lista->tabela		= 'arpag_passaro AS a INNER JOIN arpag_modalidade AS b ON b.id = a.id_modalidade';
if ($consulta = select_db($lista)){
	while($resposta = $consulta->fetch_array()){
		?><tr><td><a href='#' onclick="exclui('<?php echo cript($resposta['id']);?>')">Excluir</a></td>
		<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td></tr><?php
	}
}
?>
</table>

            </div>
            
            
		</div>
		
	</div>
	
    
    
	<!-- footer -->
	<div class="footer">
		<!-- container -->
		<div class="container">
			<p>Desenvolvido por <a href="http://www.criativaguaxupe.com.br/" target="_blank">Criativa Guaxupé</a></p>
		</div>
		<!-- //container -->
	</div>
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
</body>
</html>