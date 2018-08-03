<?php

/**
 * @author Cícero Lourenço da Silva
 *
 */
class Upload extends TRecord
{
	const TABLENAME = 'upload';
	
	const HANDLER_POST = 'js/upload.php'; // script PHP que receberá o POST	
	const DESTINO_ARQUIVO = 'userfiles/upload/'; // pasta que armazenará temporariamente o arquivo
	const PRAZO = ' 1 DAY '; // string SQL do prazo de validade do arquivo (exclusão automática)

	
	/**
	 * Exclui o objeto e seu arquivo
	 * @see classes/app.ado/TRecord::delete()
	 */
	public function delete($id=null)
	{
		$upload = $id ? new self($id) : $this;
		$upload->exclui_arquivo();
		
		return parent::delete($boleto->id);
	}
	
	
	/**
	 * Transfere o upload para a pasta desejada
	 * @param string $pasta Pasta desejada (a partir da raíz do site)
	 */
	public function transfere($pasta,$arquivo_alterado="")
	{
		$nome_imagem = $arquivo_alterado ? $arquivo_alterado : $this->nome_arquivo;

		$end_atual = DIR_ROOT . self::DESTINO_ARQUIVO . $nome_imagem;
		$end_novo = DIR_ROOT . $pasta . $this->nome_arquivo;
		
		// muda o arquivo para a pasta definitiva
		rename($end_atual, $end_novo);
		
		// exclui o upload
		$this->delete();
		
		// limpa os antigos
		self::limpa();
	}
		
	
	/**
	 * Exclui os uploads antigos que não foram relacionados a um item no site
	 * para não encher o disco
	 */
	public static function limpa()
	{ 
		$rep = new TRepository(__CLASS__);
		$crit = new TCriteria();
		$crit->add(new TFilter('quando', '<', ' NOW()-INTERVAL ' . self::PRAZO));
		$lista = $rep->load($crit);
		
		if($lista)
		{
			foreach ($lista as $upload)
			{
				$upload->delete();
			}
		}
	}

	
	/**
	 * Exclui o arquivo do disco
	 * @param int $id ID do objeto no banco. Se informado, instancia o objeto
	 */
	public function exclui_arquivo($id=null)
	{
		$upload = $id ? new self($id) : $this;
		@unlink(DIR_ROOT . self::DESTINO_ARQUIVO . $upload->nome_arquivo);
		@unlink(DIR_ROOT . self::DESTINO_ARQUIVO ."c_". $upload->nome_arquivo);
		$upload->nome_arquivo = '';
	}





	/**
	 * Retorna a string que deve ser passada para permitir o campo de upload de arquivos
	 * @param string $id_campo ID do campo no DOM
	 * @param array $vetor_extensoes Vetor unidimensional com as extensões permitidas (consultar o padrão do JS de upload) 
	 * @param int $tamanho_max Tamanho máximo do upload em KBytes
	 * @param string $arquivo_existente Caminho do arquivo existente (cria link para exibí-lo)
	 * @param bool $boolCrop valor que analisa se a imagem deve exibir a opcao de croop
	 */
	public static function write($id_campo, $vetor_extensoes=null, $tamanho_max=null, $arquivo_existente=null, $classe_input='', $boolCrop=false,$escala="")
	{
		$php_upload = DIR_CMS_HTM_ROOT . self::HANDLER_POST; //script PHP que receberá o POST
		$seletor_campo = '#' . $id_campo;
		$id_div = 'fu' . rand(0,1000);
		$id_objeto = 'obj_upload_' . $id_div;
		
		if($vetor_extensoes!=null)
		{
			$vetor_extensoes_js = "new Array(";
			foreach($vetor_extensoes as $extensao)
			{
				$vetor_extensoes_js .= "'" . $extensao . "', ";
			}
			$vetor_extensoes_js = substr($vetor_extensoes_js, 0, -2);
			$vetor_extensoes_js .= ")";
		}
		
		global ${$id_campo};
		
		ob_start();
		?>
		<input type="hidden" name="<?=$id_campo?>" id="<?=$id_campo?>" value="<?=${$id_campo}?>" class="<?=$classe_input?>" escala="<?=$escala;?>"  />
	    <div id="<?=$id_div?>">
	    	<?
			if($arquivo_existente!=null)
			{
				$vetor_img = array('jpg', 'jpeg', 'gif', 'png');
				$classe_lightbox = in_array(Utils::extensao($arquivo_existente), $vetor_img) ? 'ceebox' : '';
				?>
	            <span class="arq_anterior"><a href="<?=$arquivo_existente?>" target="_blank" class="bt_ico ico_view_on <?php echo $classe_lightbox;?>"><em>arquivo</em></a></span>
	            <?
			}
			?>
	        <div class="upload_box_arquivo" style="display: none;">
	            <a href="#" target="_blank" class="bt_ico ico_view_on" title="visualizar"><em>visualizar</em></a>
	            <a href="javascript:obj_<?=$id_div?>.upload_delete()" class="bt_ico ico_exc_up_on" title="excluir"><em>excluir</em></a>
				<? if($boolCrop){?>
					<a onclick="editarImagem('<?=$seletor_campo?>'); " rel="iframe" class="bt_ico ico_edit_on" title="Editar imagem"><em>editar</em></a>
				<? }?>
	        </div>
	        <div class="upload_loading" style="display: none;"><img src="<?=DIR_CMS_HTM_ROOT?>images/icons/loading_peq.gif" width="16" height="16" /></div>
	        <div class="upload_progresso" style="display:none;">
	            <div class="upload_barra">
	                <div class="upload_bg_barra"></div>
	                <div class="upload_nome_imagem"></div>
	            </div>
	            <a href="#" onclick="obj_<?=$id_div?>.cancelUpload()" class="bt_ico ico_cancel_on" title="cancelar"><em>cancelar</em></a>
	        </div>
	        <a id="<?=$id_objeto?>" class="bt_ico ico_folder_on" title="procurar..."><em>procurar...</em></a>
	        <script type="text/javascript">
	            var obj_<?=$id_div?> = new FileUploader('<?=$id_objeto?>', '<?=$seletor_campo?>', '#<?=$id_div?>', '<?=$php_upload?>', <? if(!$vetor_extensoes_js) echo 'null'; else echo $vetor_extensoes_js; ?>, <? if(!$tamanho_max) echo 'null'; else echo $tamanho_max; ?>);
	        </script>
	    </div>
	    <?
		$string_resultado = ob_get_contents();
		ob_flush();
		return $string_resultado;
	}
	
}
