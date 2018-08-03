<?php

final class TSqlSelect extends TSqlInstruction
{
	private $_vetorColunas; // array de colunas solicitadas
	
	public function addColumn($coluna)
	{
		$this->_vetorColunas[] = $coluna;
	}

    /**
     *  Adiciona as colunas a query select
     * @param Array $colunas
     */
    public function addColumns($colunas){
        if(is_array($colunas)){
            foreach ($colunas as $coluna) {
                $this->_vetorColunas[] = $coluna;
            }
        }else{
            $this->_vetorColunas[] = $colunas;
        }
    }


    public function getSQL()
	{
		$this->_sql  = 'SELECT ';
		$this->_sql .= count($this->_vetorColunas)==0 ? '*' : implode(', ', $this->_vetorColunas);
		$this->_sql .= ' FROM ' . $this->_entidade;
		
		// adiciona a cláusula WHERE do objeto
		if($this->_criterio)
		{
			// WHERE...
			if($this->_criterio->_bool_tem_filtro)
			{
				$this->_sql .= ' WHERE ' . $this->_criterio->dump();
			}
			
			// GROUP BY...
			$group = $this->_criterio->getProperty('group');
			if($group)
			{
				$this->_sql .= ' GROUP BY ' . $group;
			}
			
			// ORDER BY...
			$order = $this->_criterio->getProperty('order');
			if($order)
			{
				$this->_sql .= ' ORDER BY ' . $order;
			}
			
			// LIMIT...
			$limit = $this->_criterio->getProperty('limit');
			if($limit)
			{
				$this->_sql .= ' LIMIT ' . $limit;
			}
			
			// OFFSET...
			$offset = $this->_criterio->getProperty('offset');
			if($offset)
			{
				$this->_sql .= ' OFFSET ' . $offset;
			}
			
		}
		
		return $this->_sql;
	}
}

?>