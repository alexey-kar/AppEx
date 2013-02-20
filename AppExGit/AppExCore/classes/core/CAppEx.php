<?php
final class CAppEx
{
	private static $m_aObjects = array();
	
	public static function run(){}
	public function __get($alias)
	{
		return isset($this->m_aObjects[$alias]) ? $this->m_aObjects[$alias] : null;
	}
	public function __set($alias, $ref)
	{
		if (!isset($this->m_aObjects[$alias]))
		{
			$this->m_aObjects[$alias] = $ref;
		}
	}
}
?>