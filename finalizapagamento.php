<?php
    include("seguranca/seguranca.php");
    //protegePagina(2);
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
                $banner->campo      = 'id, imagem';
                $banner->parametro  = 'id DESC LIMIT 1';
                $banner->tabela     = 'arpag_banner';
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
                <h3>Imprima a ficha de Inscrições</h3>
            </div>
            <?php 
            //if ($idetapa = isset($_GET['m']) ? dcript($_GET['m'],'Erro id etapa, funcao ajax') : null){
            if ($idpagamento        = str_replace('-', '',isset($_GET['cod']) ? $_GET['cod'] : null)){
                $info               = $_GET['i'];
                $idetapa_passaro    = dcript(substr($info,0,strpos($info, '@')),'Erro na identificacao da inscricao');
                $cod_pagamento      = dcript(substr($info,strpos($info, '@') + 1),'Erro na identificacao do codigo de pagamento');
                $pagamento = new insercao(); 
                $pagamento->campo   =   'data_gerado, cod_pagseguro, status_transacao, valor,cod_pagamento';
                $pagamento->dados   =   "'".date('Y-m-d H:i:s')."','".$idpagamento."',1 ,'0.00',".$cod_pagamento;
                $pagamento->tabela  =   'arpag_pagamento';
                if($id_pagamento = insert_bd_return_id($pagamento)){ 
                    $pagamento_item = new insercao();
                                        $pagamento_item->campo  =   'id_pagamento,id_passaro_etapa';
                                        $pagamento_item->dados  =   $id_pagamento.",".$idetapa_passaro;
                                        $pagamento_item->tabela =   'arpag_pagamento_passaro_etapa';
                    if($pagamento_envia = insert_bd($pagamento_item)){

                        echo "<p class='alert-success'>Voc&ecirc; já pode Imprimir sua ficha de inscrição</p>"; 

                    }else echo "segunda ";
                }else echo "primeira ";

               // echo "<a class='btn btn-primary btn-success' href='imprime.php?kj=".cript($idetapa_passaro)."' target='blank'><span class='glyphicon glyphicon-print'></span>&nbsp;&nbsp;Imprimir inscri&ccedil;&atilde;o</a> ";
            }
                
                
            ?>
            <h3><a href="cad_inscricoes.php">Volta para tela de Inscrições</a></h3>
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