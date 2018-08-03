<?php

namespace admin;

class Controller_regioes extends \Controller
{
	/*
	public function show_index() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/regioes/home.php');
		$this->view->display();
	}
	*/


	public function show_listar_comunas() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/regioes/listar_comunas.php');
		$this->view->display();
	}


	public function show_editar_comuna() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/regioes/editar_comuna.php');

		$id = floor($this->params[2]);

		if($id==0)
		{
			$modo = 'inserir';
			if($_POST)
			{
				$objeto = new \Comuna();
				$objeto->fromVetor($_POST);

				if($erro==0)
				{
					$id = $objeto->store();
					header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/editar-comuna/' . $id);
				}
				else
				{
					$msg_erro = 'Erro na criação do item.';
				}
			}
		}
		else
		{
			$objeto = new \Comuna(floor($id));
			if(!$objeto->id)
			{
				// não encontrou no banco, manda pra lista
				header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/listar-comunas/');
			}
			else
			{
				if($_POST)
				{
					//var_dump($_POST);
					$objeto->fromVetor($_POST);

					//$erro = 1;
					if($erro==1)
					{
						$msg_erro = 'Erro na edição do item.';
						$modo = 'editar';
					}

					if($erro==0)
					{
						$objeto->store();
						$msg_sucesso = 'Dados alterados com sucesso.';
						$modo = 'ver';
					}
				}
				else
				{
					$modo = 'ver';
				}

				foreach($objeto->toArray() as $chave=>$valor)
				{
					$this->view->assign($chave, $valor);
				}
			}
		}

		$this->view->assign('msg_erro', $msg_erro);
		$this->view->assign('msg_sucesso', $msg_sucesso);
		$this->view->assign('modo', $modo);
		$this->view->display();
	}




	public function show_excluir_comuna() 
	{
		$objeto = new \Comuna(floor($this->params[2]));
		if($objeto->id && $objeto->pode_deletar())
		{
			$objeto->delete();
		}

		header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/listar-comunas');
	}



	

	/* -------------------------------------------- */



	public function show_listar_bairros() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/regioes/listar_bairros.php');
		$this->view->display();
	}


	public function show_editar_bairro() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/regioes/editar_bairro.php');

		$id = floor($this->params[2]);

		if($id==0)
		{
			$modo = 'inserir';
			if($_POST)
			{
				$objeto = new \Bairro();
				$objeto->fromVetor($_POST);
				
				$erro = 1;
				if($erro==0)
				{
					$id = $objeto->store();
					header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/editar-bairro/' . $id);
				}
				else
				{
					$msg_erro = 'Erro na criação do item.';
				}
			}
		}
		else
		{
			$objeto = new \Bairro(floor($id));
			if(!$objeto->id)
			{
				// não encontrou no banco, manda pra lista
				header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/listar-bairros/');
			}
			else
			{
				if($_POST)
				{
					//var_dump($_POST);
					$objeto->fromVetor($_POST);

					//$erro = 1;
					if($erro==1)
					{
						$msg_erro = 'Erro na edição do item.';
						$modo = 'editar';
					}

					if($erro==0)
					{
						$objeto->store();
						$msg_sucesso = 'Dados alterados com sucesso.';
						$modo = 'ver';
					}
				}
				else
				{
					$modo = 'ver';
				}

				foreach($objeto->toArray() as $chave=>$valor)
				{
					$this->view->assign($chave, $valor);
				}
			}
			$this->view->assign('bairro', $objeto);
		}

		$this->view->assign('msg_erro', $msg_erro);
		$this->view->assign('msg_sucesso', $msg_sucesso);
		$this->view->assign('modo', $modo);
		$this->view->display();
	}




	public function show_excluir_bairro() 
	{
		$objeto = new \Bairro(floor($this->params[2]));
		if($objeto->id && $objeto->pode_deletar())
		{
			$objeto->delete();
		}

		header('Location: ' . DIR_ADM_HTM_ROOT . 'regioes/listar-bairros');
	}

}