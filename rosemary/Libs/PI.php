<?php
/**
* 
*/
class PI
{
	private $action;
	private $controller;
	private $controllerFile;
	static public $data = array();
	function __construct()
	{
		self::$data['get'] = magic_quotes($_GET);                         //get�������������
		self::$data['post'] = magic_quotes($_POST);                       //post�������������
		self::$data['method'] = $_SERVER['REQUEST_MOTHOD'];                //����ķ���
		self::$data['debug']  = PI_DEBUG;
		unset($_POST, $_GET);
	}
	public function run()
	{
		$get = $this->get('get');
		$this->action = $get['a'] ? $get['a'] : PI_DEFAULT_ACTION;       //��÷�����
		$this->controller = $get['c'] ? $get['c'] : PI_DEFAULT_CONTROLLER;     //��ÿ�������
        //������������ĸ��д�����˴���
        $this->controller = ucfirst(preg_replace("/[^a-z\_1-9]/i", "", $this->controller)).'Controller';
		//�������ļ�
		$this->controllerFile = PI_APP_ROOT.'controllers/'.$this->controller.'.php';
		//��������ʼ��
		require_once($this->controllerFile);

		if (class_exists($this->controller))
		{
			$objcontroller = new $this->controller;                            //���������������
			if (is_object($objcontroller))
			{
				$obj=$objcontroller->{$this->action}();                       //���ÿ�������ķ���
			}
			else
			{
				//header("location:".PI_ERROR_404);
			}
		}

	}

	/**
	 *  ��õ�����
	 *
     *  @string  $key  ����  ��get��ʽ����post��ʽ
     *  @string  $field  �����ʽ���ݣ������data�Ƕ�ά����ʱ��
     */
	static public function get($key = '', $field = '')
	{
		if ($key === '')
			{
				return self::$data['get'];
			}
		else
			{
				return $field === '' ? self::$data[$key] : self::$data[$key][$field];
			}
	}


	
}
class Load
{
	/** 
	 *  ������ͼ
	 * @param string  $tpl : ��ͼ��
	 * @param array   $data: ��������
	 * @return object
	*/
	public function view($tpl,$datas)
	{
		if(!empty($datas))
		{
			foreach ($$datas as $key => $value)
			{
				$$key = $value;
			}
		}
		//��������ͼ·��
		$tplFile = PI_VIEW_ROOT.'tpl/'.$tpl.'.php';
		if (file_exists($tplFile)) 
		{
			require_once($tplFile);
		}

	}
}
/**
 * ��������
 *
 * 
 */
abstract class Controller
{
	protected $load;
	public $debug;

	function __construct()
	{
		$this->load  = new Load();
		//$this->debug = &PI::$data['debug'];
	}
	public function get($key = '', $field = '')
	{
		return PI::get($key, $field);
	}

}

//�������ô���ħ������
function magic_quotes($value, $flag = FALSE)
{
	if (!get_magic_quotes_gpc() || $flag)
	{
		return is_array($value) ? array_map('magic_quotes', $value) : addslashes($value);
	}
	else
	{
		return $value;
	}
}

?>