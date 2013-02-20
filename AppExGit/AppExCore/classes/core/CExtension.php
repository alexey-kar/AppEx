<?php
namespace System
{
	final class CExtension extends CSingleton
	{
		public function __get($k){}
		public function __set($k, $v){}
		private function __sleep(){}
		private function __wakeup(){}
		public function load($ext_name, $path)
		{
			if (!ini_get('safe_mode') && ini_get('enable_dl'))
			{
				if (!extension_loaded($ext_name) && is_file($path))
				{
					if (@dl($path)){ return true; }
					return false;
				}
			}
			return false;
		}
		public function getFuntionsModule($name)
		{
			return get_extension_funcs($name);
		}
		public function getList()
		{
			return get_loaded_extensions();
		}
	}
}
?>