<?php
/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 17.11.2017
 * Time: 18:09
 */

namespace vendor\core\base;

class View
{
	public $route = [];
	public $view;
	public $layout;
	
	public function __construct($route, $layout = '', $view = '')
	{
		$this->route = $route;
		$this->view = $view;
		
		if ($layout === false) {
			$this->layout = false;
		} else {
			$this->layout = $layout ?: LAYOUT;
		}
		
	}
	
	public function render($vars)
	{
		extract($vars);
		$fileView = APP . '/views/' . $this->route['controller'] . '/' . $this->view . '.php';
		ob_start();
		
		if (is_file($fileView)) {
			require $fileView;
		} else {
			echo 'View not found';
		}
		
		$content = ob_get_clean();
		
		if ($this->layout !== false) {
			$fileLayout = APP . '/views/layouts/' . $this->layout . '.php';
			if (is_file($fileView)) {
				require $fileLayout;
			} else {
				echo 'Layout not found';
			}
		}
	}
}