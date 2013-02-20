<?php
namespace Base
{
	final class CResponse extends \System\CSingleton
	{
		private $m_aHttpStatusCodes = array(
												/*INFORMATION*/
			100 => 'Continue',							101 => 'Switching Protocols',
				
												/*SUCCESS*/
			200 => 'OK',										201 => 'Created',
			202 => 'Accepted',							203 => 'Non-Authoritative Information',
			204 => 'No Content',						205 => 'Reset Content',
			206 => 'Partial Content',
				
												/*REDIRECT*/
			300 => 'Multiple Choices',			301 => 'Moved Permanently',
			302 => 'Moved Temporarily',			303 => 'See Other',
			304 => 'Not Modified',					305 => 'Use Proxy',
				
												/*PARTIAL REQUEST*/
			400 => 'Bad Request',						401 => 'Unauthorized',
			402 => 'Payment Required',			403 => 'Forbidden',
			404 => 'Not Found',							405 => 'Method Not Allowed',
			406 => 'Not Acceptable',				407 => 'Proxy Authentication Required',
			408 => 'Request Time-out',			409 => 'Conflict',
			410 => 'Gone',									411 => 'Length Required',
			412 => 'Precondition Failed',		413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Large',	415 => 'Unsupported Media Type',
				
												/*ERRORS*/
			500 => 'Internal Server Error',	501 => 'Not Implemented',
			502 => 'Bad Gateway',						503 => 'Service Unavailable',
			504 => 'Gateway Time-out',			505 => 'HTTP Version not supported');
			
		private $m_aHttpMimeTypes = array(
			'ai' =>	'application/postscript',
			'aif' =>	'audio/aiff',
			'ani' =>	'application/x-navi-animation',
			'aos' =>	'application/x-nokia-9000-communicator-add-on-software',
			'aps' =>	'application/mime',
			'arc' =>	'application/octet-stream',
			'arj' =>	'application/arj',
			'art' =>	'image/x-jg',
			'asf' =>	'video/x-ms-asf',
			'asm' =>	'text/x-asm',
			'asp' =>	'text/asp',
			'asx' =>	'video/x-ms-asf',
			'au' =>	'audio/basic',
			'au' =>	'audio/x-au',
			'avi' =>	'video/avi',
			'bin' =>	'application/octet-stream',
			'bm' =>	'image/bmp',
			'bmp' =>	'image/bmp',
			'boo' =>	'application/book',
			'book' =>	'application/book',
			'c' =>	'text/x-c',
			'c++' =>	'text/plain',
			'ccad' =>	'application/clariscad',
			'class' =>	'application/java',
			'com' =>	'application/octet-stream',
			'conf' =>	'text/plain',
			'cpp' =>	'text/x-c',
			'cpt' =>	'application/x-compactpro',
			'css' =>	'text/css',
			'dcr' =>	'application/x-director',
			'def' =>	'text/plain',
			'dif' =>	'video/x-dv',
			'dir' =>	'application/x-director',
			'dl' =>	'video/dl',
			'doc' =>	'application/msword',
			'dot' =>	'application/msword',
			'drw' =>	'application/drafting',
			'dvi' =>	'application/x-dvi',
			'dwg' =>	'application/acad',
			'dxf' =>	'application/dxf',
			'dxr' =>	'application/x-director',
			'exe' =>	'application/octet-stream',
			'gif' =>	'image/gif',
			'gz' =>	'application/x-gzip',
			'gzip' =>	'multipart/x-gzip',
			'h' =>	'text/plain',
			'hlp' =>	'application/hlp',
			'htc' =>	'text/x-component',
			'htm' =>	'text/html',
			'html' =>	'text/html',
			'htmls' =>	'text/html',
			'htt' =>	'text/webviewhtml',
			'ice' =>	'x-conference/x-cooltalk',
			'ico' =>	'image/x-icon',
			'inf' =>	'application/inf',
			'jam' =>	'audio/x-jam',
			'jav' =>	'text/plain',
			'java' =>	'text/plain',
			'jcm' =>	'application/x-java-commerce',
			'jfif' =>	'image/jpeg',
			'jfif-tbnl' =>	'image/jpeg',
			'jpe' =>	'image/jpeg',
			'jpeg' =>	'image/jpeg',
			'jpg' =>	'image/jpeg',
			'jps' =>	'image/x-jps',
			'js' =>	'text/javascript',
			'latex' =>	'application/x-latex',
			'lha' =>	'application/octet-stream',
			'lhx' =>	'application/octet-stream',
			'list' =>	'text/plain',
			'lsp' =>	'application/x-lisp',
			'lst' =>	'text/plain',
			'lzx' =>	'application/octet-stream',
			'm3u' =>	'audio/x-mpequrl',
			'man' =>	'application/x-troff-man',
			'mid' =>	'audio/x-mid',
			'midi' =>	'audio/midi',
			'mod' =>	'audio/mod',
			'mov' =>	'video/quicktime',
			'movie' =>	'video/x-sgi-movie',
			'mp2' =>	'video/x-mpeq2a',
			'mp3' =>	'audio/mpeg3',
			'mpa' =>	'audio/mpeg',
			'mpeg' =>	'video/mpeg',
			'mpg' =>	'video/mpeg',
			'mpga' =>	'audio/mpeg',
			'pas' =>	'text/pascal',
			'pcl' =>	'application/x-pcl',
			'pct' =>	'image/x-pict',
			'pcx' =>	'image/x-pcx',
			'pdf' =>	'application/pdf',
			'pic' =>	'image/pict',
			'pict' =>	'image/pict',
			'pl' =>	'text/plain',
			'pm' =>	'image/x-xpixmap',
			'pm4' =>	'application/x-pagemaker',
			'pm5' =>	'application/x-pagemaker',
			'png' =>	'image/png',
			'pot' =>	'application/mspowerpoint',
			'ppa' =>	'application/vnd.ms-powerpoint',
			'pps' =>	'application/mspowerpoint',
			'ppt' =>	'application/powerpoint',
			'ps' =>	'application/postscript',
			'psd' =>	'application/octet-stream',
			'pwz' =>	'application/vnd.ms-powerpoint',
			'py' =>	'text/x-script.phyton',
			'pyc' =>	'applicaiton/x-bytecode.python',
			'qt' =>	'video/quicktime',
			'qtif' =>	'image/x-quicktime',
			'ra' =>	'audio/x-realaudio',
			'ram' =>	'audio/x-pn-realaudio',
			'rm' =>	'audio/x-pn-realaudio',
			'rpm' =>	'audio/x-pn-realaudio-plugin',
			'rtx' =>	'text/richtext',
			'rv' =>	'video/vnd.rn-realvideo',
			'sgml' =>	'text/sgml',
			'sh' =>	'text/x-script.sh',
			'shtml' =>	'text/x-server-parsed-html',
			'ssi' =>	'text/x-server-parsed-html',
			'tar' =>	'application/x-tar',
			'tcl' =>	'application/x-tcl',
			'text' =>	'text/plain',
			'tgz' =>	'application/x-compressed',
			'tif' =>	'image/tiff',
			'tiff' =>	'image/tiff',
			'txt' =>	'text/plain',
			'uri' =>	'text/uri-list',
			'vcd' =>	'application/x-cdlink',
			'vmd' =>	'application/vocaltec-media-desc',
			'vrml' =>	'application/x-vrml',
			'vsd' =>	'application/x-visio',
			'vst' =>	'application/x-visio',
			'vsw' =>	'application/x-visio',
			'wav' =>	'audio/wav',
			'wmf' =>	'windows/metafile',
			'xla' =>	'application/excel',
			'xla' =>	'application/x-msexcel',
			'xlb' =>	'application/excel',
			'xlc' =>	'application/excel',
			'xld' =>	'application/excel',
			'xlk' =>	'application/excel',
			'xll' =>	'application/excel',
			'xlm' =>	'application/x-excel',
			'xls' =>	'application/excel',
			'xlt' =>	'application/excel',
			'xlv' =>	'application/excel',
			'xlw' =>	'application/x-msexcel',
			'xm' =>	'audio/xm',
			'xml' =>	'text/xml',
			'z' =>	'application/x-compressed',
			'zip' =>	'multipart/x-zip');
	
		public function __get($k){}
		public function __set($k, $v){}
		private function __sleep(){}
		private function __wakeup(){}
		public function setRedirect($location)
		{
			if ($location !== null){ header('Location: '.$location); exit; }
		}
		public function setNotFound()
		{
			$this->setResponseCode(404);
		}
		public function set($k, $v)
		{
			if (!self::isSentHeaders() && $k !== null && $v !== null)
			{
				header($k.': '.$v);
			}
		}
		public function setContentType($type)
		{
			if ($type !== null)
			{
				header('Content-type: '.$type);
				return true;
			}
			return false;
		}
		public function getMimeType($type)
		{
			if ($type !== null && isset($this->m_aHttpMimeTypes[$type]))
			{
				return $this->m_aHttpMimeTypes[$type];
			}
			return null;
		}
		public function setNoCache()
		{
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header('Cache-Control: post-check=0, pre-check=0', false);
			header('Pragma: no-cache');
		}
		public function isSent($header)
		{
			$headers = headers_list();
	    $header = trim($header, ': ');
	    foreach ($headers as $hdr)
	    {
	        if (stripos($hdr, $header) !== false){ return true; }
	    }
	    return false;
		}
		public function isSentHeaders()
		{
			return headers_sent();
		}
		public function getList()
		{
			return headers_list();
		}
		public function setResponseCode($code)
		{
			if ($code !== null && is_numeric($code) && isset($this->m_aHttpStatusCodes[$code]))
			{
				$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
				header($protocol.' '.$code.' '.$this->m_aHttpStatusCodes[$code]);
				return true;
			}
			return false;
		}
	}
}
?>