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

<script type="text/javascript">
 
    function ExcluiFoto()
    {
      var confirmacao = confirm('Você deseja realmente excluir a foto?');
        if (confirmacao)
            return true;
        else
          return false;
    }
                        

</script>

<style type="text/css">
  
  .n1 {
  width: 30%;
  height: 140px;
  float: left;
  padding: 2 2px;
}

.n1 img{
  width: 180px;
  height: 100px;
  padding: 5 5px;
}
</style>

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
            <div id="page-in">
<?php
	require_once('menu.php');

	

?>

      <h3>Enviar fotos</h3>
 
                  
                  <?php 

                  require_once("conexao.php");



                  $id_galeria   = $_GET['id'];
                  $fi         = $_GET['fi'];
                  $nome_pasta = $_GET['nome_pasta'];

                  $sql    = "SELECT * FROM arpag_fotos WHERE id = $id_galeria";   
                  $resultado  = $conn->query($sql);    
                      
                    
                    if($resultado->num_rows > 0){
                                while ($exibe = $resultado->fetch_assoc()){                                                                  

                                    $fotos = opendir ("fgaleria/".$exibe['nome_pasta']."/");
                                    $cont = 0;
                                                                                                                                       
                          while ($file = readdir ($fotos)) {

                          
                              if (($file != ".") && ($file != "..") && ($file != "Thumbs.db") && ($file != "thumbnails") && ($file != "photothumb.db")){
                                   $array[$cont]= "<a href=\"fgaleria/".$idgaleria."/$file\" data-lightbox=\"roadtrip\">
                                    <img class=\"img-responsive\" src=\"fgaleria/".$exibe['nome_pasta']."/$file\" border=\"0\" alt=\"$no[0]\" style=\"widht:100px !important; height=\"100px !important;\"\" /></a> ";

                                      echo "
                                          
                                              <div class=\"n1\">
                                                <img class=\"col-md-3\" src=\"fgaleria/".$exibe['nome_pasta']."/$file\" alt=\"\" title=\"\" style=\"widht:100px !important; height=\"100px !important;\"\" /> 
                                              
                                              <div>
                                                <a href=\"excluir-foto.php?id=".$id_galeria."&nome_pasta=".$nome_pasta."&nome=$file\" Onclick='return ExcluiFoto();'>Excluir</a> 
                                              </div>
                                            </div>

                                      ";
                              
                                  $cont++;
                              }//if
                          }//while2

                          echo "        
                            <div class=\"clearfix\"></div>
                            <hr>
                            <h4>Enviar imagens para Galeria</h4><br>                    
                           <form enctype=\"multipart/form-data\" action=\"img-action-adicionar-foto.php\" method=\"post\" >
                                 <input type=\"hidden\" name=\"id_galeria\" value=".$exibe['id'].">
                                 <input type=\"hidden\" name=\"nome_pasta\" value=".$exibe['nome_pasta']." />
                                 <br />
                                 Imagens: <input type=\"file\" name=\"file[]\" id=\"file\" required multiple /> 
                                 <br />
                                 <input type=\"submit\" value=\"Enviar\" class=\"btn btn-success\" /><br>
                              </form>   
                          ";    

                            
                              }//while1

                          }//if inicio
                      

                ?>

                    
       
                  
                </tbody>
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

