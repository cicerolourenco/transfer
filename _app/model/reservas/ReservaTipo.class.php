<?php 

class ReservaTipo extends Registro
{
	const TABLENAME = 'reserva_tipo';


	public static function lista($filtros=null, $propriedades=null)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		return $rep->load($crit);
	}


	public static function lista_select()
	{
		$lista = self::lista();
		if($lista)
		{
			foreach ($lista as $item) 
			{
				$opcoes[$item->id] = $item->nome;
			}
		}

		return $opcoes;
	}
}
