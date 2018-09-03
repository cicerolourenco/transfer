<?php 

class Indicacao extends Registro
{
	const TABLENAME = 'indicacao';

	
	public function delete()
	{
		$this->exclui_relacoes();
		return parent::delete();
	}


	public static function lista($filtros=null, $propriedades=null)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		return $rep->load($crit);
	}



	/**
	 * Lista as possíveis indicações para o select (drop-down), incluindo uma opção nula, já que não é obrigatório
	 * @return type
	 */
	public static function lista_select()
	{
		$lista = self::lista();
		if($lista)
		{
			foreach ($lista as $indicacao) 
			{
				$opcoes[$indicacao->id] = $indicacao->nome;
			}
		}

		return $opcoes;
	}




	
	public function exclui_relacoes()
	{
		$rep = TRepository('Reserva');
		$crit = new TCriteria();
		$crit->add(new TFilter('id_indicacao', '=', $this->id));
		$lista = $rep->load($crit);

		if($lista)
		{
			foreach ($lista as $reserva) 
			{
				$reserva->id_indicacao = 0;
				$reserva->store();
			}
		}
	}

}
