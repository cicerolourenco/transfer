<?php

/**
 * classe TSqlUpdate
 * Cria uma string SQL do comando UPDATE
 * @author Salve
 *
 */
final class TSqlUpdate extends TSqlInstruction
{
	
	/**
	 * (non-PHPdoc)
	 * @see app.ado/TSqlInstruction::getSQL()
	 */
	public function getSQL()
	{
		$this->_sql = "UPDATE {$this->_entidade} ";
		if($this->_valoresColunas)
		{
			foreach ($this->_valoresColunas as $coluna=>$valor)
			{
				$set[] = "{$coluna} = {$valor}";
			}
		}
		$this->_sql .= ' SET ' . implode(', ', $set);
		
		// adiciona a cláusula WHERE do objeto
		if($this->_criterio && $this->_criterio->_bool_tem_filtro)
		{
			$this->_sql .= ' WHERE ' . $this->_criterio->dump();
		}  
		
		return $this->_sql;
	}
}

?>