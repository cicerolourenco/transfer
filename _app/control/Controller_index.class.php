<?php
class Controller_index extends Controller
{
	public function show_index() 
	{
		var_dump($this->params);
		die('HOME aberta do site');
		$this->view = new View('home.php');

		$this->view->display();
	}

}