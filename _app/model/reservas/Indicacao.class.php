<?php 

class Indicacao extends Registro
{
	const TABLENAME = 'indicacao';


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
}
