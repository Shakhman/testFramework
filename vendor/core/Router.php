<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 16.11.2017
 * Time: 15:37
 */
class Router
{
	protected static $routes = [];
	protected static $route = [];
	
	public static function add($regexp, $route = [])
	{
		self::$routes[$regexp] = $route;
	}
	
	public static function getRoutes()
	{
		return self::$routes;
	}
	
	public static function getRoute()
	{
		return self::$route;
	}
	
	public static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route) {
			if (preg_match("#$pattern#i", $url, $matches)) {
				foreach ($matches as $k => $v) {
					if (is_string($k)) {
						$route[$k] = $v;
					}
				}
				if (!isset($route['action'])) {
					$route['action'] = 'index';
				}
				self::$route = $route;
				
				return true;
			}
		}
		
		return false;
	}
	
	public static function dispatch($url)
	{
		if (self::matchRoute($url)) {
			$controller = self::upperCamelCase(self::$route['controller']);
			
			if (class_exists($controller)) {
				$cObj = new $controller;
				$action = self::lowerCamelCase(self::$route['action']) . 'Action';
				debug($action);
				if (method_exists($cObj, $action)) {
					$cObj->$action();
				} else {
					echo 'Action not found';
				}
				
			} else {
				echo 'no';
			}
		} else {
			http_response_code(404);
			include '404.html';
		}
	}
	
	protected static function upperCamelCase($name)
	{
		$name = str_replace('-', ' ', $name);
		$name = ucwords($name);
		$name = str_replace(' ', '', $name);
		return $name;
	}
	
	protected static function lowerCamelCase($name)
	{
		return lcfirst(self::upperCamelCase($name));
	}
}