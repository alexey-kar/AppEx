<?php
namespace Base
{
	class CHttpRequestBuilder extends CSingleton
	{
		public function get($url, $args, $resFile = null)
		{
			$opts = array(
				'http' => array(
					'method' => 'GET',
					'header' => "Content-type: application/x-www-form-urlencoded\r\n".
					"User-agent:Opera 10.00\r\nContent-length:".strlen($post)."\r\nConnection:close",
					'content' => http_build_query($args)
				)
			);
			
			$context = stream_context_create($opts);
			$res = file_get_contents($url, false, $context);
			if ($resFile == null)
			{
				return array(
						'content' => $res,
						'header' => $http_response_header
						);
			}
			else
			{
				return file_put_contents($resFile, $res);
			}
			return false;
		}
		public function post($url, $args, $resFile = null)
		{
			$opts = array(
					'http' => array(
						'method' => 'POST',
						'header' => "Content-type: application/x-www-form-urlencoded\r\n".
						"User-agent:Opera 10.00\r\nContent-length:".strlen($post)."\r\nConnection:close",
						'content' => http_build_query($args)
					)
			);
			
			$context = stream_context_create($opts);
			$res = file_get_contents($url, false, $context);
			if ($resFile == null)
			{
				return array(
						'content' => $res,
						'header' => $http_response_header
						);
			}
			else
			{
				return file_put_contents($resFile, $res);
			}
			return false;
		}
	}
}
?>