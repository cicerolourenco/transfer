<?php 

class Comuna extends Registro
{
	const TABLENAME = 'comuna';


	public static function lista($filtros=null, $propriedades=null)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->setProperty('order', 'nome');
		return $rep->load($crit);
	}
	


	public static function lista_select()
	{
		$lista = self::lista();
		if($lista)
		{
			foreach ($lista as $comuna) 
			{
				$opcoes[$comuna->id] = $comuna->nome;
			}
		}

		return $opcoes;
	}

}
