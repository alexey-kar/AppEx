<?php
use System\CSession;

use Base\CRequest;

//define(".", "::");

//require_once("AppExCore/classes/core/CAutoloader.php");

require_once("AppExCore/classes/base/CObject.php");
require_once("AppExCore/classes/base/CSingleton.php");

require_once("AppExCore/classes/core/CRegistry.php");

require_once("AppExCore/classes/core/CExtension.php");
require_once("AppExCore/classes/core/CFileSystem.php");

require_once("AppExCore/classes/core/CRequest.php");
require_once("AppExCore/classes/core/CResponse.php");

require_once("AppExCore/classes/core/CSession.php");
require_once("AppExCore/classes/core/CCookie.php");

require_once("AppExCore/classes/modules/CCrypt.php");
require_once("AppExCore/classes/modules/CCaptcha.php");


use System as Sys;
//CCaptcha::getInstance()->create("/AppExCore/files/fonts/HARNGTON.TTF");
//echo '<pre>', print_r(\get_declared_classes()), '</pre>';


echo '<img src="'.Sys\Modules\CCaptcha::getInstance()->create("/AppExCore/files/fonts/HARNGTON.TTF").'" >';



//require_once("AppExCore/classes/core/CDispatcher.php");

?>