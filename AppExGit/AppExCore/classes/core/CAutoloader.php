<?php
namespace AppEx
{
  class Autoloader
  {
    public function __construct(){}
     /**
     * Функция прямого подключения класса или файла.
     * В случае неудачи, вызывает функцию рекурсивного поиска.
     * 
     * @param string $file имя файла(без расширения)
     * @param string $ext расширение файла(без точки)
     * @param string $dir директория для поиска(без первого и последнего слешей)
      * 
     * @return string
     * @return false
     * 
     */
    public static function autoload($file, $ext = FALSE, $dir = FALSE)
    {
      $file = str_replace('\\', '/', $file);

      if($ext === FALSE)
      {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/AppEx/AppExCore/classes';
        $filepath = $_SERVER['DOCUMENT_ROOT'] . '/AppEx/AppExCore/classes/' . $file . '.php';
      }
      else
      {
        $path = $_SERVER['DOCUMENT_ROOT'] . (($dir) ? '/' . $dir : '');
        $filepath = $path . '/' . $file . '.' . $ext;
      }
      
      if (file_exists($filepath))
      {
        if($ext === FALSE)
        {
          //if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath));
          require_once($filepath);
        }
        else
        {
          //if(Autoloader::debug) Autoloader::StPutFile(('нашли файл в ' .$filepath));
          return $filepath;
        }
      }
      else
      {
        $flag = true;
        //if(Autoloader::debug) Autoloader::StPutFile(('начинаем рекурсивный поиск файла <b>' . $file . '</b> в <b>' . $path . '</b>'));
        return Autoloader::recursive_autoload($file, $path, $ext, $flag);
      }
    }

     /**
     * Функция рекурсивного подключения класса или файла.
     * 
     * @param string $file имя файла(без расширения)
     * @param string $path путь где ищем
     * @param string $ext расширение файла
     * @param string $flag необходим для прерывания поиска если искомый файл найден
      * 
     * @return string
     * @return bool
     * 
     */
    public static function recursive_autoload($file, $path, $ext, &$flag)
    {
    	$res = null;
      if (FALSE !== ($handle = opendir($path)) && $flag)
      {
        while (FAlSE !== ($dir = readdir($handle)) && $flag)
        {
          if (strpos($dir, '.') === FALSE)
          {
            $path2 = $path .'/' . $dir;
            $filepath = $path2 . '/' . $file .(($ext === FALSE) ? '.php' : '.' . $ext);
            //if(Autoloader::debug) Autoloader::StPutFile(('ищем файл <b>' .$file .'</b> in ' .$filepath));

            if (file_exists($filepath))
            {
              $flag = FALSE;
              if($ext === FALSE)
              {
                //if(Autoloader::debug) Autoloader::StPutFile(('подключили ' .$filepath ));
                require_once($filepath);
                break;
              }
              else
              {
               // if(Autoloader::debug) Autoloader::StPutFile(('нашли файл в ' .$filepath ));
                return $filepath;
              }
            }
            $res = Autoloader::recursive_autoload($file, $path2, $ext, $flag); 
          }
        }
        closedir($handle);
      }
      return $res;
    }
    private static function StPutFile($data){}
  }
  \spl_autoload_register('AppEx\Autoloader::autoload');
}

/*
public static function autoload($className)
{
	// use include so that the error PHP file may appear
	if(isset(self::$_coreClasses[$className]))
		include(YII_PATH.self::$_coreClasses[$className]);
	else if(isset(self::$classMap[$className]))
		include(self::$classMap[$className]);
	else
	{
		if(strpos($className,'\\')===false)
			include($className.'.php');
		else  // class name with namespace in PHP 5.3
		{
			$namespace=str_replace('\\','.',ltrim($className,'\\'));
			if(($path=self::getPathOfAlias($namespace))!==false)
				include($path.'.php');
			else
				return false;
		}
		return class_exists($className,false) || interface_exists($className,false);
	}
	return true;
}
*/
?>