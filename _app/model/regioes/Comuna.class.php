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




	
	public function pode_deletar()
	{
		$bool_pode = true;
		
		if($bool_pode)
		{
			$rep = new TRepository('Reserva');
			$crit = new TCriteria();
			$crit->add(new TFilter('id_comuna', '=', $this->id));

			if($rep->count($crit)>0) $bool_pode = false;
		}

		
		if($bool_pode)
		{
			$rep = new TRepository('Bairro');
			$crit = new TCriteria();
			$crit->add(new TFilter('id_comuna', '=', $this->id));

			if($rep->count($crit)>0) $bool_pode = false;
		}
		
		return $bool_pode;
	}


}
