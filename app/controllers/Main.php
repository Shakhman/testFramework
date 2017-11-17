<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 16.11.2017
 * Time: 17:40
 */

namespace app\controllers;

use vendor\core\base\Controller;

class Main extends App
{
	//public $layout = 'main';
	
	public function indexAction()
	{
		//$this->layout = false;
		//$this->view = 'test';
		$name = 'asdasd';
		$this->set(['name' => $name]);
	}
}