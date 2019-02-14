<?php

if($_POST['hash'])
{
	// atualiza os dados da reserva
	$reserva = Reserva::get_by_hash($_POST['hash']);

	// confirma se a data escolhida pela pessoa atende a antecedência mínima
	$dia_min = Reserva::get_min_date();

	if(!$erro)
	{
		if($reserva->tiporeserva!=3)
		{
			$v_chega = explode('-', $_POST['data_chegada']);
			$dt_chega = new Datetime($v_chega[2].'-'.$v_chega[1].'-'.$v_chega[0]);

			if($dt_chega->diff($dia_min) < 0)
			{
				$erro = true;
				$msg_erro = 'Data de chegada inválida (' . $_POST['data_chegada'] . '). Antecedência insuficiente (mín: ' . $dia_min->format('d-m-Y') . ').';
			}
		}
	}


	if(!$erro)
	{
		if($reserva->tiporeserva!=2)
		{
			$v_parte = explode('-', $_POST['data_partida']);
			$dt_parte = new Datetime($v_parte[2].'-'.$v_parte[1].'-'.$v_parte[0]);

			if($dt_parte->diff($dia_min) < 0)
			{
				$erro = true;
				$msg_erro = 'Data de saída inválida (' . $_POST['data_partida'] . '). Antecedência insuficiente (mín: ' . $dia_min->format('d-m-Y') . ').';
			}
		}
	}


	if(!$erro)
	{
		$reserva->quando_chega = $reserva->tiporeserva==3 ? null : $v_chega[2].'-'.$v_chega[1].'-'.$v_chega[0] . ' ' . $_POST['hora_chegada'];
		$reserva->quando_parte = $reserva->tiporeserva==2 ? null : $v_parte[2].'-'.$v_parte[1].'-'.$v_parte[0] . ' ' . $_POST['hora_partida'];
		$reserva->numero_voo_chega = $_POST['numero_voo_chega'];
		$reserva->numero_voo_parte = $_POST['numero_voo_parte'];
		$reserva->bool_duty_free = $_POST['bool_duty_free'] ? 1 : 0;
		$reserva->bool_internacional = $_POST['bool_internacional'] ? 1 : 0;
		$reserva->observacoes = $_POST['observacoes'];

		$reserva->nome = $_POST['nome'];
		$reserva->cpf = $_POST['cpf'];
		$reserva->telefone = $_POST['telefone'];
		$reserva->email = $_POST['email'];

		// anula os campos que não vão para o banco
		$campos = array('etapa', 'data_chegada', 'hora_chegada', 'data_partida', 'hora_partida');
		foreach ($campos as $atributo) 
			$reserva->{$atributo} = null;

		$reserva->store();
		$sucesso = true;
	}
}



// ------------------------------------------------------

if(isset($_GET['cancel']))
{
	$reserva = Reserva::get_by_hash($_GET['cancel']);
	if(!$reserva->id)
	{
		$erro = true;
		$msg_erro = 'Reserva não encontrada.';
	}
	else
	{
		$reserva->delete();
		$sucesso_cancelada = true;
	}
}

?>




<section class="section">
	<div class="row align-center">
		<div class="column small-12 large-10">		

			<?php
			if($erro)
			{
				?>
				<p style="margin: 50px 0; display: block; padding: 20px; background: #ffeb3b; color: #900;"><?=$msg_erro?></p>
				<?php
			}


			// se já postou, abre o resumo dos valores ou o sucesso (confirmação final)
			if($sucesso_cancelada)
			{
				?>
				<header class="s-header align-center">
					<h2 class="s-headline"> RESERVA CANCELADA<span class="s-headline-decor"></span></h2>
				</header>
				<p>Confirmamos o cancelamento da reserva.</p>
				<?php					
			}
			elseif($sucesso)
			{
				?>
				<header class="s-header align-center">
					<h2 class="s-headline"> RESERVA ALTERADA<span class="s-headline-decor"></span></h2>
				</header>

                <header class="s-header align-center" style="margin-bottom: 20px;">
					<h2 class="s-headline"> Dados Pessoais<span class="s-headline-decor"></span></h2>
				</header>
    
                <div class="box-cinza" style="padding: 20px 40px 10px;">
				    <div class="row small-up-2 medium-up-4">
                        <div class="column">
                            <strong>Nome</strong> <em> <?=$reserva->nome?></em>
                        </div>
						<div class="column">
							<strong>E-mail</strong> <em><?=$reserva->email?></em>
						</div>
						<div class="column">
							<strong>CPF</strong> <em> <?=$reserva->cpf?></em>
						</div>
                        <div class="column">
							<strong>Telefone</strong> <em> <?=Utils::formata_tel($reserva->telefone)?></em>
						</div>
				    </div>
                </div>
    
                <header class="s-header align-center" style="margin-bottom: 20px; margin-top: 35px;">
					<h2 class="s-headline"> Dados da Reserva<span class="s-headline-decor"></span></h2>
				</header>

                <div class="box-cinza" style="padding: 20px 40px 10px;">
				    <div class="row small-up-2 medium-up-3">
                        <div class="column">
                            <strong>Tipo de reserva:</strong> <em> <?=$reserva->get_tipo()?></em>
                        </div>
                        <div class="column">
                            <strong>Adultos</strong> <em>(10 anos ou mais): <?=$reserva->qtd_adt?></em>
                        </div>
						<div class="column">
							<strong>Bebês</strong> <em>(0 a 4 anos): <?=floor($reserva->qtd_chd_5)?></em>
						</div>
						<div class="column">
							<strong>Crianças</strong> <em>(5 a 9 anos): <?=floor($reserva->qtd_chd_10)?></em>
						</div>
                        <div class="column">
							<strong>Passageiros:</strong> <em> <?=$reserva->get_qtd_pax()?></em>
						</div>
                       
                        <?php
				          if($reserva->quando_chega!=null)
				          {
					     ?>
                        <div class="column">
							<strong>Pouso previsto:</strong> <em> <?=date('d/m/Y à\s H:i', strtotime($reserva->quando_chega))?></em>
						</div>
                        <div class="column">
							<strong>Número do voo (ida):</strong> <em> <?=$reserva->numero_voo_chega?></em>
						</div>
                        <div class="column">
							<strong>Voo internacional:</strong> <em> <?=($reserva->bool_internacional ? 'sim' : 'não')?></em>
						</div>
                        <div class="column">
							<strong>Passar no Duty Free:</strong> <em> <?=($reserva->bool_duty_free ? 'sim' : 'não')?></em>
						</div>
					    <?php
                        }
                        ?>


                        <?php
                        if($reserva->quando_parte!=null)
                        {
                            ?>
                        <div class="column">
							<strong>Decolagem prevista:</strong> <em> <?=date('d/m/Y à\s H:i', strtotime($reserva->quando_parte))?></em>
						</div>
                        <div class="column">
							<strong>Número do voo (volta):</strong> <em> <?=$reserva->numero_voo_parte?></em>
						</div>
                            <?php
                        }
                        ?>
                         
                        <div class="column">
							<strong>Bairro:</strong> <em> <?=$reserva->get_bairro()?></em>
						</div>
                        <div class="column">
							<strong>Comuna:</strong> <em> <?=$reserva->get_comuna()?></em>
						</div>
                        <div class="column">
							<strong>Endereço de destino:</strong> <em> <?=$reserva->endereco_destino?></em>
						</div>
				    </div>
                    <div class="row small-up-1">
                        <div class="column text-center">
                            <h3><strong>VALOR TOTAL:</strong> CLP <em><?=Utils::formata_num($reserva->preco, 0)?></em></h3>
                        </div>
				    </div>
                </div>

				<?php
			}
			else
			{
				$hash = $_GET['h']; //var_dump($hash);
				$reserva = Reserva::get_by_hash($hash);

				if(!$reserva->id)
				{
					?>
					<p>Reserva não encontrada.</p>
					<?php
				}
				else
				{
					?>
					<form data-abide novalidate action="" method="post" autocomplete="off">

						<header class="s-header align-center">
							<h2 class="s-headline"> ALTERAÇÃO DE RESERVA<span class="s-headline-decor"></span></h2>
						</header>

	                    <div class="box-cinza">
						    <div class="row small-up-1 medium-up-3">
	                            <div class="column">
	                                <strong>Adultos</strong> <em>(10 anos ou mais): <?=$reserva->qtd_adt?></em>
	                            </div>
								<div class="column">
									<strong>Bebês</strong> <em>(0 a 4 anos): <?=floor($reserva->qtd_chd_5)?></em>
								</div>
								<div class="column">
									<strong>Crianças</strong> <em>(5 a 9 anos): <?=floor($reserva->qtd_chd_10)?></em>
								</div>
						    </div>
	                        <div class="row small-up-1 medium-up-3">
	                            <div class="column">
	                                <strong>Bairro:</strong> <?=$bairro->nome?>
	                            </div>
	                            <div class="column">
	                                <strong>Endereço:</strong> <?=$reserva->endereco_destino?>
	                            </div>
	                            <div class="column">
	                                <strong>Tipo:</strong> <?=$reserva->get_tipo()?>
	                            </div>
	                        </div>
	                        <div class="row">
	                            <div class="column text-center">
	                                <h3><strong>VALOR TOTAL:</strong> CLP <?=Utils::formata_num($reserva->preco, 0)?>  <em>(<?=$reserva->get_qtd_pax()?> passageiros)</em></h3>
	                            </div>
	                        </div>
	                    </div>

						<!-- ---------------------- -->


						<header class="s-header align-center" style="margin-top: 50px;">
							<h2 class="s-headline"> Dados do Voo<span class="s-headline-decor"></span></h2>
	                        <?php if($reserva->tiporeserva!=2) : ?>
	                        <br><br>
	                        <p>No Transfer Out a saída do hotel é realizada com 3 a 4 horas antes do voo dependendo do horário da saída.</p>
	                        <?php endif; ?>
						</header>
	                    
						<div class="row js-datepicker-group small-up-1 medium-up-3">
							<div class="column medium-4">
								<label class="chegada">
	                                <p class="mobile-hidden">Data de chegada</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-calendar-check fa fa-calendar-check-o"></span>
										<input class="input-group-field js-datepicker-date chegadainput" type="text" name="data_chegada" placeholder="Data de chegada" required value="<?=date('d-m-Y', strtotime($reserva->quando_chega))?>">
									</span>
								</label>
								<label class="partida">
	                                <p class="mobile-hidden">Data de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-calendar-close fa fa-calendar-times-o"></span>
										<input class="input-group-field js-datepicker-date partidainput" type="text" name="data_partida" placeholder="Data de saída" required value="<?=date('d-m-Y', strtotime($reserva->quando_parte))?>">
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label class="chegada">
	                                <p class="mobile-hidden">Horário do voo de chegada</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-check fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time chegadainput" type="text" name="hora_chegada" placeholder="Horário do voo de chegada" required value="<?=date('H:i', strtotime($reserva->quando_chega))?>">
									</span>
								</label>
								<label class="partida">
	                                <p class="mobile-hidden">Horário do voo de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-off fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time partidainput" type="text" name="hora_partida" placeholder="Horário do voo de saída" required value="<?=date('H:i', strtotime($reserva->quando_parte))?>">
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label class="chegada">
	                                <p class="mobile-hidden">Voo de chegada</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field chegadainput" type="text" name="numero_voo_chega" placeholder="Número do voo de chegada" required value="<?=$reserva->numero_voo_chega?>">
									</span>
								</label>
								<label class="partida">
	                                <p class="mobile-hidden">Voo de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field partidainput" type="text" name="numero_voo_parte" placeholder="Número do voo de saída" required value="<?=$reserva->numero_voo_parte?>">
									</span>
								</label>
							</div>
						</div>
						
						<div class="row small-up-1  medium-up-3">
							<div class="column medium-4 text-center">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-shopping-bag fa-fw"></span>
										<select class="input-group-field placeholder" name="bool_duty_free" required>
											<option disabled selected hidden value="">Deseja visitar Duty Free?</option>
											<option value="1" <?php if($reserva->bool_duty_free==1) echo 'selected'; ?>>Sim</option>
											<option value="0" <?php if($reserva->bool_duty_free==0) echo 'selected'; ?>>Não</option>
										</select>
									</span>
								</label>											
							</div>
							<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-send fa-fw"></span>
										<select class="input-group-field placeholder" name="bool_internacional" required>
											<option disabled selected hidden value="">Tipo de voo</option>
											<option value="0" <?php if($reserva->bool_internacional==0) echo 'selected'; ?>>Nacional</option>
											<option value="1" <?php if($reserva->bool_internacional==1) echo 'selected'; ?>>Internacional</option>
										</select>
									</span>
								</label>
							</div>
							<?php /*<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-city zmdi-hc-fw"></span>
										<input class="input-group-field" type="text" name="hora_parte_hotel" placeholder="Hora preferida de saída do hotel" required>
									</span>
								</label>
								
							</div>*/ ?>
						</div>

						<div class="row small-up-1">
							<div class="column medium-12">
								<label>Observações</label>
								<span class="input-group">
									<textarea class="input-group-field placeholder" name="observacoes"><?=$reserva->observacoes?></textarea>
								</span>
							</div>
						</div>


						<header class="s-header align-center" style="margin-top: 50px;">
							<h2 class="s-headline"> Dados de Contato<span class="s-headline-decor"></span></h2>
						</header>
						
						<div class="row small-up-1 medium-up-2">
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-account fa fa-user"></span>
										<input class="input-group-field" type="text" name="nome" placeholder="Nome" required value="<?=$reserva->nome?>">
									</span>
								</label>										
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-vcard fa-fw"></span>
										<input class="input-group-field" type="text" name="cpf" placeholder="CPF" required value="<?=$reserva->cpf?>">
									</span>
								</label>
							</div>
						</div>
						<div class="row small-up-1 medium-up-3">
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-phone fa fa-phone"></span>
										<input class="input-group-field" type="text" name="telefone" data-type-phone placeholder="Telefone" required value="<?=$reserva->telefone?>">
									</span>
								</label>
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-email fa fa-envelope"></span>
										<input class="input-group-field" type="email" name="email" placeholder="E-mail" required value="<?=$reserva->email?>">
									</span>
								</label>
							</div>
						</div>
	                    
	                    <div class="alert callout" data-abide-error style="display: none;">
							<p><i class="fi-alert"></i> Existem alguns erros no formulário, por favor revise os dados e tente novamente.</p>
						</div>
						
						<div class="text-center">
							<button class="button rh-button mb0" type="submit"><i class="zmdi zmdi-mail-send"></i>
								<span>Salvar alterações</span>
							</button>
							&nbsp;&nbsp;&nbsp;
							<a href="#" class="button rh-button mb0 alert" onclick="confirma_cancelamento(event);"><i class="zmdi zmdi-mail-send"></i>
								<span>Cancelar reserva</span>
							</a>
						</div>

						<input type="hidden" name="hash" value="<?=$reserva->hash?>" />
					</form>
					<?php
				}
			}

			?>					
        </div><!-- /end .column -->
	</div><!-- /end .row -->
</section><!-- /end .section -->

<script type="text/javascript">
function confirma_cancelamento(e) {
	e.preventDefault();
	if(window.confirm('Você confirma o cancelamento desta reserva?')) {
		window.location = '?cancel=<?=$reserva->hash?>';
	} else {
		return false;
	}
}	
</script>