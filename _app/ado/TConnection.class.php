<?php

/**
 * TConnection
 * Classe de conexão com banco de dados
 * @author Salve
 *
 */
final class TConnection
{
	private function __construct()
	{
		// intencionalmente private e vazio (não permite instanciar objetos)
	}
	
	/**
	 * Função estática open
	 * Abre uma conexão ao banco de dados
	 * Se não passar nenhum nome de arquivo no parâmetro $arquivo_db, conecta ao banco padrão da aplicação
	 * @param $arquivo_db
	 */
	public static function open($arquivo_db='')
	{
		$db_tipo 	= C8_DB_TYPE; 
		$db_host 	= C8_DB_HOST;
		$db_nome 	= C8_DB_NAME;
		$db_usuario = C8_DB_USER;
		$db_senha 	= C8_DB_PASS;
		$db_porta 	= C8_DB_PORT;
		
		
		
		
		switch ($db_tipo)
		{
			case 'pgsql':
				$db_porta = $db_porta ? $db_porta : '5432';
				$conn = new PDO("pgsql:dbname={$db_nome}; user={$db_usuario}; password={$db_senha}; host={$db_host}; port={$db_porta}");
				break;
			
			case 'mysql': 
				$db_porta = $db_porta ? $db_porta : '3306';
				$conn = new PDO("mysql:host={$db_host}; dbname={$db_nome}; port={$db_porta}; charset=utf8", $db_usuario, $db_senha);
				break;
			
			case 'sqlite': 
				$conn = new PDO("sqlite:{$db_nome}");
				break;
			
			case 'ibase': 
				$conn = new PDO("firebird:dbname={$db_nome}", $db_usuario, $db_senha);
				break;
			
			case 'oci8': 
				$conn = new PDO("oci:dbname={$db_nome}", $db_usuario, $db_senha);
				break;
			
			case 'mssql': 
				$conn = new PDO("mssql:host={$db_host}, 1433; dbname={$db_nome}", $db_usuario, $db_senha);
				break;
		}
		
		// define o atributo error mode para lançar exceções em caso de erro
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $conn;
	} 
}
