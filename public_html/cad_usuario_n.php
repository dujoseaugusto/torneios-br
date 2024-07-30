<?php
session_start();
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php'); 
include_once('amd_arpag/galeria/config.php');
include_once('topo.php');
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link rel="stylesheet" href="css/lightbox.css">
<script src="js/jquery-1.11.1.min.js"> </script>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">

window.onload = function() {
	new dgCidadesEstados(
    	document.getElementById('estado'),
        document.getElementById('cidade'),
        true
    );
}

/* Máscaras */
jQuery(function($){
	
	$(".data").mask("99/99/9999");
	
	$(".cpf").mask("999.999.999-99");
	
});
/* Máscaras */	

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
	<div class="banner">
		<!-- container -->
		<div class="container">
        	<br /><br /><br /><br />
			<div class="top-nav">
				
				<?php require_once('menu_inicial.php'); ?>
				
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
				<h3>Cadastro</h3>
			</div>
			
            <?php
				//include_once('menu.php');
				if($nome = (isset($_POST['nome'])) ? trocanome($_POST["nome"]) : null){
					 $cidade		= trocanome($_POST['cidade']);
					 $estado		= trocanome($_POST['estado']);
					 $email			= trocanome($_POST['email']);
					 $cpf			= trocanome(str_replace('-','',str_replace('.','',$_POST['cpf'])));
					 $ctf			= trocanome($_POST['ctf']);
					 $senha			= ($_POST['senha'] == $_POST['senhacof']) ? "'".sha1(trocanome($_POST['senha']))."'" : null ;
					 $idclube		= dcript($_POST['clube'],'Erro no id clube');
					$insere = new insercao();
								$insere->campo	=	'nome, id_clube, email, cidade, estado, cpf, ctf, senha, ativo, tipo_usuario';
								$insere->dados	=	("'".$nome."',".$idclube.",'".$email."','".$cidade."','".$estado."','".$cpf."','".$ctf."',".$senha.",1,2");
								$insere->tabela	=	'arpag_pessoa';
					if (insert_bd($insere)) echo "<script> alert ('Seu cadastro foi efetuado com sucesso. Faça seu login!!!!'); window.location='index.php' </script>";
					else echo 'Erro';
				}
			?>
            
            <div>
            
            	<form name="CadastroUsuario" method="post" action="cad_usuario.php" onSubmit="return validaCadastro();">
                        <label>Nome:</label><br /><input type="text" name="nome" style="width:390px !important;" required />
                        <br /><br />
                        <label>E-mail:</label><br /><input type="email" name="email" style="width:390px !important;" required />
                        <br /><br />
                         <label>Estado:</label><br />
                            <select name="estado" id="estado">
                                <option value="">Selecione um estado...</option>
                            </select>
                        <br /><br />
                        <label>Cidade:</label><br />
                            <select name="cidade" id="cidade">
                                <option value="">Selecione uma cidade...</option>
                             </select>
                        <br /><br />
                        <label>Clube:</label><br />
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
                        <br /><br />
                        <label>CPF:</label><br /><input type="text" name="cpf" class="cpf" required />
                        <br /><br />
                        <label>CTF:</label><br /><input type="text" name="ctf" required />
                        <br /><br />
                        <label>Senha:</label><br /><input type="password" name="senha" required />
                        <br /><br />
                        <label>Confirmar senha:</label><br /><input type="password" name="senhacof" required />
                        <br /><br />
                        <input type="submit" class="btn" value="Cadastrar" />
                </form>
            </div>
            
            
		</div>
		
	</div>
    
	<!-- anunciantes -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">
			<div class="gallery-info">
				<h3>Parceiros</h3>
				<h5 class="caption">Veja alguns de nossos parceiros.</h5>
                
                <?php
					$sql = mysql_query("SELECT arpag_comercial.link, arpag_comercial.imagem FROM arpag_comercial");
					while($rs = mysql_fetch_array($sql)){
						
							echo "
									<div class=\"anunciantes-items\">
										<div class=\"anunciantes-item\"> 
											<div class=\"anunciantes-item-inner\">
													<a href=\"http://$rs[link]\" target=\"_blank\">
														<img src=\"anuncios/$rs[imagem]\" class=\"img-responsive\" style=\"height:195px !important; width:262px !important;\"/>
													</a>
											</div>
										</div>
									</div>";
						
					}
			     	?>
                         
			</div><!--info-->
		</div>
		<!-- //container -->
	</div>
	<!-- //anunciantes -->
    
  
    
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
    
    
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<script>
function validaForm(){
var d = document.form1;
if (d.nome.value == ""){
    alert("O campo \"Digite seu Email \" deve ser preenchido!");
    d.nome.focus();
    return false;
}
return true;
}
</script>
<?php
$nome = isset($_POST["nome"]) ? trocanome($_POST["nome"]) : false;
    if ($nome != ""){
        $query_select = new consulta();
                        $query_select->campo = "id,email";
                        $query_select->tabela = "arpag_pessoa";
                        $query_select->parametro = "email = '".$nome."'";
        if($rs  = select_db($query_select)){
            $novasenha = substr(sha1(time()),0,5);
            $li        = $rs->fetch_array();
            $senha     = sha1($novasenha);
            $query     = new atualiza();
                        $query->campo       = "senha = '".$senha."'";
                        $query->tabela      =  "arpag_pessoa";
                        $query->parametro   = "id = ".$li['id'];
            $outros    = "umed=hsda79f8hsdhf7sdh7sahfh&yt=bnsdpisfihisahdfh&cod=sdijnpjfposjdafsdjfnosdfnpksandfpsidfp&nf=$senha&sen=ojiasdfndsfsaojnfojsaodffojn+nsdfnnfodjnfoj+mudanca+usuario+dmksdfnnp&conf=sdkfnsdnfokopansdfkplnjjds";
            if($ex = update_bd($query) == True){
                $data         = date("d/m/Y");
                $emailpara    = $li['email'];
                $titulo       = "Nova Senha enviada em $data";
                $texto="<html><body>
                        <p>Link de acesso: http://www.criativaguaxupe.com.br/proj_passaro2/alteracaodesenha/NovaSenha.php?$outros \n </p>
                        C&oacute;digo: $novasenha <br><b>Data:</b> $data  <br>   <br />

                        </body> </html>";
                //$header = "MIME-Version: 1.0\n";
                $header .= "Content-type: text/html; charset=iso-8859-1\n";
                if (mail($emailpara, $titulo, $texto, $header)){
                    echo "<script>alert(\"Foi enviado para o e-mail ".$li['email'].", link e um código para ativação de sua nova senha\");</script>";
                }else echo "<script>alert(\"Erro no enviada!\");</script>";
            } else echo "<script>alert(\"Erro na base de dados. Os dados não foram encontrados!\");</script>";
        }else echo "<script>alert(\"E-mail incorreto. Entre em contato pelo formulário do site.\");</script>";
    }
?>

<form id="form1" name="form1" method="post" action="index.php" enctype="multipart/form-data" onSubmit="return validaForm()">
    <br />
    <label>Digite seu Email:</label><br>
    <input type="text" name="nome" id="input2" size="50" maxlength="50" /><br />
    <input type="submit" name="Submit" id="bt" value="Recuperar" />

</form>

</div> 
   
</body>
</html>