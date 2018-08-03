<?php

/**
 * 
 * classe TFilter
 * Esta classe provê uma interface para definição de filtros de seleção
 * @author Salve
 *
 */
class TFilter extends TExpression
{
	private $_variavel;
	private $_operador;
	private $_valor;
	
	/*
	 * CONSTRUTOR
	 * Instancia um novo filtro
	 * @param $_variavel = variável
	 * @param $_operador = operador de comparação 
	 * @param $_valor = valor a ser comparado 
	 * */
	public function __construct($variavel, $operador, $valor)
	{
		$this->_variavel = $variavel;
		$this->_operador = $operador;
		$this->_valor = $valor;
			
	}
	
	
	/*
	 * método transform
	 * Recebe um valor e faz as modificações necessárias para 
	 * ele ser interpretado pelo banco de dados, podendo ser
	 * integer/string/boolean ou array contendo estes itens.
	 * @param $valor = valor a ser transformado
	 * */
	function transform($valor)
	{
		if(is_array($valor))
		{
			// percorre os valores
			foreach ($valor as $x) 
			{
				if(is_integer($x))
				{
					$vetor[] = $x;
				}
				else if(is_string($x))
				{
					$vetor[]= "'$x'";
				}
			}
			
			// converte o array em string separada por vírgula
			$resultado = '(' . implode(',', $vetor) . ')';
		}
		else if(is_string($valor))
		{
			$resultado = "'$valor'";
		}
		else if(is_null($valor))
		{
			$resultado = 'NULL';
		}
		else if(is_bool($valor))
		{
			$resultado = $valor ? true : false;
		}
		else
		{
			$resultado = $valor;
		}
	}
	
	
	/**
	 * Retorna o filtro em forma de expressão
	 * @see app.ado/TExpression::dump()
	 */
	function dump()
	{
		// concatena a expressão
		return "{$this->_variavel}{$this->_operador}{$this->_valor}";
	}
	
}

?>