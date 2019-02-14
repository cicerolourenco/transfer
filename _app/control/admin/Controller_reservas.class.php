<?php

namespace admin;

class Controller_reservas extends \Controller
{
	public function show_index() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/reservas/agenda.php');
		$this->view->display();
	}


	public function show_listar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/reservas/listar.php');
		$this->view->display();
	}


	public function show_editar() 
	{
		\UsuarioCMS::autentica();
		$this->view = new \View('admin/reservas/editar.php');

		$id = floor($this->params[2]);

		if($id==0)
		{
			$modo = 'inserir';
			if($_POST)
			{
				// testando as datas, pra confirmar 
				$dt_chega = $_POST['tiporeserva']==3 ? '' : \Utils::str_quando_to_mysql($_POST['quando_chega']);
				$dt_parte = $_POST['tiporeserva']==2 ? '' : \Utils::str_quando_to_mysql($_POST['quando_parte']);

				/*
				$datetime_chega = new \Datetime($dt_chega);
				$datetime_parte = new \Datetime($dt_parte);
				$intervalo = $datetime_parte->diff($datetime_chega);

				if($intervalo<0)
				{
					$msg_erro = 'As datas de chegada e partida estão fora da ordem cronológica.';
				}
				*/

				if($erro==0)
				{
					$objeto = new \Reserva();
					$objeto->fromVetor($_POST);
					$objeto->quando_chega = $dt_chega;
					$objeto->quando_parte = $dt_parte;
					$objeto->bool_duty_free = $_POST['bool_duty_free'] ? 1 : 0;
					$objeto->bool_recalcular = null;
					$objeto->preco = $objeto->calcula_preco();
					$bairro = new \Bairro(floor($_POST['id_bairro']));
					$objeto->id_comuna = $bairro->id_comuna;
					$objeto->quando = date('Y-m-d H:i');

					$id = $objeto->store();
					header('Location: ' . DIR_ADM_HTM_ROOT . 'reservas/editar/' . $id);
				}
			}
		}
		else
		{
			$objeto = new \Reserva(floor($id));
			if(!$objeto->id)
			{
				// não encontrou no banco, manda pra lista
				header('Location: ' . DIR_ADM_HTM_ROOT . 'reservas/listar/');
			}
			else
			{
				if($_POST)
				{
					$modo = 'editar';
					//var_dump($_POST);
					$objeto->fromVetor($_POST);

					// testando as datas, pra confirmar 
					$dt_chega = $objeto->tiporeserva==3 ? '' : \Utils::str_quando_to_mysql($_POST['quando_chega']);
					$dt_parte = $objeto->tiporeserva==2 ? '' : \Utils::str_quando_to_mysql($_POST['quando_parte']);

					/*
					$datetime_chega = new \Datetime($dt_chega);
					$datetime_parte = new \Datetime($dt_parte);

					if($datetime_parte <= $datetime_chega)
					{
						$erro = 1;
						$msg_erro = 'As datas de chegada e partida estão fora da ordem cronológica.';
					}
					*/

					if($erro==0)
					{
						$objeto->bool_duty_free = $_POST['bool_duty_free'] ? 1 : 0;
						$objeto->quando_chega = $dt_chega;
						$objeto->quando_parte = $dt_parte;
						$objeto->bool_recalcular = null;
						$bairro = new \Bairro(floor($_POST['id_bairro']));
						$objeto->id_comuna = $bairro->id_comuna;
						if($_POST['bool_recalcular'])
						{
							$objeto->preco = $objeto->calcula_preco();	
						}
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
					if(floor($erro)==0 && ($chave=='quando_chega' || $chave=='quando_parte')) {
						$valor = $valor==null ? '' : date('d/m/Y H:i', strtotime($valor));
						$this->view->assign($chave, $valor);
					} elseif(floor($erro)==0 && $chave=='hora_parte_hotel') {
						$valor = $valor==null ? '' : date('H:i', strtotime($valor));
						$this->view->assign($chave, $valor);
					} else {
						$this->view->assign($chave, $valor);
					}
				}
			}
			$this->view->assign('objeto', $objeto);
			$this->view->assign('tipo', $objeto->get_tipo());
			$this->view->assign('bairro', $objeto->get_bairro());
			$this->view->assign('indicacao', $objeto->get_indicacao());
		}

		$this->view->assign('msg_erro', $msg_erro);
		$this->view->assign('msg_sucesso', $msg_sucesso);
		$this->view->assign('modo', $modo);
		$this->view->display();
	}




	public function show_excluir() 
	{
		$objeto = new \Reserva(floor($this->params[2]));
		if($objeto->id && $objeto->pode_deletar())
		{
			$objeto->delete();
		}

		header('Location: ' . DIR_ADM_HTM_ROOT . 'reservas/listar');
	}

}