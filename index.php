<?php 
header('Content-Type:text/html;Charset=utf-8');
define('APP_DEBUG', true);
define('WORKING_PATH',str_replace('\\','/',__DIR__));
define('UPLOAD_ROOT_PATH','/Public/Upload/');
//echo WORKING_PATH.UPLOAD_ROOT_PATH;die;
require "ThinkPHP/ThinkPHP.php";




 ?>