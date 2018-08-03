<?php

final class TSqlInsert extends TSqlInstruction
{
	
	
	/**
	 * Não pode haver critério na inserção de dados.
	 * @see app.ado/TSqlInstruction::setCriteria()
	 */
	public function setCriteria($criterio)
	{
		throw new Exception('Não pode haver critério na inserção de dados.');
	}
	
	
	/**
	 * @see app.ado/TSqlInstruction::getSQL()
	 */
	public function getSQL()
	{
		$this->_sql = "INSERT INTO {$this->_entidade} (";
		$colunas = implode(', ', array_keys($this->_valoresColunas));
		$this->_sql .= $colunas . ')';
		$valores = implode(', ', array_values($this->_valoresColunas));
		$this->_sql .= " VALUES ({$valores})";
		
		return $this->_sql;
	}
}