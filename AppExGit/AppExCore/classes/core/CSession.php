<?php
namespace System
{
	final class CSession extends CSingleton
	{
		public function __get($k){ $this->get($k); }
		public function __set($k, $v){ $this->set($k, $v); }
		private function __sleep(){}
		private function __wakeup(){}
		public function set($k, $v)
		{
			$this->start();
			return $_SESSION[$k] = $v;
		}
		public function get($k)
		{
			$this->start();
			return isset($_SESSION[$k]) ? $_SESSION[$k] : null;
		}
		public function remove($k)
		{
			$this->start();
			if(isset($_SESSION[$k])){ unset($_SESSION[$k]); }
		}
		public function isExist($k)
		{
			return (boolean)isset($_SESSION[$k]);
		}
		public function start()
		{
			if (!$this->isStarted()){ session_start(); }
		}
		public function isStarted()
		{
			return (boolean)session_id();
		}
		public function getSessionId()
		{
			return session_id();
		}
		public function destroy()
		{
			$this->start();
			if (isset($_COOKIE))
			{
				if (isset($_COOKIE[session_name()])){ unset($_COOKIE[session_name()]); }
				if (isset($_COOKIE[session_id()])){ unset($_COOKIE[session_id()]); }
			}
			session_unset();
			session_destroy();
		}
	}
}
?>