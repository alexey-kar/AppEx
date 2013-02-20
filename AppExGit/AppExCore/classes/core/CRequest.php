<?php
namespace Base
{
	final class CRequest extends \System\CSingleton
	{
		public $m_aServer = array();
		public $m_aStorage = array();
		
		public function __get($k){ $this->get($k); }
		public function __set($k, $v){}
		private function __sleep(){}
		private function __wakeup(){}
		private function __construct()
		{
			$this->m_aServer = $_SERVER;
			switch($this->getMethod())
			{
				case 'HEAD':{}
				case 'GET':{ $this->m_aStorage = $_GET; break; }
				case 'POST':{ $this->m_aStorage = $_POST; break; }
				case 'PUT':
				{
					$putdata = file_get_contents('php://input'); 
					$exploded = explode('&', $putdata);  
	 
					foreach($exploded as $pair)
					{ 
	    			$item = explode('=', $pair); 
	    			if(count($item) == 2)
	    			{ 
	      			$this->m_aStorage[urldecode($item[0])] = urldecode($item[1]); 
						}
					}
					break;
				}
			};
			unset($_SERVER);
			unset($_GET);
			unset($_POST);
		}
		public function getMethod()
		{
			return isset($this->m_aServer['REQUEST_METHOD']) ? $this->m_aServer['REQUEST_METHOD'] : null;
		}
		public function isPostRequest()
		{
			return $this->m_aServer['REQUEST_METHOD'] == 'POST' ? true : false;
		}
		public function isGetRequest()
		{
			return $this->m_aServer['REQUEST_METHOD'] == 'GET' ? true : false;
		}
		public function isPutRequest()
		{
			return $this->m_aServer['REQUEST_METHOD'] == 'PUT' ? true : false;
		}
		public function isHeadRequest()
		{
			return $this->m_aServer['REQUEST_METHOD'] == 'HEAD' ? true : false;
		}
		public function getHost()
		{
			return isset($this->m_aServer['HTTP_HOST']) ? $this->m_aServer['HTTP_HOST'] : null;
		}
		public function getIP()
		{
			return !empty($this->m_aServer['HTTP_CLIENT_IP']) ? $this->m_aServer['HTTP_CLIENT_IP'] : !empty($this->m_aServer['HTTP_X_FORWARDED_FOR']) ? $this->m_aServer['HTTP_X_FORWARDED_FOR'] : $this->m_aServer['REMOTE_ADDR'];
		}
		public function getPort()
		{
			return isset($this->m_aServer['SERVER_PORT']) ? $this->m_aServer['SERVER_PORT'] : null;
		}
		public function getQueryString()
		{
			return isset($this->m_aServer['QUERY_STRING']) ? $this->m_aServer['QUERY_STRING'] : null;
		}
		public function getClientPort()
		{
			return isset($this->m_aServer['REMOTE_PORT']) ? $this->m_aServer['REMOTE_PORT'] : null;
		}
		public function getUri()
		{
			return isset($this->m_aServer['REQUEST_URI']) ? $this->m_aServer['REQUEST_URI'] : null;
		}
		public function getHttpReferer()
		{
			return isset($this->m_aServer['HTTP_REFERER']) ? $this->m_aServer['HTTP_REFERER'] : null;
		}
		public function getUriInfo($uri)
		{
			return array_merge(parse_url($uri), pathinfo($uri));
		}
		public function isAjaxRequest()
		{
			if(function_exists('getallheaders'))
			{
				$allHeaders = getallheaders();
				$key = 'x-requested-with';
				$value = 'XMLHttpRequest';
				foreach ($allHeaders as $name => $val)
				{
					if (strtolower($name) == $key && $val == $value){ return true; }
				}
			}
			
			$allHeaders = $this->m_aServer;
			$key = 'http_x_requested_with';
			$value = 'XMLHttpRequest';
			foreach ($allHeaders as $name => $val)
			{
				if (strtolower($name) == $key && $value == $value){ return true; }
			}
			return false;
		}
		public function get($k)
		{
			if (isset($this->m_aStorage[$k])){ return $this->m_aStorage[$k]; }
			return null;
		}
	}
}
?>