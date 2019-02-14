<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Email
{
	private $destinatarios = '';
	
	public $vetor_replace;
	public $bool_debug = false;
	public $template;
	private $vetor_destinatarios;
	
	/**
	 * Sobrescreve o construtor do PHPMailer
	 * para definir as configurações mais comuns
	 * e buscar algumas no config.ini
	 */
	public function __construct($bool_exceptions = null)
	{
		// configs 
		$this->pasta_templates = '_app/view/email/';
		$this->pasta_log = '_userfiles/log/email/';
		$this->arquivo_log = 'log_header.htm';
		$this->template = 'padrao.htm';
		$this->remetente_email = 'contato@transferbrasil.cl';
		$this->remetente_nome  = 'Transfer Brasil';
	}

	

	public function add($endereco, $nome = '') 
	{
		$this->vetor_destinatarios[] = array($endereco, $nome);
	}	
	
	
	
	/**
	 * Substitui os pares de string no corpo da mensagem
	 */
	private function replace_mensagem()
	{
		// Define o conteúdo do HTML a ser enviado
		$this->Body = file_get_contents(DIR_ROOT . $this->pasta_templates . $this->template);
		
		// O vetor padrão contém as substituições mais comuns
		$vetor_padrao['#dir_htm_root#'] = DIR_HTM_ROOT;
		$vetor_padrao['#dir_cms_htm_root#'] = DIR_CMS_HTM_ROOT;
		$vetor_padrao['src="img'] = 'src="' . DIR_HTM_ROOT . $this->pasta_templates . 'img';
		$vetor_padrao['#assunto#'] = $this->Subject;
		
		// cria um vetor único com as substituições
		$vetor = $this->vetor_replace ? array_merge($vetor_padrao, $this->vetor_replace) : $vetor_padrao;

		//Utils::dumpa($vetor);
		
		// substitui as ocorrências na mensagem
		foreach($vetor as $chave=>$valor)
		{
			$this->Body = str_replace($chave, $valor, $this->Body);
		}
	}


	
	/**
	 * Coloca um header em HTML na mensagem, 
	 * registrando as variáveis mais importantes do envio
	 * e salva um arquivo de log 
	 */
	private function cria_log()
	{
		/**
		 * substituições do header do log
		 */
		$vetor_log['#email_from#'] = $this->remetente_email;

		foreach ($this->vetor_destinatarios as $destino) 
			$destinatarios .= htmlentities('<' . $destino[0] . '>' . $destino[1] . ', ');   
		$vetor_log['#email_to#'] = substr($destinatarios, 0, -2);

		$vetor_log['#email_from_name#'] = utf8_encode($this->remetente_nome);
		$vetor_log['#email_subject#'] = $this->Subject;
		$vetor_log['#quando#'] = date('d/m/Y, H:i:s');
		
		$str_header = file_get_contents(DIR_ROOT . $this->pasta_templates . $this->arquivo_log);

		// substitui as strings do header
		foreach($vetor_log as $chave=>$valor)
		{
			$str_header = str_replace($chave, $valor, $str_header);
		}
		
		// mescla ao HTML da mensagem
		$pos_ini_body = strpos($this->Body, '<body');
		$pos_fim_body = strpos($this->Body, '>', $pos_ini_body);
		$tag_body = substr($this->Body, $pos_ini_body, ($pos_fim_body-$pos_ini_body)+1);
		
		$this->Body = str_replace($tag_body, $tag_body . $str_header, $this->Body);
		//Utils::dumpa(DIR_ROOT . $this->pasta_log);
		$log = new TLoggerHTML(DIR_ROOT . $this->pasta_log . 'log_' . date('YmdHis') . '.htm');
		$log->write($this->Body);
	}	
	


	
	/**
	 * Sobrescreve o método do PHPMailer, para desviar o fluxo e escrever
	 * um log do envio quando estiver testando localmente
	 * @see _app/lib/PHPMailer/PHPMailer::Send()
	 */
	public function envia()
	{
		$this->replace_mensagem();
		
		if($this->bool_debug || preg_match('/^(localhost)|(192)|(127)/', $_SERVER['HTTP_HOST']))
		{
			$this->cria_log();
			return true;
		}
		else
		{
			return $this->phpMailerSend();
		}
	}



	/**
	 * Envia usando o PHP Mailer (v6.0)
	 * @return boolean
	 */
	public function phpMailerSend()
	{
		$mail = new PHPMailer(true); // Argumento `true` permite exibir exceções

		try 
		{
		    // SMTP
		    $mail->isSMTP();                             // Define pra usar SMTP
		    $mail->SMTPDebug = 0;                        // Debug: 0=não, 1=sim, 2=SMTP, 3=SMTP detalhes
		    $mail->SMTPAuth = true;                      // Autenticação SMTP (recomendada)
		    $mail->SMTPSecure = false;                   // false, 'tls' ou 'ssl' (encriptação) --> GoDaddy: false
			$mail->setLanguage('br');
			$mail->CharSet = 'UTF-8';
		    $mail->Host = 'smtpout.secureserver.net';  
		    $mail->Port = 80;								// Na Locaweb, usar: 587. Em outras: 465, 80 ou 25 (confirmar com o servidor)
		    $mail->Username = 'contato@transferbrasil.cl';
		    $mail->Password = 'transfer9155$';                           
		    $mail->setFrom($this->remetente_email, $this->remetente_nome);
		    //$mail->addReplyTo('contato@transferbrasil.cl', 'Transfer Brasil');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Arquivo anexo
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Nome do arquivo anexo (opcional)

		    //Content
		    $mail->isHTML(true);                                  // Define o formato pra HTML
		    $mail->Subject = $this->Subject;
		    $mail->Body    = $this->Body;
		    //$mail->AltBody = 'Corpo alternativo quando o programa cliente não lê HTML';

		    foreach ($this->vetor_destinatarios as $destino)
		    {
    		    $mail->addAddress($destino[0], $destino[1]);
			    //$mail->addCC('cc@example.com');
			    //$mail->addBCC('bcc@example.com');
		    } 
		
		    return $mail->send();
		    
		} 
		catch (Exception $e) 
		{
		    echo 'ERRO: ', $mail->ErrorInfo;
		    return false;
		}
	}
}

