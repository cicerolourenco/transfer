<?php

class View 
{
    protected $_file;
    public $_uri;
    protected $_data = array();
    const PAGE404 = 'erro404.php';
    
    // assign de variáveis comuns a todos
    private $_topMenu;  
//                              'O que fazemos?'=>array('_parent'=>'trabalho', 
//                                                      'Passeios'=>'trabalho/passeios',
//                                                      'Treinos'=>'treinos',
//                                                      'Viagens'=>'trabalho/viagens',
//                                                      ), 
                                
    

    
    /**
     * Monta e imprime o menu principal
     * @param array $v Vetor com os dados a serem renderizados
     */
    public function montaMenu($v=null)
    {
        $proximos = Evento::lista_proximos(3);

        if(sizeof($proximos)>0)
        {
            $this->_topMenu['Treinos'] = 'treinos';
        }
        $this->_topMenu['Vídeos'] = 'videos';
        $this->_topMenu['Viagens'] = 'viagens';
        //$this->_topMenu['Calend&aacute;rio'] = 'calendario';
        //$this->_topMenu['Uniformes'] = 'uniformes';
        $this->_topMenu['Os Braddocks'] = 'braddocks';
        //$this->_topMenu['Dicionário'] = 'dicionario'; 
        $this->_topMenu['Fotos'] = 'fotos'; 
        $this->_topMenu['Contato'] = 'contato';



        if($v==null)
        {
            $v = $this->_topMenu;
            $class_ul = 'nav navbar-nav'; // classe do menu principal
            $level1 = true;
        }
        else
        {
            $class_ul = 'dropdown-menu'; // classe dos submenus
            $level1 = false;
        }
        
        // escreve o menu
        echo '<ul class="'.$class_ul.'">';
        foreach($v as $nome=>$dest)
        {
            if(is_array($dest))
            {
                $pasta = $dest['_parent'];
            }
            else
            {
                $destV = explode('/', $dest);
                $pasta = $destV[0];
            }
            
            $class_active = $pasta==$this->_uri[0] || ($dest=='' && $this->_uri[0]=='') ? 'active' : '';
            if(is_array($dest))
            {
                echo '<li class="'.$class_active.' dropdown"><a href="'.DIR_HTM_ROOT.$dest['_parent'].'" class="dropdown-toggle" data-toggle="dropdown">'.$nome.'</a>' . PHP_EOL;
                $this->montaMenu($dest);
                echo '</li>';
            }
            elseif($nome!='_parent')
            {
                if(!$level1) $class_active=''; // gambiarra pra desmarcar como "active" os sub-itens
                echo '<li class="'.$class_active.'"><a href="'.DIR_HTM_ROOT.$dest.'">'.$nome.'</a></li>' . PHP_EOL;
            }
        }
        echo '</ul>';
    } 
    

    
    /**
     * Construtor da classe
     * @param string $file Nome do arquivo template para o front-end
     */
    public function __construct($file)
    {
        $this->_file = $file;
//      Utils::dumpa($_SERVER['REQUEST_URI']);
//      Utils::dumpa(DIR_STRING_ROOT);
        $this->_uri = explode('/', str_replace(DIR_STRING_ROOT, '', $_SERVER['REQUEST_URI']));
        if($this->_uri[0]=='' && sizeof($this->_uri)>1) array_shift($this->_uri);
//      Utils::dumpa($this->_uri);
//      die();
    }

    
    /**
     * Guarda uma vari?vel para ser exibida no front-end 
     * @param string $key Nome da vari?vel
     * @param mixed $val Valor da vari?vel
     */
    public function assign($key, $val)
    {
        $this->_data[$key] = $val;
    }

    
    /**
     * Guarda todas as vari?veis do array para serem exibidas no front-end 
     * @param array $v Array com as vari?veis 
     */
    public function assign_array($v)
    {
        foreach ($v as $key=>$val)
        {
            $this->_data[$key] = $val;
        }
    }

    
    /**
     * Recupera o valor de uma vari?vel, se existir
     * @param string $key Nome da vari?vel
     */
    public function __get($key) 
    {
        if (array_key_exists($key, $this->_data)) 
        {
            return $this->_data[$key];
        }       
    }


    /**
     * Renderiza o template definido 
     */
    public function display()
    {
        if(!file_exists(DIR_VIEW . $this->_file))
        {
            //echo DIR_VIEW . $this->_file;
            die('Erro VIEW'); 
        }
        else
        {
            $this->assign('topMenu', $this->_topMenu);
            require_once DIR_VIEW . $this->_file;
            die();
        }
    }    
    
    
    /**
     * Imprime o erro na tela
     */
    public function escreve_erro()
    {
        if($this->erro!='')
        {
            echo '<div class="erro"><i class="icon-attention"></i> <p>'. $this->erro .'</p></div>';
        }
    }
    
    
    /**
     * Imprime o sucesso na tela
     */
    public function escreve_sucesso()
    {
        if($this->sucesso!='')
        {
            echo '<div class="sucesso"><i class="icon-thumbs-up"></i> <p>'. $this->sucesso .'</p></div>';
        }
    }
}