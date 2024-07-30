<?php
		
	include("../seguranca/seguranca.php");
    protegePagina(1);
    require_once('../php/class.php');
    require_once('../bd_funcao/maysql.php');
	include("conexao.php");	
	include("php/funcoes.php");	

	//ini_set('memory_limit', '512M');
	ini_set('post_max_size', '500M');
	ini_set('upload_max_filesize', '500M');



function clean($string) {
	$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕºª";
	$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRroa";
	$string = utf8_decode($string);
	$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"
	$string = str_replace(" ","-",$string); // retira espaco
	$string = strtolower($string); // passa tudo para minusculo
	return utf8_encode($string); //finaliza, gerando uma saída para a funcao
}


function resizeImage($Largura_atual,$Altura_atual,$Tamanho_Maximo,$Pasta_Destino,$SrcImage,$Qualidade_img,$Tipo_imagem){
	//Verifica se a imagem existe
	if($Largura_atual <= 0 || $Altura_atual <= 0) 
		return false;
			
	//Construção proporcional da nova imagem
	$Imagem       = min($Tamanho_Maximo/$Largura_atual, $Tamanho_Maximo/$Altura_atual); 
	$Nova_Largura = ceil($Imagem*$Largura_atual);
	$Nova_Altura  = ceil($Imagem*$Altura_atual);
	
	if($Largura_atual < $Nova_Largura || $Altura_atual < $Nova_Altura){	
		$Nova_Largura = $Largura_atual;
		$Nova_Altura = $Altura_atual;
	}
	
	$NewCanves 	= imagecreatetruecolor($Nova_Largura, $Nova_Altura);

	// Redimensionamento de imagem
	if(imagecopyresampled($NewCanves, $SrcImage,0, 0, 0, 0, $Nova_Largura, $Nova_Altura, $Largura_atual, $Altura_atual)){	
		switch(strtolower($Tipo_imagem)){	
			case 'image/png':
						imagepng($NewCanves,$Pasta_Destino);
						break;
					case 'image/gif':
						imagegif($NewCanves,$Pasta_Destino);
						break;			
					case 'image/jpeg':
					case 'image/pjpeg':
						imagejpeg($NewCanves,$Pasta_Destino,$Qualidade_img);
						break;
					default:
						return false;
		}
			if(is_resource($NewCanves)) 
				imagedestroy($NewCanves); 
				 
			return true;
	}
}

$nome_galeria = $_POST["nome_galeria"]; 
$nome_pasta   = clean($nome_galeria);

$destino_imagem = mkdir('fgaleria/'.$nome_pasta.'/',0777,true);

// Inserção na tabela de galeria
$nome_galeria  = $_POST["nome_galeria"];
$data    	   = date("Y-m-d", strtotime($_POST['data']));

	
if(isset($_FILES['file']['name'])){


			//Configurações da Imagem
			$Tamanho_Max_Imagem 		= 640; //Largura e altura máxima da imagem
			$Prefixo_Img_redimensionada	= "imagem_comprimida"; //Prefixo para o nome da imagem salva
			$Pasta_Img_Original			= 'original/';
			$Pasta_Img_Comprimida		= 'fgaleria/'; //Diretório para onde a imagem comprimida será salva
			$Qualidade_img 				= 90;
			$Local_Img_comprimida[] 	= $destino_imagem;
			$Local_Img_original[]		= "";

		

			if ($nome_galeria != ""){
								
				$sql = utf8_decode("INSERT INTO arpag_fotos (nome, data, nome_pasta) 
								VALUES ('$nome_galeria', '$data', '$nome_pasta')");
				
				if($conn->query($sql) === TRUE){					
					echo utf8_encode('<script>window.location="cad_gal_realizado.php";</script>');
				}
				else{
					echo "Erro: " . $sql . "<br />" .$conn->error;
					echo utf8_encode('<script>window.location="cad_gal_fotos.php";</script>');
				}
			}
			


			$cont = $_FILES['file']['tmp_name'];

			 for($i = 0; $i < count($cont); $i++){

				// Algumas informações das imagens que serão necessárias.
				$Nome_Imagem=$_FILES['file']["name"][$i];
				$Tamanho_Imagem=$_FILES['file']['size'][$i];
				$TempSrc=$_FILES['file']['tmp_name'][$i];
				$Tipo_imagem=$_FILES['file']['type'][$i];

				$Process_Imagem = true;
			
			
			//Validação de arquivo e criação da imagem a partir da imagem que foi feito upload.
					switch(strtolower($Tipo_imagem)){
						case 'image/png':
								$Imagem_Criada = imagecreatefrompng($TempSrc);
								break;
							case 'image/gif':
								$Imagem_Criada = imagecreatefromgif($TempSrc);
								break;
							case 'image/jpeg':
							case 'image/pjpeg':
								$Imagem_Criada = imagecreatefromjpeg($TempSrc);
								break;
							default:
								$Process_Imagem = false; //Formato do arquivo não suportado! 
					}
							


					//Pega o tamanho da imagem
					list($Largura_atual,$Altura_atual) = getimagesize($TempSrc);

					//Local para as imagens de destino
					$DestRandNome_Imagem 			= 'fgaleria/'.$nome_pasta.'/'.$Nome_Imagem; //Name for Big Image
					date_default_timezone_set('America/Sao_Paulo'); 
					$data_upload = date('Y-m-d H:i:s');
  

					//Redimensionamento da imagem para o tamanho especificado na função resizeImage.
					if($Process_Imagem && resizeImage($Largura_atual,$Altura_atual,$Tamanho_Max_Imagem,$DestRandNome_Imagem,$Imagem_Criada,$Qualidade_img,$Tipo_imagem)){	
					
							//Novo tamanho para imagem
							list($ResizedWidth,$ResizedHeight)=getimagesize($DestRandNome_Imagem);
							$Local_Img_comprimida	= $DestRandNome_Imagem;
							echo $Local_Img_comprimida;
							//$Local_Img_original	= $OriginalNome_Imagem;						
					}

					else{
						echo '<p style="color:red;">Ocorreu um erro ao processar.<strong>'.$Nome_Imagem.'</strong></div>'; //output error
					}

		}
	
}

	echo '<script language="javascript">alert("Imagens enviadas com sucesso!")</script>';

	
?>