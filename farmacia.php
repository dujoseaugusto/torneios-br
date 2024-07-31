<?php
    include_once("seguranca/seguranca.php");
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
<link href="lytebox/lytebox.css" type="text/css" media="screen" rel="stylesheet"/>
<script src="lytebox/lytebox.js" type="text/javascript" language="javascript"></script>
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

    var xmlhttp = getXmlHttpRequest();
   
    function getXmlHttpRequest()
    {
       if (window.XMLHttpRequest)
       {
          return new XMLHttpRequest();
       }
       else if (window.ActiveXObject)
       {
          try
          {
             return new ActiveXObject("Msxml2.XMLHTTP");
          }
          catch (e)
          {
             try
             {
                return new ActiveXObject("Microsoft.XMLHTTP");
             }
             catch (e){}
          }
       }
    }

    function requisicao(_strNomePagina)
    {
          xmlhttp.open("GET", _strNomePagina, true);
          xmlhttp.setRequestHeader("Content-Type", "text/html; charset=iso-8859-1");
          xmlhttp.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
          xmlhttp.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
          xmlhttp.setRequestHeader("Pragma", "no-cache");
          xmlhttp.onreadystatechange = function()
          {
             if (xmlhttp.readyState==4)
             {
                document.getElementById('conteudo').innerHTML = xmlhttp.responseText;
             }
          }   
          xmlhttp.send(null);
    }
	
</script>	
	
</head>
<body>
	<table style="width: 100%; margin-top: 1%;">
	<tr><td><?php include_once("menu.php"); ?></td></tr>  
    <tr><td><?php include_once("banner_topo.php"); ?></td></tr>
    <tr><td><?php include("novo_menu.php"); ?></td></tr>
   	</table>      
	
	<!-- banner-bottom -->
	<div id="agenda" class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-text">
				<h3>Farmácia</h3>
				<h5 class="caption">Confira abaixo uma lista de medicamentos e suas informações.</h5>
			</div>
            <br /><br /><br />
            
            <div style="float:left; width:25%" id="nomes_medicamentos">
            	<a href="javascript:requisicao('farmacia/acariasma.php');">ACARIASMA (AviZoon)</a><br />
                <a href="javascript:requisicao('farmacia/allax.php');">ALLAX (Jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/aminomix.php');">AMINOMIX PET (vetnil)</a><br />
                <a href="javascript:requisicao('farmacia/aminopan.php');">AMINOPAN (LaviZoo)</a><br />    
                <a href="javascript:requisicao('farmacia/aminosol.php');">AMINOSOL (LaviZoo)</a><br /> 
                <a href="javascript:requisicao('farmacia/aminostress.php');">AMINOSTRESS (lavizoo)</a><br /> 
                <a href="javascript:requisicao('farmacia/arvovit.php');">AROVIT (roche)</a><br /> 
                <a href="javascript:requisicao('farmacia/avecox.php');">AVECOX (vansil)</a><br />
                <a href="javascript:requisicao('farmacia/avemetazina.php');">AVEMETAZINA (ucb)</a><br />
                <a href="javascript:requisicao('farmacia/aviarium.php');">AVIARIUM (lab. simões)</a><br />
                <a href="javascript:requisicao('farmacia/avitrim.php');">AVITRIM ANTIBIÓTICO (coveli)</a><br />
                <a href="javascript:requisicao('farmacia/avitrin_calcio.php');">AVITRIN CÁLCIO (coveli)</a><br />
                <a href="javascript:requisicao('farmacia/avitrin_complexo.php');">AVITRIN COMPLEXO VITAMÍNICO (coveli)</a><br />
                <a href="javascript:requisicao('farmacia/avitrin_e.php');">AVITRIN E</a><br />
                <a href="javascript:requisicao('farmacia/avitrin_ferro.php');">AVITRIN FERRO (coveli)</a><br />            
                <a href="javascript:requisicao('farmacia/avitrin_fermifugo.php');">AVITRIN VERMÍFUGO (coveli)</a><br />
                <a href="javascript:requisicao('farmacia/baicox.php');">BAYCOX (bayer)</a><br />
                <a href="javascript:requisicao('farmacia/baytril.php');">BAYTRIL (bayer)</a><br />
                <a href="javascript:requisicao('farmacia/biobird.php');">BIOBIRD (vansil)</a><br />
                <a href="javascript:requisicao('farmacia/biocid.php');">BIOCID (pfizer)</a><br />
                <a href="javascript:requisicao('farmacia/bolfo.php');">BOLFO (bayer)</a><br />
                <a href="javascript:requisicao('farmacia/calcivet.php');">CALCIVET (layinex pet)</a><br />
                <a href="javascript:requisicao('farmacia/canaril.php');">CANARIL (jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/cantolindo.php');">CANTOLINDO (Lab.Simões)</a><br />
                <a href="javascript:requisicao('farmacia/cantonico.php');">CANTÔNICO (Lab.Simões)</a><br />
                <a href="javascript:requisicao('farmacia/carnation.php');">CARNATION B12 (LaviZoo)</a><br />
                <a href="javascript:requisicao('farmacia/clavulin.php');">CLAVULIN 250g (beecham)</a><br />
                <a href="javascript:requisicao('farmacia/clusivol.php');">CLUSIVOL (whitehall)</a><br />
                <a href="javascript:requisicao('farmacia/coccinon.php');">COCCINON (ANGERCAL)</a><br />
                <a href="javascript:requisicao('farmacia/dolemil.php');">DOLEMIL (jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/enerbesol.php');">ENERBESOL (lavizoo)</a><br />
                <a href="javascript:requisicao('farmacia/enro_flec.php');">ENRO FLEC 10% (Vansil)</a><br />
                <a href="javascript:requisicao('farmacia/ferro_sm.php');">FERRO SM (Santa Marina)</a><br />
                <a href="javascript:requisicao('farmacia/ferti.php');">FERTI - VIT (Orlux)</a><br />
                <a href="javascript:requisicao('farmacia/fp.php');">FP 20/20 (Avizoon)</a><br />
                <a href="javascript:requisicao('farmacia/glicopan.php');">GLICOPAN (Vetnil)</a><br />
                <a href="javascript:requisicao('farmacia/glicosol.php');">GLICOSOL (Aviszoo)</a><br />
                <a href="javascript:requisicao('farmacia/gosmil.php');">GOSMIL (Jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/gritzoo.php');">Gritzoo (Lavzoo)</a><br />
                <a href="javascript:requisicao('farmacia/hemolitan.php');">HEMOLITAN (Vetnil)</a><br />
                <a href="javascript:requisicao('farmacia/hidovit.php');">HIDOVIT (Vetnil)</a><br />
                <a href="javascript:requisicao('farmacia/hidrapet.php');">HIDRAPET (Lavzoo)</a><br />
                <a href="javascript:requisicao('farmacia/iodave_sm.php');">IODAVE SM (Santa Marina)</a><br />
                <a href="javascript:requisicao('farmacia/iodepol.php');">IODEPOL (Laboratório Aché)</a><br />
                <a href="javascript:requisicao('farmacia/iodocal.php');">IODOCAL (Laboratório Simões)</a><br />
                <a href="javascript:requisicao('farmacia/ivomec.php');">IVOMEC POUR-ON (Merial)</a><br />
                <a href="javascript:requisicao('farmacia/kilol.php');">KILOL (Quinabra)</a><br />
                <a href="javascript:requisicao('farmacia/labcon_ferro.php');">LABCON CLUB FERRO (Labcon)</a><br />
                <a href="javascript:requisicao('farmacia/labcon_polivita.php');">LABCON CLUB POLIVITAMÍNICO (Labcon)</a><br />
                <a href="javascript:requisicao('farmacia/labcon_regulador.php');">LABCON CLUB REGULADOR INTESTINAL (Labcon)</a><br />
                <a href="javascript:requisicao('farmacia/labcon_revital.php');">LABCON CLUB REVITALIZANTE (Labcon)</a><br />
                <a href="javascript:requisicao('farmacia/labcon_vitil.php');">LABCON CLUB VITIL PS (Labcon)</a><br />
                <a href="javascript:requisicao('farmacia/lavi_fen.php');">LAVI - FEN (Lavizoo)</a><br />
                <a href="javascript:requisicao('farmacia/lavimed.php');">LAVIMED - SD (Lavizoo)</a><br />
                <a href="javascript:requisicao('farmacia/layinex.php');">LAYINEX PET (Quinabra)</a><br />
                <a href="javascript:requisicao('farmacia/licor_cacau.php');">LICOR DE CACAU XAVIER (Laboratório Simôes)</a><br />
                <a href="javascript:requisicao('farmacia/linco.php');">LINCO SPECTIN (Pfizer)</a><br />
                <a href="javascript:requisicao('farmacia/macromix.php');">MACROMIX (Amgercal)</a><br />
                <a href="javascript:requisicao('farmacia/mercepton.php');">MERCEPTON (Laboratório Bravet)</a><br />
                <a href="javascript:requisicao('farmacia/muta.php');">MUTA - VIT (ORLUX)</a><br />
                <a href="javascript:requisicao('farmacia/nalyt_baby.php');">NALYT - BABY (Amgecal)</a><br />
                <a href="javascript:requisicao('farmacia/nalyt_muda.php');">NALYT - MUDA (Amgercal)</a><br />
             	<a href="javascript:requisicao('farmacia/nalyt_plus.php');">NALYT - PLUS (Amgercal)</a><br />
                <a href="javascript:requisicao('farmacia/nalyt_reprod.php');">NALYT - REPRODUÇÃO (Amgercal)</a><br />
                <a href="javascript:requisicao('farmacia/neosulmetina.php');">NEOSULMETINA (Santa Marina)</a><br />
                <a href="javascript:requisicao('farmacia/norkil.php');">NORKIL (vetbrands)</a><br />
                <a href="javascript:requisicao('farmacia/omni.php');">OMNI - VIT (ORLUX)</a><br />
                <a href="javascript:requisicao('farmacia/orosol.php');">OROSOL (lavizoo)</a><br />
                <a href="javascript:requisicao('farmacia/pantelmin.php');">PANTELMIN (Cilag Farmacêutic)</a><br />            
                <a href="javascript:requisicao('farmacia/penaviar.php');">PENAVIAR (Jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/penavit.php');">PENAVIT PLUS (Jofadel)</a><br />
                <a href="javascript:requisicao('farmacia/petkol.php');">PETKOL (Quinabra)</a><br />
                <a href="javascript:requisicao('farmacia/piolhaves.php');">PIOLHAVES (Laboratório Simôes)</a><br />
                <a href="javascript:requisicao('farmacia/plumas.php');">PLUMAS KLEEN (PILTIK)</a><br />
                <a href="javascript:requisicao('farmacia/probi.php');">PROBI - ZYME (Orlux)</a><br />
                <a href="javascript:requisicao('farmacia/problac.php');">PROBLAC PLUS (Amgercal)</a><br />
                <a href="javascript:requisicao('farmacia/promotor_cria.php');">PROMOTOR CRIA EXTRA (Avizoo)</a><br />
                <a href="javascript:requisicao('farmacia/promotor_l.php');">PROMOTOR L (Avizoo)</a><br />
                <a href="javascript:requisicao('farmacia/protexin.php');">PROTEXIN (Avizoon))</a><br />
                <a href="javascript:requisicao('farmacia/protovit.php');">PROTOVIT PLUS (Roche)</a><br />
              	<a href="javascript:requisicao('farmacia/revectina.php');">REVECTINA</a><br />
                <a href="javascript:requisicao('farmacia/rovital.php');">ROVITAL C (Amgercal)</a><br />
                <a href="javascript:requisicao('farmacia/sp_verme.php');">S.P. VERME (Avizoon)</a><br />
                <a href="javascript:requisicao('farmacia/sulfaq.php');">SULFAQUINOXALINA (Vansil)</a><br />
                <a href="javascript:requisicao('farmacia/thuya.php');">THUYA (Laboratório Simôes)</a><br />
                <a href="javascript:requisicao('farmacia/transivit.php');">TRANSIVIT (Ravasi)</a><br />
                <a href="javascript:requisicao('farmacia/tylan.php');">TYLAN SOLÚVEL (Elanco)</a><br />
                <a href="javascript:requisicao('farmacia/tylotrat.php');">TYLOTRAT SM (Santa Marina)</a><br />
                <a href="javascript:requisicao('farmacia/vancid.php');">VANCID (Vansil)</a><br />
                <a href="javascript:requisicao('farmacia/vermiaves.php');">VERMIAVES (Laboratório Simões)</a><br />
                <a href="javascript:requisicao('farmacia/vitagold.php');">VITAGOLD (Tortuga)</a><br />
                <a href="javascript:requisicao('farmacia/vitalmax.php');">VITALMAX (Vansil)</a><br />
                <a href="javascript:requisicao('farmacia/vitamin.php');">VITAMIN E (Angercal)</a><br />
                <a href="javascript:requisicao('farmacia/vitazoon.php');">VITAZOON (Avizoon)</a><br />
                <a href="javascript:requisicao('farmacia/xantion.php');">XANTION B12</a><br />
                <a href="javascript:requisicao('farmacia/zooserine.php');">ZOOSERINE (Avizoon)</a><br />
                <a href="javascript:requisicao('farmacia/zoovigon.php');">ZOOVIGON (Farmavet)</a><br />
            </div>
			
         	<div style="float:left; width:70% !important; left:5%; text-align:justify;" id="conteudo"></div>
         
            
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
    
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
    
    
   <!-----divi para recuperar senha---->
<div id="dialog" class="recupera" title="Recuperar Senha">
<?php include_once("esenha.php");?>
</div> 
   
</body>
</html>