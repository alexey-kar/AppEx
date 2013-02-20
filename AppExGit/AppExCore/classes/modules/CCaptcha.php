<?php
namespace System\Modules
{
	final class CCaptcha extends \System\CSingleton
	{
		private static $_sWidth = 400;
		private static $_sHeight = 80;
		private static $_shImage;
		private static $_saColors = array();
		private static $_sHash;
		private static $_sFont;
		
		public function __get($k){}
		public function __set($k, $v){}
		private function __sleep(){}
		private function __wakeup(){}
		
		public function validate($key)
		{
			return $key != null || \System\CSession::getInstance()->get('AppEx_captcha_code') == $key ? true : false;
		}
		
		public function create($font)
		{
			\System\CSession::getInstance()->remove('AppEx_captcha_code');
				
			self::$_sFont = $font;
			
			self::$_shImage = imagecreatetruecolor(self::$_sWidth, self::$_sHeight);
			//imagecolortransparent(self::$_shImage, $black);
			self::$_saColors['white'] = imagecolorallocate(self::$_shImage, 255, 255, 255);
			self::$_saColors['blue'] = imagecolorallocate(self::$_shImage, 100, 149, 237);
			self::$_saColors['gray'] = imagecolorallocate(self::$_shImage, 192, 192, 192);
			self::$_saColors['black'] = imagecolorallocate(self::$_shImage, 0, 0, 0);
			self::$_sHash = self::_genegateText(7);
			
			self::_createGrid();
			self::_drawText(4);
			
			\Base\CResponse::getInstance()->setContentType('gif');
			//выводим готовую картинку	
			return imagegif(self::$_shImage);
		}
		
		private function _drawText($count)
		{
			$string = self::_genegateText($count);
			\System\CSession::getInstance()->set('AppEx_captcha_code', $string);
			$start = 10;
			for ($i = 0; $i < $count; $i++)
			{
				imagettftext(self::$_shImage, 50, rand(-40, 40), $start, rand(50, self::$_sHeight), imagecolorallocate(self::$_shImage, rand(50, 200), rand(50, 200), rand(50, 200)), self::$_sFont, $string[$i]);
				$start += self::$_sWidth/$count;
			}
		}
		 
		private function _createGrid($horizont = 10, $vertical = 30)
		{
			$stepHeight = floor(self::$_sHeight/$horizont);
			$stepWidth = floor(self::$_sWidth/$vertical);
			$start = 0;
			for ($i = 0; $i < $horizont; $i++)
			{
				$start += $stepHeight ;
				imageline(self::$_shImage, 0, $start, self::$_sWidth, $start, self::$_saColors['blue']);
			}
			$start = 0 ;
			for ($i = 0; $i < $vertical; $i++)
			{
				$start += $stepWidth;
				imageline(self::$_shImage, $start, 0, $start, self::$_sHeight, self::$_saColors['blue']);
			}
		}
		
		private function _genegateText($count)
		{
			$chars = 'abdefghiknrstxyzABDEFGHKNQRSTYZ1234567890' ;
			$numChars = strlen($chars);
			$string = '';
			for ( $i = 0; $i < $count; $i++)
			{
				$string .= substr($chars, rand(1, $numChars) - 1, 1);
			}
			return $string;
		}
	}
}
?>