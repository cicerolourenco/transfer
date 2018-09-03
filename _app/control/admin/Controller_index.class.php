<?php

namespace admin;

class Controller_index extends \Controller
{
	public function show_index() 
	{
		// Verifica a permissão. Se não tiver permissão, encerra a sessão (e redireciona para o login)
		\UsuarioCMS::autentica();

		//die('ADMIN do site');
		$this->view = new \View('admin/home.php');

		$this->view->assign('con_adm_usuario', unserialize($_SESSION['con_adm_usuario']));
		$this->view->display();
	}	
}