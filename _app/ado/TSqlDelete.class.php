<?php

/**
 * classe TSqlDelete
 * Cria a string SQL do comando DELETE
 * @author Salve
 *
 */
final class TSqlDelete extends TSqlInstruction
{
	
	/**
	 * (non-PHPdoc)
	 * @see app.ado/TSqlInstruction::getSQL()
	 */
	public function getSQL()
	{
		$this->_sql = "DELETE FROM {$this->_entidade}";
		if($this->_criterio && $this->_criterio->_bool_tem_filtro)
		{
			$this->_sql .= ' WHERE ' . $this->_criterio->dump();
		}
		//echo $this->_sql;
		return $this->_sql;
	}
}


?>