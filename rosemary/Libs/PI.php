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
		self::$data['get'] = magic_quotes($_GET);                         //get请求过来的数据
		self::$data['post'] = magic_quotes($_POST);                       //post请求过来的数据
		self::$data['method'] = $_SERVER['REQUEST_MOTHOD'];                //请求的方法
		self::$data['debug']  = PI_DEBUG;
		unset($_POST, $_GET);
	}
	public function run()
	{
		$get = $this->get('get');
		$this->action = $get['a'] ? $get['a'] : PI_DEFAULT_ACTION;       //获得方法名
		$this->controller = $get['c'] ? $get['c'] : PI_DEFAULT_CONTROLLER;     //获得控制器名
        //控制器名首字母大写及过滤处理
        $this->controller = ucfirst(preg_replace("/[^a-z\_1-9]/i", "", $this->controller)).'Controller';
		//控制器文件
		$this->controllerFile = PI_APP_ROOT.'controllers/'.$this->controller.'.php';
		//控制器初始化
		require_once($this->controllerFile);

		if (class_exists($this->controller))
		{
			$objcontroller = new $this->controller;                            //声明控制器类对象
			if (is_object($objcontroller))
			{
				$obj=$objcontroller->{$this->action}();                       //调用控制器类的方法
			}
			else
			{
				//header("location:".PI_ERROR_404);
			}
		}

	}

	/**
	 *  获得的数据
	 *
     *  @string  $key  键名  如get方式或则post方式
     *  @string  $field  数组格式数据（针对于data是二维数组时）
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
	 *  加载视图
	 * @param string  $tpl : 视图名
	 * @param array   $data: 数据数组
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
		//完整的视图路径
		$tplFile = PI_VIEW_ROOT.'tpl/'.$tpl.'.php';
		if (file_exists($tplFile)) 
		{
			require_once($tplFile);
		}

	}
}
/**
 * 控制器类
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

//根据设置处理魔术引用
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