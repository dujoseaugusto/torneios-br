<?php
	include("seguranca/seguranca.php");
	require_once('php/class.php');
	require_once('bd_funcao/maysql.php');
	require_once('php/funcao_0.2.php');
	//require_once('adm_arpag/config.php');
	include_once('topo.php');
	error_reporting(0);
	$banner = '#000';
?>
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/lightbox.css">
<script src="js/jquery-1.11.1.min.js"> </script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script type="text/javascript">
	//Scrool
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});

	//Dialog (Recuperar Senha)
	$(function() {
		$("#dialog").dialog({
				autoOpen: false,
				show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#opener" ).click(function() {
			$("#dialog").dialog("open");
		});

	});

	$(".recupera").dialog("option", "width", 650);

</script>

</head>
<body>
<table style="width: 100%; margin-top: 1%;">
    <tr><td><?php include_once("menu.php"); ?></td></tr>  
    <tr><td><?php include_once("banner_topo.php"); ?></td></tr>
    <tr><td><?php include("novo_menu.php"); ?></td></tr>
</table>    

    <!-- notícias -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">
			<div class="gallery-info">
				    <div style="float:left; "> <a href="index.php?ex=3">Ver Todas Notícias</a>
				            <br /><br />
				            </div>

				            <?php

				            // execucao
				            $esc = $_GET['ex'];
				            switch ($esc) {
				                case 1:{
				                    $idnot = dcript($_GET['d'],'Erro na identificacao da noticia');

				                   	$comercial = new consulta();
										$comercial->campo 		= 'data,autor,titulo,subti,texto,video,idgaleria,foto';
										$comercial->parametro	= "id = ".$idnot;
										$comercial->tabela		= 'arpag_noticia';
									$resultado = select_db($comercial);
									
				                    $lin = $resultado->fetch_array();
				                    ?>
				                    <div style="float:right; font-size:8px"> <?php echo utf8_encode($lin['autor'])."-".dtahoraela($lin['data']);?> <br /></div>
	                                  <h3><?php echo utf8_encode($lin['titulo'])?></h3> 
	                                 <p style="font-size:12px;font-weight:normal"><?php echo utf8_encode($lin['subti']);?> </p>
				                    <span><img src="adm_arpag/fotonoticia/<?php echo $lin['foto'];?>" width="380" alt="<?php echo utf8_encode($lin['titulo'])?>" title="<?php echo utf8_encode($lin['titulo'])?>" /><?php echo utf8_encode($lin['texto'])?>
				                   <?php
				                        //include ("galeria.php");

				                    /*
				                    echo  "<br />Veja tamb&eacute;m:<br /><br />";
				                        if ($lin[7] != "") {
				                            $sql = "SELECT id,titulo,data FROM noticia where idsetor = $lin[7] and id != $idnot order  by data desc";
				                        }else {
				                            $sql = "SELECT id,titulo,data FROM noticia where id != $idnot order  by data desc";
				                        }
				                        //echo $sql;
				                        $rs = mysql_query($sql);
				                        while ($li  = mysql_fetch_row($rs)) {
				                            $li[1]  = $li[1];
				                            $id     = cript($li[0]);
				                            $nd     = cript(date("ss"));
				                            echo    utf8_encode("<a href=\"noticia.php?d=$id&u=$nd&ex=1\" title=\"$lin[1]\">$li[1]</a><br />");
				                        }
											*/
				                }
				                    break;
				                case 2:{
				                    $busca = utf8_decode($_POST["busca"]);
				                        $bs = 1;
				                        echo "<p>Not&iacute;cias encontradas:</p><br />";
				                        $sql    = "SELECT * FROM noticia where titulo like \"%$busca%\" order by data desc";
				                        $rs = mysql_query($sql);
				                        echo "<ul>";
				                        while ($lin = mysql_fetch_row($rs)) {
				                            $bs++;
				                            $id   = cript($lin[0]);
				                            $nd   = cript(date("ss"));
				                            $data = dtahoraela($lin[7]);
				                            echo utf8_encode("<li><a href=\"noticia.php?d=$id&u=$nd&ex=1\"><img src=\"fotonoticia/$lin[4]\" width=\"215\" /><br />$lin[1]<br />$data</a></li>");
				                        }
				                        echo "</ul>";
				                        if($bs==1)echo "<p><br /><br />N&atilde;o foi encontradas not&iacute;cias com \"$busca\", Tente Novamente</p><br />";
				                }
				                case 3:{
				                        $bs = 1;
				                        echo "<p>Not&iacute;cias encontradas:</p><br />";
				                        $noticia_l = new consulta();
											$noticia_l->campo 		= 'id,titulo,foto,texto,data';
											$noticia_l->parametro	= "data <= '".date("Y-m-d H:i:s")."' ORDER BY data DESC";
											$noticia_l->tabela		= 'arpag_noticia';
										$resultado = select_db($noticia_l);
										echo "<table class='table'>";
				                        while ($lin = $resultado->fetch_array()) {
				                            $bs++;  
				                            $nd   = cript(date("ss"));
				                            echo utf8_encode("	<tr>
				                            						<td>
					                            						<a href='index.php?d=".cript($lin['id'])."&u=".$nd."&ex=1'>
					                            						<img src='adm_arpag/fotonoticia/".$lin['foto']."' width='70'/>
					                            						</a>
					                            					</td>
					                            					<td>
					                            						<a href='index.php?d=".cript($lin['id'])."&u=".$nd."&ex=1'>".$lin['titulo']."</a>
					                            					</td>
					                            					<td>
					                            						<a href='index.php?d=".cript($lin['id'])."&u=".$nd."&ex=1'>".dtahoraela($lin['data'])."</a>
					                            					</td>
				                            					</tr>");

				                        }
				                        echo "</table>";
				                        if($bs==1)echo "<p><br /><br />N&atilde;o foi encontradas not&iacute;cias com \"$busca\", Tente Novamente</p><br />";
				                }
				                    break;
				                default: {
				                    $rs = mysql_query("SELECT * FROM noticia where data <= $dttt order by data desc limit 4");
				                    $noticia_l = new consulta();
										$noticia_l->campo 		= 'id,titulo,foto,texto';
										$noticia_l->parametro	= "data <= '".date("Y-m-d H:i:s")."' ORDER BY id DESC LIMIT 1";
										$noticia_l->tabela		= 'arpag_noticia';
									$resultado = select_db($noticia_l);
									?>
									<?php 
									/*while($rs = $resultado->fetch_array()){
										?>
										<li><a href="index.php?d=<?php echo cript($rs['id']); ?>&ex=1" ><img src="adm_arpag/fotonoticia/<?php echo $rs['foto'];?>" width="450", height="220"  alt="<?php echo utf8_encode($rs['titulo'])	; ?>" title="<?php echo utf8_encode($rs['titulo']); ?>"></a>
										</li>
										<li class="li"><?php echo utf8_encode(substr($rs['texto'], 0, 250)) ; ?><br /> <a href="index.php?d=<?php echo cript($rs['id']); ?>&ex=1">Saiba Mais</a>
										</li>
									
									<?php
									}*/
									$rs = $resultado->fetch_array();
										?>
										<a href="index.php?d=<?php echo cript($rs['id']); ?>&ex=1" ><img src="adm_arpag/fotonoticia/<?php echo $rs['foto'];?>" width="80% alt="<?php echo utf8_encode($rs['titulo'])	; ?>" title="<?php echo utf8_encode($rs['titulo']); ?>"></a>
										
										<?php echo utf8_encode(substr($rs['texto'], 0, 250)) ; ?><br /> <a href="index.php?d=<?php echo cript($rs['id']); ?>&ex=1">Saiba Mais</a>
									
				                    <!--<h3>Veja Tamb&eacute;m:</h3><br />
				                    <?php
				                }
				                break;
				            }

				            ?>
			           
                                  
			</div><!--info-->
		</div>
		<!-- //container -->
	</div>
	<!-- //notícias -->
    
    
    
        <!-- anunciantes -->
	<div id="anunciantes" class="gallery-top">
		<!-- container -->
		<div class="container">
			<div class="gallery-info">
				<h3>Parceiros</h3>
				<h5 class="caption">Veja alguns de nossos parceiros.</h5>                
                <?php
				include_once('comercial.php');
				?>                         
			</div><!--info-->
		</div>
		<!-- //container -->
	</div>
	<!-- //anunciantes -->
   </div>      
	<!-- footer -->
   <!-- footer -->
    <div class="footer">
        <!-- container -->
        <div class="container">
            <?php include_once("rodape_anun.php"); ?>
        </div>
        <!-- //container -->
    </div>
    <!-- //footer -->
    <script type="text/javascript">
                                    $(document).ready(function() {
                                        /*
                                        var defaults = {
                                            containerID: 'toTop', // fading element id
                                            containerHoverID: 'toTopHover', // fading element hover id
                                            scrollSpeed: 1200,
                                            easingType: 'linear' 
                                        };
                                        */
                                        
                                        $().UItoTop({ easingType: 'easeOutQuart' });
                                        
                                    });
                                </script>
                                    <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
    <!-- content-Get-in-touch -->
    <script src="js/responsiveslides.min.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    

</body>
</html>