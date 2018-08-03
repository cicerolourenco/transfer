<?php

namespace admin;

class Controller_login extends \Controller
{
	public function show_index() 
	{
		if($_POST)
		{
			$retorno = \UsuarioCMS::submete_login($_POST['email'], $_POST['senha']);
			if($retorno[0]==0)
			{
				header('Location: ' . DIR_ADM_HTM_ROOT);
			}
			else
			{
				$erro = $retorno;
			}
		}

		$this->view = new \View('admin/login.php');
		$this->view->assign('erro', $retorno);
		$this->view->display();
	}
}