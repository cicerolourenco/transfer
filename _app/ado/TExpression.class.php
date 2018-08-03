<?php

/**
 * 
 * classe TExpression
 * classe abstrata para gerenciar expressões
 * @author Salve
 *
 */
abstract class TExpression
{
	//operadores lógicos
	const AND_OPERATOR = ' AND ';
	const OR_OPERATOR = ' OR ';
	
	/**
	 * método dump
	 * Deve ter implementado pelas classes-filha
	 * Retornará a expressão resultante em forma de string
	 */
	abstract public function dump();
}
?>