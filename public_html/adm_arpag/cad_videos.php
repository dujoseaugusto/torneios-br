<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');
      error_reporting(0);
?>

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

<script>
	function exclui(m){
        var url = 'funcao_ajax.php?fun=3&m='+m;
        $.get(url, function(dataReturn) {
         $('#load').html(dataReturn);
        });
      }
</script>


<?php
include_once('menu.php');

    if ($nome = isset($_POST["nome"]) ? trocanome($_POST["nome"]) : null){
        $link = substr(trocanome($_POST["desc"]),32,11);
        $insertcal  = new insercao();
                            $insertcal->campo   = 'titulo,codigo';
                            $insertcal->tabela  = 'arpag_video';
                            $insertcal->dados   = "'".$nome."','".$link."'";
        if (insert_bd($insertcal))echo  utf8_encode("<script> alert ('Seu cadastro foi efetuado com sucesso !!!!');window.location='cad_videos.php';</script> <br /><br />");
        
 	}
?>

<form id="form1" name="form1" method="post" action="cad_videos.php" enctype="multipart/form-data" onSubmit="return validaForm()">
  <br />
  <label>T&iacute;tulo:</label><br />
  <input type="text"  name="nome" id="nome" />
  <br />  <br />
  <label>URL (caminho):</label><br />
  <input type="text"  name="desc" id="desc" > (Colocar endereço completo do Youtube: http://www.youtube.com/...)
  <br />   <br />
  <input type="submit" name="Submit" id="button" value="Cadastrar" class="botao" />
</form>

<br /><br />

<h3>Vídeos cadastrados:</h3>
<table class='table'>
<?php
if(($ex = isset($_GET['e']) ? dcript($_GET['e'],'Erro de indentificacao para a exclusao') : NULL) == 1){
    $di         = dcript($_GET['d'],'Erro na identificacao da noticia');
    $deletar    = new exclui();
                $deletar->tabela    ='arpag_video';
                $deletar->parametro = "id = ".$di;
    if (delete_db($deletar)) echo utf8_encode("<script> alert ('Exclusao executada com sucesso');window.location='cad_videos.php';</script> ");
}
echo "<br />";
$listavideo  = new consulta();
                $listavideo->campo       = '*';
                $listavideo->tabela      = 'arpag_video';
                $listavideo->parametro   = 'id DESC';
$listexect = select_db_2($listavideo);
while ($li = $listexect->fetch_array()) {
    echo "<tr><td>
            <a href='cad_videos.php?d=".cript($li['id'])."&e=".cript(1)."'class='btn btn-danger'>Excluir</a>
             - ".utf8_encode($li[1])."<br /></td></tr>";
}    
?>
</table>
               
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
