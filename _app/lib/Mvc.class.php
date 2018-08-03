<?php

class Mvc {
	private $url;
	private $explode;
	public $folder = '';
	public $namespace = '';
	public $controller;
	public $action;
	public static  $params;

	public function  __construct($pasta=null)
	{
		 $this->setUrl();
		 $this->setExplode();
		 $this->setController($pasta);
		 $this->setAction();
		 $this->setParams();
	}

	private function setUrl()
	{
		//var_dump($_GET);
		$this->url = isset($_GET['url']) ? $_GET['url'] : 'index/index';
	}

	private function setExplode()
	{
		$this->explode = explode('/',$this->url);
	}

	private function setController($pasta=null)
	{
		$this->controller = 'Controller_' . str_replace('-', '_', $this->explode[0]);
		if($pasta)
		{
			$this->namespace = $pasta . "\\";
			$this->folder = $pasta . "/";
		}
	}

	private function setAction()
	{
		$act = (!isset($this->explode[1]) || $this->explode[1] == null || $this->explode[1] == 'index') ? 'show_index' : 'show_' . str_replace('-', '_', $this->explode[1]);
		$this->action = $act;
//		die($this->action);
	}

	private function setParams()
	{
		if(end($this->explode) == null)
		{
			array_pop($this->explode);
		}
		$i=0;
		self::$params = $this->explode;
	}

	public static function getParams()
	{
		return self::$params;
	}

	
	public function run()
	{
		$controller_path =  DIR_CONTROLLER . $this->folder . $this->controller.'.class.php';  //echo 'CONTROLLER_PATH:|'.$controller_path . '|';
		
		if(!file_exists($controller_path))
		{
			$this->controller = 'Controller_404';
		}
		
		$nome_app = $this->namespace . $this->controller; //echo 'NOME_APP:|' . $nome_app . '|';

		$app = new $nome_app();
		$action = $this->action;
		if(method_exists($app, $action)){
			$app->$action();
		}  elseif(method_exists($app, 'show_index')) {
			$app->show_index();
		}  else {
			die('Erro MVC');
		}
	}


}