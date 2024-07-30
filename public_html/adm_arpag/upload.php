<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    include_once('topo.php');
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
           

            <style type="text/css">
                body{margin:0; padding:0;}
                table{font-family:Arial, Helvetica, sans-serif; font-size:12px;}
            </style>
            <script>
                function lista(){ 
                    $('#load').html("<img src='../images/loading.gif' style='width: 200px;'>");
                    var url = 'funcao_ajax.php?fun=11';
                    var a = $("input[name=nome]").val();
                    $.post(url, {nome: a, }, function(dataReturn) {
                        $('#load').html(dataReturn);
                    });
                }

               
            </script>
                    <?php
                    if($arquivo = isset($_FILES["doc"]) ? $_FILES["doc"] : NULL){
                      $desc = isset($_POST["desc"]) ? trocanome($_POST["desc"]) : NULL;

                      if($arquivo)
                      {
                            unlink("farm/Documento.ret");
                            //unlink("farm/arquivo.ret");
                            $dd = "Documento";
                            $imagem_nome = substr_replace($arquivo["name"], $dd,0,strrpos($arquivo["name"], "."));
                           // preg_match("/\.([-.a-zA-Z]|[1-9]){1,10}/", $imagem_nome, $ext);
                            if(substr($imagem_nome, -3) == "ret"){
                                $imagem_dir = "farm/" . $imagem_nome;
                                // Faz o upload da imagem
                                $up = move_uploaded_file($arquivo["tmp_name"], $imagem_dir);
                                if ($up){
                                    require_once ('arquivo_farm.php');

                                }else echo "<script> alert (\"Erro no Upload\");</script> <br /><br />";
                            }else echo "<script> alert (\"Extensão não confere\");</script> <br /><br />";
                      }else echo "<script> alert (\"Erro no Arquivo Imagem\");</script><br /><br />";


                    }



                    ?>
                    <h3>Baixa de pagamento</h3> <br /><br />
                    <form id="form1" name="form1" method="post" action="upload.php" enctype="multipart/form-data" onSubmit="return validaForm()">
                        <!---<label>Nome:</label><br />
                      <input type="text"  name="nome" id="nome" />
                      <br />  <br />  -->

                      <label>Documento:</label><br />
                      <input type="file" name="doc" id="doc" />
                      <br />  <br />
                      <input type="hidden"  name="nome" id="nome"  value="123"/>
                      <input type="submit" name="Submit" id="button" value="Enviar Arquivo" />
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
