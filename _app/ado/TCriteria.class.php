<?php

/**
 * classe TCriteria
 * Esta classe provъ uma interface utilizada para definiчуo de critщrios
 * @author Salve
 *
 */
class TCriteria extends TExpression
{
	private $_expressoes;  	// armazena a lista de expressѕes
	private $_operadores;  	// armazena a lista de operadores
	private $_propriedades; // propriedades do critщrio
	public $_bool_tem_filtro = false; // define se tem ou nуo filtro WHERE
	
	
	/**
	 * CONSTRUTOR
	 */
	function __construct()
	{
		$this->_expressoes = array();
		$this->_operadores = array();
	}
	
	
	/**
	 * mщtodo add
	 * Adiciona uma expressуo ao critщrio
	 * @param TFilter $expressao = expressуo (objeto TFilter)
	 * @param unknown_type $operador = operador lѓgico de comparaчуo
	 */
	public function add(TFilter $expressao, $operador = self::AND_OPERATOR)
	{
		// na primeira vez, nуo precisa de operador lѓgico para concatenar
		if(empty($this->_expressoes))
		{
			$operador = NULL;
			$this->_bool_tem_filtro = true;
		}

		// agrega o resultado da expressуo р lista de expressѕes
		$this->_expressoes[] = $expressao;
		$this->_operadores[] = $operador;
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see app.ado/TExpression::dump()
	 */
	public function dump()
	{
		// concatena a lista de expressѕes
		if(is_array($this->_expressoes))
		{
			if(count($this->_expressoes)>0)
			{
				$resultado = '';
				foreach ($this->_expressoes as $i=>$expressao)
				{
					$operador = $this->_operadores[$i];
					// concatena o operador com a respectiva expressуo
					$resultado .= $operador . $expressao->dump() . ' ';
				}
				$resultado = trim($resultado);
				return "({$resultado})";
			}
		}
	}
	
	
	/**
	 * armazena o valor de uma propriedade no vetor $_propriedades
	 * @param unknown_type $propriedade = nome da propriedade
	 * @param unknown_type $valor		= valor da propriedade
	 */
	public function setProperty($propriedade, $valor)
	{
		$this->_propriedades[$propriedade] = isset($valor) ? $valor : NULL;
	}
	
	
	/**
	 * Retorna o valor de uma propriedade
	 * @param unknown_type $propriedade = nome da propriedade requisitada
	 */
	public function getProperty($propriedade)
	{
		if(isset($this->_propriedades[$propriedade]))
		{
			return $this->_propriedades[$propriedade];
		}
	}
	
}



?>