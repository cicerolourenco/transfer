<?php

/*
 * Classe de controle
 */
abstract class Controller
{
	protected $view;
	public $css_files;
	public $unidade;
	public $vars = null;
	public $params = array();
	
	const PUBLICAR = true;

	/**
	 * Construtor
	 */
	public function  __construct() 
	{
		$this->init();
	}

	
	/**
	 * Esse metodo é chamado quando instanciado a classe Controller
	 * Esse método deverar ser sobrescrito quando querermos adicionar funcionalidades a uma area especifica ou eliminar o comportamento padrão dele
	 */
	public function init()
	{
		$this->trava();
		
//		$this->loadVarsPrincipais();
//		$this->loadCss();
//		$this->loadJs();

		$this->params = Mvc::getParams();
	}

	
	/**
	 * Disponibiliza as variáveis globais em todos os templates
	 
	private function loadVarsPrincipais()
	{
		$params  =  Mvc::getParams();
		for($i=0; $i<sizeof($params); $i++)
		{
			$url_atual .= "$params[$i]/";
		}
	}
	*/

	/**
	 * Intercepta a chamada para travar ou não o site da visitação
	 */
	public function trava()
	{
		if(!self::PUBLICAR)
		{
			//$paginas_liberadas = array('uniforme');
			$this->params = Mvc::getParams();
			$liberar = false; //in_array($params[0], $paginas_liberadas);
			
			//___trava temporária
			if(!preg_match('/^(localhost)|(192)|(127)/', $_SERVER['HTTP_HOST']) && !$liberar && $_GET['v']!=1 && $_SESSION['v']!=1)
			{
				$this->view = new View('des.php');
				$this->view->display();
			}
			elseif($_GET['v']==1)
			{
				$_SESSION['v']=1;
			}
		}
	}
	
	
	/**
	 * Carrega todos os arquivos CSS do site
	 */
	public function loadCss()
	{
		$vetor_css = $this->css_files;
	    // prepara os arquivos CSS para serem carregados______
//		$vetor_css[] = array('all', 'css/reset.css'); // --> tem que ser o primeiro
//		$vetor_css[] = array('all', 'css/main.css');
//		$vetor_css[] = array('all', 'css/header.css');
//		$vetor_css[] = array('all', 'css/footer.css');
//		$vetor_css[] = array('all', 'css/forms.css');
//		$vetor_css[] = array('all', 'css/home.css');	
//		$vetor_css[] = array('all', 'css/fonts.css');	
//		$vetor_css[] = array('print', 'css/print.css'); // --> tem que ser o último
		//____________________________________________________
		
	    $estilos = array();
	    if(is_array($vetor_css))
	    {
		    foreach($vetor_css as $arquivo)
		    {
			    if(file_exists(DIR_ROOT . $arquivo[1]))
			    {
				    $estilos[] = array($arquivo[0],$arquivo[1], floor(@filemtime(DIR_ROOT . $arquivo[1])));
			    }
		    }
	    }
	    
//		$this->view->assign('estilos', $estilos);
	    
	}
	
	
	/**
	 * Carrega todos os arquivos JS do site
	 */
	public function loadJs()
	{
	    // prepara os arquivos JS para serem carregados
	    // $vetor_js[][0] = charset
	    // $vetor_js[][1] = caminho a partir da raíz do site
//		$vetor_js[] = array('', 'js/funcoes.js');
		//____________________________________________________
		
	    $scripts = array();
	    if(is_array($vetor_css))
	    {
		    foreach($vetor_js as $arquivo)
		    {
				if(file_exists(DIR_ROOT . $arquivo[1]))
				{
					$charset = $arquivo[0]=='' ? '' : ' charset="' . $arquivo[0] . '"';
					$scripts[] = array($charset, $arquivo[1], filemtime(DIR_ROOT . $arquivo[1]));
				}
		    }
	    }
	    
//	    $this->view->assign('scripts', $scripts);
	}




}
