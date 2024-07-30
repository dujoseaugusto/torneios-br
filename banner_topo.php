<!-- banner -->	
	<?php
			$banner = new consulta();
				$banner->campo 		= 'id, imagem';
				$banner->parametro	= 'id DESC LIMIT 1';
				$banner->tabela		= 'arpag_banner';
			$resultado = select_db_2($banner);
				
			while($rs = $resultado->fetch_array()){
				$bg = 'banner/'.$rs['imagem'];	
				//$teste = $rs['nome'];	
		}
	?>
	
		<!-- container -->
		<div class="banner">

			<img src="<?php echo $bg; ?>" class="img-responsive" style="" />
			

				
		<!-- //container -->
		</div>


	<!-- //banner -->      