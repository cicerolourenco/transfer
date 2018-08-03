<?php
/*
 * classe TLogger
 * Esta classe provê uma interface abstrata para definição de algoritmos de LOG
 */
abstract class TLogger
{
    protected $_filename;  // local do arquivo de LOG
    
    /*
     * instancia um logger
     * @param $filename = local do arquivo de LOG
     */
    public function __construct($nome_arquivo)
    {
        $this->_filename = $nome_arquivo;
        // reseta o conteúdo do arquivo
        //file_put_contents($nome_arquivo, '');
    }
    
    // define o método write como obrigatório
    abstract function write($message, $bool_limpar=false);
}
?>