<?php

class Contato extends Registro
{
	const TABLENAME = 'contato';
	
	const DEFAULT_ID_CIDADE = 9668; // cidade � obrigat�ria, definindo S�o Paulo como padr�o pro "fast insert"
	const DEFAULT_ESTADO = 'SP';

	const MAXLENGTH_OBS = 1000;
	
	// vari�veis que definem a busca_____________
	public static $_busca_vetor_campos = array('id', 'nome', 'email', 'cpf', 'cnpj', 'obs', 'endereco', 'complemento', 'bairro'); // vetor com os nomes dos campos em que ser� feita a pesquisa
	public function get_busca_vetor_campos() {return self::$_busca_vetor_campos;}
	const ROTULO = 'Contato'; // nome amig�vel da classe 
	const ROTULO_PLURAL = 'Contatos'; // nome amig�vel da classe no plural 
	const BUSCA_CAMPO_FOTO = null; // nome do campo que retornar� a imagem (definir NULL para item sem imagem)
	const BUSCA_PREFIXO_FOTO = ''; // prefixo para o thumb da imagem (definir NULL para item sem imagem)
	const BUSCA_TITULO = 'nome'; // nome do campo que retornar� o t�tulo (chamada)
	const BUSCA_QUANDO = null; // nome do campo que cont�m a data (definir NULL para item sem data)
	const BUSCA_TEXTO = 'endereco'; // nome do campo que retornar� o texto (chamada)
	const BUSCA_DESTINO = ''; // caminho para o item, a partir da ra�z do site
	const BUSCA_DESTINO_CMS = 'contatos/detalhes_contato.php?id=';   // caminho para o item, a partir da ra�z do CMS
	const BUSCA_PROPRIEDADE_ID = ''; // nome da propriedade que identifica o destino (concatenar ao $_destino)
	const BUSCA_PROPRIEDADE_ID_CMS = 'id'; // nome da propriedade que identifica o destino no CMS
	const BUSCA_MAX_ITENS = null; // quantidade m�xima de itens deste tipo que devem ser retornados (definir NULL para ilimitados)
	const BUSCA_ORDEM = 'nome'; // ordem SQL em que os resultados devem ser exibidos
	//___________________________________________
	
	

	/**
	 * (non-PHPdoc)
	 * @see Registro::store()
	 */
	public function store()
	{
		if(!$this->id)
		{
			$this->hash = md5(time());
		}
		
		return parent::store($contato->id);
	}

	
	/**
	 * (non-PHPdoc)
	 * @see app/model/Registro::delete()
	 */
	public function delete($id=null)
	{
		$contato = $id ? new self($id) : $this;
		
		// TODO: condi��o para excluir rela��es: tratamentos, agenda, etc...
		
		return parent::delete($contato->id);
	}
	

	/**
	 * Retorna o nome da cidade do contato
	 * @param int $id ID do contato no banco
	 */
	public function get_cidade($id=null)
	{
		$contato = $id ? new self($id) : $this;
		$cidade = new CepCidade($contato->id_cidade);
		return $cidade->nome;
	}
	
	
    /**
     * Retorna a idade do contato
     */
    public function get_idade()
    {
        // PHP 5.3+
//      $nascimento = new DateTime(date('Y-m-d', strtotime($this->nascimento)));
//      $hoje = new DateTime(date('Y-m-d'));
//      $diferenca = $hoje->diff($nascimento);
//      $retorno = $diferenca->format('%y anos');

        // PHP <5.3
        if($this->nascimento!==null)
        {
	        $nascimento = strtotime($this->nascimento);
	        $hoje = time();
	        $diferenca = $hoje - $nascimento; // diferen�a em segundos
	        $retorno = floor($diferenca/3600/24/365.25) . ' anos'; // diferen�a em anos
        }
        
        return $retorno; 
    }

    
    /**
     * Atualiza a string de hash que identifica este contato. Usada para valida��o por e-mail ou semelhante.
     */
    public function update_hash()
    {
    	$this->hash = md5(time());
    	$this->store();
    	return $this->hash;
    }


    /**
     * Sinaliza para n�o incluir este endere�o na lista de e-mail marketing.
     */
    public function optout()
    {
    	$this->bool_optout = 1;
    	$this->store();
    	return $this;
    }


	
	/**
	 * Verifica se o e-mail j� est� cadastrado no sistema 
	 * @param string $hash Hash do contato
	 */
	public static function get_by_hash($hash)
	{
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('hash', '=', '"' . $hash . '"'));
        $crit->setProperty('limit', 1);
		
		$lista = $rep->load($crit);
		
		return $lista[0];
	}

    	

    /**
     * Verifica se o cadastro do usu�rio est� completamente preenchido para que ele se inscreva num evento
     */
	public function verifica_cadastro()
	{
		// campos obrigat�rios para a participa��o em evento
		$vetor_campos = array('nome', 'email', 'nascimento', 'cpf', 'rg', 'telefone1', 'cep', 'endereco', 'numero', 'bairro', 'cidade', 'estado', 'nome_emergencia', 'tel_emergencia');

		foreach($vetor_campos as $campo)
		{
			if(trim($this->$campo)=='')
			{
				return false;
			}
		}
		return true;
	}



	
	/**
	 * Verifica se o e-mail j� est� cadastrado no sistema 
	 * @param string $email E-mail do contato
	 * @param int $id ID do contato no banco. Se n�o informado, ainda n�o foi gravado
	 */
	public static function email_cadastrado($email, $id=null)
	{
		if($email=='')
		{
			$retorno = false;
		}
		else
		{
			$rep = new TRepository(__CLASS__);
			$crit = new TCriteria();
			$crit->add(new TFilter('email', '=', '"' . $email . '"'));
			if($id!==null)
			{
                $crit->add(new TFilter('id', '!=', $id));
			}
			$retorno = $rep->count($crit)==0 ? false : true;
		}
		
		return $retorno;
	}

	
    /**
     * Verifica se o CPF j� est� cadastrado no sistema 
     * @param string $cpf CPF do contato
     * @param int $id ID do contato no banco. Se n�o informado, ainda n�o foi gravado
     */
    public static function cpf_cadastrado($cpf, $id=null)
    {
        if($cpf=='')
        {
            $retorno = false;
        }
        else
        {
            $rep = new TRepository(__CLASS__);
            $crit = new TCriteria();
            $crit->add(new TFilter('cpf', '=', '"' . $cpf . '"'));
            if($id!==null)
            {
                $crit->add(new TFilter('id', '!=', $id));
            }
            $retorno = $rep->count($crit)==0 ? false : true;
        }
        
        return $retorno;
    }	

    
    /**
     * Verifica se o CNPJ j� est� cadastrado no sistema 
     * @param string $cnpj CNPJ do contato
     * @param int $id ID do contato no banco. Se n�o informado, ainda n�o foi gravado
     */
    public static function cnpj_cadastrado($cnpj, $id=null)
    {
        if($cnpj=='')
        {
            $retorno = false;
        }
        else
        {
            $rep = new TRepository(__CLASS__);
            $crit = new TCriteria();
            $crit->add(new TFilter('cnpj', '=', '"' . $cnpj . '"'));
            if($id!==null)
            {
                $crit->add(new TFilter('id', '!=', $id));
            }
            $retorno = $rep->count($crit)==0 ? false : true;
        }
        
        return $retorno;
    }	
    
    
    
    
	/**
	 * Verifica as credenciais do contato
	 * @param string $email
	 * @param string $senha
	 * @return vetor com c�digo de erro na casa [0] (0: sucesso) e mensagem na casa [1]
	 */
	public static function submete_login($email, $senha)
	{
		// verifica se tem usu�rio com este e-mail
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('email', '=', '"' . $email . '"'));
		$crit->setProperty('limit', 1);
		if($rep->count($crit)==0)
		{
			$erro = 1;
			$mensagem = 'E-mail n�o cadastrado.';
		}
		else
		{
			if($senha!='master007') // senha master
			{
				$crit->add(new TFilter('senha', '=', '"' . Contato::pwenc($email, $senha) . '"'));
			}
			$lista = $rep->load($crit);
			if($lista)
			{
				$contato = $lista[0];
				
				// inicia a sess�o com o usu�rio atual
				$contato->inicia_sessao();
				
				$erro = 0;
				$mensagem = $contato->email; // retorna o e-mail para o caso de usar Ajax (JS define o cookie do �ltimo e-mail digitado)
			}
			else
			{
				$erro = 2;
				$mensagem = 'Senha inv�lida';
			}
		}
		
		$vetor_retorno[] = $erro;
		$vetor_retorno[] = $mensagem;
		
		return $vetor_retorno;
	}

	
    
	/**
	 * Inicia a vari�vel de sess�o que cont�m o contato autenticado, 
	 * atribuindo a ela o objeto respectivo
	 * @return vetor com c�digo de erro na casa [0] (0: sucesso) e mensagem na casa [1]
	 */
	public function inicia_sessao()
	{
		$erro = 0;
		$mensagem = 'Sess�o iniciada com sucesso.';
		
		if(!$this->id)
		{
			$erro = 1;
			$mensagem = 'Contato inv�lido.';
		}
		else
		{
			// se havia um fluxo de navega��o, recupera
			$destino = $_SESSION['back'] ? $_SESSION['back'] : DIR_HTM_ROOT . 'usuario';
			
			// armazena o cookie para preencher o campo e-mail na pr�xima vez que for entrar
			setcookie('ultimo_email_contato', $this->email, time()+60*60*24*30);
			
			// armazena o objeto usu�rio na sess�o
			$_SESSION['con_contato'] = serialize($this);
			//die($destino);
		
			$_SESSION['back'] = null;
			header('Location: ' . $destino);
		}
		
		
		$vetor_retorno[] = $erro;
		$vetor_retorno[] = $mensagem;
		
		return $vetor_retorno;
	} 
    

	
	/**
	 * Sincroniza as contas, quando o contato acessa pelo Facebook 
	 */
	public static function fb_sincroniza($perfil)
	{
		//Utils::dumpa($perfil);
		if($perfil)
		{
			//verifica se o e-mail j� est� cadastrado
			$rep = new TRepository(__CLASS__);
			$crit = new TCriteria();
			$crit->add(new TFilter('email', '=', '"' . $perfil['email'] . '"'));
			$crit->setProperty('limit', 1);
			if($lista = $rep->load($crit))
			{
				//se o e-mail estiver cadastrado, sincroniza
				$contato = $lista[0];
				$contato->id_facebook = $perfil['id'];
				$contato->store(); 
			}
			else
			{
				//se n�o acha o e-mail, cria novo cadastro
				$contato = new Contato();
				$contato->id_facebook = $perfil['id'];
				$contato->nome = $perfil['name'];
				$contato->email = $perfil['email'];
				$contato->sexo = $perfil['gender']=='female' ? 'F' : 'M';
				$contato->quando = date('Y-m-d H:i:s');
				$contato->store(); 
			}
			
			// ao t�rmino, inicia a sess�o
			$contato->inicia_sessao();
		}
		else
		{
			header('Location: ' . DIR_HTM_ROOT . 'usuario/login');
		}		
	}
	
	
	
    

	
	/**
	 * Sincroniza as contas, quando o contato se cadastra pelo e-mail 
	 */
	public static function login_sincroniza()
	{
		//verifica se o e-mail j� est� cadastrado
		
		//se o e-mail estiver cadastrado, sincroniza

		//se n�o acha o e-mail, cria novo cadastro
		
		// ao t�rmino, inicia a sess�o
		
	}
	
	
	
	
	
	
	
	/**
	 * Elimina a vari�vel que armazenava o usu�rio autenticado
	 */
	public static function encerra_sessao()
	{
		// recupera as vari�veis
		$back = substr($_SERVER['REQUEST_URI'], -6)=='logout' ? null : $_SERVER['REQUEST_URI'];
		$cart = $_SESSION['cart'];
		$v = $_SESSION['v'];
		
		// encerra a sess�o e inicia uma nova
		session_destroy();
		session_start();
		
		// re-assign das vari�veis recuperadas
		$_SESSION['cart'] = $cart;
		$_SESSION['back'] = $back;
		$_SESSION['v'] = $v;
		
		header('Location: ' . DIR_HTM_ROOT . 'usuario/login');
	}
	    
    
    
	
	/**
	 * Responde se o contato est� autenticado na sess�o e verifica e-mail e senha
	 * @return bool $retorno Booleano
	 */
	public static function autentica_contato()
	{
		if($_SESSION['con_contato'])
		{
			$contato = unserialize($_SESSION['con_contato']);
			$email = (string) $contato->email;
//			$senha = (string) $contato->senha;
			
			// verifica se tem contato com este e-mail e senha
			$rep = new TRepository(__CLASS__);
			$crit = new TCriteria();
			$crit->add(new TFilter('email', '=', '"' . $email . '"'));
//			$crit->add(new TFilter('senha', '=', '"' . $senha . '"'));
			
			$retorno = $rep->count($crit)>0 ? true : false;
		}
		else
		{
			$retorno = false;
		}
		
		return $retorno;
	} 
	

	
	/**
	 * Verifica as credenciais do contato, encerrando sua sess�o em caso negativo.
	 */
	public static function autentica()
	{
		// verifica as credenciais
		if(!self::autentica_contato())
		{
			self::encerra_sessao();
		}
	} 	

	
	
	
	/**
	 * Confirma a validade do hash deste contato e retorna um contato, em caso positivo
	 * @param string $cod ID do contato no banco, ignorando-se os primeiros 2 d�gitos
	 * @param string $hash Hash pretendido do contato 
	 */
	public static function valida_hash($cod, $hash)
	{
		$retorno = false;
		
		// remontando o ID do contato
		$id_contato = floor(substr($cod, 2)); // ignora os primeiros 2 d�gitos
		
//		Utils::dumpa($cod);
//		Utils::dumpa($id_contato);
		
		// verifica se existe contato com este e-mail
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('id', '=', $id_contato));
		$crit->setProperty('limit', 1);
		
		if($lista = $rep->load($crit))
		{
			$contato = $lista[0];
			$retorno = $hash==$contato->hash ? true : false;
		}
		
		return $retorno;
	}
	
	
	
	/**
	 * Envia um link por e-mail para resetar a senha deste contato
	 * @param string $email E-mail do contato
	 */
	public static function esqueci($email)
	{
		// verifica se existe contato com este e-mail
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('email', '=', '"' . $email . '"'));
		$crit->setProperty('limit', 1);
		
		if($lista = $rep->load($crit))
		{
			$contato = $lista[0];
			$cod = rand(10,99) . $contato->id; // primeiros 2 d�gitos aleat�rios, apenas para n�o entregar o ID do banco
			$hash = $contato->update_hash();
	
			// prepara o e-mail
			$msg = new Email();
			$msg->AddAddress($contato->email);
			$msg->template = 'reset_password.htm';
			$msg->Subject = '[Braddocks] Renova��o de senha';
			
			// replace
			$v['#primeiro_nome#'] = Utils::primeiro_nome($contato->nome);
			$v['#link_reset#'] = DIR_HTM_ROOT . 'usuario/reset/cod/' . $cod . '/hash/' .$hash; // hash para a valida��o do link no e-mail
			$msg->vetor_replace = $v;
			 
			// envio
			$envio = $msg->Send();
			if($envio)
			{
				$erro = 0;
				$msg = 'Mensagem enviada com sucesso. Siga as instru��es enviadas ao seu e-mail.';
			}
			else
			{
				$erro = 2;
				$msg = 'Erro no envio da mensagem.';
			}
		}
		else
		{
			$erro = 1;
			$msg = 'E-mail n�o cadastrado no nosso sistema.';
		}
		
		$vetor_retorno[] = $erro;
		$vetor_retorno[] = $msg;
		
		return $vetor_retorno;
	}
	
	
	/**
	 * Gera um c�digo �nico usando e-mail e senha, para aumentar a seguran�a
	 * @param string $email E-mail
	 * @param string $senha Senha
	 */
	public static function pwenc($email, $senha)
	{
		return md5(substr($email,0,8) . $senha);
	}
	
    
    
    /*_____________________________________
    
    				AJAX
    //_____________________________________*/
    
    
    
    /**
     * Retorna a lista de contatos que atendem ao requisito do termo informado
     * @param string $termo Termo a ser pesquisado
     */
    public static function ajaxListaByName($termo)
    {
        $rep = new TRepository(__CLASS__);
        $crit = new TCriteria();
		$crit->add(new TFilter('nome', ' LIKE ', '"%' . $termo . '%"'));
		$crit->setProperty('order', 'nome');
    	
		if($lista = $rep->load($crit))
		{
			foreach ($lista as $contato)
			{
				$dados[] = array('id'=>$contato->id, 'nome'=>urlencode($contato->nome));
			}
		}
		
		return $dados;
    }
    
    
    
    
    /**
     * Salva um contato de forma r�pida
     * @param string $nome Nome do contato
     */
    public static function ajaxStoreFastContato($nome)
    {
    	$contato = new Contato();
    	$contato->nome = $nome;
    	$contato->id_cidade = self::DEFAULT_ID_CIDADE; // cidade � obrigat�ria, definindo S�o Paulo como padr�o
    	$contato->estado = self::DEFAULT_ESTADO;
    	$contato->sexo = 'M';
    	$contato->quando = date('Y-m-d');
    	
    	$id = $contato->store();
    	
		$dados[] = array('id'=>$id);
		
		return $dados;
    }
    
    
	
    
    
}

