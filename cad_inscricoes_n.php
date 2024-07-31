<?php
    include("seguranca/seguranca.php");
	protegePagina(2);
	require_once('php/class.php');
	require_once('bd_funcao/maysql.php');
	require_once('php/funcao_0.2.php');
	include_once('topo.php');
	//include_once('adm_arpag/galeria/config.php');
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
	<!-- banner-top -->
	<div id="home" class="banner-top">
		<!-- container -->
		<div class="container">

        <div class="header-top-left">
        	<img src="images/logo_ini.png" />
		</div>

            <div class="details" style="font-size:11px !important;">
					<?php
						if (isset($_SESSION['usuarioNome'])) echo 'Logado como: '. ($_SESSION['usuarioNome']);
					?>

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
		<div class="container" style="height:170px !important;">
			<div class="top-nav" style="line-height:18px !important;">
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
				<h3>Inscrições</h3>
			</div>
			<script>
			function inscricao(m,n,o){
				$('#load'+n).html("<img src='images/loading.gif'>");
				var url = 'funcao_ajax.php?fun=3&m='+m+'&o='+o;
				$.get(url, function(dataReturn) {
					$('#load'+n).html(dataReturn);
				});

			}
			</script>

            <?php
//include_once('menu.php');
if($nome = (isset($_POST['idetapa'])) ? dcript($_POST["idetapa"],'Erro no idetapa') : null){
	$tipo 	= $_POST['passaro'];
	$idmoda = dcript($_POST['idmoda'],'Erro no identificacao  da modalidade');

	function excolhe_inicio($idpessoa,$idmoda){
		$excolher_ini = new consulta();
						$excolher_ini->campo		= 'COUNT(*)';
						$excolher_ini->tabela		= 'arpag_passaro';
						$excolher_ini->parametro	= "id_pessoa = ".$idpessoa." AND id_modalidade = ".$idmoda;
		$excolher_exe = select_db($excolher_ini);
		$excolher_result = $excolher_exe->fetch_array();
		if($excolher_result[0] < 2) return mt_rand(1,50);
		else if($excolher_result[0] < 4) return mt_rand(1,40);
		else if($excolher_result[0] < 6) return mt_rand(1,30);
		else if($excolher_result[0] < 8) return mt_rand(1,20);
		else return mt_rand(1,3);

	}

	function numero_inscricao($nome,$idmoda,$idpessoa){
		$verifica_pass_pess = new consulta();
								$verifica_pass_pess->campo		= 'MAX(a.numero)';
								$verifica_pass_pess->tabela		= "arpag_passaro_etapa AS a
																	INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro";
								$verifica_pass_pess->parametro  = "a.id_etapa = ".$nome. "
																	AND b.id_modalidade = ".$idmoda ."
																	AND b.id_pessoa = ".$idpessoa;
		$resultado_ver = select_db($verifica_pass_pess);
		$reasult_ver = $resultado_ver->fetch_array();
		if(($reasult_ver[0]) != null) $num_inicia = $reasult_ver[0] + mt_rand(5,10);
		else $num_inicia = excolhe_inicio($idpessoa,$idmoda);
		//echo "<br />".$num_inicia."<br />".$reasult_ver[0]."<br />";
		//verifica o numero no bd
		$verificar = new consulta();
					$verificar->campo       = 'a.numero';
					$verificar->tabela      = 'arpag_passaro_etapa AS a
												INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro ';
					$verificar->parametro   = "a.numero >= ".$num_inicia." AND a.id_etapa = ".$nome. " AND b.id_modalidade = ".$idmoda ." ORDER BY numero";
		$executa_ver = select_db($verificar);
		$cont = $num_inicia;
		$numero = $num_inicia;
		//descobre qual numero vago para iniciar ma nova inscrição
		while($linha_ex = $executa_ver->fetch_array()){
			if($linha_ex['numero'] != $cont){	$numero = $cont; break;}
			else{	$numero = $cont+1;$cont++;}

		}
		//echo "<br />".$numero."<br />";
		return $numero;
	}
   //echo "<br />".$numero." - ".$cont;

    //rece os passaros selecionado para a incrição
    //$numero = 1;*/
	//break;
	foreach($tipo as $valor => $ak){
		$inserir = new insercao();
				$inserir->campo	= 'id_pessoa,id_passaro,id_etapa, numero';
				$inserir->dados	= dcript($_SESSION['usuarioID'],'Erro no id usuario').",
									".dcript($ak,'Erro ao inserir passaro').",".$nome.",
									".numero_inscricao($nome,$idmoda,dcript($_SESSION['usuarioID'],'Erro no id usuario'));
				$inserir->tabela = 'arpag_passaro_etapa';
		$executar = insert_bd($inserir);
	}
	echo "<script> alert ('Click nesta modalidade, para imprimir a sua ficha de incrição'); window.location='cad_inscricoes.php' </script>";
}

?>
<br />
<table class="table table-hover" >
<td><b>Temporada</b></td>
<td><b>Etapa</b></td>
<td><b>Local</b></td>
<td><b>Data</b></td>
<td><b>Cidade</b></td>
<td><b>Inscrição</b></td>
<?php
$lista = new consulta();
			$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local';
			$lista->parametro	= "a.data_etapa >='". date('Y-m-d')."' AND a.status = 0 GROUP BY a.id";
			$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
if ($consulta = select_db($lista)){
	$cont = 1;
	while($resposta = $consulta->fetch_array()){
		?><tr>
		<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td>
		<td><?php echo ($resposta['descricao'])." </td><td> ". dtahoraela($resposta['data_etapa']);?></td>
		<td><?php echo ($resposta['local']);?></td><td>

		<?php
		$vetor_mod = verifica_etapa($resposta['id']);
		for ($i=1;$i<=count($vetor_mod);$i++){
		?><a onClick="inscricao('<?php echo cript($resposta['id']);?>','<?php echo $cont;?>','<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
			<?php echo $vetor_mod[$i][2];?></a><br /><?php
		}
		?>
		</td>
		</tr><tr><td colspan=6><div id='load<?php echo $cont++;?>'</td></tr><?php
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