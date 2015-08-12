<?php 
class TinyMVC
{
		protected $_controllerDirectoryPath = array();

		protected $_modelDirectoryPath = array();

		protected $_libraryDirectoryPath = array();

		protected $_controller;

		public function __construct()
		{
			$this->controllersDirectoryPath	= CONTROLLERS_PATH_DIR;
			$this->tinyMVCDirectoryPath		= TINY_MVC_DIR;

			spl_autoload_register(array($this,	'load_controllers'));
			spl_autoload_register(array($this,	'load_tiny_mvc'));
		}

		public function start()
		{
			$url = explode('/', $_SERVER['REQUEST_URI']);

			$controller = empty($url[1]) ? 'Index' : $url[1] ;
			$action = empty($url[2]) ? 'index' : $url[2];

			$this->_controller = new $controller();
			$this->_controller->$action();

			if ($this->_controller->_render_content === null)
				$this->_controller->render(null, $action);

			echo $this->_controller->renderLayout(); 
		}

		public function load_controllers($controller)
		{
			if ($controller) {
				set_include_path($this->controllersDirectoryPath);
				spl_autoload($controller."Controller");
			}
		}

		public function load_tiny_mvc($tinyiMVC)
		{
			if ($tinyiMVC) {
				set_include_path($this->tinyMVCDirectoryPath);
				spl_autoload_extensions('.class.php');
				spl_autoload($tinyiMVC);
			}
		}
		
	
}	