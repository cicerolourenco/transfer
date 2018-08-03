<?php


// DATABASE CONNECTION___________________
if(preg_match('/^(localhost)|(192)|(127)/', $_SERVER['HTTP_HOST']))
{
	// ambiente local (desenvolvimento e teste)
	define('C8_DB_TYPE', 'mysql');
	define('C8_DB_HOST', 'localhost');
	define('C8_DB_NAME', 'transfer');
	define('C8_DB_USER', 'root');
	define('C8_DB_PASS', '');
	define('C8_DB_PORT', '');
}
else
{
	// ambiente de produção
	define('C8_DB_TYPE', 'mysql');
	define('C8_DB_HOST', 'localhost'); // 107.180.5.9 
	define('C8_DB_NAME', '123esite_transferbrasil');
	define('C8_DB_USER', 'sitetransferdb');
	define('C8_DB_PASS', 'x{^g-)tg@Ror');
	define('C8_DB_PORT', '');
}
//_____________________________________*/

