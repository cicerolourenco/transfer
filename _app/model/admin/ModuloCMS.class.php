<?php

/**
 * @author Cícero Lourenço da Silva
 *
 */
class ModuloCMS extends TRecord
{
	const TABLENAME = 'cms_modulo';
	
	const DIRETORIO_IMAGEM = 'images/modulos/';
	const PREFIXO_IMAGEM = 'modulo_';
	const EXTENSAO_IMAGEM = '.png';
	
	
	
	/**
	 * Verifica se o diretório pesquisado é protegido e, em caso afirmativo, 
	 * verifica se o usuário fornecido tem permissão para acessar o módulo
	 * @param string $pasta nome do diretório pesquisado
	 * @param int $id_usuario ID do usuário no banco
	 * @return bool $retorno booleano (TRUE para permissão concedida)
	 */
	public static function autentica($pasta, $id_usuario=null)
	{
		$retorno = true;
		
		$usuario = $id_usuario ? new UsuarioCMS(floor($id_usuario)) : unserialize($_SESSION['con_usuario']);
		
		if(!$usuario->id)
		{
			$retorno = false;
		}
		else 
		{
			// verifica se há necessidade de permissão ao diretório atual
			$rep = new TRepository('ModuloCMS');
			$crit = new TCriteria();
			$crit->add(new TFilter('diretorio', '=', '"'. $pasta .'"'));
			$crit->setProperty('limit', 1);
			$lista = $rep->load($crit);
			
			if($lista)
			{
				// diretório está protegido, então verifica a permissão do usuário ao módulo
				$modulo = $lista[0];
				
				$rep = new TRepository('UsuarioModuloCMS');
				$crit = new TCriteria();
				$crit->add(new TFilter('id_usuario', '=', $usuario->id));
				$crit->add(new TFilter('id_modulo', '=', $modulo->id));
				
				if($rep->count($crit)==0)
				{
					$retorno = false;
				}
			}
		}
		
		return $retorno;
	}
	
	
	
	/**
	 * Retorna o endereço absoluto HTML da imagem que representa o módulo ou da imagem padrão, se não existir
	 * @param int $id ID do objeto no banco. Se informado, instancia um objeto
	 */
	public function get_imagem($id=null)
	{
		$modulo = $id ? new self($id) : $this;
		
		$caminho_php = DIR_CMS_ROOT . self::DIRETORIO_IMAGEM;
		$caminho_html = DIR_CMS_HTM_ROOT . self::DIRETORIO_IMAGEM;
		$imagem = self::PREFIXO_IMAGEM . $modulo->diretorio . self::EXTENSAO_IMAGEM;
		
		if(!file_exists($caminho_php . $imagem))
		{
			$imagem = 'padrao.png';
		}
		
		return $caminho_html . $imagem;
	}
	
	
	
	/**
	 * Auxilia na montagem do menu superior (classe do item ativo e imagem respectiva)
	 * @param string $diretorio Diretório da página atual
	 * @param string $dir_modulo Diretório do módulo pesquisado
	 */
	public static function getVetor($diretorio, $dir_modulo)
	{
		$vetor['auth'] = self::autentica($dir_modulo); 
		$vetor['current'] = $diretorio==$dir_modulo ? true : false; 
		
		return $vetor; 
	}
	
	
	
	
	
}
