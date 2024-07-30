<?php
include_once("seguranca/seguranca.php");
require_once('php/class.php');
require_once('bd_funcao/maysql.php');
require_once('php/funcao_0.2.php'); 
//require_once('adm_arpag/config.php');
include_once('topo.php');
error_reporting(0);
$banner = '#000';
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />  
<link href="lytebox/lytebox.css" type="text/css" media="screen" rel="stylesheet"/>
<script src="lytebox/lytebox.js" type="text/javascript" language="javascript"></script>
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
    
 <!-- Informações -->
    <div id="informacoes" class="banner-bottom">
        <!-- container -->
        <div class="container">
            <div class="banner-text">
<script>
function validaForm(){
var d = document.form1;
if (d.nome.value == ""){
    alert("O campo 'Digite seu Email ' deve ser preenchido!");
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
                        <p>Link de acesso: https://torneios.net.br/alteracaodesenha/NovaSenha.php?$outros \n </p>
                        C&oacute;digo: $novasenha <br><b>Data:</b> $data  <br>   <br />

                        </body> </html>";
                //$header = "MIME-Version: 1.0\n";
                $header .= "Content-type: text/html; charset=iso-8859-1\n";
                if (mail($emailpara, $titulo, $texto, $header)){
                    echo "<script>alert('Foi enviado para o e-mail ".$li['email'].", link e um código para ativação de sua nova senha');</script>";
                }else echo "<script>alert('Erro no enviada!');</script>";
            } else echo "<script>alert('Erro na base de dados. Os dados não foram encontrados!');</script>";
        }else echo "<script>alert('E-mail incorreto. Entre em contato pelo formulário do site.');</script>";
    }
?>

<form id="form1" name="form1" method="post" action="esenha.php" enctype="multipart/form-data" onSubmit="return validaForm()">
    <br />
    <label>Digite seu Email:</label><br>
    <input type="text" name="nome" id="input2" size="50" maxlength="50" /><br />
    <input type="submit" name="Submit" id="bt" value="Recuperar" />
    <p>Caso não saiba o email de cadastro, clique <a href="contato.php">aqui</a> para enviar uma mensagem ao administrador</p>
    

</form>
             </div>
            
        </div>
        <!-- //container -->
    </div>
    <!-- Informações -->
    
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