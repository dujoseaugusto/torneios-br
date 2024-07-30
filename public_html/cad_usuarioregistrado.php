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
<script src="js/jquery.js"> </script>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script type="text/javascript" src="js/cidades_estados.js" charset="iso-8859-1"></script>
<script type="text/javascript" src="js/maskedinput.js"></script>
<script type="text/javascript" src="js/funcoes.js"></script>

<script type="text/javascript">
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
	
function validaCadastro(){
	var cpf = document.getElementById("cpf_n").value;
	cpf = cpf.replace(".","");
	cpf = cpf.replace(".","");
	cpf = cpf.replace("-","");
	if(validaCPF(cpf)) return true;
	else {
		document.getElementById("cpf_n").focus();
		document.getElementById("pr_cpf").innerHTML = "<span class='alert-danger'> Digito Um CPF válido</span>";
		return false;
	}
}

function validaCPF(cpf)
  {
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
          return false;
    for (i = 0; i < cpf.length - 1; i++)
          if (cpf.charAt(i) != cpf.charAt(i + 1))
                {
                digitos_iguais = 0;
                break;
                }
    if (!digitos_iguais)
          {
          numeros = cpf.substring(0,9);
          digitos = cpf.substring(9);
          soma = 0;
          for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(0))
                return false;
          numeros = cpf.substring(0,10);
          soma = 0;
          for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1))
                return false;
          return true;
          }
    else
        return false;
  }
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
				<h3>Dados cadastrados</h3>
			</div>
			
           <?php
include_once('menu.php');
if($nome = (isset($_POST['nome'])) ? trocanome($_POST["nome"]) : null){
	 $cidade		= trocanome($_POST['cidade']);
	 $estado		= trocanome($_POST['estado']);
	 $email			= trocanome($_POST['email']);
	 $cpf			= trocanome(str_replace('-','',str_replace('.','',$_POST['cpff'])));
	 $ctf			= trocanome($_POST['ctf']);
	 $nsocio    	= trocanome($_POST['n_socio']);
	 $senha_oc		= trocanome($_POST['senhaor']);
	 $senha			= (($_POST['senha'] == $_POST['senhacof']) && ($_POST['senha'] != null)) ? "'".sha1($_POST['senha'])."'" : null ;
	 $idclube		= dcript($_POST['clube'],'Erro no id clube');
	 if(!validaCPF($cpf)){echo "<p class='alert-danger'>CPF invalido, caso tenha problemas, entre em contato com o administrador <a href='cad_usuario.php'>sair</a></p>"; exit;}
	if  (!$senha)$senha = "'".$senha_oc."'";
	$atualiza = new atualiza();
				$atualiza->campo	=	("nome='".$nome."',id_clube=".$idclube.", email='".$email."', cidade='".$cidade."'
										, estado='".$estado."', cpf='".$cpf."', ctf='".$ctf."', senha=".$senha.", numero_socio = '".$nsocio."'");
				$atualiza->parametro	=	" id = ". dcript($_SESSION['usuarioID'],'Erro no id usuario');
				$atualiza->tabela	=	'arpag_pessoa';
	if (update_bd($atualiza)) echo "<script> alert ('Seu cadastro foi atualizado com sucesso !!!!'); window.location='cad_usuarioregistrado.php' </script>";
	else echo 'Erro';
}
?>
<?php
	$consulta = new consulta();
				$consulta->campo	= 'a.nome, a.email, a.cidade, a.estado, b.nome, a.cpf, a.ctf, a.id_clube, a.senha, a.numero_socio';
				$consulta->tabela	= 'arpag_pessoa AS a INNER JOIN arpag_clube AS b ON b.id = a.id_clube';
				$consulta->parametro= " a.id = ". dcript($_SESSION['usuarioID'],'Erro no usuario');
	$resp_usuario = select_db($consulta);
	$linha_us = $resp_usuario->fetch_array();
?>
<form name="CadastroUsuario" method="post" action="cad_usuarioregistrado.php" onSubmit="return validaCadastro();">
	<!--<label>Nome:</label>&nbsp;<input type="text" name="nome" value="<?php echo ($linha_us[0]); ?>" />
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
	-->

    <table  class='table'>
                        <tr>
                        	<td >
                        	<label>Nome:</label>
                        		<div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                        <input type="text" name="nome" class="form-control" required value="<?php echo ($linha_us[0]); ?>"  />
                                        <input type="hidden" name="senhaor" value="<?php echo $linha_us['senha']; ?>"  />
                                </div>                        		
                        	</td>
                       
                        	<td >
                        		<label>E-mail:</label>
                        		<div class="form-group input-group">
                                     <span class="input-group-addon">@</span>
                                        <input type="email" name="email" class="form-control" required value="<?php echo $linha_us['email']; ?>"  />
                                </div> 

                        	</td>
                        </tr>
                        <tr>
                        	<td>
                         		<label>Estado:</label>
                         		<div class="form-group input-group">
                         			<span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                            		<input type="text" name="estado" class="form-control" id="estado" value="<?php echo $linha_us['estado']; ?>" >
                        	</td>
                        	<td>
                        	    <label>Cidade:</label>
                        	    <div class="form-group input-group">
                         			<span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                	<input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo ($linha_us['cidade']); ?>" >
                             	</div>
                        	</td>
                        </tr>
                        <tr>
                        	<td>
                        		<label>Clube:</label>
                        		<div class="form-group">
    								<select name="clube" class="form-control">
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
        						</div>
                        	</td>
                       		<td>
                       			<label>CPF:</label>
                       			<div class="form-group input-group">
                       				<span class="input-group-addon"><i class="fa fa-paperclip"  ></i></span>
                       				<input type="text" name="cpff" class="cpf" id="cpf_n" class="form-control" required  value="<?php echo mcpfcnpj($linha_us['cpf']); ?>"/>
                       			</div>
                       			<div id="pr_cpf"></div>
                       		</td>
                       	</tr>
                       	<tr>
                       		<td>
                                <label>CTF:</label>
                                <div class="form-group input-group">
                                	<span class="input-group-addon"><i class="fa fa-paperclip"  ></i></span>
                                	<input type="text" name="ctf" class="form-control" required  value="<?php echo $linha_us['ctf']; ?>" />
                                </div>
                        	</td>
                        	<td>
                        	    <label>Senha:<span style="color:red;font-size:11px !important; font-family: arial">(Digite uma nova senha, caso queira alterar)</label>
                        	    <div class="form-group input-group">
                        	    	<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                        	    	<input type="password" name="senha" class="form-control" placeholder="Digite a Senha" />
                        	    </div>
                        	</td>
                        </tr>
                        <tr>
                        	<td>
							<label>Nº de Sócio:</label>
                                <div class="form-group input-group">
                                	<span class="input-group-addon"><i class="fa fa-paperclip"  ></i></span>
                                	<input type="number" name="n_socio" class="form-control" required placeholder="Digite o Nº de Sócio" value="<?php echo $linha_us['numero_socio']; ?>" />
                                </div>
							</td>
                        	<td>
                        		<label>Confirmar senha:</label>
                        		<div class="form-group input-group">
                        			<span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                        			<input type="password" name="senhacof" class="form-control" placeholder="Confirme a Senha" />
                        		</div>
                        	</td>
                        </tr>
                        <tr>
                        	<td colspan="2">
                        		<input type="submit" class="btn" value="Atualizar Dados" class="btn btn-success " />
                        	</td>
                        </tr>
                    </table>
</form>

            </div>
            
            
		</div>
		
	</div>
     
    <!-- footer -->
    <div class="footer">
        <!-- container -->
        <div class="container">
            <?php include_once("rodape_anun.php"); ?>
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
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>