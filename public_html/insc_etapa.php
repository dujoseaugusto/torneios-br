<?php
  /*  include("seguranca/seguranca.php");
	protegePagina(1);
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
	<?php
			$banner = new consulta();
				$banner->campo 		= 'id, imagem';
				$banner->parametro	= 'id DESC LIMIT 1';
				$banner->tabela		= 'arpag_banner';
			$resultado = select_db_2($banner);
				
			while($rs = $resultado->fetch_array()){
				$bg = 'banner/'.$rs['imagem'];

				
		}
	?>
	
		<!-- container -->
		<div class="banner" style="background: white url('<?php echo $bg; ?>') !important  no-repeat 0px 0px; background-size: cover; padding: 5em 0;">
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
if($id_user = (isset($_POST['cc'])) ? dcript($_POST["cc"],'sair erro'; NULL){
	unset($_SESSION['usuarioAdmin']);
}
if($id_user = (isset($_POST['dghf'])) ? dcript($_POST["dghf"],'Erro no usuario'; NULL){
	$_SESSION['usuarioAdmin'] = $id_user;
}
if (isset($_SESSION['usuarioAdmin'])){ 
		if($nome = (isset($_POST['idetapa'])) ? dcript($_POST["idetapa"],'Erro no idetapa') : null){
			$tipo 	= $_POST['passaro'];
			$idmoda = dcript($_POST['idmoda'],'Erro no identificacao  da modalidade');

			function excolhe_inicio($idpessoa,$idmoda,$numero_de_incricao){

				$excolher_ini 	= new consulta();
								$excolher_ini->campo		= 'COUNT(*)';
								$excolher_ini->tabela		= 'arpag_passaro';
								$excolher_ini->parametro	= "id_pessoa = ".$idpessoa." AND id_modalidade = ".$idmoda;
				$excolher_exe 		= select_db($excolher_ini);
				$excolher_result 	= $excolher_exe->fetch_array();
				if($excolher_result[0] < 2) return mt_rand(1,25+$numero_de_incricao);
				else if($excolher_result[0] < 3) return mt_rand(1,15+$numero_de_incricao);
				else if($excolher_result[0] < 5) return mt_rand(1,10+$numero_de_incricao);
				else if($excolher_result[0] < 7) return mt_rand(1,5+$numero_de_incricao);
				else return mt_rand(1,3);

			}

			function numero_inscricao_novo2($nome,$idmoda,$idpessoa){

				$numero_inscri 	= new consulta();
								$numero_inscri->campo 		= 'COUNT(*)';
								$numero_inscri->tabela		= "arpag_passaro_etapa AS a
																INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro";
								$numero_inscri->parametro	= "a.id_etapa = ".$nome. "
																AND b.id_modalidade = ".$idmoda;
				$resultado_ni 	= select_db($numero_inscri);
				$result_ni 	= $resultado_ni->fetch_array();

				$numero_de_incricao = $result_ni[0];

				$verifica_pass_pess = new consulta();
										$verifica_pass_pess->campo		= 'MAX(a.numero)';
										$verifica_pass_pess->tabela		= "arpag_passaro_etapa AS a
																			INNER JOIN arpag_passaro AS b ON b.id = a.id_passaro";
										$verifica_pass_pess->parametro  = "a.id_etapa = ".$nome. "
																			AND b.id_modalidade = ".$idmoda ."
																			AND b.id_pessoa = ".$idpessoa;
				$resultado_ver = select_db($verifica_pass_pess);
				$result_ver = $resultado_ver->fetch_array();
				if(($result_ver[0]) != null) $num_inicia = $result_ver[0] + mt_rand(8,13);
				else $num_inicia = excolhe_inicio($idpessoa,$idmoda,$numero_de_incricao);
				//echo "<br />".$num_inicia."<br />".$result_ver[0]."<br />";
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
			/*foreach($tipo as $valor => $ak){
				$verifica_ja_exite = new consulta();
									$verifica_ja_exite->campo 		= 'COUNT(*)';
									$verifica_ja_exite->tabela		= 'arpag_passaro_etapa';
									$verifica_ja_exite->parametro	= "id_pessoa = ".dcript($_SESSION['usuarioAdmin'],'Erro no id usuario')."
																		AND id_passaro = ".dcript($ak,'Erro ao inserir passaro')."
																		AND id_etapa = ".$nome;
				$resp_verifica = select_db($verifica_ja_exite);
				$linha_ver = $resp_verifica->fetch_array();
				if($linha_ver[0] == 0){	
					$inserir = new insercao();
							$inserir->campo	= 'id_pessoa,id_passaro,id_etapa, numero';
							$inserir->dados	= dcript($_SESSION['usuarioAdmin'],'Erro no id usuario').",
												".dcript($ak,'Erro ao inserir passaro').",".$nome.",
												".numero_inscricao_novo2($nome,$idmoda,dcript($_SESSION['usuarioAdmin'],'Erro no id usuario'));
							$inserir->tabela = 'arpag_passaro_etapa';
					$executar = insert_bd($inserir);
				}	
			} 
			echo "<script> alert ('Inscrição realizada'); window.location='pos_inscricao.php?m=".cript($nome)."&o=".cript($idmoda)."';</script>"; 
			echo " <meta http-equiv='refresh' content=1;url='pos_inscricao.php?m=".cript($nome)."&o=".cript($idmoda)."'>";
		} 

		?>
		<br />
		<p>
		<a class='tn btn-primary btn-primary' href="insc_etapa.php?cc=<?php echo cript(3);?>">Sair</a>
		</p>
		<table class="table table-hover" >
		<?php
		$lista = new consulta();
					$lista->campo		= 'a.id, b.nome, a.nome, a.descricao, a.data_etapa, a.local';
					$lista->parametro	= " b.fechada <> 2 and a.data_etapa >='". date('Y-m-d H:i:s')."' GROUP BY a.id";
					$lista->tabela		= 'arpag_etapa AS a INNER JOIN arpag_temporada AS b ON b.id = a.id_temporada';
		if ($consulta = select_db($lista)){
			$cont = 1;
			while($resposta = $consulta->fetch_array()){
				?>
				<tr><td><b>Temporada</b></td>
				<td><b>Etapa</b></td>
				<td><b>Local</b></td>
				<td><b>Data</b></td>
				<td><b>Cidade</b></td></tr>
				<tr>
				<td><?php echo ($resposta[1])." </td><td> ". ($resposta[2]);?></td>
				<td><?php echo ($resposta['descricao'])." </td><td> ". dtahoraela($resposta['data_etapa']);?></td>
				<td><?php echo ($resposta['local']);?></td></tr><tr><td colspan=5>

				<?php
				$vetor_mod = verifica_etapa($resposta['id']);
				for ($i=1;$i<=count($vetor_mod);$i++){
				?><a onClick="inscricao('<?php echo cript($resposta['id']);?>','<?php echo $cont;?>','<?php echo cript($vetor_mod[$i][1]);?>')" class="btn btn-primary btn-primary">
					<?php echo $vetor_mod[$i][2];?></a><?php
				}
				?>
				</td>
				</tr><tr><td colspan=5><div id='load<?php echo $cont++;?>'</td></tr><?php
			}
		}
		?>
		</table>
<?php 		
}
else{
	$consulta 	= new consulta();
                $consulta->campo	= '*';
                $consulta->tabela	= "arpag_pessoa";
                $consulta->parametro= "nome";
				$executa = select_db_2($consulta);
				$li = $executa->fetch_array();

	?>
	<table border='1'class='table table-bordered'>
	  <tr>
	    <td colspan="3" style="text-align:center; font-weight:bold;">Lista de inscritos</td>
	  </tr>
	  <tr>
	    <td><img src="../images/logotipo.jpg" width="100" /></td>
	    <td width="519" style="font-weight:bold;"><br />
	    <td width="196" style="font-weight:bold;"><p><br />
	    </p>
	    <p><br />
		</p></td>
	  </tr>
  
    </table>

	<table border='1'class='table table-bordered'>
	<tr class='titulo_tabela'>
		<td></td>
		<td>ID</td>
		<td>Nome</td>
		<td>Email</td>
		<td>CPF</td>
		<td>CTF</td>
		<td>Cidade</td>
		<td>Clube</td>
		<td>inscrever</td>
	</tr>
	
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
			<td><a class='tn btn-primary btn-primary' href="insc_etapa.php?dghf=<?php echo cript($linha['id']);?>">Alt Passaro</a></td>
		</tr>
		
		<?php
		$cont++;
	}
?>
</table>
<?php 
}
?>

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

/*										$().UItoTop({ easingType: 'easeOutQuart' });

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
</html>*/