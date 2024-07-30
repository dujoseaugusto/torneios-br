<div class="footer">
	<div class="container">
		<?php
		 $s_rodape = new consulta();
    $s_rodape->campo     = 'texto';
    $s_rodape->tabela    = 'arpag_textosite';
    $s_rodape->parametro = "id = '1'";
  $executa_rod = select_db($s_rodape);

  $linha_rod = $executa_rod->fetch_array();
  echo $linha_rod['texto'];
?>
	</div>
</div>

<script type="text/javascript" src="js/bootstrap.js"></script>