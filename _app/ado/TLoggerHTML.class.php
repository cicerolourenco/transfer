<?php
/*
 * classe TLoggerHTML
 * implementa o algoritmo de LOG em HTML
 */
class TLoggerHTML extends TLogger
{
    /*
     * método write()
     * escreve uma mensagem no arquivo de LOG
     * @param $message = mensagem a ser escrita
     */
    public function write($message, $bool_limpar=false)
    {
    	$metodo_abertura = $bool_limpar ? 'w' : 'a';
    	
        $time = date("Y-m-d H:i:s");
        
        // adiciona ao final do arquivo
        $handler = fopen($this->_filename, $metodo_abertura);
        fwrite($handler, $message);
        fclose($handler);
    }
}
