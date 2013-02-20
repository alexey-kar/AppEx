<?php
namespace System\Modules
{
	final class CCrypt extends \System\CSingleton
	{
		public function __get($k){ $this->get($k); }
		public function __set($k, $v){ $this->set($k, $v); }
		private function __sleep(){}
		private function __wakeup(){}
		
		public function md5($str, $rawOutput = false)
		{
			return md5($str, $rawOutput);
		}
		public function md5File($fileName, $rawOutput = false)
		{
			return md5_file($fileName, $rawOutput);
		}
		public function sha1($str, $rawOutput = false)
		{
			return sha1($str, $rawOutput);
		}
		public function sha1File($fileName, $rawOutput = false)
		{
			return sha1_file($fileName, $rawOutput);
		}
		
		public function crypt($str, $salt = null)
		{
			if ($salt != null)
			{
				return crypt($str, $salt);
			}
			return crypt($str);
		}
		
		public function vernam($openText, $key = '') 
		{      
	    $length = mb_strlen($oStr, 'utf-8');
	    $cryptText = '';
	    
	    if($key == '')
	    {  
	        for($i = 0; $i < $length; $i++)
	        {         
	            $key .= mb_substr(md5(mt_rand(1, mt_getrandmax())), 0, 1, 'utf-8');
	        }
	    }
	    for($i = 0; $i < $length; $i++)
	    {
	        $cryptText .= $openText[$i]^$key[$i]; 
	    }
	    return array('key' => $key, 'cryptText' => $cryptText);
		}
		
		
		public function crc32($openText)
		{
			return crc32($openText);
		}
	}
}
?>