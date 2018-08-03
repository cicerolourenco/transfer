<?php

/**
 * 
 * Esta classe provê os métodos para carregar e persistir
 * objetos da base de dados (Active Record) 
 * @author Salve
 *
 */
abstract class TRecord
{
	protected $_dados; // array contendo os dados do objeto
	
	public $_out;
	
	
	/**
	 * Instancia um Active Record. Se passado o ID, carrega o objeto. 
	 * @param unknown_type $id = ID do objeto na tabela do banco de dados
	 */
	public function __construct($id=null)
	{
		if($id)
		{
			// se o ID for informado, carrega o objeto correspondente
			$objeto = $this->load($id);
			if($objeto)
			{
				$this->fromArray($objeto->toArray());
			}
			else
			{
				$this->id = null;
			}
		}
	}
	
	
	
	/**
	 * Chamado automaticamente quando o objeto é clonado, limpa o ID
	 * do objeto para não sobrescrever (no banco) o objeto original ao persistir
	 */
	public function __clone()
	{
		$this->id = null;
	}
	
	
	/**
	 * Chamado automaticamente ao se tentar atribuir valor a uma propriedade, 
	 * verifica se existe um método específico para isso ou simplesmente atribui
	 * @param unknown_type $prop = nome da propriedade a ser alterada
	 * @param unknown_type $valor = valor desejado para a propriedade
	 */
	public function __set($prop, $valor)
	{
		// verifica se existe método set_<propriedade>
		if(method_exists($this, 'set_' . $prop))
		{
			call_user_func(array($this, 'set_' . $prop), $valor);
		}
		elseif($valor===null)
		{
			unset($this->_dados[$prop]);
		}
		else
		{
			$this->_dados[$prop] = $valor;
		}
	}
	
	
	/**
	 * Chamado automaticamente ao se tentar obter o valor de uma propriedade,
	 * verifica se existe um método específico para isso ou simplesmente retorna
	 * @param unknown_type $prop = nome da propriedade a ser retornada
	 */
	public function __get($prop)
	{
		// verifica se existe método get_<propriedade>
		if(method_exists($this, 'get_' . $prop))
		{
			// executa o método específico que retorna o valor da propriedade
			return call_user_func(array($this, 'get_' . $prop));
		}
		else
		{
			// retorna o valor da propriedade
			if(isset($this->_dados[$prop]))
			{
				return $this->_dados[$prop];
			}
		}
	}
	
	
	/**
	 * Retorna o nome da entidade (tabela), que é única para a classe
	 */
	private function getEntity()
	{
		// obtém o nome da classe
		$classe = get_class($this);
		// retorna a constante de classe TABLENAME
		return constant("{$classe}::TABLENAME");
	}
	
	
	/**
	 * Preenche os dados do objeto com o Array passado
	 * @param unknown_type $dados = array com os dados
	 */
	public function fromArray($dados)
	{
		$this->_dados = $dados;
	}
	
	
	/**
	 * Preenche os dados do objeto com o Array passado, prevenindo SQL injection
	 * @param array $dados array com os dados
	 * @param array $dados_out array com as chaves que não são propriedades deste objeto
	 */
	public function fromVetor($dados, $dados_out=null)
	{
		foreach ($dados as $chave=>$valor)
		{
			if(!is_array($valor) && ($dados_out==null || !in_array($chave, $dados_out)) )
			{
				$this->_dados[$chave] = htmlspecialchars($valor, ENT_QUOTES, 'ISO-8859-1');
			}
		}
	}
	
	
	/**
	 * Retorna os dados do objeto em forma de Array 
	 */
	public function toArray()
	{
		return $this->_dados; 
	}

	
	/**
	 * Armazena o objeto no banco de dados e retorna o número de linhas afetado pela instrução
	 */
	public function store()
	{
		//limpando o cache do site, quando atualiza algo via CMS
		//$this->limpa_cache();
		
		
		// se o registro não existe ainda, insere no banco
		if(empty($this->_dados['id']) || (!$this->load($this->id)) )
		{
			// cria uma instrução de INSERT
			$sql = new TSqlInsert();
			$sql->setEntity($this->getEntity());
			foreach ($this->_dados as $chave=>$valor)
			{
				//x e y sao passados no POST pela funcao fromArray 
				if($chave!=='id' && $chave!=='y' && $chave!=='x'  ) // o ID não precisa ir para o banco (usar AUTO-INCREMENT)
				{
					$sql->setRowData($chave, $this->$chave);
				}
			}
		}
		else
		{
			// se já tem ID, atualiza o registro (UPDATE)
			$sql= new TSqlUpdate();
			$sql->setEntity($this->getEntity());
			$criterio = new TCriteria();
			$criterio->add(new TFilter('id', '=', $this->id));
			$sql->setCriteria($criterio);
			foreach ($this->_dados as $chave=>$valor)
			{
				//x e y sao passados no POST pela funcao fromArray 
				if($chave!=='id' && $chave!=='y' && $chave!=='x' ) // o ID não precisa ser atualizado
				{
					$sql->setRowData($chave, $this->$chave);
				}
			}
		}
		
		
		// ARMAZENA
		// TODO: transação (se julgar necessário)
		$conn = TConnection::open();
//		echo $sql->getSQL(); 
		$conn->exec($sql->getSQL());
		if(empty($this->_dados['id']))
		{
			// se for operação de INSERT, atribui o ID inserido no banco ao objeto 
			$this->_dados['id'] = $conn->lastInsertId();
		}
		$conn = null;
		
		return $this->_dados['id'];
		
	}
	
	
	
	/**
	 * Limpando o cache do site, quando atualiza algo via CMS
	public function limpa_cache()
	{
		$cache = new Cache(60, DIR_ROOT . 'cache/');
		$cache->clearAllCache();
	}
	 */
	
	
	
	/**
	 * Recupera e retorna um objeto do banco de dados de acordo com o ID passado
	 * @param unknown_type $id = ID do registro no banco de dados
	 */
	public function load($id)
	{
		$sql = new TSqlSelect();
		$sql->setEntity($this->getEntity());
		$sql->addColumn('*');
		$criterio = new TCriteria();
		$criterio->add(new TFilter('id', '=', $id));
		$sql->setCriteria($criterio);
		
		
		// CONSULTA E RETORNA
		// TODO: transação (se julgar necessário)
		$conn = TConnection::open(); 

		try {
			$result = $conn->query($sql->getSQL());
		} catch (PDOException $e) {
			trigger_error(str_replace('#', '', $e->getTraceAsString()) . ' SQL: '.$sql->getSQL(), E_USER_ERROR);
		}

		$objeto = $result->fetchObject(get_class($this));
		$conn = null;
		
		return $objeto;
	}
	
	
	
	/**
	 * Exclui um objeto no banco de dados de acordo com o ID passado 
	 * @param unknown_type $id = ID do registro no banco de dados
	 */
	public function delete($id=null)
	{
		// se não for passado ID do banco, usa a propriedade 'id' do objeto, 
		// pois este já foi instanciado
		$id = $id ? $id : $this->id;
		
		$sql = new TSqlDelete();
		$sql->setEntity($this->getEntity());
		$criterio = new TCriteria();
		$criterio->add(new TFilter('id', '=', $id));
		$sql->setCriteria($criterio);
		//echo $sql->getSQL();
		
		
		// EXCLUI
		// TODO: transação (se julgar necessário)
		$conn = TConnection::open();
		$result = $conn->exec($sql->getSQL());
		$conn = null;
		
		return $result;
	}
	
	
	/**
	 * Conta o número de registros dessa classe no banco
	 * @param TCriteria $criterio
	 */
	public static function count(TCriteria $criterio=null)
	{
		$repositorio = new TRepository(get_called_class());
		return $repositorio->count($criterio);
	}
	
	
	

}


?>