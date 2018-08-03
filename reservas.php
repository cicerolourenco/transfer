<?php

// se já vem com dados preenchidos, calcula o preço
if($_POST)
{

	$bairro = new Bairro(floor($_POST['id_bairro']));
	if($bairro->id)
	{
		$comuna = new Comuna($bairro->id_comuna);
		$preco = Reserva::calcula($comuna, floor($_POST['qtd_adt']), floor($_POST['qtd_chd_5']), floor($_POST['qtd_chd_10']));
	}
	else
	{
		$erro = true;
		$msg_erro = 'Bairro não encontrado.';
	}


	// se já preencheu os dados, salva e confirma
	if($_POST['etapa']==2)
	{
		$objeto = new Reserva();
		$objeto->fromVetor($_POST);
		$objeto->quando_chega = $_POST['data_chegada'] . ' ' . $_POST['hora_chegada'];
		$objeto->quando_parte = $_POST['data_partida'] . ' ' . $_POST['hora_partida'];
		$objeto->id_comuna = $comuna->id;
		$objeto->preco = $objeto->calcula_preco();
		$objeto->quando = date('Y-m-d H:i');

		// anula os campos que não vão para o banco
		$campos = array('etapa', 'data_chegada', 'hora_chegada', 'data_partida', 'hora_partida');
		foreach ($campos as $atributo) 
			$objeto->{$atributo} = null;

		//var_dump($objeto);
		$objeto->store();

		// TODO: dispara o e-mail para o cliente
		


		$sucesso = true;
	}
}


?>
<!-- ===== CONTACT FORM ===== -->

<section class="section s-line">
	<div class="row align-center">
		<div class="column small-12 large-10">

			<?php

			if(!$_POST)
			{
				// se não postou nada, abre o form dos dados da reserva
				?>
				<form data-abide novalidate action="" method="post">

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
										for($i=1; $i<=10; $i++)
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
										for($i=0; $i<=10; $i++)
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
										for($i=0; $i<=10; $i++)
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
					<div class="row medium-6">
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

					<div class="text-center">
						<button class="button rh-button mb0" type="submit"><i class="zmdi zmdi-mail-send"></i>
							<span>Reservar</span>
						</button>
					</div>

					<input type="hidden" name="etapa" value="1" />
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
					<?php
				}
				else
				{
					?>
					<form data-abide novalidate action="" method="post">

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
                            </div>
                            <div class="row">
                                <div class="column text-center">
                                    <h3><strong>VALOR TOTAL:</strong> CLP <?=Utils::formata_num($preco, 0)?>  <em>(<?=floor($_POST['qtd_adt']+$_POST['qtd_chd_5']+$_POST['qtd_chd_10'])?> passageiros)</em></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column text-center">
                                    <a class="button rh-button mb0" href="#" onclick="window.history.go(-1); return false;"><i class="zmdi zmdi-mail-send"></i> <span>Alterar dados da reserva</span></a>
                                </div>
                            </div>
                        </div>

						<!-- ---------------------- -->


						<header class="s-header align-center" style="margin-top: 50px;">
							<h2 class="s-headline"> Dados do Voo<span class="s-headline-decor"></span></h2>
						</header>
						
						<div class="row js-datepicker-group">
							<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-calendar-check fa fa-calendar-check-o"></span>
										<input class="input-group-field js-datepicker-date" type="text" name="data_chegada" placeholder="Data de chegada" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-calendar-close fa fa-calendar-times-o"></span>
										<input class="input-group-field js-datepicker-date" type="text" name="data_partida" placeholder="Data de saída" required>
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-check fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time" type="text" name="hora_chegada" placeholder="Horário do voo de chegada">
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-alarm-off fa fa-clock-o"></span>
										<input class="input-group-field js-datepicker-time" type="text" name="hora_partida" placeholder="Horário do voo de saída">
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field" type="text" name="numero_voo_chega" placeholder="Número do voo de chegada" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-airplane zmdi-hc-fw"></span>
										<input class="input-group-field" type="text" name="numero_voo_parte" placeholder="Número do voo de saída" required>
									</span>
								</label>
							</div>
						</div>
						
						<div class="row">
							<div class="column medium-4 text-center">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-shopping-bag fa-fw"></span>
										<select class="input-group-field placeholder" name="bool_duty_free" required>
											<option disabled selected hidden value="">Deseja visitar Duty Free?</option>
											<option value="1">Sim</option>
											<option value="0">Não</option>
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
											<option value="0">Nacional</option>
											<option value="1">Internacional</option>
										</select>
									</span>
								</label>
							</div>
							<div class="column medium-4">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-city zmdi-hc-fw"></span>
										<input class="input-group-field" type="text" name="hora_parte_hotel" placeholder="Hora preferida de saída do hotel" required>
									</span>
								</label>
								
							</div>
						</div>

						<div class="row">
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
						<div class="alert callout" data-abide-error style="display: none;">
							<p><i class="fi-alert"></i> There are some errors in your form.</p>
						</div>
						<div class="row small-up-1 medium-up-2">
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-account fa fa-user"></span>
										<input class="input-group-field" type="text" name="nome" placeholder="Nome" required>
									</span>
								</label>										
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-vcard fa-fw"></span>
										<input class="input-group-field" type="text" name="cpf" placeholder="CPF" required>
									</span>
								</label>
							</div>
						</div>
						<div class="row small-up-1 medium-up-3">
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-phone fa fa-phone"></span>
										<input class="input-group-field" type="text" name="telefone" data-type-phone placeholder="Telefone" required>
									</span>
								</label>
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-email fa fa-envelope"></span>
										<input class="input-group-field" type="email" name="email" placeholder="E-mail" required>
									</span>
								</label>
							</div>
							<div class="column">
								<label>
									<span class="input-group">
										<span class="input-group-label fa fa-question-circle fa-fw"></span>
										<select class="input-group-field placeholder" name="id_indicacao">
											<option disabled selected hidden value="">Onde nos conheceu?</option>
											<?php
											$lista = Indicacao::lista();
											foreach($lista as $indicacao)
											{
												?>
												<option value="<?=$indicacao->id?>"><?=$indicacao->nome?></option>
												<?php
											}
											?>
											<option>Não me lembro</option>
										</select>
									</span>
								</label>
							</div>
						</div>										
						
						<div class="text-center" style="margin-top: 20px;">
							<div class="checkbox">
								<label>
									<input id="checkbox1" type="checkbox">
									<span class="custom-checkbox"><i class="icon-check"></i>
									</span>Li e aceito os <a href="#">termos e condições</a>
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
						<input type="hidden" name="endereco_destino" value="<?=$_POST['endereco_destino']?>" />
					</form>
					<?php
				}
			}

			?>



		</div><!-- /end .column -->
	</div><!-- /end .row -->
</section><!-- /end .section -->