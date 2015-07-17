<?php
$debug=true;
//定义是否显示错误
define("PI_DEBUG", $debug);

//定义当前应用程序的根目录
/*dirname(path);返回路径中的目录部分
  DIRECTORY_SEPARATOR :代表目录分隔符
*/
define("PI_APP_ROOT",dirname(__FILE__).DIRECTORY_SEPARATOR);  // D:/WAMP/www/rosemary/


//框架根路径
define("PI_CORE_ROOT", PI_APP_ROOT.'Libs/');                 // D:/WAMP/www/rosemary/Libs/
define("PI_VIEW_ROOT", PI_APP_ROOT.'Views/');                  // D:/WAMP/www/rosemary/Views/
define('PI_DEFAULT_CONTROLLER', 'login');            // 默认控制器文件
define('PI_DEFAULT_ACTION',     'index');           // 默认方法
//设置时区
date_default_timezone_get("Asia/Shanghai");

//判断是否显示error
if(PI_DEBUG)
{
	error_reporting(E_ALL);
}
else
{
	error_reporting(0);
}

//加载主体
require_once(PI_CORE_ROOT.'PI.php');

//运行
$app=new PI();
$app->run();
?>