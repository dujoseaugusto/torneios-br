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
   if (d.busca.value == ""){
       alert("O campo \"Digite parte do título\" deve ser preenchido!");
       d.busca.focus();
       return false;
   }
  return true;
}


 </script>



<?php
   $busca = isset($_REQUEST["busca"]) ? $_REQUEST["busca"] : NULL;
?>
<h3>ALTERAR NOTÍCIAS</h3><br />
<form  name="form1" id="form1" method="POST" action="AlterarNoticia.php" enctype="multipart/form-data" onSubmit="return validaForm()">

  Digite parte do título:<br />
  <input name="busca" type="text" id="busca"  size="15" maxlength="10" value="<?php echo  $busca;?>" />
  <br />   <br />
  <input type="submit" value="Buscar" class="botao" /></td>

</form>
  <br /><br />
<?php
 // Deleta Notícia
 $ex = isset($_GET["e"]) ? $_GET["e"] : NULL;
 if($ex == 1){
    $idn = dcript($_GET["d"],'Erro para excluir');
    $foto = $_GET["f"];

    $excluir_noticia  = new procid();
          $excluir_noticia->variavel  = "'".$idn."'";
          $excluir_noticia->nome      = 'arpag_p_exclui_noticio';
      if(exec_procidure2 ($excluir_noticia)) {unlink("fotonoticia/$foto"); echo "<p class='alert-danger'>Excluido</p>";}
      else{echo "Erro"; exit;}
  }

 //Faz a busca  de notícias de acordo com o testo digitado e imprime o link para exclusão.

 if($busca){
    $consulta     = new consulta();
                $consulta->campo  = 'id,titulo,data,foto';
                $consulta->tabela = "arpag_noticia";
                $consulta->parametro= "titulo like '%".$busca."%' order by id desc limit 20";
    $executa = select_db($consulta);

    ?>
      <div class="panel panel-default">
        <div class="panel-heading">
             Lista de Not&iacute;cias.
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>T&iacute;tulo</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    while ($lin = $executa->fetch_array()) {
                      ?><tr class="odd gradeX">
                          <td><a href="AlterarNoticia2.php?d=<?php echo cript($lin['id']);?>" class="botao">Alterar</a></td>
                          <td><a href="AlterarNoticia.php?d=<?php echo cript($lin['id']);?>&e=1&f=<?php echo $lin['foto'];?>&busca=<?php echo utf8_decode($busca);?>" class="botao">Excluir</a></td>
                          <td><?php echo  utf8_encode($lin['titulo']);?> </td>
                          <td><?php echo  dtahoraela($lin['data']);?> </td> 
                        </tr>
                    <?php
                    }
                    ?>
                       
                    </tbody>
                </table>
            </div>
            
        </div>
      </div>
      <?php
      }
      ?>


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
