<?php 

class Reserva extends Registro
{
	const TABLENAME = 'reserva';


	public static function lista($filtros=null, $propriedades=null)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		return $rep->load($crit);
	}
	


	/**
	 * Retorna as próximas chegadas ou partidas
	 * @param int $limit 
	 * @return array Array com as reservas em ordem
	 */
	public static function get_proximas($limit = 10)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('quando_chega','>','NOW()'));
		if(floor($limit)>0)
			$crit->setProperty('limit', floor($limit));
		$crit->setProperty('order', 'quando_chega');
		$lista_chegadas = $rep->load($crit);
		foreach ($lista_chegadas as $reserva) 
		{
			$reserva->quando_criterio = $reserva->quando_chega;
			$reserva->tipo = 'chegada';
			$lista[] = $reserva;
		}


		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('quando_parte','>','NOW()'));
		$crit->setProperty('limit', floor($limit));
		$crit->setProperty('order', 'quando_parte');
		$lista_partidas = $rep->load($crit);
		foreach ($lista_partidas as $reserva) 
		{
			$reserva->quando_criterio = $reserva->quando_parte;
			$reserva->tipo = 'partida';
			$lista[] = $reserva;
		}

		// ordena e limita
		usort($lista, array(__CLASS__, "cmp"));
		if($limit>0) $lista = array_slice($lista, 0, $limit);

		return $lista;
	}


	public static function cmp($a, $b)
	{
		return strcmp($a->quando_criterio, $b->quando_criterio);
	}
	


	/**
	 * Calcula o preço da reserva, com base na comuna e nas quantidades de adultos e crianças
	 * @return type
	 */
	public function calcula_preco()
	{
		$comuna = new Comuna($this->id_comuna);
		return self::calcula($comuna, $this->qtd_adt, $this->qtd_chd_5, $this->qtd_chd_10);
	}


	public static function calcula($comuna, $qtd_adt, $qtd_chd_5=0, $qtd_chd_10=0)
	{
		// crianças de 5 a 9 anos representam "meia pessoa"
		// crianças até 4 anos não contam
		$qtd_considerada = $qtd_adt + ($qtd_chd_10/2);

		if($qtd_considerada<=3)
			$preco = $comuna->preco3;
		elseif($qtd_considerada<5)
			$preco = $comuna->preco4;
		else
			$preco = $comuna->preco5 * $qtd_considerada;

		return $preco;
	}


	public function get_qtd_pax()
	{
		return $this->qtd_adt + $this->qtd_chd_5 + $this->qtd_chd_10;
	}


	public function get_comuna()
	{
		$comuna = new Comuna($this->id_comuna);
		return $comuna->nome;
	}

	public function get_bairro()
	{
		$bairro = new Bairro($this->id_bairro);
		return $bairro->nome;
	}

	public function get_indicacao()
	{
		$indicacao = new Indicacao($this->id_indicacao);
		if($indicacao->id) $nome = $indicacao->nome;
		return $nome;
	}




	public static function get_eventos()
	{
		$destino = DIR_ADM_HTM_ROOT . 'reservas/editar/';
		$lista = self::get_proximas(0);
		if($lista)
		{
			foreach ($lista as $reserva) 
			{
				$objeto = new StdClass();
				$objeto->id = $reserva->id;
				$objeto->resourceId = 'a';
				$objeto->title = $reserva->nome;
				$objeto->start = $reserva->quando_criterio;
				$objeto->url = $destino . $reserva->id;
				$objeto->color = $reserva->tipo=='partida' ? '#900' : '#090';
				$retorno_json[] = $objeto;
			}
		}


		/*
		$retorno_json = "{
              id: '1',
              resourceId: 'a',
              title: 'grupo da França',
              start: '2018-07-01 12:30:00',
              url: 'reservas/editar/1',
              color: '#090'
            },
            {
              id: '2',
              resourceId: 'a',
              title: 'Staff',
              start: '2018-06-29 17:15:00',
              url: 'reservas/editar/2',
              color: '#090'
            },
            {
              id: '3',
              resourceId: 'a',
              title: 'André e Simone lofwreiu fwieu bwvie bwvib reivb weri bvierb viureve',
              start: '2018-06-29 17:30:00',
              url: 'reservas/editar/3',
              color: '#900'
            }";	
        */	

        return json_encode($retorno_json);
	}
}
