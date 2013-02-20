<?php
namespace System
{
	class CSingleton extends CObject
	{
	    protected static $m_aInstance = array();
	    private function __construct(){}
	    final private function __clone(){}
	    public static function getInstance()
	    {
	    	$sClassName = get_called_class();
	    	if(!isset(self::$m_aInstance[$sClassName]))
	    	{
	      	self::$m_aInstance[$sClassName] = new $sClassName();
				}
	    	$oInstance = self::$m_aInstance[$sClassName];
	    	return $oInstance;
	    }
	}
}
?>