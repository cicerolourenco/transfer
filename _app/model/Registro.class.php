<?php

/**
 * @author Cícero Lourenço da Silva
 *
 */
class Registro extends TRecord
{
	const TABLENAME = null;

	const REGEX_URL_AMIGAVEL = '/[^a-z0-9|\-]/';	

	protected $validate;
	
	
	public function  __construct($id = null)
	{
		parent::__construct($id);
	}


	/**
	 * (non-PHPdoc)
	 * @see app/dao/TRecord::delete()
	 * @param int $id ID do registro no banco. Se fornecido, instancia o objeto.
	 */
	public function delete($id=null)
	{
		$classe = get_class($this);
		$objeto = $id ? new $classe($id) : $this;
		
		if($objeto->ordem!==null)
		{
			$objeto->reorganiza_ordem();
		}
		
		return parent::delete($id);
	}
	
	


	/**
	 * Tenta escolher uma URL amigável para o item, com base nas duas opções definidas e 
	 * retorna a URL ou null se não conseguiu
	 * @param string $string1 Primeira opção
	 * @param string $string2 Segunda opção
	 */
	public function define_url_amigavel($string1, $string2)
	{
		$string1 = preg_replace('/[ ]+/', '-', strtolower(Utils::remove_acentos($string1))); // substitui um ou mais espaços por um traço: "-"
		$string2 = preg_replace('/[ ]+/', '-', strtolower(Utils::remove_acentos($string2)));
		
		$url_amigavel = preg_replace(self::REGEX_URL_AMIGAVEL, '', $string1);
		if($url_amigavel=='')
		{
			// tenta a segunda opção
			$url_amigavel = preg_replace(self::REGEX_URL_AMIGAVEL, '', $string2);
		}
	
		// verifica se algum item já tem esta URL
		//$classe_filha = get_class($this);
		//die('$classe_filha: ' . $classe_filha);
		
		$rep = new TRepository(get_class($this));
		$crit = new TCriteria();
		$crit->add(new TFilter('url_amigavel', '=', '"' . $url_amigavel . '"'));
		
		if($this->id)
		{
			// se o item já foi salvo, exclui o próprio ID da lista pesquisada
			$crit->add(new TFilter('id', '<>', $this->id));
		}
		
		// Se não tem outro igual, atribui e retorna true
		if($rep->count($crit)==0)
		{
			$this->url_amigavel = $url_amigavel;
			return true;
		}
		else
		{
			return false;
		}
	}

	

	
	/**
	 * Retorna um vetor com todas as tags desta classe
	 * @param int $limite limite de tags retornadas
	 */
	public static function get_all_tags($filtrar_visiveis=true, $limite=null)
	{
		$sql = new TSqlSelect();
		$sql->addColumn('tags');
		$sql->setEntity(constant(get_called_class() .'::TABLENAME'));
		$criterio = new TCriteria();
		if($filtrar_visiveis)
		{
			$criterio->add(new TFilter('bool_exibir', '=', 1));
			$sql->setCriteria($criterio);
		}
		$sql->getSQL();
		$conn = TConnection::open();
		$resultado = $conn->query($sql->getSQL());
		
		
		if($resultado)
		{
			while($row = $resultado->fetch(PDO::FETCH_ASSOC))
			{
				$vetor_tags = explode(' ', $row['tags']);
				foreach ($vetor_tags as $chave=>$tag)
				{
					$vetor[] = trim($tag);
				}
			}
			
			if($vetor)
			{
				// ordenando o vetor para retirar as tags repetidas
				sort($vetor);
				$i_max = $limite ? $limite+1 : sizeof($vetor); 
				for($i=0; $i<$i_max; $i++)
				{
					if($vetor[$i]!=$vetor[$i-1] && $vetor[$i]!='')
					{
						$retorno[] = $vetor[$i];
					}
				}
			}
		}
		
		return $retorno;		
	}
		

	/**
	 * 
	 * Retorna o número de itens com a tag desejada
	 * @param string $tag tag desejada
	 */
	public static function conta_itens_tag($tag, $filtrar_visiveis=true)
	{
		$where_visiveis = $filtrar_visiveis ? 'AND bool_exibir=1' : '';
		$sql = 'SELECT COUNT(*) as quantidade FROM ' . constant(get_called_class() .'::TABLENAME') . ' WHERE tags LIKE "%' . $tag . '%" ' . $where_visiveis;
			
		$conn = TConnection::open();
		$result = $conn->query($sql);
		$conn = null;
		
		if($result)
		{
			$row = $result->fetch();
		}
		
		return $row[0];
	}


	
	/**
	 * Coloca o registro em primeiro na fila da ordem, empurrando os demais para baixo
	 * @param TCriteria $crit Critério opcional
	 */
	public function fura_fila($crit=null)
	{
		if($crit===null)
		{
			$classe = get_class($this);
			$campo_grupo = !defined($classe . '::CAMPO_GRUPO') ? '' : constant($classe . '::CAMPO_GRUPO');
			if($campo_grupo)
			{
				$crit = new TCriteria();
				$crit->add(new TFilter($campo_grupo, '=', $this->$campo_grupo));
			}
		}
		
		$rep = new TRepository(get_class($this));
		if($lista = $rep->load($crit))
		{
			foreach ($lista as $registro)
			{
				$registro->ordem = $registro->ordem + 1;
				$registro->store();
			}
		}
		
		$this->ordem = 1;
	}
	

	
	/**
	 * Coloca o registro em último na fila da ordem, empurrando os demais para baixo
	 * @param TCriteria $crit Critério opcional
	 */
	public function segue_fila($crit=null)
	{
		if($crit===null)
		{
			$classe = get_class($this);
			$campo_grupo = !defined($classe . '::CAMPO_GRUPO') ? '' : constant($classe . '::CAMPO_GRUPO');
			if($campo_grupo)
			{
				$crit = new TCriteria();
				$crit->add(new TFilter($campo_grupo, '=', $this->$campo_grupo));
			}
		}
		$rep = new TRepository(get_class($this));
		$this->ordem = 1 + $rep->count($crit);
	}
	
	

	/**
	 * Refaz a ordem desta classe, para que a exclusão de um item
	 * não interfira na numeração de 1 a n
	 */
	protected function reorganiza_ordem()
	{
		$classe = get_class($this);
		$tabela = constant($classe . '::TABLENAME');
		
		// verifica se há algum campo de categoria ou grupo na ordenação 
		// (ex.: fotos de uma mesma galeria são agrupados pelo campo "id_galeria")
		$campo_grupo = !defined($classe . '::CAMPO_GRUPO') ? '' : constant($classe . '::CAMPO_GRUPO');
		$where_grupo = $campo_grupo ? ' AND ' . $campo_grupo . '=' . $this->$campo_grupo : '';
		
		// executa
		$conn = TConnection::open();
		$conn->query('UPDATE ' . $tabela . ' SET ordem=ordem-1 WHERE ordem>' . $this->ordem . $where_grupo);
//		$log = new TLoggerTXT(DIR_ROOT . '/log/log_sql.txt');
//		$log->write('UPDATE ' . $tabela . ' SET ordem=ordem-1 WHERE ordem>' . $this->ordem . $where_grupo);
		$conn = null;
	}
	
	
	
	
	
	/**
	 * Cria um thumbnail em tempo de execução e retorna a URL
	 * @param int $wmax Largura máxima do thumbnail
	 * @param int $hmax Altura máxima do thumbnail
	 */
	public function get_thumb($wmax=50, $hmax=50)
	{
		$classe = get_class($this);
		$destino = !defined($classe . '::DESTINO_ARQUIVO') ? '' : constant($classe . '::DESTINO_ARQUIVO');
		
		if($destino!='' && $this->arquivo && file_exists(DIR_ROOT . $destino . $this->arquivo))
		{
			$caminho = DIR_ROOT . $destino . $this->arquivo;
			$retorno = DIR_CMS_HTM_ROOT . 'ferramentas/miniatura.php?arquivo=' . $caminho . '&wmax=' . $wmax . '&hmax=' . $hmax;
		}
		
		return $retorno;
	}

        /**
	 * Verifica se o item pode ser excluido, se tem alguma dependencia.
	 */
         public function pode_deletar(){
            return true;
        }
	
	
	
	
	
	/**
	 * Retorna todos os itens do repositório num vetor chave(id)=>valor(nome) 
	 * @param string $ordem Ordem desejada (padrão: 'id'; opção: 'nome' ou outro campo válido) 
	 */
	public static function get_drop_down($primeiro=null, $rotulo='nome', $ordem='id')
	{
		$rep = new TRepository(get_called_class());
		$crit = new TCriteria();
		$crit->setProperty('order', $ordem);
		
		if($primeiro!==null)
		{
			$vetor_drop[''] = $primeiro;
		}
		else
		{
			$vetor_drop = null;
		}
		
		if($lista = $rep->load($crit))
		{
			foreach ($lista as $registro)
			{
				$vetor_drop[$registro->id] = $registro->$rotulo; 
			}
		}
		return $vetor_drop;
	}
		
        
	
	
	
	
	/**
	 * Escreve um arquivo de log para teste
	 * @param string $mensagem Mensagem a ser escrita no arquivo
	 */
	public static function log($mensagem)
	{
		$log = new TLoggerTXT(DIR_ROOT . 'userfiles/log/' . get_called_class() . '.txt');
		$log->write($mensagem);
	}
	
	
	
	
	
	/**
	 * Retorna todos os itens visíveis desta classe, ordenados pela coluna 'ordem', por padrão
	 */
	public static function lista($filtros=null, $propriedades=null)
	{
		if(!isset($filtros['bool_exibir']) && $filtros['bool_exibir']!==null)
		{
			$filtros['bool_exibir'] = 1;
		}

		if(!isset($propriedades['order']))
		{
			$propriedades['order'] = 'ordem';
		}
		
		$rep = new TRepository(get_called_class());
		$crit = new TCriteria();
		
		if($filtros)
		{
			foreach ($filtros as $chave=>$valor)
			{
				$crit->add(new TFilter($chave, '=', $valor));
			}
		}
		
		if($propriedades)
		{
			foreach ($propriedades as $chave=>$valor)
			{
				$crit->setProperty($chave, $valor);
			}
		}
		
		return $rep->load($crit);
	}
	
	
	
	/**
	 * Retorna os dados desta classe para um array (chave: ID, valor: "nome")
	 * Mais útil para as tabelas de configs ou tipos (listagem fixa)
	 */
	public static function toVetor()
	{
		$rep = new TRepository(get_called_class());
		if($lista = $rep->load())
		{
			foreach ($lista as $registro)
			{
				$vetor[$registro->id] = $registro->nome;
			}
			
		}
		return $vetor;
	}
	

	/**
	 * Retorna a data formatada, se existir
	 */
	public function get_quando_fmt()
	{
		if($this->quando)
		{
			$retorno = date('d/m/Y', strtotime($this->quando));
		}
		return $retorno;
	}
		
}
