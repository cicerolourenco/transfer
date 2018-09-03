<?php

namespace admin;

class Controller_parceiros extends \Controller
{
	public function show_index() 
	{
		$this->show_listar();
	}


	public function show_listar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/parceiros/listar.php');
		$this->view->display();
	}


	public function show_editar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/parceiros/editar.php');

		$id = floor($this->params[2]);

		if($id==0)
		{
			$modo = 'inserir';
			if($_POST)
			{
				if($erro==0)
				{
					$objeto = new \Indicacao();
					$objeto->fromVetor($_POST);

					$id = $objeto->store();
					header('Location: ' . DIR_ADM_HTM_ROOT . 'parceiros/editar/' . $id);
				}
			}
		}
		else
		{
			$objeto = new \Indicacao(floor($id));
			if(!$objeto->id)
			{
				// não encontrou no banco, manda pra lista
				header('Location: ' . DIR_ADM_HTM_ROOT . 'parceiros/listar/');
			}
			else
			{
				if($_POST)
				{
					$modo = 'editar';
					$objeto->fromVetor($_POST);

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




	public function show_excluir() 
	{
		$objeto = new \Indicacao(floor($this->params[2]));
		if($objeto->id && $objeto->pode_deletar())
		{
			$objeto->delete();
		}

		header('Location: ' . DIR_ADM_HTM_ROOT . 'parceiros/listar');
	}

}