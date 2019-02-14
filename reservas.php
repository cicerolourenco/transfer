<?php

// se já vem com dados preenchidos, calcula o preço
if($_POST)
{
	//Utils::dumpa($_POST);

	$bairro = new Bairro(floor($_POST['id_bairro']));
	if($bairro->id)
	{
		$comuna = new Comuna($bairro->id_comuna);
		$preco = Reserva::calcula($comuna, floor($_POST['qtd_adt']), floor($_POST['qtd_chd_5']), floor($_POST['qtd_chd_10']), floor($_POST['tiporeserva']));
	}
	else
	{
		$erro = true;
		$msg_erro = 'Bairro não encontrado.';
	}


	// se já preencheu os dados, salva e confirma
	if(!$erro && $_POST['etapa']==2)
	{
		// confirma se a data escolhida pela pessoa atende a antecedência mínima
		$dia_min = Reserva::get_min_date();

		if(!$erro)
		{
			if($_POST['tiporeserva']!=3)
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
			if($_POST['tiporeserva']!=2)
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
			$objeto = new Reserva();
			$objeto->fromVetor($_POST);
			$objeto->quando_chega = $_POST['tiporeserva']==3 ? null : $v_chega[2].'-'.$v_chega[1].'-'.$v_chega[0] . ' ' . $_POST['hora_chegada'];
			$objeto->quando_parte = $_POST['tiporeserva']==2 ? null : $v_parte[2].'-'.$v_parte[1].'-'.$v_parte[0] . ' ' . $_POST['hora_partida'];
			$objeto->id_comuna = $comuna->id;
			$objeto->preco = $objeto->calcula_preco();
			$objeto->quando = date('Y-m-d H:i');
			$objeto->pid = null;

			// anula os campos que não vão para o banco
			$campos = array('etapa', 'data_chegada', 'hora_chegada', 'data_partida', 'hora_partida');
			foreach ($campos as $atributo) 
				$objeto->{$atributo} = null;

			//var_dump($objeto);
			$objeto->store();
			$objeto->envia_email();
			

			$reserva_confirmada = $objeto;

			$sucesso = true;
		}
	}
}


?>
<!-- ===== CONTACT FORM ===== -->

<section class="section">
	<div class="row align-center">
		<div class="column small-12 large-10">

			<?php
			//Utils::dumpa($_POST);

			if(!$_POST)
			{
				// se não postou nada, abre o form dos dados da reserva
				?>
				<form data-abide novalidate action="" method="post" autocomplete="off">

					<header class="s-header align-center">
						<h2 class="s-headline"> Dados da Reserva<span class="s-headline-decor"></span></h2>
					</header>

					<div class="row small-up-1 medium-up-3">
						<div class="column">
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-seat zmdi-hc-fw"></span>
									<select class="input-group-field placeholder" name="qtd_adt" required>
										<option disabled selected hidden value="">Quantos adultos? (10 anos ou mais)</option>
										<?php
										for($i=1; $i<=30; $i++)
										{
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php
										}
										?>
									</select>
								</span>
							</label>
						</div>
						<div class="column">
							<label>
								<span class="input-group">
									<span class="input-group-label fa fa-child fa-fw"></span>
									<select class="input-group-field placeholder" name="qtd_chd_5">
										<option selected value="0">Bebês (0 a 4 anos)</option>
										<?php
										for($i=0; $i<=30; $i++)
										{
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php
										}
										?>
									</select>
								</span>
							</label>
						</div>
						<div class="column">
							<label>
								<span class="input-group">
									<span class="input-group-label fa fa-male fa-fw"></span>
									<select class="input-group-field placeholder" name="qtd_chd_10">
										<option selected value="0">Crianças (5 a 9 anos)</option>
										<?php
										for($i=0; $i<=30; $i++)
										{
											?>
											<option value="<?=$i?>"><?=$i?></option>
											<?php
										}
										?>
									</select>
								</span>
							</label>
						</div>
					</div>
					<div class="row small-up-1 medium-up-2">
						<div class="column">
							<label>
								<span class="input-group">
									<span class="input-group-label fa fa-map fa-fw"></span>
									<select class="input-group-field placeholder" name="id_bairro" required>
										<option disabled selected hidden value="">Bairro</option>
										<?php
										$lista = Bairro::lista();
										foreach($lista as $bairro)
										{
											?>
											<option value="<?=$bairro->id?>"><?=$bairro->nome?></option>
											<?php
										}
										?>
									</select>
								</span>
							</label>
						</div>
						<div class="column">
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-pin zmdi-hc-fw"></span>
									<input class="input-group-field" type="text" name="endereco_destino" placeholder="Endereço" required>
								</span>
							</label>
						</div>
					</div>


                    <div class="text-center" style="margin-top: 20px;">
						<div class="radio radioreserva">
							<label>
								<input class="tiporeserva" type="radio" name="tiporeserva" value="1" required checked>
								<span class="custom-radio"><i class="icon-radio-check"></i>
								</span>Ida e Volta
							</label>
						</div>
                        <div class="radio radioreserva">
							<label>
								<input class="tiporeserva"  type="radio" name="tiporeserva" value="2" required>
								<span class="custom-radio"><i class="icon-radio-check"></i>
								</span>Somente Ida
							</label>
						</div>
                        <div class="radio radioreserva">
							<label>
								<input class="tiporeserva"  type="radio" name="tiporeserva" value="3" required>
								<span class="custom-radio"><i class="icon-radio-check"></i>
								</span>Somente Volta
							</label>
						</div>
					</div>
					


					<div class="text-center">
						<button class="button rh-button mb0" type="submit"><i class="zmdi zmdi-mail-send"></i>
							<span>Cotar</span>
						</button>
					</div>

					<input type="hidden" name="etapa" value="1" />
					<input type="hidden" name="pid" value="<?=floor($_POST['pid'])?>" />
				</form>				
				<?php
			}
			else
			{
				// se já postou, abre o resumo dos valores ou o sucesso (confirmação final)
				if($sucesso)
				{
					?>
					<header class="s-header align-center">
						<h2 class="s-headline"> RESERVA EFETUADA<span class="s-headline-decor"></span></h2>
					</header>

		            <?php /*<ul>
						<li>Nome: <?=$reserva_confirmada->nome?></li>
						<li>E-mail: <?=$reserva_confirmada->email?></li>
						<li>CPF: <?=$reserva_confirmada->cpf?></li>
						<li>Telefone: <?=Utils::formata_tel($reserva_confirmada->telefone)?></li>

						<li>Tipo de reserva: <?=$reserva_confirmada->get_tipo()?></li>
						<li>Adultos: <?=$reserva_confirmada->qtd_adt?></li>
						<li>Bebês (até 5 anos): <?=floor($reserva_confirmada->qtd_chd_5)?></li>
						<li>Crianças (até 10 anos): <?=floor($reserva_confirmada->qtd_chd_10)?></li>
						<li>Passageiros: <?=$reserva_confirmada->get_qtd_pax()?></li>
						<li>Preço: CLP <?=Utils::formata_num($reserva_confirmada->preco, 0)?></li>

						<li>Endereço de destino: <?=$reserva_confirmada->endereco_destino?></li>
						<li>Bairro: <?=$reserva_confirmada->get_bairro()?></li>
						<li>Comuna: <?=$reserva_confirmada->get_comuna()?></li>

						<?php
						if($reserva_confirmada->quando_chega!=null)
						{
							?>
							<li>Pouso previsto: <?=date('d/m/Y à\s H:i', strtotime($reserva_confirmada->quando_chega))?></li>
							<li>Número do voo (ida): <?=$reserva_confirmada->numero_voo_chega?></li>
							<li>Voo internacional: <?=($reserva_confirmada->bool_internacional ? 'sim' : 'não')?></li>
							<li>Passar no Duty Free: <?=($reserva_confirmada->bool_duty_free ? 'sim' : 'não')?></li>
							<?php
						}
						?>


						<?php
						if($reserva_confirmada->quando_parte!=null)
						{
							?>
							<li>Decolagem prevista: <?=date('d/m/Y à\s H:i', strtotime($reserva_confirmada->quando_parte))?></li>
							<li>Número do voo (volta): <?=$reserva_confirmada->numero_voo_parte?></li>
							<?php
						}
						?>
		            </ul>*/ ?>
            
                        <header class="s-header align-center" style="margin-bottom: 20px;">
							<h2 class="s-headline"> Dados Pessoais<span class="s-headline-decor"></span></h2>
						</header>
            
                        <div class="box-cinza" style="padding: 20px 40px 10px;">
						    <div class="row small-up-2 medium-up-4">
                                <div class="column">
                                    <strong>Nome</strong> <em> <?=$reserva_confirmada->nome?></em>
                                </div>
								<div class="column">
									<strong>E-mail</strong> <em><?=$reserva_confirmada->email?></em>
								</div>
								<div class="column">
									<strong>CPF</strong> <em> <?=$reserva_confirmada->cpf?></em>
								</div>
                                <div class="column">
									<strong>Telefone</strong> <em> <?=Utils::formata_tel($reserva_confirmada->telefone)?></em>
								</div>
						    </div>
                        </div>
            
                        <header class="s-header align-center" style="margin-bottom: 20px; margin-top: 35px;">
							<h2 class="s-headline"> Dados da Reserva<span class="s-headline-decor"></span></h2>
						</header>

                        <div class="box-cinza" style="padding: 20px 40px 10px;">
						    <div class="row small-up-2 medium-up-3">
                                <div class="column">
                                    <strong>Tipo de reserva:</strong> <em> <?=$reserva_confirmada->get_tipo()?></em>
                                </div>
                                <div class="column">
                                    <strong>Adultos</strong> <em>(10 anos ou mais): <?=$reserva_confirmada->qtd_adt?></em>
                                </div>
								<div class="column">
									<strong>Bebês</strong> <em>(0 a 4 anos): <?=floor($reserva_confirmada->qtd_chd_5)?></em>
								</div>
								<div class="column">
									<strong>Crianças</strong> <em>(5 a 9 anos): <?=floor($reserva_confirmada->qtd_chd_10)?></em>
								</div>
                                <div class="column">
									<strong>Passageiros:</strong> <em> <?=$reserva_confirmada->get_qtd_pax()?></em>
								</div>
                               
                                <?php
						          if($reserva_confirmada->quando_chega!=null)
						          {
							     ?>
                                <div class="column">
									<strong>Pouso previsto:</strong> <em> <?=date('d/m/Y à\s H:i', strtotime($reserva_confirmada->quando_chega))?></em>
								</div>
                                <div class="column">
									<strong>Número do voo (ida):</strong> <em> <?=$reserva_confirmada->numero_voo_chega?></em>
								</div>
                                <div class="column">
									<strong>Voo internacional:</strong> <em> <?=($reserva_confirmada->bool_internacional ? 'sim' : 'não')?></em>
								</div>
                                <div class="column">
									<strong>Passar no Duty Free:</strong> <em> <?=($reserva_confirmada->bool_duty_free ? 'sim' : 'não')?></em>
								</div>
							    <?php
                                }
                                ?>


                                <?php
                                if($reserva_confirmada->quando_parte!=null)
                                {
                                    ?>
                                <div class="column">
									<strong>Decolagem prevista:</strong> <em> <?=date('d/m/Y à\s H:i', strtotime($reserva_confirmada->quando_parte))?></em>
								</div>
                                <div class="column">
									<strong>Número do voo (volta):</strong> <em> <?=$reserva_confirmada->numero_voo_parte?></em>
								</div>
                                    <?php
                                }
                                ?>
                                 
                                <div class="column">
									<strong>Bairro:</strong> <em> <?=$reserva_confirmada->get_bairro()?></em>
								</div>
                                <div class="column">
									<strong>Comuna:</strong> <em> <?=$reserva_confirmada->get_comuna()?></em>
								</div>
                                <div class="column">
									<strong>Endereço de destino:</strong> <em> <?=$reserva_confirmada->endereco_destino?></em>
								</div>
						    </div>
                            <div class="row small-up-1">
                                <div class="column text-center">
                                    <h3><strong>VALOR TOTAL:</strong> CLP <em><?=Utils::formata_num($reserva_confirmada->preco, 0)?></em></h3>
                                </div>
						    </div>
                        </div>

					<?php
				}
				else
				{
					if($erro)
					{
						?>
						<p style="margin: 50px 0; display: block; padding: 20px; background: #ffeb3b; color: #900;"><?=$msg_erro?></p>
						<?php
					}

					?>
					<form data-abide novalidate action="" method="post" autocomplete="off">

						<header class="s-header align-center">
							<h2 class="s-headline"> Dados da Reserva<span class="s-headline-decor"></span></h2>
						</header>

                        <div class="box-cinza">
						    <div class="row small-up-1 medium-up-3">
                                <div class="column">
                                    <strong>Adultos</strong> <em>(10 anos ou mais): <?=$_POST['qtd_adt']?></em>
                                </div>
								<div class="column">
									<strong>Bebês</strong> <em>(0 a 4 anos): <?=floor($_POST['qtd_chd_5'])?></em>
								</div>
								<div class="column">
									<strong>Crianças</strong> <em>(5 a 9 anos): <?=floor($_POST['qtd_chd_10'])?></em>
								</div>
						    </div>
                            <div class="row small-up-1 medium-up-3">
                                <div class="column">
                                    <strong>Bairro:</strong> <?=$bairro->nome?>
                                </div>
                                <div class="column">
                                    <strong>Endereço:</strong> <?=$_POST['endereco_destino']?>
                                </div>
                                <div class="column">
                                    <strong>Tipo:</strong> <?php $v_tipos = array(1=>'Ida e volta', 2=>'Somente ida', 3=>'Somente volta'); echo $v_tipos[$_POST['tiporeserva']]; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column text-center">
                                    <h3><strong>VALOR TOTAL:</strong> CLP <?=Utils::formata_num($preco, 0)?>  <em>(<?=floor($_POST['qtd_adt']+$_POST['qtd_chd_5']+$_POST['qtd_chd_10'])?> passageiros)</em></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column text-center">
                                    <a class="button rh-button mb0" href="#" onclick="window.history.go(-1); return false;"><i class="zmdi zmdi-mail-send"></i> <span>Alterar dados</span></a>
                                </div>
                            </div>
                        </div>

						<!-- ---------------------- -->


						<header class="s-header align-center" style="margin-top: 50px;">
							<h2 class="s-headline"> Dados do Voo<span class="s-headline-decor"></span></h2>
                            <?php if($v_tipos[$_POST['tiporeserva']] == 'Somente volta' || $v_tipos[$_POST['tiporeserva']] == 'Ida e volta' ) : ?>
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
										<input class="input-group-field js-datepicker-date chegadainput" type="text" name="data_chegada" placeholder="Data de chegada" required value="<?=$_POST['data_chegada']?>">
									</span>
								</label>
								<label class="partida">
                                    <p class="mobile-hidden">Data de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-calendar-close fa fa-calendar-times-o"></span>
										<input class="input-group-field js-datepicker-date partidainput" type="text" name="data_partida" placeholder="Data de saída" required value="<?=$_POST['data_partida']?>">
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label class="chegada">
                                    <p class="mobile-hidden">Horário do voo de chegada</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-check fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time chegadainput" type="text" name="hora_chegada" placeholder="Horário do voo de chegada" required value="<?=$_POST['hora_chegada']?>">
									</span>
								</label>
								<label class="partida">
                                    <p class="mobile-hidden">Horário do voo de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-off fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time partidainput" type="text" name="hora_partida" placeholder="Horário do voo de saída" required value="<?=$_POST['hora_partida']?>">
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label class="chegada">
                                    <p class="mobile-hidden">Voo de chegada</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field chegadainput" type="text" name="numero_voo_chega" placeholder="Número do voo de chegada" required value="<?=$_POST['numero_voo_chega']?>">
									</span>
								</label>
								<label class="partida">
                                    <p class="mobile-hidden">Voo de saída</p>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field partidainput" type="text" name="numero_voo_parte" placeholder="Número do voo de saída" required value="<?=$_POST['numero_voo_parte']?>">
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
											<option value="1" <?php if(isset($_POST['bool_duty_free']) && $_POST['bool_duty_free']==1) echo 'selected'; ?>>Sim</option>
											<option value="0" <?php if(isset($_POST['bool_duty_free']) && $_POST['bool_duty_free']==0) echo 'selected'; ?>>Não</option>
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
											<option value="0" <?php if(isset($_POST['bool_internacional']) && $_POST['bool_internacional']==0) echo 'selected'; ?>>Nacional</option>
											<option value="1" <?php if(isset($_POST['bool_internacional']) && $_POST['bool_internacional']==1) echo 'selected'; ?>>Internacional</option>
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
									<textarea class="input-group-field placeholder" name="observacoes"><?=$_POST['observacoes']?></textarea>
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
										<input class="input-group-field" type="text" name="nome" placeholder="Nome" required value="<?=$_POST['nome']?>">
									</span>
								</label>										
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-vcard fa-fw"></span>
										<input class="input-group-field" type="text" name="cpf" placeholder="CPF" required value="<?=$_POST['cpf']?>">
									</span>
								</label>
							</div>
						</div>
						<div class="row small-up-1 medium-up-3">
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-phone fa fa-phone"></span>
										<input class="input-group-field" type="text" name="telefone" data-type-phone placeholder="Telefone" required value="<?=$_POST['telefone']?>">
									</span>
								</label>
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-email fa fa-envelope"></span>
										<input class="input-group-field" type="email" name="email" placeholder="E-mail" required value="<?=$_POST['email']?>">
									</span>
								</label>
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-question-circle fa-fw"></span>
										<?php
										$id_parceiro = floor($_POST['pid'])==0 ? 0 : floor($_POST['pid']);
										?>
										<select class="input-group-field placeholder" name="id_indicacao" <?php if($id_parceiro>0) echo 'disabled'; ?>>
											<option disabled selected hidden value="">Onde nos conheceu?</option>
											<?php

											$lista = Indicacao::lista();
											foreach($lista as $indicacao)
											{
												if($id_parceiro>0)
												{
													$seleciona = $indicacao->id==$id_parceiro ? 'selected' : '';
												}
												else
												{
													$seleciona = $indicacao->id==$_POST['id_indicacao'] ? 'selected' : '';
												}

												?>
												<option value="<?=$indicacao->id?>" <?=$seleciona?>><?=$indicacao->nome?></option>
												<?php
											}
											?>
											<option>Não me lembro</option>
										</select>
									</span>
								</label>
							</div>
						</div>
                        
                        <div class="alert callout" data-abide-error style="display: none;">
							<p><i class="fi-alert"></i> Existem alguns erros no formulário, por favor revise os dados e tente novamente.</p>
						</div>
						
						<div class="text-center" style="margin-top: 20px;">
							<div class="checkbox">
								<label>
									<input id="checkbox1" type="checkbox" required>
									<span class="custom-checkbox"><i class="icon-check"></i>
									</span>Para finalizar a reserva é preciso aceitar os nossos termos e condições. Para acessar basta <a href="<?php bloginfo('url'); ?>/termos-e-condicoes/" target="_blank">clicar aqui.</a>
								</label>
							</div>
						</div>
							
						<div class="text-center">
							<button class="button rh-button mb0" type="submit"><i class="zmdi zmdi-mail-send"></i>
								<span>Confirmar</span>
							</button>
						</div>

						<input type="hidden" name="etapa" value="2" />

						<!-- Dados da etapa anterior -->
						<input type="hidden" name="qtd_adt" value="<?=$_POST['qtd_adt']?>" />
						<input type="hidden" name="qtd_chd_5" value="<?=$_POST['qtd_chd_5']?>" />
						<input type="hidden" name="qtd_chd_10" value="<?=$_POST['qtd_chd_10']?>" />
						<input type="hidden" name="id_bairro" value="<?=$_POST['id_bairro']?>" />
						<input type="hidden" name="tiporeserva" value="<?=$_POST['tiporeserva']?>" />
						<input type="hidden" name="endereco_destino" value="<?=$_POST['endereco_destino']?>" />
						<input type="hidden" name="pid" value="<?=floor($_POST['pid'])?>" />
					</form>
					<?php
				}
			}

			?>
            
           



		</div><!-- /end .column -->
	</div><!-- /end .row -->
</section><!-- /end .section -->