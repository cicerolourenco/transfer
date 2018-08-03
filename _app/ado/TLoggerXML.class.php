<?php
/*
 * classe TLoggerXML
 * implementa o algoritmo de LOG em XML
 */
class TLoggerXML extends TLogger
{
    /*
     * m�todo write()
     * escreve uma mensagem no arquivo de LOG
     * @param $message = mensagem a ser escrita
     */
    public function write($message, $bool_limpar=false)
    {
    	$metodo_abertura = $bool_limpar ? 'w' : 'a';
    	
        date_default_timezone_set('America/Sao_Paulo');
        $time = date("Y-m-d H:i:s");
        
        // monta a string
        $text = "<log>\n";
        $text.= "   <time>$time</time>\n";
        $text.= "   <message>$message</message>\n";
        $text.= "</log>\n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->_filename, $metodo_abertura);
        fwrite($handler, $text);
        fclose($handler);
    }
}
?>