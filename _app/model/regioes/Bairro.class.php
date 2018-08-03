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
}
