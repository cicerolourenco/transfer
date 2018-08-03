<?php

/**
 * Esta classe provê os métodos necessários para manipular coleções de objetos.
 * @author Salve
 */
final class TRepository
{
	private $_classe; // nome da classe manipulada pelo repositório
	
	/**
	 * Instancia um repositório de objetos
	 * @param $classe = nome da classe de objetos que precisa ser retornada.
	 */
	public function __construct($classe)
	{
		$this->_classe = $classe;
	}
	
	
	/**
	 * Recupera um conjunto de objetos (collection) do banco de dados
	 * usando um critério de seleção e instancia os objetos em memória
	 * @param TCriteria $criterio = objeto TCriteria
	 * @param TSqlSelect $sql = objeto TSqlSelect 
	 */
	public function load(TCriteria $criterio=null,TSqlSelect $sql=null)
	{
		if(!$sql)
		{
			$sql = new TSqlSelect();
			$sql->addColumn('*');
		}
		
		$sql->setEntity(constant($this->_classe . '::TABLENAME'));
		$criterio = $criterio==null ? new TCriteria() : $criterio;
		$sql->setCriteria($criterio);
		
		// SELECIONA
		// TODO: Implementar transação (se julgar necssário)
		$conn = TConnection::open();
//		$log = new TLoggerTXT(DIR_ROOT .'/log/log_sql.txt');
//		$log->write($sql->getSQL());
//		echo $sql->getSQL();
		
		try {
			$result = $conn->query($sql->getSQL());
		} catch (PDOException $e) {
			trigger_error(str_replace('#', '', $e->getTraceAsString()) . ' SQL: '.$sql->getSQL(), E_USER_ERROR);
		}
		
		$resultados = array();
		
		if($result)
		{
			while ($row = $result->fetchObject($this->_classe))
			{
				// percorre o resultado, retornando um objeto 
				// e armazenando no vetor $resultados
				$resultados[] = $row;
			}
		}
		$conn = null;
		
		return $resultados;
	}
	
	
	/**
	 * Exclui um conjunto de objetos (collection) do banco de dados 
	 * @param TCriteria $criterio = objeto TCriteria
	 */
	public function delete(TCriteria $criterio=null)
	{
		$sql = new TSqlDelete();
		$sql->setEntity(constant($this->_classe . '::TABLENAME'));
		if($criterio)
		{
			$sql->setCriteria($criterio);
		}
		
		// EXCLUI
		// TODO: Implementar transação (se julgar necssário)
		$conn = TConnection::open();
		$result = $conn->exec($sql->getSQL());
		$conn = null;
		
		return $result;
	}
	
	
	/**
	 * Retorna a quantidade de objetos no banco de dados
	 * que obedecem ao critério passado
	 * @param TCriteria $criterio = objeto TCriteria
	 */
	public function count(TCriteria $criterio=null)
	{
		$sql = new TSqlSelect();
		$sql->setEntity(constant($this->_classe . '::TABLENAME'));
		$sql->addColumn('COUNT(*)');
		$sql->setCriteria($criterio);
		
		// CONTA
		// TODO: Implementar transação (se julgar necssário)
		//echo $sql->getSQL();
		$conn = TConnection::open();
		$result = $conn->query($sql->getSQL());
		$conn = null;
		
		if($result)
		{
			$row = $result->fetch();
		}
		
		return $row[0];
	}
	
}

?>