<?php

function load_config($class_name)
{
	$path_to_file = 'config/' . $class_name . '.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}

function load_model($class_name)
{
	$path_to_file = 'models/' . $class_name . '.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}

function load_controller($controller_name)
{
	$path_to_file = 'controllers/' . $controller_name . '.php';

	if (file_exists($path_to_file)) {
		require $path_to_file;
	}
}

spl_autoload_register('load_config');
spl_autoload_register('load_model');
spl_autoload_register('load_controller');