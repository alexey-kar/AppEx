<?php
namespace System
{
	final class CCookie extends CSingleton
	{
		public function __get($k){ $this->get($k); }
		public function __set($k, $v){ $this->set($k, $v); }
		private function __sleep(){}
		private function __wakeup(){}
		public function set($name, $value, $expire = 0, $path = '/', $domain = null, $secure = false)
		{
			if ($domain === null){ $domain = $_SERVER['HTTP_HOST']; }
			return setcookie($name, $value, $expire, $path, $domain, $secure);
		}
		public function get($k)
		{
			return isset($_COOKIE[$k]) ? $_COOKIE[$k] : null;
		}
		public function remove($k)
		{
			if(isset($_COOKIE[$k])){ setcookie($_COOKIE[$k]); }
		}
		public function isExist($k)
		{
			return (boolean)isset($_COOKIE[$k]);
		}
		public function isEmpty()
		{
			return !((boolean)count($_COOKIE));
		}
		public function destroy()
		{
			if (isset($_COOKIE))
			{
				foreach ($_COOKIE AS $k => $v)
				{
					if (strpos($_COOKIE[$k], '_'))
					{
						setcookie($_COOKIE[$k], '');
						unset($_COOKIE[$k]);
					}
				}
			}
		}
	}
}
?>