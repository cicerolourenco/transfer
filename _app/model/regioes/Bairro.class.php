<?php 

class Bairro extends Registro
{
	const TABLENAME = 'bairro';


	public static function lista($filtros=null, $propriedades=null)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		return $rep->load($crit);
	}



	public function get_comuna()
	{
		$comuna = new Comuna($this->id_comuna);
		return $comuna->nome;
	}
	




	public static function lista_select()
	{
		$lista = self::lista();
		if($lista)
		{
			foreach ($lista as $bairro) 
			{
				$opcoes[$bairro->id] = $bairro->nome;
			}
		}

		return $opcoes;
	}



	
	public function pode_deletar()
	{
		$bool_pode = true;

		if($bool_pode)
		{
			$rep = new TRepository('Reserva');
			$crit = new TCriteria();
			$crit->add(new TFilter('id_bairro', '=', $this->id));

			if($rep->count($crit)>0) $bool_pode = false;
		}

		return $bool_pode;
	}
}
