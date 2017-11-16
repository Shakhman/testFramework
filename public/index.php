<?php
/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 16.11.2017
 * Time: 15:18
 */

$query = rtrim($_SERVER['QUERY_STRING'], '/');
define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . 'vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');


require_once '../vendor/core/Router.php';
require_once '../vendor/libs/functions.php';
//require_once '../app/controllers/Main.php';

spl_autoload_register(function($class) {
	$file = APP . "/controllers/$class.php";
	if (is_file($file)) {
		require_once $file;
	}
});



Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

//debug(Router::getRoutes());

Router::dispatch($query);