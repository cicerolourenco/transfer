<?php

/**
 * Transaчуo de queries no banco de dados
 * @author Salve
 *
 */
final class TTransaction
{
	private static $_conn;
	
	/**
	 * Nуo permite instanciar a classe
	 */
	private function __construct()
	{
		// intencionalmente deixado private e vazio (para nуo permitir instanciar a classe)
	}
	
	
	/**
	 * Abre a conexуo com com o banco e inicia a transaчуo
	 * @param unknown_type $arquivo_db
	 */
	public static function open($arquivo_db='')
	{
		if(empty(self::$_conn))
		{
			self::$_conn = TConnection::open($arquivo_db);
			self::$_conn->beginTransaction();
		}
	}
	
	
	/**
	 * Retorna a conexуo ativa da transaчуo
	 */
	public static function get()
	{
		return self::$_conn;
	}
	
	
	/**
	 * Desfaz todas as operaчѕes da transaчуo
	 */
	public static function rollback()
	{
		if(self::$_conn)
		{
			self::$_conn->rollBack();
			self::$_conn = null;
		}
	}
	
	
	/**
	 * Aplica todas as operaчѕes e fecha a transaчуo
	 */
	public static function close()
	{
		if(self::$_conn)
		{
			self::$_conn->commit();
			self::$_conn = null;
		}
	}
}
?>