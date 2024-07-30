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
 if (d.arquivo.value == ""){
    alert("O campo \"Foto\" deve ser preenchido!");
    d.arquivo.focus();
    return false;
 }


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





 function caracteres() {

var numero=document.getElementById("descricao").value.length;

if (numero == 200) {
    alert("limite de 200 caracter ");
}
if (numero > 200){
    var re = numero - 199;
    alert("Passou " + re + " caracter ");
}
document.form1.descricao.focus();

}
</script>



<?php


if ($titulo  = isset($_POST['titulo']) ? utf8_decode(trocanome($_POST["titulo"])) : NULL){

  $texto      = utf8_decode(trocanome($_POST["postContent_2"]));
  $id         = dcript($_POST["id"],'Erro na identificacao da noticia');

   $atualizanu  = new atualiza();
      $atualizanu->campo      = "texto = '".$texto."'";
      $atualizanu->tabela     = 'arpag_textosite';
      $atualizanu->parametro  = "id = ".$id;
      if (update_bd($atualizanu)){
        echo "<p class='alert-danger'>Roda-pé alterado com sucesso !!!!</p>";
      //exit;
    }else echo mysql_error();
}

  echo "<br /> <br />"

?>
<h3>Alterar Roda-P&eacute;</h3>
<br />
<?php
  $s_noticia = new consulta();
    $s_noticia->campo     = 'id,titulo, texto';
    $s_noticia->tabela    = 'arpag_textosite';
    $s_noticia->parametro = "id = '1'";
  $executa_not = select_db($s_noticia);

  $linha_not = $executa_not->fetch_array();
?>
      <form id="form1" name="form1" method="post" action="AlteraRodape.php" enctype="multipart/form-data" >
         

          <label>Título:</label><br />
          <input type="hidden" name="id" id="id" value="<?php echo cript($linha_not['id']);?>">
          <input name="titulo" type="text" id="titulo" value="<?php echo utf8_encode($linha_not['titulo']);?>" />

          <br />

          
          <label>Editar Rodapé:</label><br />
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

              </script>
          <textarea id="postContent_2" name="postContent_2" rows="15" style="width:80%">
            <?php echo utf8_encode($linha_not['texto']);?>
          </textarea>
       

            <br /><br />
            <input type="submit" name="Submit" id="button" value="Alterar" class="botao" />

      </form>
  
        
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
