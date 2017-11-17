<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 16.11.2017
 * Time: 17:40
 */

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
	//public $layout = 'main';
	
	public function indexAction()
	{
		//$this->layout = false;
		//$this->view = 'test';
		$model = new Main();
		//$res = $model->query('CREATE TABLE users SELECT * FROM protest14.users');
		$users = $model->findAll();
		//$user = $model->findOne(2);
		//$d = $model->findLike('область', 'territory');
		$this->set(['users' => $users]);
		
	}
}