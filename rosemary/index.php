<?php
$debug=true;
//�����Ƿ���ʾ����
define("PI_DEBUG", $debug);

//���嵱ǰӦ�ó���ĸ�Ŀ¼
/*dirname(path);����·���е�Ŀ¼����
  DIRECTORY_SEPARATOR :����Ŀ¼�ָ���
*/
define("PI_APP_ROOT",dirname(__FILE__).DIRECTORY_SEPARATOR);  // D:/WAMP/www/rosemary/


//��ܸ�·��
define("PI_CORE_ROOT", PI_APP_ROOT.'Libs/');                 // D:/WAMP/www/rosemary/Libs/
define("PI_VIEW_ROOT", PI_APP_ROOT.'Views/');                  // D:/WAMP/www/rosemary/Views/
define('PI_DEFAULT_CONTROLLER', 'login');            // Ĭ�Ͽ������ļ�
define('PI_DEFAULT_ACTION',     'index');           // Ĭ�Ϸ���
//����ʱ��
date_default_timezone_get("Asia/Shanghai");

//�ж��Ƿ���ʾerror
if(PI_DEBUG)
{
	error_reporting(E_ALL);
}
else
{
	error_reporting(0);
}

//��������
require_once(PI_CORE_ROOT.'PI.php');

//����
$app=new PI();
$app->run();
?>