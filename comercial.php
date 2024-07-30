<?php
	$comercial = new consulta();
					$comercial->campo 		= 'link, imagem';
					$comercial->parametro	= 'id ASC';
					$comercial->tabela		= 'arpag_comercial';
	$resultado = select_db_2($comercial);
	
	while($rs = $resultado->fetch_array()){
		
			echo "
					<div class='anunciantes-items'>
						<div class='anunciantes-item'> 
							<div class='anunciantes-item-inner'>
									<a href='http://".$rs['link']."' target='_blank'>
										<img src='anuncios/".$rs['imagem']."' class='img-responsive' style='height:125px !important; width:168px !important;'/>
									</a>
							</div>
						</div>
					</div>";
		
	}
?>