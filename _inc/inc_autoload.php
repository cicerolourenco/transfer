<?php

spl_autoload_register('meuAutoLoad');

function meuAutoLoad($classe)
{
	$classe = str_replace('\\', '/', $classe);
	$vetor_pastas[] = '_app/ado/';
	$vetor_pastas[] = '_app/lib/';

	$vetor_pastas[] = '_app/model/';
	$vetor_pastas[] = '_app/model/admin/';
	$vetor_pastas[] = '_app/model/contato/';
	$vetor_pastas[] = '_app/model/reservas/';
	$vetor_pastas[] = '_app/model/regioes/';

	$vetor_pastas[] = '_app/view/';
	$vetor_pastas[] = '_app/view/admin/';

	$vetor_pastas[] = '_app/control/';
	$vetor_pastas[] = '_app/control/admin/';


	foreach($vetor_pastas as $pasta) {
		$caminho = DIR_ROOT . $pasta . $classe . '.class.php';
		if(file_exists($caminho)) {
			include_once($caminho);
		}
	}
}


// PHP Mailer atualizado
include_once(DIR_ROOT . '_app/lib/PHPMailer/Exception.php');
include_once(DIR_ROOT . '_app/lib/PHPMailer/OAuth.php');
include_once(DIR_ROOT . '_app/lib/PHPMailer/PHPMailer.php');
include_once(DIR_ROOT . '_app/lib/PHPMailer/POP3.php');
include_once(DIR_ROOT . '_app/lib/PHPMailer/SMTP.php');

