<?php

class Campo
{


	/**
	 * Escreve um trecho de código HTML/PHP para o campo do CMS
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write($view, $campo)
	{
		$def['type'] = 'text';
		$def['obr'] = 'required';
		$def['maxlength'] = 200;
		$def['contador'] = false;
		$def['classes'] = '';
		$def['obs'] = '';
		$def['autocomplete'] = 'off';
		$def['unidimensional'] = false; // arrays associativos são padrão


		foreach ($def as $k => $v) 
		{
			if(!isset($campo[$k]))
			{
				$campo[$k] = $v;
			}
		}

		switch ($campo['type']) {
			case 'diahorapicker':
			case 'diapicker':
			case 'horapicker':
			case 'datetimedupla':
				self::write_picker($view, $campo);
				break;
			
			case 'checkbox':
				self::write_checkbox($view, $campo);
				break;
			
			case 'select':
				self::write_select($view, $campo);
				break;
			
			case 'password':
				self::write_password($view, $campo);
				break;
			
			case 'textarea':
				self::write_textarea($view, $campo);
				break;
			
			default: // text, email
				self::write_text($view, $campo);
				break;
		}
	}


	/**
	 * Escreve tipo text
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_text($view, $campo)
	{
		ob_start();

		$str_valor = $campo['type']=='email' && $view->{$campo['id']}!='' ? '<a href="mailto:' . $view->{$campo['id']} . '">' . $view->{$campo['id']} . '</a>' : $view->{$campo['id']};
		?>
        <label class="form-label"><?=$campo['label']?></label>
        <div class="form-group">
            <div class="form-line">
                <input type="<?=$campo['type']?>" name="<?=$campo['id']?>" id="<?=$campo['id']?>" value="<?=$view->{$campo['id']}?>" <?php if(floor($campo['maxlength'])>0) echo 'maxlength="' . $campo['maxlength'] . '"';?> class="form-control <?=$campo['classes']?>" autocomplete="<?=$campo['autocomplete']?>" <?=$campo['obr']?>><span class="value"><?=$str_valor?></span>
                <?php if($campo['obs']!='') { ?><div class="help-block"><?=$campo['obs']?></div><?php } ?>
                <?php if($campo['contador']) { ?><div class="help-info"><?=$campo['maxlength']-strlen(utf8_decode($view->{$campo['id']}))?></div><?php } ?>
            </div>
        </div>
		<?php
		ob_end_flush();		
	}



	/**
	 * Escreve tipo password
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_password($view, $campo)
	{
		ob_start();
		?>
        <label class="form-label"><?=$campo['label']?></label>
        <div class="form-group">
            <div class="form-line">
                <input type="password" name="<?=$campo['id']?>" id="<?=$campo['id']?>" <?php if(floor($campo['maxlength'])>0) echo 'maxlength="' . $campo['maxlength'] . '"';?> class="form-control <?=$campo['classes']?>" <?=$campo['obr']?>><span class="value">******</span>
                <?php if($campo['obs']!='') { ?><div class="help-block"><?=$campo['obs']?></div><?php } ?>
                <?php if($campo['contador']) { ?><div class="help-info"><?=$campo['maxlength']?></div><?php } ?>
            </div>
        </div>
		<?php
		ob_end_flush();		
	}



	/**
	 * Escreve tipo textarea
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_textarea($view, $campo)
	{
		ob_start();

		$str_valor = $campo['type']=='email' && $view->{$campo['id']}!='' ? '<a href="mailto:' . $view->{$campo['id']} . '">' . $view->{$campo['id']} . '</a>' : $view->{$campo['id']};
		?>
        <label class="form-label"><?=$campo['label']?></label>
        <div class="form-group">
            <div class="form-line">
                <textarea name="<?=$campo['id']?>" id="<?=$campo['id']?>" <?php if(floor($campo['maxlength'])>0) echo 'maxlength="' . $campo['maxlength'] . '"';?> class="form-control <?=$campo['classes']?>" autocomplete="<?=$campo['autocomplete']?>" <?=$campo['obr']?>><?=$view->{$campo['id']}?></textarea><span class="value textarea"><?=$str_valor?></span>
                <?php if($campo['obs']!='') { ?><div class="help-block"><?=$campo['obs']?></div><?php } ?>
                <?php if($campo['contador']) { ?><div class="help-info"><?=$campo['maxlength']-strlen(utf8_decode($view->{$campo['id']}))?></div><?php } ?>
            </div>
        </div>
		<?php
		ob_end_flush();		
	}



	/**
	 * Escreve tipo select
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_select($view, $campo)
	{
		ob_start();
		?>
        <label class="form-label"><?=$campo['label']?></label>
        <div class="form-group">
            <div class="form-line">
                <select name="<?=$campo['id']?>" class="form-control <?=$campo['classes']?>" <?=$campo['obr']?>>
                    <?php  
                    if($campo['vazia']) { ?><option value=""></option><? }

                    if(isset($campo['lista_simples']))
                    {
                    	$chave = 'v';
                    	$value = $view->{$campo['id']};
                    	$campo['lista'] = $campo['lista_simples'];
                    }
                    else
                    {
                    	$chave = 'k';
                    	$value = $campo['value'];
                    }

                    if(is_array($campo['lista']))
                    {
	                    foreach ($campo['lista'] as $k=>$v) 
	                    {
	                        $seleciona = ${$chave}==$view->{$campo['id']} ? 'selected' : '';
	                        ?>
	                        <option value="<?=${$chave}?>" <?=$seleciona?>><?=$v?></option>
	                        <?php
	                    }
                    }
                    ?>
                </select><span class="value"><?=$value?></span>
                <?php if($campo['obs']!='') { ?><div class="help-block"><?=$campo['obs']?></div><?php } ?>
            </div>
        </div>
		<?php
		ob_end_flush();		
	}



	/**
	 * Escreve tipo date/timepicker
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_picker($view, $campo)
	{
		ob_start();
		?>
        <label class="form-label"><?=$campo['label']?></label>
        <div class="form-group">
            <div class="form-line">
                <input type="text" name="<?=$campo['id']?>" id="<?=$campo['id']?>" value="<?=$view->{$campo['id']}?>" class="form-control <?=$campo['type']?> <?=$campo['classes']?>" <?=$campo['obr']?>><span class="value"><?=$view->{$campo['id']}?></span>
                <?php if($campo['obs']!='') { ?><div class="help-block"><?=$campo['obs']?></div><?php } ?>
            </div>
        </div>
		<?php
		ob_end_flush();		
	}



	/**
	 * Escreve tipo checkbox
	 * @param object $view Objeto view
	 * @param array $campo Opções em array associativo
	 * @return type
	 */
	public static function write_checkbox($view, $campo)
	{
		ob_start();

		$label0 = isset($campo['label0']) ? $campo['label0'] : 'Não';
		$label1 = isset($campo['label1']) ? $campo['label1'] : 'Sim';
		$labelView = !$view->{$campo['id']} ? $label0 : $label1;
		?>
        <div class="toplabel"><?=$campo['label']?></div>
        <input type="checkbox" id="<?=$campo['id']?>" name="<?=$campo['id']?>" class="filled-in chk-col-light-blue <?=$campo['classes']?>" <?php if($view->{$campo['id']}) echo 'checked'; ?>>
        <label for="<?=$campo['id']?>" class="checklabel"><?=$label1?></label><span class="value checkvalue"><i class="icon-display fa <?php if($view->{$campo['id']}) echo 'fa-check'; else echo 'fa-times'; ?>"></i> <?=$labelView?></span>
		<?php
		ob_end_flush();		
	}




}
