<?php 

error_reporting(E_ALL &  ~E_WARNING &  ~E_NOTICE &  ~E_DEPRECATED &  ~E_STRICT);
@ini_set('display_errors', 1);
define('TIMEZONE', 'America/Santiago');//'America/Sao_Paulo'); // 'America/Los_Angeles');
date_default_timezone_set(TIMEZONE);
header('Content-Type: text/html; charset=utf-8');
session_start();

if( preg_match('/^(localhost)|(192)|(127)/', $_SERVER['HTTP_HOST']) )
{
	$dir_string_root = 'transfer/'; // diretorio raiz (? localhost : produção)
	define('SUFIXO_ADMIN', 'adm/');
}
else
{
	$dir_string_root = 'wp-content/themes/tematransfer/'; // diretorio raiz (? localhost : produção)
	define('SUFIXO_ADMIN', '');
}

$doc_root = substr($_SERVER['DOCUMENT_ROOT'], -1)=='/' ? $_SERVER['DOCUMENT_ROOT'] : $_SERVER['DOCUMENT_ROOT'] . '/';

define('DIR_STRING_ROOT', $dir_string_root);
define('DIR_ROOT', $doc_root . $dir_string_root);
define('DIR_ADM_ROOT', $doc_root . $dir_string_root . SUFIXO_ADMIN);
define('DIR_HTM_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/' . $dir_string_root);
define('DIR_ADM_HTM_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/' . $dir_string_root . 'adm/');
/*
echo '$_SERVER[DOCUMENT_ROOT]: ' . $_SERVER['DOCUMENT_ROOT'] . '<br />';
echo 'DIR_STRING_ROOT: ' . DIR_STRING_ROOT . '<br />';
echo 'DIR_ROOT: ' . DIR_ROOT . '<br />';
echo 'DIR_HTM_ROOT: ' . DIR_HTM_ROOT . '<br />';
echo 'DIR_ADM_HTM_ROOT: ' . DIR_ADM_HTM_ROOT . '<br />';
//die();
//____*/


// MVC
define('DIR_MODEL', DIR_ROOT . '_app/model/');
define('DIR_VIEW', DIR_ROOT . '_app/view/');
define('DIR_HTM_VIEW', DIR_HTM_ROOT . '_app/view/');
define('DIR_CONTROLLER', DIR_ROOT . '_app/control/');
define('DIR_LIB', DIR_ROOT . '_app/lib/');

/*
echo 'DIR_MODEL: ' . DIR_MODEL . '<br />';
echo 'DIR_VIEW: ' . DIR_VIEW . '<br />';
echo 'DIR_HTM_VIEW: ' . DIR_HTM_VIEW . '<br />';
echo 'DIR_CONTROLLER: ' . DIR_CONTROLLER . '<br />';
echo 'DIR_LIB: ' . DIR_LIB . '<br />';
//die();
//____*/



// Geral
define('DIR_USERFILES', DIR_ROOT . '_userfiles/');
define('DIR_HTM_USERFILES', DIR_HTM_ROOT . '_userfiles/');
define('DIR_LOG', DIR_ROOT . 'userfiles/log/');


include_once(DIR_ROOT . '_inc/inc_database.php');
include_once(DIR_ROOT . '_inc/inc_autoload.php');

//extract($_POST);
//Utils::limpa_posts();


/*
if(!preg_match('/^(localhost)|(192)|(127)/', $_SERVER['HTTP_HOST']))
    if($_GET['v']==1 || $_SESSION['v']==1)
        $_SESSION['v']=1;
    else
        header('Location: ' . DIR_ADM_HTM_ROOT);
*/

// caso tenha um usuário logado, disponibiliza o objeto respectivo
/*
if(isset($_SESSION['con_adm_usuario']))
	$con_adm_usuario = unserialize($_SESSION['con_adm_usuario']);
	*/

