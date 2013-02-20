<?php
namespace System
{
	class CFileSystem extends CSingleton
	{
		public function getFileExtension($fileName)
		{
			if (!empty($fileName))
			{
				preg_match('|.*\.(\S+)|', $fileName, $result);
				return $result[1];
			}
			return null;
		}
		public function getPathInfo($path)
		{
			return pathinfo($path);
		}
		public function chmod($path, $mode = 0664)
		{
			if (intval($mode) == 0)
			{
				$res = $this->_modeRWX2Octal($mode);
				if ($res == null){ return false; }
				$mode = $res;
			}
			return chmod($path, $mode);
		}
		function chmodR($path, $mode)
		{
	    if (!$this->isDir($path))
	    {
	    	return $this->chmod($path, $mode);
	    }
	    $dh = opendir($path);
	    while (($file = readdir($dh)) !== false)
	    {
	    	if($file != '.' && $file != '..')
	    	{
	      	$fullpath = $path.'/'.$file;
	        if(is_link($fullpath))
	        {
	        	return false;
	        }
	        elseif(!$this->isDir($fullpath) && !$this->chmod($fullpath, $mode))
	        {
	        	return false;
	        }
	        elseif(!$this->chmodR($fullpath, $mode))
	        {
	        	return false;
	        }
	    	}
	    }
	
	    closedir($dh); 
	
	    if($this->chmod($path, $mode))
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
	  }
		public function chown($path, $uid)
		{
			return chown($path, $uid);
		}
		public function chgrp($file, $gid)
		{
			return chgrp($file, $gid);
		}
		function chownChgrpR($path, $uid, $gid)
		{ 
			$dir = new dir($path);
	  	while(($file = $dir->read()) !== false)
	  	{
	  		if($this->isDir($dir->path.$file))
	      {
	      	$this->chownChgrpR($dir->path.$file, $uid, $gid);
	      }
	      else
	      {
	      	$this->chown($file, $uid);
	      	$this->chgrp($file, $gid);
	      }
	    }
	    $dir->close();
		}
		private function _modeRWX2Octal($modeRWX)
		{
	    if (!preg_match("/[-d]?([-r][-w][-xsS]){2}[-r][-w][-xtT]/", $modeRWX)){ return null; }
	    $Mrwx = substr($modeRWX, -9);
	    $ModeDecStr = (preg_match("/[sS]/", $Mrwx[2]))?4:0;
	    $ModeDecStr .= (preg_match("/[sS]/", $Mrwx[5]))?2:0;
	    $ModeDecStr .= (preg_match("/[tT]/", $Mrwx[8]))?1:0;
	    $Moctal = $ModeDecStr[0]+$ModeDecStr[1]+$ModeDecStr[2];
	    $Mrwx = str_replace(array('s','t'), "x", $Mrwx);
	    $Mrwx = str_replace(array('S','T'), "-", $Mrwx);
	    $trans = array('-'=>'0','r'=>'4','w'=>'2','x'=>'1');
	    $ModeDecStr .= strtr($Mrwx, $trans);
	    $Moctal .= $ModeDecStr[3]+$ModeDecStr[4]+$ModeDecStr[5]; 
	    $Moctal .= $ModeDecStr[6]+$ModeDecStr[7]+$ModeDecStr[8];
	    $Moctal .= $ModeDecStr[9]+$ModeDecStr[10]+$ModeDecStr[11];
	    return $Moctal;
		}
		public function isFile($path)
		{
			clearstatcache();
			return is_file($path);
		}
		public function isDir($path)
		{
			clearstatcache();
			return is_dir($path);
		}
		public function isExecutable($fileName)
		{
			if ($this->isFile($fileName))
			{
				return is_executable($fileName);
			}
			return false;
		}
		public function isReadable($path)
		{
			return is_readable($path);
		}
		public function isWritable($path)
		{
			return is_writable($path);
		}
		public function pathExists($path)
		{
			clearstatcache();
			return file_exists($path);
		}
		
		public function rename($oldName, $newName)
		{
			return rename($oldName, $newName);
		}
		public function remove($path)
		{
			if ($this->isDir($path))
			{
				return rmdir($path);
			}
			return unlink($path);
		}
		public function pathType($path)
		{
			return filetype($path);
		}
		public function copy($source, $dest)
		{
			return copy($source, $dest);
		}
	}
}
?>