<?php
include("../seguranca/seguranca.php");
protegePagina(1);
require_once('../php/class.php');
require_once('../bd_funcao/maysql.php');
require_once('../php/funcao_0.2.php');
include_once('topo.php');
?>

<body>
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
<!--
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="../css/geral.css" type="text/css" />
<link rel="stylesheet" href="../css/jquery_ui.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery_ui.js"></script>
<script type="text/javascript" src="../js/maskedinput.js"></script>
<script type="text/javascript" src="../js/cidades_estados.js"></script>
<script type="text/javascript" src="../js/money.js"></script>
<script type="text/javascript" src="../js/funcoes.js" charset="utf-8"></script>-->


<script src="../js/scripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script>
function validaForm(){


var d = document.form1;

 if (d.hora.value == ""){
    alert("O campo \"Horário\" deve ser preenchido!");
    d.hora.focus();
    return false;
 }
 if (d.data.value == ""){
    alert("O campo \"Data\" deve ser preenchido!");
    d.data.focus();
    return false;
 }
 if (d.titulo.value == ""){
    alert("O campo \"Título\" deve ser preenchido!");
    d.titulo.focus();
    return false;
 }

 if (d.subtitulo.value == ""){
    alert("O campo \"subtitulo\" deve ser preenchido!");
    d.subtitulo.focus();
    return false;
 }
 if (d.autor.value == ""){
    alert("O campo \"Autor\" deve ser preenchido!");
    d.autor.focus();
    return false;
 }



if (d.data.value == ""){  alert ("O campo " + d.data.name + " deve ser preenchido!"); return false }
var er = /^(([0-2]\d|[3][0-1])\/([0]\d|[1][0-2])\/[1-2][0-9]\d{2})$/;
var b=document.getElementById("data").value;

if(b!=""){
if(er.test(b)){

var dia = b.substring(0,2);
var mes = b.substring(3,5);
var ano = b.substring(6,10);

  if(ano < 1940)
  {
    alert("Erro no ano especificado ");
    //document.getElementById(Ncampo).style.background="red";
         d.data.focus();
        return false;
  }

    if((mes==04 || mes==06 || mes==09 || mes==11) && (dia > 30)){

      alert("O mês especificado contém no máximo 30 dias");
            d.data.focus();
             return false;
    } else
    {
    if(ano%4!=0 && mes==02 && dia>28){

      alert("Data incorreta!! O mês especificado contém no máximo 28 dias.");
           d.data.focus();
             return false;
    } else{
    if(ano%4==0 && mes==02 && dia>29){
     d.data.focus();
         return false;
    }}}} else {

      alert("Erro no formato de data");

      document.getElementById("data").focus();
              return false;
    }
    }

         if (d.descricao.value == ""){
                    alert("O campo \"Palavras Chaves\" deve ser preenchido!");
                     d.descricao.focus();
                     return false;
                  }
var h=document.getElementById("hora").value;
if (d.hora.value == ""){  alert ("O campo " + d.hora.name + " deve ser preenchido!"); return false }

if(h!=""){

var hor = h.substring(0,2);
var min = h.substring(3,5);
var seg = h.substring(6,8);

if (hor > 24){ alert ("hora incorreta"); return false;}
if (min > 60){ alert ("minutos incorretos"); return false;}
if (seg > 60){ alert ("segundos incorretos"); return false;}

}




    return true;
}


 function formata(vv){
 var campo = vv;
        if (campo == "data"){
              if(document.getElementById(campo).value.length==2)
    {
      var str = document.getElementById(campo).value.substring(0,2);
      pt1=document.getElementById(campo).value = str+"/";
    }
       if(document.getElementById(campo).value.length==5)
        {
          var str2 = document.getElementById(campo).value.substring(3,5);
          pt2=document.getElementById(campo).value = pt1+str2+"/";
        }
        }
      if (campo == "hora"){
          if(document.getElementById(campo).value.length==2)
        {
      var str = document.getElementById(campo).value.substring(0,2);
      pt1=document.getElementById(campo).value = str+":";
       }
      if(document.getElementById(campo).value.length==5)
        {
      var str2 = document.getElementById(campo).value.substring(3,5);
      pt2=document.getElementById(campo).value = pt1+str2+":";
    }
      }
    }


</script>


<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="conteudoHomeAdmin">

    <div id="TopoAdm">

    </div><!-- TopoAdm -->

  <div id="bannerAdm">
      <img src="../img/banner_adm.jpg" width="1061" height="213" alt="" title="" />
    </div><!-- bannerAdm -->
    
    <div class="clear"></div>
    
    
  <?php include("menu.php"); ?>
    
    <div class="clear"></div>
    
    <div class="espacamento2"></div>

    <div id="CadastraNoticias">
        <?php include("MenuNoticia.php") ?>
        <br />
<?php

if ($titulo  = isset($_POST['titulo']) ? trocanome($_POST["titulo"]) : NULL){
  // Prepara a varivel do arquivo
  $erro = $config = array();
  $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
  $foto       = $_POST["foto"];
  $sub        = $_POST["subtitulo"];
  $autor      = $_POST["autor"];
  $texto      = $_POST["postContent_2"];
  $id         = $_POST["id"];
  $secretaria = $_POST["secretaria"];
  $galeria    = $_POST["galeria"];
  $video      = $_POST["video"];
  $data       = $_POST["data"];
  $hora       = $_POST["hora"];
  $data       = dtafor($data);
  $h          = substr($hora,0,2);
  $m          = substr($hora,3,2);
  $dat        = $data . $h . $m . "00";
  $iduss      =  $_SESSION['usuarioID'];
  if($arquivo["name"]!= "")
  {
    // Verifica se o mime-type do arquivo  de imagem
    if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"])){
        echo utf8_encode("<script>alert (\"Arquivo em formato invlido! O qrquivo deve ser em
                          jpg, jpeg, bmp, gif ou png. Cadastro No Foi Realizado\");</script>");
    }
    else{
        // Pega extenso do arquivo
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);
        $datim          = date("d_m_y_H_i_s");
        $imagem_nome    = $datim . "." . $ext[1];
        $imagem_dir     = "../../fotonoticia/" . $imagem_nome;
        $up             = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
        if ($up){
            unlink("../../fotonoticia/$foto");
            $sql = utf8_decode("update noticia set titulo = '$titulo', autor = '$autor',
                    texto = '$texto', foto = '$imagem_nome', subti = '$sub',
                    data = '$dat', idus = '$iduss',  idgaleria = $galeria, video = $video, idsetor = $secretaria
                    where id = $id");
          $rss = mysql_query($sql);
            if ($rss){
                echo utf8_decode("<script>alert (\"Alteracao efetuado com sucesso !!!!\");
                      window.location.assign(\"AlterarNoticia.php\");
                      </script>");
            }else echo mysql_error();
        }else echo "<script>alert (\"Erro no Upload\");</script>";
    }
  }
  else{
        $sql = utf8_decode("update noticia set titulo = '$titulo', autor = '$autor',
                texto = '$texto', subti = '$sub', video = '$video',
                data = '$dat', idus = $iduss, idgaleria = $galeria, video = $video, idsetor = $secretaria
                where id = $id");
        $rss = mysql_query($sql);
        if ($rss){
            echo utf8_decode("<script>alert (\"Alteracao foi efetuado com sucesso !!!!\");
                              window.location.assign(\"AlterarNoticia.php\");  </script>");
        }else echo mysql_error();
  }

}else $idba = $_GET["d"];
?>
<h3>ALTERA NOT&Iacute;CIAS</h3> <br />
<?php

$busca  = $_GET["busca"];
$busca2 = $_GET["busca2"];

$busca  = dtafor($busca);
$busca2 = dtafor($busca2);

$busca  = $busca . "000000";
$busca2 = $busca2 . "000000";

if ($idba == ""){
    $sql    ="select id,titulo,data from noticia where data > $busca and data < $busca2  order by id desc";
    $rs     = mysql_query($sql);
    while ($lin = mysql_fetch_row($rs)) {
        echo "<p><a href=\"anoticia.php?d=$lin[0]\">Alterar</a> $lin[1] || $lin[2] </p>";
    }
}else{
    $sql    ="select id,titulo,autor,texto,foto,subti,video,idsetor,idgaleria,data from noticia where id = $idba";
    $rs     = mysql_query($sql);
    $lin    = mysql_fetch_row($rs);
    $lin[9] = str_replace("-","",$lin[9]);
    $ddd    = dtahoraela($lin[9]);
    $datt   = substr($ddd,0,10);
    $horr   = substr($ddd,12,9);
    
?>

<div id="tudo" />
<form id="form1" name="form1" method="post" action="AlterarNoticia2.php" enctype="multipart/form-data" onSubmit="return validaForm()">

  <label>Categoria:</label><br />
    <select name="secretaria" id="secretaria">
<?php
     $sql   = "select id,setor from setorunimed where id = $lin[7] ";
   $sr    = mysql_query($sql);
     while ($l = mysql_fetch_row($sr)){
        echo utf8_encode("<option value=\"$l[0]\">$l[1]</option>");
     }
     $sql   = "select id,setor from setorunimed where id != $lin[7] order by setor";
   $sr    = mysql_query($sql);
     while ($li = mysql_fetch_row($sr)){
        echo "<option value=\"$li[0]\">$li[1]</option>";
     }
?>
      </select>
      <br />
    <label>Hora:</label><br />
    <input name="hora" type="text" id="hora" size="15" maxlength="8" onkeyup="formata('hora');" value="<?php echo $horr;?>" />
    <br /><br />
    <label>Data:</label><br />
    <input name="data" type="text" id="data" size="15" maxlength="10" class="data calendario" onkeyup="formata('data');" value="<?php echo $datt;?>" />
    <br /><br />
    <label>Titulo:</label><br />
    <input type="hidden" name="id" id="id" value="<?php echo $lin[0];?>">
    <input name="titulo" type="text" id="titulo" size="65" maxlength="120" value="<?php echo utf8_encode("$lin[1]"); ?>" />
    <br /><br />
    <label>Subtítulo:</label><br />
    <input name="subtitulo" type="text" id="subtitulo" size="65" maxlength ="500" value="<?php echo utf8_encode("$lin[5]"); ?>" />
    <br /><br />
    <label>Autor:</label><br />
    <input name="autor" type="text" id="autor" size="45" maxlength ="60" value="<?php echo utf8_encode($lin[2]); ?>" />
    <br /><br />
    Editar Notcia:<br />
    <!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->

        <!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
        <script type="text/javascript">
// BeginOAWidget_Instance_2204022: #postContent_2

  tinyMCE.init({
    // General options
    mode : "exact",
    elements : "postContent_2",
    theme : "advanced",
    skin : "default",
    plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,print,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,image,media,|,forecolor,backcolor,|,insertdate,inserttime,",
    theme_advanced_buttons3 : "hr,cite,abbr,acronym,del,ins,sub,sup,visualchars,nonbreaking,charmap,emotions,ltr,rtl,|,code,preview,fullscreen,help,cleanup,removeformat,|,styleprops,attribs,",
    theme_advanced_buttons4 : "tablecontrols,visualaid,|,insertlayer,moveforward,movebackward,absolute,visualaid,|,template,pagebreak,restoredraft,",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    // Example content CSS (should be your site CSS)
    content_css : "/css/editor_styles.css",

    // Drop lists for link/image/media/template dialogs, You shouldn't need to touch this
    template_external_list_url : "/lists/template_list.js",
    external_link_list_url : "/lists/link_list.js",
    external_image_list_url : "/lists/image_list.js",
    media_external_list_url : "/lists/media_list.js",

    // Style formats: You must add here all the inline styles and css classes exposed to the end user in the styles menus
    style_formats : [
      {title : 'Bold text', inline : 'b'},
      {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
      {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
      {title : 'Example 1', inline : 'span', classes : 'example1'},
      {title : 'Example 2', inline : 'span', classes : 'example2'},
      {title : 'Table styles'},
      {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ]
  });

// EndOAWidget_Instance_2204022
        </script>
        <!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
        <textarea id="postContent_2" name="postContent_2" rows="15" style="width:80%"><?php echo utf8_encode($lin[3]); ?></textarea>

   <br /><br />
   <label>Galeria:</label><br />
   <select name="galeria" id="galeria">
    <?php
    if ($lin[8] == null){
        echo "<option value=\"null\"></option>";
        $sql = "select id,nome from galeria order by nome";
    $sr = mysql_query($sql);
        while ($l = mysql_fetch_row($sr)){
            echo "<option value=\"$l[0]\">$l[1]</option>";
        }
        }
        else{
        $sql = "select id,nome from galeria where id = $lin[8] ";
        $sr = mysql_query($sql);
            while ($l = mysql_fetch_row($sr)){
                echo "<option value=\"$l[0]\">$l[1]</option>";
                echo "<option value=\"null\"></option>";
        }
        $sql = "select id,nome from galeria where id != $lin[8] order by nome";
    $sr = mysql_query($sql);
        while ($li = mysql_fetch_row($sr)){
            echo "<option value=\"$li[0]\">$li[1]</option>";
        }
        }
    ?>
      </select>

   <br /><br />

   <label>V&iacute;deo:</label><br />
      <select name="video" id="video">
          <?php
      echo $lin[6];
      if ($lin[6] == null){          
            echo utf8_decode("<option value=\"null\"></option>");
            $sql = "select * from video order by titulo";
            echo $sql;
        $sr = mysql_query($sql);
          while ($l = mysql_fetch_row($sr)){
            echo utf8_encode("<option value=\"$l[0]\">$l[1]</option>");
          }
          }
          else{
            $sql = "select * from video where id = $lin[6] ";

        $sr = mysql_query($sql);
            while ($l = mysql_fetch_row($sr)){
                echo utf8_encode("<option value=\"$l[0]\">$l[4]</option>");
                echo "<option value=\"null\"></option>";
            }
            $sql = "select * from video where id != $lin[6] order by titulo";
        $sr = mysql_query($sql);
            while ($li = mysql_fetch_row($sr)){
            echo utf8_encode("<option value=\"$li[0]\">$li[1]</option>");
            }
            }


      ?>
        </select>

      <br /><br />
   <label>Foto:</label><br />
   <input type="hidden" name="foto" id="foto" size="40" value="<?php echo $lin[4]; ?>" />
   <input type="file" name="arquivo" id="arquivo" />
   <br /> <br />
   <input type="submit" name="Submit" id="button" class="botao" value="Alterar" />

</form>
 <?php } ?>
<br />
<br />
<br />

    </div>
  </div>

    <div class="clear"></div>

    <div id="FraseAdm"></div>
    
    <div class="clear"></div>
    
    <?php include("../rodape.php"); ?>

</div><!-- conteudoHomeAdmin -->

</body>   
</html>