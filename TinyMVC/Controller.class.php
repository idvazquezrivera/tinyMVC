<?php
class Controller
{
	public $_data = array();
	public $_render_content = null;
	public $layout = null;
	public $modelsDirectoryPath;
	public function __construct()
	{
		$this->modelsDirectoryPath = MODELS_PATH_DIR;
		spl_autoload_register(array($this,	'load_models'));
	}
	
	public function loadModel($model)
	{
		return new $model();
	}

	public function set($var_name, $var_value)
	{
		$this->_data[$var_name] = $var_value;
	}

	public function redirect($url)
	{
		if(isset($_SERVER['HTTPS'])){
			$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		}
		else{
			$protocol = 'http';
		}
		header ("Location:". $protocol . "://" .  $_SERVER['HTTP_HOST'].$url);
	}

	public function render($controller = null, $view)
	{
		ob_start();
		extract($this->_data, EXTR_SKIP);
		$controller = $controller != null ? $controller : get_class($this);
		include($_SERVER['DOCUMENT_ROOT'].'/App/Views/'.$controller.'/'.$view.'.php');
		$content_html = ob_get_contents();
		ob_end_clean();
		$this->_render_content = $content_html;
	}

	public function renderLayout()
	{
		$layout = $this->layout === null ? 'Default' : $this->layout;
		ob_start();
		extract(array('content' => $this->_render_content), EXTR_SKIP);
		include($_SERVER['DOCUMENT_ROOT'].'/App/Views/Layouts/'.$layout.'.php');
		$layout_content = ob_get_contents();
		ob_end_clean();
		return $layout_content;
	}

	public function load_models($model)
	{
		if ($model) {
			set_include_path($this->modelsDirectoryPath);
			spl_autoload_extensions('.php');
			spl_autoload($model);
		}
	}
}
