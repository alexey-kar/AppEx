<?php
namespace System
{
	final class CRegistry extends CSingleton
	{
		private $m_aStorage = array();
		
		public function __get($k){ $this->get($k); }
		public function __set($k, $v){ $this->set($k, $v); }
		public function __sleep()
		{
			return array_keys(get_class_vars(__CLASS__));
		}
		private function __wakeup(){}
		public function set($key, $value = null)
		{
			if ($key != null)
			{
				if (is_array($key))
				{
					foreach ($key as $k => $v)
					{
						if (!empty($k)){ $this->m_aStorage[$k] = $v; }
					}
				}
				else
				{
					if (!empty($key)){ $this->m_aStorage[$key] = $value; }
				}
			}
		}
		public function get($key)
		{
			if ($key == null){ return null; }
			if (is_array($key))
			{
				$result = array();
				foreach ($key as $k => $v)
				{
					if (!empty($v) && isset($this->m_aStorage[$v])){ $result[] = $this->m_aStorage[$v]; }
				}
				return $result;
			}
			else
			{
				if (!empty($key) && isset($this->m_aStorage[$key])){ return $this->m_aStorage[$key]; }
			}
			return null;
		}
		public function remove($key)
		{		
			if ($key == null){ return null; }
			if (is_array($key))
			{
				foreach ($key as $k => $v)
				{
					if (!empty($v) && isset($this->m_aStorage[$v])){ unset($this->m_aStorage[$v]); }
				}
			}
			else
			{
				if (!empty($key) && isset($this->m_aStorage[$key])){ unset($this->m_aStorage[$key]); }
			}
		}
		public function size()
		{
			return count($this->m_aStorage);
		}
		public function erase()
		{
			foreach ($this->m_aStorage as $k => $v){ unset($this->m_aStorage[$k]); }
		}
		public function keys()
		{
			$result = array();
			foreach ($this->m_aStorage as $k => $v){ $result[] = $k; }
			return $result;
		}
		public function values()
		{
			$result = array();
			foreach ($this->m_aStorage as $k => $v){ $result[] = $v; }
			return $result;
		}
		public function search($values)
		{
			$vls = array();
			if (!is_array($values))
			{
				$vls[] = $values;
			}
			else
			{
				$vls = $values;
			}
			$result = array();
			foreach ($this->m_aStorage as $k => $v)
			{
				if (in_array($v, $vls)){ $result[] = $k; }
			}
			return $result;
		}
	}
}
?>