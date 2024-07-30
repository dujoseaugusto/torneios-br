<?php
    include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
    require_once('../php/funcao_0.2.php');
    
    //include_once('topo.php');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
</head>

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

function pago(m,n){
	$('#carrega'+n).html("<img src='../images/loading.gif'>");
	var url = 'funcao_ajax.php?fun=13&m='+m;
	$.get(url, function(dataReturn) {
	 $('#carrega'+n).html(dataReturn);
	});
	//alert  ('#carrega'+n);
}
</script>
<?php
include_once('menu.php');

if($id_pessoa = (isset($_GET['mjf'])) ? dcript($_GET["mjf"],'Erro no identificacao da inscricao') : null){
	

	$consulta = new consulta();
				$consulta->campo	= 'a.id, f.nome AS nomepessoa, a.status_transacao, a.cod_pagamento, e.nome AS nomepassaro, g.nome AS nomeetapa, i.nome AS nometemporada, a.valor AS valorpago, h.valor AS valorinsc, c.id AS idinsc';
				$consulta->tabela	= "arpag_pagamento AS a
										INNER JOIN arpag_pagamento_passaro_etapa 	AS b ON b.id_pagamento 	= a.id
										INNER JOIN arpag_passaro_etapa 				AS c ON c.id 			= b.id_passaro_etapa 
										INNER JOIN arpag_passaro 					AS e ON e.id 			= c.id_passaro
	                                    INNER JOIN arpag_pessoa 					AS f ON f.id 			= c.id_pessoa
	                                    INNER JOIN arpag_etapa 						AS g ON g.id 			= c.id_etapa
	                                    INNER JOIN arpag_temporada 					AS i ON i.id 			= g.id_temporada
	                                    INNER JOIN arpag_valor_inscricao_etapa		AS h ON (h.id_etapa = g.id AND h.id_modalidade = e.id_modalidade)";
				$consulta->parametro= "i.fechada <> 2 AND f.id = ".$id_pessoa."   
										ORDER BY a.status_transacao";
	$executa = select_db($consulta);
?>
  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">

						<div class="panel-heading">
                             <?php
                                //Colocar o nome da pessoa verificada 
                             	//echo utf8_encode(retorna_nome($id,'arpag_pessoa'));
                             ?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                     <tr>
                                        <th>Status</th>
                                        <th>Func</th>
                                        <th>Proprietário</th>
                                        <th>Passaro</th>
                                        <th>Etapa</th>
                                        <th>temporada</th>
                                        <th>Valor</th>
                                        <th>valor Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
	$cont = 1;
	$pag = null;
	while($linha = $executa->fetch_array()){
		echo
		"<tr class='odd gradeX'>
		 <td class='center'><img src='../images/".retorna_imagem($linha['status_transacao'],'arpag_status_pagseguro')."' width='20' title='".retorna_nome($linha['status_transacao'],'arpag_status_pagseguro')."' /></td>

        <td class='center'><div id='carrega".$linha['cod_pagamento']."'>
        <!--<a class='btn btn-danger btn-sm' onclick=\"cancela('".cript($linha['idinsc'])."','".$cont."')\">Cancelar</a>-->";
		if ($linha['status_transacao'] == 0) echo "<a class='btn btn-warning btn-sm' href='../pagamento2.php?kj=".cript($linha['id'])."' target='_blank'>Ger. Pagamento</a><br /><br />";
		if ($linha['status_transacao'] < 3 ) echo "<a class='btn btn-success btn-sm' onclick=\"pago('".cript($linha['id'])."','".$linha['cod_pagamento']."')\">Lib. Pagamento Nº ".$linha['cod_pagamento']." </a>";
		else echo  "Pagamento Nº ".$linha['cod_pagamento'];
		echo "</div></td>
        <td class='center'>".$linha['nomepessoa']."</td>
       	 <td class='center'>".utf8_encode($linha['nomepassaro'])."</td>
        <td class='center'>".utf8_encode($linha['nomeetapa'])."</td>
        <td class='center'>".utf8_encode($linha['nometemporada'])."</td>
        <td class='center'>R\$ ".$linha['valorinsc']."</td>
        <td class='center'>R\$ ".$linha['valorpago']."</td>
    </tr>";
    $cont++;
	}
}
	
?>
       
                                       
                                    
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

               
        </div>
             <!-- /. PAGE INNER  -->
    </div>    
<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
