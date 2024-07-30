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
            <div id="page-in">
<?php
	require_once('menu.php');

	

?>

      <form name="clero" method="post" action="img-action.php" enctype="multipart/form-data"> 
          <div class="form-group"> 
            <label for="exampleInputEmail1">Nome</label> 
              <input type="text" name="nome_galeria" class="form-control" id="exampleInputEmail1" placeholder="Nome"> 
          </div> 

          <div class="form-group"> 
            <label for="exampleInputPassword1">Data</label> 
              <input type="date" name="data" class="form-control" id="exampleInputPassword1" placeholder="Data">
          </div>

          <div class="clearfix"></div>

          <div class="form-group"> 
            <label for="exampleInputFile">Fotos</label>
              <input type="file" name="file[]" id="exampleInputFile" required multiple> 
          </div> 


          <button type="submit" class="btn btn-default">Cadastrar</button> 
      </form> 

      <br /><br />

      <h3>Cadastros realizados</h3>
            <table id="table" class="table-hover font-table">
                <thead style="text-align:center !important;">
                  <tr>
                  <th style="text-align:left !important; width: 35em;">Galeria</th>
                  <th style="text-align:left !important; width: 8em;">Data</th>
                  <th style="text-align:center !important; width: 4em;">Enviar Fotos</th>
                  <th style="text-align:center !important; width: 4em;">Excluir</th>
                  </tr>
                </thead>
                
                <tbody>
                  
                  <?php 

                  require_once("conexao.php");

                    $sql    = "SELECT * FROM arpag_fotos ORDER BY id DESC";
                    $resultado  = $conn->query($sql);

                    if($resultado->num_rows > 0){
                      while ($exibe = $resultado->fetch_assoc()){
                        echo utf8_encode("
                          <tr>
                          <td style=\"text-align:left !important; width: 35em;\">".$exibe['nome']."</td>  
                          <td style=\"text-align:left !important; width: 8em;\">".date("d/m/Y", strtotime($exibe['data']))."</td>                                       
                          
                          <td style=\"text-align:center !important; width: 8em;\"><a href=\"envia_fotos.php?id=".$exibe['id']."&nome_pasta=".$exibe['nome_pasta']."\"><i class=\"fa fa-paper-plane\"></i></a></td>

                          <td style=\"text-align:center !important; width: 6em;\"><a href=\"excluirGaleria.php?id=".$exibe['id']."&t=2&i=".$exibe['nome_pasta']."\"><i class=\"fa fa-eraser\"></i></a></td>
                        </tr>
                        ");
                      }
                    }
                    
                    $conn->close();

                    
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

