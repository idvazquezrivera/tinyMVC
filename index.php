<?php
	define('TINY_MVC_DIR', 'TinyMVC/');
	define('MODELS_PATH_DIR', 'App/Models');
	define('VIEWS_PATH_DIR','App/Views');
	define('CONTROLLERS_PATH_DIR', 'App/Controllers');

	set_include_path(get_include_path().PATH_SEPARATOR.TINY_MVC_DIR);
	spl_autoload_extensions('.php');
	spl_autoload_register();

	$TinyMVC = new TinyMVC();
	$TinyMVC->start();
