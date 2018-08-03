<?php

class Imagem
{
	
	/**
	 * 
	 * recorta imagem apartir de uma área selecionada
	 * @param $arquivo endereço da imagem a ser recortada
	 * @param $arrInfoRecorte x,y,w,h da imagem
	 * @param $novo_arquivo
	 * @param $wmax caso tenha sido redimensionada a imagem antes da selecao, informa a largura atual
	 * @param $hmax caso tenha sido redimensionada a imagem antes da selecao, informa a altura atual
	 */
	function cropImage($arquivo,$arrInfoRecorte,$novo_arquivo=null,$wmax=false,$hmax =false)
	{
		$novo_arquivo = $novo_arquivo==null ? $arquivo : $novo_arquivo;

		list($larguraImg, $alturaImg, $tipo) = getimagesize($arquivo);

		$posX = $arrInfoRecorte['x'] ;
		$posY = $arrInfoRecorte['y'] ;

		$largura 	= $arrInfoRecorte['w'];
		$altura 	= $arrInfoRecorte['h'];

		//DEFINE A NOVA LARGURA E ALTURA SE PRECISARMOS REDIMENSIONAR É SO DEFINIR AQUI
		$largura_desejada 	= $largura;
		$altura_desejada 	= $altura;

		//CASO TENHA SIDO REDIMENSÃO NA PAGINA DE RECORTE, CALCULAMOS A REDIMENSAO ANTES DE RECORTAR
		if($wmax || $hmax)
		{
			$wmax	= $wmax ? $wmax : $largura;
			$hmax	= $hmax ? $hmax : $altura;
			$escala = max($larguraImg/$wmax, $alturaImg/$hmax);

			if($escala > 1)
			{
				$posX = $posX * $escala;
				$posY = $posY * $escala;
				$largura 	= $largura * $escala;
				$altura 	= $altura * $escala;
			}
		}
		$new_image = imagecreatetruecolor($largura_desejada, $altura_desejada);
		switch($tipo)
		{
			case 1:		$old_image = imagecreatefromgif($arquivo);
						break;

			case 2:		$old_image = imagecreatefromjpeg($arquivo);
						break;

			default:	$old_image = imagecreatefrompng($arquivo);
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
		}
		imagecopyresampled($new_image, $old_image, 0, 0,$posX, $posY, $largura_desejada, $altura_desejada, $largura, $altura);
		//_______Output______________
		switch($tipo)
		{
			case 1:		imagegif($new_image, $novo_arquivo);
						break;

			case 2:		imagejpeg($new_image, $novo_arquivo, 100);
						break;

			default: //PNG
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
						imagepng($new_image, $novo_arquivo);
		}
		imagedestroy($old_image);
		imagedestroy($new_image);
	}
		
	public static function redimensiona($arquivo, $wmax = null, $hmax = null, $novo_arquivo=null)
	{
		$novo_arquivo = $novo_arquivo==null ? $arquivo : $novo_arquivo;
		
		//___pega as dimensões da imagem e define a escala_________
		list($largura, $altura, $tipo) = getimagesize($arquivo);
		
		if($wmax && $hmax){
			$escala=max($largura/$wmax, $altura/$hmax);
		}elseif($wmax){
			$escala=$largura/$wmax;
		}elseif($hmax){
			$escala=$altura/$hmax;
		}else{
			$escala =1;
		}
		
		$altura_desejada=floor($altura/$escala);
		$largura_desejada=floor($largura/$escala);
		
		//_______Resample____________
		if($escala>1)
		{
			$new_image = imagecreatetruecolor($largura_desejada, $altura_desejada);
			switch($tipo)
			{
				case 1:		$old_image = imagecreatefromgif($arquivo); 
							break;
							
				case 2:		$old_image = imagecreatefromjpeg($arquivo); 
							break; 
							
				default:	$old_image = imagecreatefrompng($arquivo);
							imagealphablending($new_image, false);
							imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
							imagesavealpha($new_image, true);
			}
			imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $largura_desejada, $altura_desejada, $largura, $altura);
	
			
			//_______Output______________
			switch($tipo)
			{
				case 1:		imagegif($new_image, $novo_arquivo);
							break; 
							
				case 2:		imagejpeg($new_image, $novo_arquivo, 100); 
							break;
							
				default: //PNG	
							imagealphablending($new_image, false);
							imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
							imagesavealpha($new_image, true);
							imagepng($new_image, $novo_arquivo); 
			}
			imagedestroy($old_image);
			imagedestroy($new_image);
		}else{
			if($novo_arquivo){
				copy($arquivo, $novo_arquivo);
			}
		}
	}
	
	//  _______________________________________________________________  //
	
	function redimensiona_square($arquivo, $dimensao)
		{
		//___pega as dimensões da imagem e define a escala_________
		list($largura, $altura, $tipo) = getimagesize($arquivo);
		
		$x_origem = $largura>$altura ? floor(($largura-$altura)/2) : 0;
		$y_origem = $largura<$altura ? floor(($altura-$largura)/2) : 0;
		
		$largura_origem = $largura>$altura ? $altura : $largura;
		$altura_origem = $largura<$altura ? $largura : $altura;
		
		//_______Resample____________
		$new_image = imagecreatetruecolor($dimensao, $dimensao);
		switch($tipo)
			{
			case 1:		$old_image = imagecreatefromgif($arquivo); break; 
			case 2:		$old_image = imagecreatefromjpeg($arquivo); break; 
			default:	$old_image = imagecreatefrompng($arquivo);
			}
		imagecopyresampled($new_image, $old_image, 0, 0, $x_origem, $y_origem, $dimensao, $dimensao, $largura_origem, $altura_origem);
	
		//_______Output______________
		switch($tipo)
			{
			case 1:		imagegif($new_image, $arquivo); 
						break;
						
			case 2:		imagejpeg($new_image, $arquivo, 100); 
						break;
						
			default: //PNG	
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
						imagepng($new_image, $arquivo); 
			}
		imagedestroy($old_image);
		imagedestroy($new_image);
		}
	
	
		
		
		
		
		
	public static function redimensiona_prop($arquivo, $wmax, $hmax, $novo_arquivo=null)
	{
		$novo_arquivo = $novo_arquivo==null ? $arquivo : $novo_arquivo;
		
		//___pega as dimensões da imagem e define a escala_________
		list($largura, $altura, $tipo) = getimagesize($arquivo);
		$escala_x = $largura/$wmax;
		$escala_y = $altura/$hmax;
		$escala=min($escala_x, $escala_y);
		
		$altura_desejada=floor($altura/$escala);
		$largura_desejada=floor($largura/$escala);
		
		//_______Redimensiona____________
		$new_image = imagecreatetruecolor($largura_desejada, $altura_desejada);
		switch($tipo)
		{
			case 1:		$old_image = imagecreatefromgif($arquivo); 
						imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
						imagealphablending($new_image, false);
						imagesavealpha($new_image, true);
						break; 
						
			case 2:		$old_image = imagecreatefromjpeg($arquivo); 
						break; 
						
			default:	$old_image = imagecreatefrompng($arquivo);
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
		}
		imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $largura_desejada, $altura_desejada, $largura, $altura);
		
		//_______Mascara com a porção central_________
		$x_origem = $escala_x>$escala_y ? floor(($largura_desejada-$wmax)/2) : 0;
		$y_origem = $escala_y>$escala_x ? floor(($altura_desejada-$hmax)/2) : 0;
		
		
		$nova_imagem = imagecreatetruecolor($wmax, $hmax);
		if($tipo==2) //-->GIF
		{
	//		imagealphablending($nova_imagem, false);
	//		imagefill($nova_imagem, 0, 0, imagecolortransparent($nova_imagem, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
	//		imagesavealpha($nova_imagem, true);
		}
		if($tipo==3) //-->PNG
		{
			imagealphablending($nova_imagem, false);
			imagefill($nova_imagem, 0, 0, imagecolortransparent($nova_imagem, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
			imagesavealpha($nova_imagem, true);
		}
		imagecopyresampled($nova_imagem, $new_image, 0, 0, $x_origem, $y_origem, $wmax, $hmax, $wmax, $hmax);
		
		//_______Output______________
		switch($tipo)
		{
			case 1:		imagegif($nova_imagem, $novo_arquivo); break;
			case 2:		imagejpeg($nova_imagem, $novo_arquivo, 100); break;
			default:	imagepng($nova_imagem, $novo_arquivo); 
		}
		imagedestroy($old_image);
		imagedestroy($new_image);
		imagedestroy($nova_imagem);
	}
	
	//  _______________________________________________________________  //

	
		
		
	public static function redimensiona_prop_top($arquivo, $wmax, $hmax, $novo_arquivo=null)
	{
		$novo_arquivo = $novo_arquivo==null ? $arquivo : $novo_arquivo;
		
		//___pega as dimensões da imagem e define a escala_________
		list($largura, $altura, $tipo) = getimagesize($arquivo);
		$escala_x = $largura/$wmax;
		$escala_y = $altura/$hmax;
		$escala=min($escala_x, $escala_y);
		
		$altura_desejada=floor($altura/$escala);
		$largura_desejada=floor($largura/$escala);
		
		//_______Redimensiona____________
		$new_image = imagecreatetruecolor($largura_desejada, $altura_desejada);
		switch($tipo)
		{
			case 1:		$old_image = imagecreatefromgif($arquivo); 
						imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));
						imagealphablending($new_image, false);
						imagesavealpha($new_image, true);
						break; 
						
			case 2:		$old_image = imagecreatefromjpeg($arquivo); 
						break; 
						
			default:	$old_image = imagecreatefrompng($arquivo);
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
		}
		imagecopyresampled($new_image, $old_image, 0, 0, 0, 0, $largura_desejada, $altura_desejada, $largura, $altura);
		
		//_______Mascara com a porção central_________
		$x_origem = $escala_x>$escala_y ? floor(($largura_desejada-$wmax)/2) : 0;
		$y_origem = 0;
		
		
		$nova_imagem = imagecreatetruecolor($wmax, $hmax);
		if($tipo==2) //-->GIF
		{
	//		imagealphablending($nova_imagem, false);
	//		imagefill($nova_imagem, 0, 0, imagecolortransparent($nova_imagem, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
	//		imagesavealpha($nova_imagem, true);
		}
		if($tipo==3) //-->PNG
		{
			imagealphablending($nova_imagem, false);
			imagefill($nova_imagem, 0, 0, imagecolortransparent($nova_imagem, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
			imagesavealpha($nova_imagem, true);
		}
		imagecopyresampled($nova_imagem, $new_image, 0, 0, $x_origem, $y_origem, $wmax, $hmax, $wmax, $hmax);
		
		//_______Output______________
		switch($tipo)
		{
			case 1:		imagegif($nova_imagem, $novo_arquivo); break;
			case 2:		imagejpeg($nova_imagem, $novo_arquivo, 100); break;
			default:	imagepng($nova_imagem, $novo_arquivo); 
		}
		imagedestroy($old_image);
		imagedestroy($new_image);
		imagedestroy($nova_imagem);
	}
	
	//  _______________________________________________________________  //

	


	public static function redimensiona_fill($arquivo, $wmax, $hmax, $novo_arquivo=null, $cor=null)
	{
		$novo_arquivo = $novo_arquivo==null ? $arquivo : $novo_arquivo;
		
		//___pega as dimensões da imagem e define a escala_________
		list($largura, $altura, $tipo) = getimagesize($arquivo);
		
		if($wmax && $hmax){
			$escala=max($largura/$wmax, $altura/$hmax);
		}elseif($wmax){
			$escala=$largura/$wmax;
		}elseif($hmax){
			$escala=$altura/$hmax;
		}else{
			$escala =1;
		}
		
		$altura_desejada=floor($altura/$escala);
		$largura_desejada=floor($largura/$escala);
		
		//_______Resample____________
		$new_image = imagecreatetruecolor($wmax, $hmax);
//		$cor = $cor ? $cor : 'ffffff'; 
//		$canal_r = '0x' . strtoupper(substr($cor, 0, 2));
//		$canal_g = '0x' . strtoupper(substr($cor, 2, 2));
//		$canal_b = '0x' . strtoupper(substr($cor, 4, 2));
//		$cor_aloc = imagecolorallocate($new_image, $canal_r, $canal_g, $canal_b);
		$cor_aloc = imagecolorallocate($new_image, 255, 255, 255);
		imagefill($new_image, 0, 0, $cor_aloc);
		
		$pos_x = floor(($wmax-$largura_desejada)/2);
		$pos_y = floor(($hmax-$altura_desejada)/2);
		switch($tipo)
		{
			case 1:		$old_image = imagecreatefromgif($arquivo); 
						break;
						
			case 2:		$old_image = imagecreatefromjpeg($arquivo); 
						break; 
						
			default:	$old_image = imagecreatefrompng($arquivo);
		}
		imagecopyresampled($new_image, $old_image, $pos_x, $pos_y, 0, 0, $largura_desejada, $altura_desejada, $largura, $altura);

		
		//_______Output______________
		switch($tipo)
		{
			case 1:		imagegif($new_image, $novo_arquivo);
						break; 
						
			case 2:		imagejpeg($new_image, $novo_arquivo, 100); 
						break;
						
			default: //PNG	
						imagealphablending($new_image, false);
						imagefill($new_image, 0, 0, imagecolortransparent($new_image, imagecolorallocatealpha($new_image, 0, 0, 0, 127)));
						imagesavealpha($new_image, true);
						imagepng($new_image, $novo_arquivo); 
		}
		imagedestroy($old_image);
		imagedestroy($new_image);
	
	}
	
	//  _______________________________________________________________  //
	
	
	
	
}