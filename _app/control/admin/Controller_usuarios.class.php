<?php

namespace admin;

class Controller_usuarios extends \Controller
{
	public function show_index() 
	{
		$this->show_listar();
	}


	public function show_listar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/usuarios/listar.php');
		$this->view->display();
	}


	public function show_editar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/usuarios/editar.php');

		$id = floor($this->params[2]);

		if($id==0)
		{
			$modo = 'inserir';
			if($_POST)
			{
				$objeto = new \UsuarioCMS();
				$objeto->fromVetor($_POST);

				if($erro==0)
				{
					$objeto->senha = \Utils::pwenc($objeto->senha1);
					$objeto->senha1 = null;
					$objeto->senha2 = null;
					$id = $objeto->store();
					header('Location: ' . DIR_ADM_HTM_ROOT . 'usuarios/editar/' . $id);
				}
				else
				{
					$msg_erro = 'Erro na criação do item.';
				}
			}
		}
		else
		{
			$objeto = new \UsuarioCMS(floor($id));
			if(!$objeto->id)
			{
				// não encontrou no banco, manda pra lista
				header('Location: ' . DIR_ADM_HTM_ROOT . 'usuarios/listar/');
			}
			else
			{
				if($_POST)
				{
					$modo = 'editar';
					//var_dump($_POST);
					$objeto->fromVetor($_POST);

					if ($objeto->senha1 != $objeto->senha2) 
					{
						$erro = 1;
						$msg_erro = 'As senhas devem ser idênticas.';
					}

					if($erro==0)
					{
						if($objeto->senha1!='')
						{
							$objeto->senha = \Utils::pwenc($objeto->senha1);
						}
						$objeto->senha1 = null;
						$objeto->senha2 = null;
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




	public function show_excluir() 
	{
		$objeto = new \UsuarioCMS(floor($this->params[2]));
		if($objeto->id && $objeto->pode_deletar())
		{
			$objeto->delete();
		}

		header('Location: ' . DIR_ADM_HTM_ROOT . 'usuarios/listar');
	}



}