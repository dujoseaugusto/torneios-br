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

       <!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/fancy/jquery.fancybox.js"></script>
        <script type="text/javascript" src="js/fancy/helpers/jquery.fancybox-media.js?v=1.0.5"></script>
        <script type="text/javascript" src = "js/uploadify/jquery-1.4.2.min.js" > </script>
		<script type="text/javascript" src = "js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src = "js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script> 
        <link href="js/fancy/jquery.fancybox.css" rel="stylesheet" />
        <link href="css/main.css" rel="stylesheet" />-->
                <?php



                if (!$idba  = isset($_GET["d"]) ? dcript($_GET["d"],'Erro na identificacao da galeria') : NULL){
                    echo   "<h3>Excluir fotos galeria</h3> <br />";
                

                     $listagaleria   = new consulta();
                                $listagaleria->campo        = 'id, nome';
                                $listagaleria->tabela       = 'arpag_galeria';
                                $listagaleria->parametro    = 'id DESC';
                    $listexect = select_db_2($listagaleria);

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
                                                <th width="20%"></th>
                                                <th>T&iacute;tulo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        while ($lin = $listexect->fetch_array()) {
                                          ?><tr class="odd gradeX">
                                              <td><a href="exfoto.php?d=<?php echo cript($lin['id'])?>&in=1&fi=12&&ll=0" class="botao">Ver Galeria</a></td>
                                              <td><?php echo  utf8_encode($lin['nome']);?> </td>
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
                }else{
                    
                    echo    "<h3>Galeria: ".utf8_encode(retorna_nome($idba ,'arpag_galeria'))." </h3> <br />";
                    echo    "<p align='center'><a href='exfoto.php?d=".cript($idba)."&in=1&fi=12&&ll=0' class='botao'>voltar</a><p>";

                    $aparec = NULL;
                    $in     = $_GET["in"];
                    $fi     = $_GET["fi"];
                    $dn     = opendir("galeria/".$idba);
                    $con    = 1;
                    $numero = 1;

                    if ($idex = isset($_GET['e'])?trocanome($_GET["e"]):NULL){
                        unlink ("galeria/".$idba."/".$idex);
                    }
                    echo    "<table width='100%' border='0'> ";
                    
                	while   ($file = readdir ($dn)) {
                        $nomm  = utf8_encode(substr($file, 0, 30));
                        
                        if     ($con <= $fi && $con >= $in){
                            if     (($file != ".") && ($file != "..") && ($file != "Thumbs.db")){
                                $del      = $file;
                                $conteudo = "<td width='180' height='180'><img src='galeria/".$idba."/".$file."' width='150' height='100' /><br />
                                           <span class='datta'>".$nomm."</span><br /><a href='exfoto.php?d=".cript($idba)."&in=1&fi=12&ll=0&e=".$del."' class='btn btn-primary btn-danger'>Excluir</a> </td>";
                                
                				if     ($numero <= 2){
                                    echo $conteudo;
                                    $numero += 1;
                                }
                				
                				else {
                                    echo $conteudo."</tr><tr>";
                                    $numero = 1;
                                }
                            }
                        }
                		
                		
                        $con += 1;
                        if ($con > $fi) {
                            $in     += 12;
                            $fi     += 12;
                            $aparec  = 1;
                            break;
                        }
                    }
                    closedir($dn);
                    echo "</tr></table>";
                    if ($aparec == 1 ){
                        $ll =$_GET["ll"];
                        $ll += 1;
                        echo "<p align='center'><a href='exfoto.php?d=".cript($idba)."&in=$in&fi=$fi&ll=$ll'>Proximo</a></p>";
                        if ($ll >= 2){
                            $in -= 24;
                            $fi -= 24;
                            $ll -= 2;
                            echo "<p align='center'><a href='exfoto.php?d=".cript($idba)."&in=$in&fi=$fi&ll=$ll'>Anterior</a></p>";
                        }
                    }
                ?>
                <?php
                }
                ?>
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
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