<?php
/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 16.11.2017
 * Time: 15:18
 */

use vendor\core\Router;

error_reporting(-1);

$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . 'vendor/core');
define('ROOT', dirname(__DIR__));
define('APP', dirname(__DIR__) . '/app');
define('LAYOUT', 'default');


require_once '../vendor/libs/functions.php';

spl_autoload_register(function($class) {
	$file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
	if (is_file($file)) {
		require_once $file;
	}
});

Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'PageControler']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'PageControler', 'action' => 'view']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);