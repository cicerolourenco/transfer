<?php
/*
 * classe TLoggerTXT
 * implementa o algoritmo de LOG em TXT
 */
class TLoggerTXT extends TLogger
{
    /*
     * método write()
     * escreve uma mensagem no arquivo de LOG
     * @param $message = mensagem a ser escrita
     */
    public function write($message, $bool_limpar=false)
    {
    	$metodo_abertura = $bool_limpar ? 'w' : 'a';
    	
        // monta a string
        date_default_timezone_set('America/Sao_Paulo');
        $time = date("d/m/Y H:i:s");
        $text = "$time :: $message\n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->_filename, $metodo_abertura);
        fwrite($handler, $text);
        fclose($handler);
    }
}
?>