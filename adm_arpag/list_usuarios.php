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
           
            <h3>Usuários:</h3>

                    <?php
    $pessoa_busca = null;
    if ($idpessoa = (isset($_GET['hjd'])) ? dcript($_GET['hjd'],'identificacao da pessoa') : NULL){
        $altera = new atualiza();
                    $altera->campo      = "senha =  '40bd001563085fc35165329ea1ff5c5ecbdbbeef'";
                    $altera->parametro  = "id = ".$idpessoa;
                    $altera->tabela     = 'arpag_pessoa';
        if (update_bd($altera)) echo "nova senha";
        $pessoa_busca = $idpessoa;             
    }

    if ($idpessoa = (isset($_GET['erdf'])) ? dcript($_GET['erdf'],'identificacao da pessoa para bloqueio') : NULL){
        $altera = new atualiza();
                    $altera->campo      = "ativo =  '0'";
                    $altera->parametro  = "id = ".$idpessoa;
                    $altera->tabela     = 'arpag_pessoa';
        if (update_bd($altera)) echo "nova senha";
        $pessoa_busca = $idpessoa;     
    }

    if ($idpessoa = (isset($_GET['esdd'])) ? dcript($_GET['esdd'],'identificacao da pessoa para desbloqueio') : NULL){
        $altera = new atualiza();
                    $altera->campo      = "ativo =  '1'";
                    $altera->parametro  = "id = ".$idpessoa;
                    $altera->tabela     = 'arpag_pessoa';
        if (update_bd($altera)) echo "nova senha";
        $pessoa_busca = $idpessoa;     
    }

    
?>

<style type="text/css">
    body{margin:0; padding:0;}
    table{font-family:Arial, Helvetica, sans-serif; font-size:12px;}
</style>
<script>
    function lista(){ 
        $('#load').html("<img src='../images/loading.gif' style='width: 200px;'>");
        var url = 'funcao_ajax.php?fun=11';
        var a = $("input[name=nome]").val();
        if (a.length > 3){
            $.post(url, {nome: a, }, function(dataReturn) {
               $('#load').html(dataReturn);
            });
        }else{
            $('#load').html(''); 
        }      
    }

    function apagar(m,n){
        
        $('#load'+m).html("<img src='../images/loading.gif' style='width: 99px;'>");
        var url = 'funcao_ajax.php?fun=12&mn='+n;
        
        //data      : 'nome='+ $('#campo1').val();            
        $.get(url, function(dataReturn) {
            $('#load'+m).html(dataReturn);
        });
    }
</script>

        <label>Buscar Nome:</label>        
        <input type="text" name="nome" placeholder="Mínimo de 3 Caracter" value='<?php 
        if ($pessoa_busca){
            echo retorna_nome($pessoa_busca,'arpag_pessoa');
        }
        ?>' onkeyup="lista();" />
        <!---<button class='btn btn-primary' onclick="lista()">Buscar</button>-->
    
    <div id="load"></div>

               
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
    <script type="text/javascript">
        lista();
    </script>>
   
</body>
</html>
