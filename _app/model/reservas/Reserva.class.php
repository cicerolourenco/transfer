<?php 

class Reserva extends Registro
{
	const TABLENAME = 'reserva';


	public function store()
	{
		if(!$this->id)
			$this->hash = md5(rand().$this->nome); // define um hash somente ao criar a reserva

		return parent::store();
	}


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
			$reserva->tipo_operacao = 'chegada';
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
			$reserva->tipo_operacao = 'partida';
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
		return self::calcula($comuna, $this->qtd_adt, $this->qtd_chd_5, $this->qtd_chd_10, $this->tiporeserva);
	}


	public static function calcula($comuna, $qtd_adt, $qtd_chd_5=0, $qtd_chd_10=0, $tipo=1)
	{
		// crianças de 5 a 9 anos representam "meia pessoa"
		// crianças até 4 anos não contam
		$qtd_considerada = $qtd_adt + ($qtd_chd_10/2);

		$v_campos[1] = 'preco'; // valor cheio (ida e volta)
		$v_campos[2] = 'ida';
		$v_campos[3] = 'volta';

		if($qtd_considerada<=3)
			$preco = $comuna->{$v_campos[$tipo].'3'};
		elseif($qtd_considerada<5)
			$preco = $comuna->{$v_campos[$tipo].'4'};
		else
			$preco = $comuna->{$v_campos[$tipo].'5'} * $qtd_considerada;

		//Utils::dumpa($preco);
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

	public function get_tipo()
	{
		$tipo = new ReservaTipo($this->tiporeserva);
		return $tipo->nome;
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



	/**
	 * Retorna a mínima data permitida para reserva (com base no horário do Chile)
	 * @return type
	 */
	public static function get_min_date()
	{
		$horario_limite = 18; // hora do dia em que não serão mais aceitas reservas para o dia seguinte
		$antecedencia = 24 - $horario_limite; // limite de horas de antecedência
		$agora = new DateTime(); //Utils::dumpa($agora);
		$amanha = new DateTime('Tomorrow'); //Utils::dumpa($amanha);
		$diff = $agora->diff($amanha);

		// se a antecedência não for suficiente, só permite agendar no dia seguinte
		$dia = $diff->h < $antecedencia ? new DateTime('Tomorrow + 1day') : $amanha;
		return $dia;
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
				$objeto->color = $reserva->tipo_operacao=='partida' ? '#090' : '#900';
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


	/**
	 * Instancia e retorna uma reserva com o hash informado
	 * @param string $hash Hash de identificação da reserva no banco
	 * @return Object | null
	 */
	public static function get_by_hash($hash)
	{
		$hash = filter_var($hash, FILTER_SANITIZE_STRING);
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('hash','=', '"' . $hash . '"'));
		$crit->setProperty('limit', 1);
		$lista = $rep->load($crit);

		if($lista)
			return $lista[0];
		else
			return null;
	}

	
	/**
	 * Avisa a confirmação da reserva por e-mail
	 * @return type
	 */
	public function envia_email()
	{
		$mail_msg = new Email();
		$mail_msg->add($this->email);
		$mail_msg->template = 'reserva_confirmada.htm';
		$mail_msg->Subject = 'Reserva confirmada';
		
		$mail_msg->vetor_replace = array( 	
			'#primeiro_nome#' => Utils::primeiro_nome($this->nome),
			'#nome#' => $this->nome,
			'#email#' => $this->email,
			'#cpf#' => $this->cpf,
			'#telefone#' => Utils::formata_tel($this->telefone),
			'#tiporeserva#' => $this->get_tipo(),
			'#qtd_adt#' => $this->qtd_adt,
			'#qtd_chd_5#' => floor($this->qtd_chd_5),
			'#qtd_chd_10#' => floor($this->qtd_chd_10),
			'#qtd_pax#' => $this->get_qtd_pax(),
			'#bairro#' => $this->get_bairro(),
			'#comuna#' => $this->get_comuna(),
			'#endereco_destino#' => $this->endereco_destino,
			'#quando_chega#' => ($this->quando_chega==null ? '---' : date('d/m/Y à\s H:i', strtotime($this->quando_chega)) ),
			'#quando_parte#' => ($this->quando_parte==null ? '---' : date('d/m/Y à\s H:i', strtotime($this->quando_parte)) ),
			//'#hora_parte_hotel#' => ($this->hora_parte_hotel==null ? '---' : date('H:i', strtotime($this->hora_parte_hotel)) ),
			'#numero_voo_chega#' => ($this->quando_chega==null ? '---' : $this->numero_voo_chega),
			'#numero_voo_parte#' => ($this->quando_parte==null ? '---' : $this->numero_voo_parte),
			'#bool_internacional#' => ($this->bool_internacional ? 'sim' : 'não'),
			'#bool_duty_free#' => ($this->bool_duty_free ? 'sim' : 'não'),
			'#preco#' => Utils::formata_num($this->preco, 0),
			'#indicacao#' => $this->get_indicacao(),
			'#link_altera#' => $this->get_link_altera(),
			'#observacoes#' => nl2br($this->observacoes),
		);
		
		return $mail_msg->envia();
	}	


	public function get_link_altera()
	{
		return DIR_HTM_ROOT . 'reserva/?h=' . $this->hash;
	}




	public static function cria_export($params=null)
	{
		if($params)
		{

		}

		$sql = 'SELECT r.*, c.nome nome_comuna, b.nome nome_bairro, t.nome tipo_reserva
				FROM reserva r, comuna c, bairro b, reserva_tipo t
				WHERE c.id=r.id_comuna
				AND b.id=r.id_bairro
				AND t.id=r.tiporeserva
				ORDER BY r.quando DESC';
		$conn = TConnection::open();
		$res = $conn->query($sql);
		
		ob_start();
		?>
	    <table id="tbexport" style="display: none;">
			<thead>
				<tr>
				<?php
				$res_campos = $conn->query($sql);
				$fields = array_keys($res_campos->fetch(PDO::FETCH_ASSOC));
				foreach ($fields as $campo) 
				{
					?>
					<th><?=$campo?></th>
					<?php	
				}	
				?>
				</tr>
			</thead>
			<tbody>
				<?php
				$prefixo = 'quando'; // campo que deve ser formatado
				while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
				// while($row = $resultado->fetchObject(__CLASS__)) // --> se precisar acessar algum método da classe
				{
					?>
					<tr>
					<?php
					foreach ($fields as $campo) 
					{
						if(substr($campo, 0, strlen($prefixo))==$prefixo)
						{
							$valor = $row[$campo]==null ? '' : date('d/m/Y H:i', strtotime($row[$campo]));
						}
						elseif($campo=='qtd_pax')
						{
							$valor = $row['qtd_adt'] + $row['qtd_chd_5'] + $row['qtd_chd_10'];
						}
						else
						{
							$valor = $row[$campo];
						}
						?>
						<td><?=$valor?></td>
						<?php
					}
					?>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
		ob_flush();
		$conn = null;
	}






}
