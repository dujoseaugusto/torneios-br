<?php
include_once("seguranca/seguranca.php");
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php'); 
//require_once('adm_arpag/config.php');
include_once('topo.php');
error_reporting(0);
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />	
<link rel="stylesheet" href="css/lightbox.css">
<link rel="stylesheet" href="css/menu.css">
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
	<!-- banner-top -->
	<div id="home" class="banner-top">	
		<!-- container -->
		<div class="container">     
        
        <div class="header-top-left">
        	<img src="images/logo_ini.png" />				
		</div>
        
            <div class="details" style="font-size:11px !important;">
					<?php
						if (isset($_SESSION['usuarioNome'])) echo 'Logado como: '. utf8_encode($_SESSION['usuarioNome']);
					?>

					<?php include_once('menu.php'); ?>
			</div>
            
            <div class="clearfix"> </div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-top -->
    
	<div class="container">
    <div class="top-nav2" style="line-height:18px !important;">
    	<span class="menu2">VISUALIZAR MENU</span>
                    <ul class="nav2 cl-effect-2">
                        <li><a href="index.php">Inicial</a></li>
                        <li><a href="diretoria.php">Diretoria</a></li>
                        <li><a href="agenda.php">Agenda</a></li>
                        <li><a href="inscritos.php">Ver Inscritos</a></li>
                        <li><a href="resultados.php">Resultados</a></li>
                        <li><a href="calendario.php">Calendário</a></li>
                        <li><a href="fotos.php">Fotos</a></li>
                        <li><a href="farmacia.php">Farmácia</a></li>
                        <li><a href="videos.php">Vídeos</a></li>
                        <li><a href="contato.php">Contato</a></li>                        
                    </ul>        
    </div>
    </div>
    
	<!-- banner
	<div class="banner">
		<!-- container
		<div class="container" style="height:170px !important;">
			<div class="top-nav" style="line-height:18px !important;">				
				<?php //require_once('menu_inicial.php'); ?>				
			</div>
		</div>

	</div>
	<!-- //banner -->            	
    
    <!-- about -->
	<div id="about" class="about">
		<!-- container -->
		<div class="container">
			<div class="about-grids">
				<div class="col-md-4 about-left">
					<img src="images/1.jpg" alt="" height="507" />
				</div>
				<div class="col-md-8 about-right">
					<h3>Associação</h3>
					<p>Fundada em 25 de Outubro de 2007, e registrada nos orgãos competentes, FEOMG sob o número 126 e IBAMA sob o número 2653849, temos como finalidades principais, promover e incentivar aos criadoristas da região de Guaxupé, a criar e preservar pássaros em cativeiro da nossa fauna.Além da efetiva promoção de treinamentos, torneios ( prioritáriamente para canários, trinca-ferro, coleira, bicudo, curió e azulão) e manejos com o plantel, bem como cuidar dos interesses de nossos associados juntos às Federações competentes e ao IBAMA.
<br /><br />
Como atividades secundárias, porém não menos importantes, está o intercâmbio de conhecimentos entre nossos associados, informações relacionadas a tratamentos, medicamentos para o cuidado de possíveis enfermidades, cuidados gerais com alimentação dos pássaros e informações gerais, que são principalmente discutidas e comentadas em nossas reuniões ou através do nosso fórum de notícias.
<br /><br />
Associação Regional de Passarinheiros em Guaxupé<br />
Rua Espirito Santo, 39 - Guaxupé/MG<br />
Telefone: (35) 3552-4732</p>
				</div>

	<p style="text-align:right;">Conheça nosso regulamento - <a href="regulamento/regulamento2015.pdf" target="_blank">Clique aqui</a></p>
				
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //about -->
    
        <!-- anunciantes -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">
			<div class="gallery-info">
				<h3>Parceiros</h3>
				<h5 class="caption">Veja alguns de nossos parceiros.</h5>                
                <?php
				include_once('comercial.php');
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