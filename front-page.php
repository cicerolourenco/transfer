<?php require(get_template_directory().'/_inc/inc_start.php'); ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 <!-- ===== HERO ===== -->

				<div class="section-hero full-height hero-carousel">
					<div class="owl-carousel" data-owl-carousel data-button-type="arrows" data-content-animation="true" data-owl-options='{"autoHeight": "true","dotsContainer": "#hero-carousel-dots .owl-dots", "autoplay": false, "animateOut": "fadeOut", "dotsClass": "hero-owl-dots", "responsive": {"760": {"nav": "true"}}}'>

		


				

						<div class="h-carousel-item has-overlay" data-interchange="[<?php bloginfo('template_url'); ?>/img/hero/hero-06@small.jpg, small], [<?php bloginfo('template_url'); ?>/img/hero/hero-06@medium.jpg, medium], [<?php bloginfo('template_url'); ?>/img/hero/hero-06@large.jpg, large]">
							<div class="row align-center-middle">
								<div class="column small-12 medium-8 large-10 hinge-in-from-middle-x mui-enter js-animate-container text-center hero-content">

									<p class="h4 js-animate-2 slide-in-left mui-enter">Seu Transfer Aeroporto Hotel Aeroporto em </p>
									<h1 class="js-animate-1 hinge-in-from-middle-x mui-enter"><span class="mark">Santiago no Chile</span></h1>
									<p class="h4 js-animate-2 slide-in-right mui-enter">Somos uma empresa especializada em transfer aeroporto hotel aeroporto</p>

									<div class="button-group align-center">
										<a class="button rh-button slide-in-up mui-enter js-animate-3 mui-enter-active" href="<?php bloginfo('url'); ?>/reserva/"><i class="rh rh-van-pass-s rh-fw"></i>
											<span>Faça sua reserva!</span>
										</a>
									</div>

								</div><!-- /end .column -->
							</div><!-- /end .row -->
						</div><!-- /end .h-carousel-item -->

					</div>
					<div id="hero-carousel-dots">
						<div class="owl-dots"></div>
					</div>
				</div>

				<!-- ===== SECTION "WELCOME" + BOOKING FORM ===== -->

				<div class="s-trapeze-edges bg-secondary s-welcome">
					<div class="s-trapeze-edges-inner">

						<div class="trapeze bg-primary overlap-small">
							<form class="form-primary" id="homepage-booking" method="post" action="<?php bloginfo('url'); ?>/reservas/" data-abide novalidate>
								<div class="block-header">
									<h2 class="h3 headline">Faça a reserva do seu transfer!</h2>
								</div>
								<div class="align-center">
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
									<div class="column small-12 medium-12">
										<button class="button rh-button secondary shadow" type="submit">
											<i class="zmdi zmdi-mail-send"></i>
											<span>RESERVAR</span>
										</button>
									</div>
								</div>
								<input type="hidden" name="etapa" value="1" />
							</form><!-- /end .homepage-booking -->
						</div><!-- /end .trapeze -->


						<!-- Section "WELCOME" -->
						<div class="row">

							<div class="column small-12 medium-5 large-7 s-welcome-image">
								<figure>
									<img src="<?php bloginfo('template_url'); ?>/img/welcome-image@large.png" data-interchange="[<?php bloginfo('template_url'); ?>/img/welcome-image@small.png, small], [<?php bloginfo('template_url'); ?>/img/welcome-image@medium.png, medium], [<?php bloginfo('template_url'); ?>/img/welcome-image@large.png, large]" alt="">
								</figure>
							</div><!-- /end .column-->

							<div class="column small-12 medium-7 large-5">
								<article class="s-welcome-content s-line-secondary">

									<header class="s-header">
										<h2 class="s-headline"> Bem-vindo<span class="s-headline-decor"></span></h2>
									</header>

									<p class="gray-color">Conheçam a Transfer Brasil, especializada em transfer aeroporto-hotel-aeroporto.</p>
									<p class="gray-color">Chegar num outro país, muitas vezes sem falar o idioma, sem saber como chegar até o seu hotel - o que escolher? Taxi? Transfers na porta do Aeroporto?</p>
                                    <p class="gray-color">Que nada, vá do hotel para o aeroporto com a Transfer Brasil! Voce bem recebido, sempre!!! Nossa equipe estará te esperando de braços abertos. </p>
                                    <p class="gray-color">Nossa prioridade é o seu conforto, a sua segurança e uma recepção de qualidade!!!</p>

									<figure class="signature">
										<figcaption>
											<p class="h6 author">Vânia Ortega</p>
											<p class="position">Diretora</p>
										</figcaption>
									</figure>

									<footer class="s-footer">
										<a class="button rh-button-simple left-vb" href="#">
											<i class="zmdi zmdi-email-open"></i>
										</a>
										<a class="button rh-button secondary-white flip-y right-vb" href="#">
											<i class="zmdi zmdi-more-vert"></i>
											<span>ENTRE EM CONTATO</span>
										</a>
									</footer>

								</article>
							</div><!-- /end .column-->
						</div><!-- /end .row -->

					</div><!-- /end .s-trapeze-edges-inner -->
				</div><!-- /end .s-trapeze-edges -->

				<!-- ===== PRODUCT CARDS CAROUSEL ===== -->

				<section class="section section s-line s-cards-carousel">
					<div class="row align-center">
						<div class="column small-12 medium-8 large-5">
							<header class="s-header align-center">
								<h2 class="s-headline">Nossos veículos<span class="s-headline-decor"></span></h2>
								<p class="subheader">Consequuntur provident aliquam exercitationem deserunt ex quia, quas incidunt nostrum soluta temporibus.</p>
							</header>
						</div>
						<div class="column small-12">
							<div class="owl-carousel" data-owl-carousel data-button-type="rh-buttons" data-button-color="secondary secondary-gray" data-owl-options='{"smartSpeed": "500","dotsClass": "rh-owl-dots dots-dark", "responsive": {"640": {"items": "2", "slideBy": "2", "dots": false, "nav": "true"}, "1024": {"items": "3", "slideBy": "3", "dots": false, "nav": "true"}}}'>

								<!-- Card product -->
								<div class="card card-product bg-secondary block-shadow">

									<div class="card-divider">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star gray-shade-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-14.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="#"><i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->

								<!-- Card product -->
								<div class="card card-product block-shadow">

									<div class="card-divider bg-white">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-22.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="#"><i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->

								<!-- Card product -->
								<div class="card card-product bg-secondary block-shadow">

									<div class="card-divider">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												

												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-03.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="fleet-details-right-sidebar.html">
											<i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->
								
								<!-- Card product -->
								<div class="card card-product bg-secondary block-shadow">

									<div class="card-divider">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star gray-shade-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-14.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="#"><i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->

								<!-- Card product -->
								<div class="card card-product block-shadow">

									<div class="card-divider bg-white">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-22.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="#"><i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->

								<!-- Card product -->
								<div class="card card-product bg-secondary block-shadow">

									<div class="card-divider">
										<h3 class="h3 headline">Nome do veículo</h3>
									</div>

									<div class="card-section card-product-data flex-container align-justify">

										<div class="price-wrap">
											<div class="price">
												

												<ul class="rating text-center">
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
													<li><i class="zmdi zmdi-star fa fa-star primary-color"></i></li>
												</ul>
											</div>
										</div><!-- /end .price-wrap -->

										<ul class="card-product-features">
											<li><i class="zmdi zmdi-male-alt zmdi-hc-fw fa fa-male fa-fw"></i>X 3</li>
											<li><i class="zmdi zmdi-gas-station zmdi-hc-fw fa fa-tint fa-fw"></i>diesel</li>
											<li><i class="zmdi zmdi-settings zmdi-hc-fw fa fa-gear fa-fw"></i>outra info</li>
										</ul>
									</div><!-- /end .card-product-data -->

									<img src="<?php bloginfo('template_url'); ?>/img/fleet/card-product-03.jpg" alt="">

									<div class="card-section text-center">
										<a class="button rh-button flip-y" href="fleet-details-right-sidebar.html">
											<i class="zmdi zmdi-info"></i>
											<span>Detalhes</span>
										</a>
									</div>
								</div><!-- /end .card-product -->

								

							</div><!-- /end .owl-carousel -->
						</div><!-- /end .column -->
					</div><!-- /end .row -->
				</section>

				<!-- ===== FULL WIDTH SECTION WITH EQUAL PADDINGS ===== -->

				<!-- ===== SECTION "SERVICES" ===== -->

				<div class="s-trapeze bg-secondary-shade">

					<!-- section background image -->
					<div class="s-trapeze-img" data-interchange="[<?php bloginfo('template_url'); ?>/img/services/s-trapeze-img-01.jpg, large]"></div>
					<div class="s-trapeze-cover"><div class="s-trapeze-cover-inner"></div></div>

					<section class="section s-line-secondary">
						<div class="row">

							<div class="column small-12">
								<header class="s-header">
									<h2 class="s-headline">Serviços<span class="s-headline-decor"></span></h2>
									<p class="subheader">Nostrum impedit rem, distinctio enim vel libero expedita inventore, ducimus cumque eligendi veniam tempore corporis hic recusandae</p>
								</header>
							</div>

							<div class="column small-12 medium-6 large-7 large-order-1 services-buttons-column">

								<!-- Service item buttons-->
								<ul class="row small-up-1 large-up-2" id="js-services-button-list" data-link-class="js-services-button" data-panel-class="js-services-item" data-responsive-accordion-tabs="accordion medium-tabs" data-allow-all-closed="true">

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-1">
											<div class="media-object-section"><i class="icon rh rh-van-pass-s rh-fw"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-2">
											<div class="media-object-section"><i class="icon rh rh-van"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-3">
											<div class="media-object-section"><i class="icon rh rh-van-combo-s rh-fw"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-4">
											<div class="media-object-section"><i class="icon rh rh-van-s rh-fw"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-5">
											<div class="media-object-section"><i class="icon rh rh-van-pass rh-fw"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

									<li class="column js-services-button">
										<a class="media-object media-button" href="#js-services-item-6">
											<div class="media-object-section"><i class="icon rh rh-van rh-fw"></i></div>
											<div class="media-object-section">
												<h3 class="h3">Título do Serviço</h3>
											</div>
										</a>
									</li>

								</ul><!-- /end #js-services-button-list -->
							</div><!-- /end .column -->

							<div class="column small-12 medium-6 large-5 show-for-medium large-order-2 services-list-column">

								<!-- Service cards container-->
								<div id="js-services-list" data-tabs-content="js-services-button-list">

									<div class="js-services-item card card-post services-item" id="js-services-item-1">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-01.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Inventore earum dignissimos, eaque hic vero quod, tenetur consectetur beatae excepturi, rerum fugit repudiandae esse quidem error.</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

									<div class="js-services-item card card-post services-item" id="js-services-item-2">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-02.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Eveniet dignissimos, architecto? Quas minus sunt, dolorem, laudantium, labore iusto quam itaque maiores explicabo eveniet incidunt accusantium?</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

									<div class="js-services-item card card-post services-item" id="js-services-item-3">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-03.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Hic sunt expedita pariatur, voluptatibus rem tenetur deleniti quas officiis impedit sapiente doloribus molestias nihil eos ex.</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

									<div class="js-services-item card card-post services-item" id="js-services-item-4">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-04.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Ipsa sit est ad minima debitis tempora mollitia magni, necessitatibus natus suscipit maxime libero quisquam numquam a.</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

									<div class="js-services-item card card-post services-item" id="js-services-item-5">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-05.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Nihil repudiandae deleniti laboriosam eligendi iure nesciunt velit aspernatur hic corporis, enim ullam quaerat illum labore molestiae.</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

									<div class="js-services-item card card-post services-item" id="js-services-item-6">
										<div class="card-media">
											<img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/services/services-06.jpg" alt="">
										</div>
										<div class="card-section">
											<p>Eius perferendis sequi aut assumenda. Sunt, expedita ea quo. Molestias, cum enim nisi odio harum labore minima.</p>
										</div>
										<div class="card-section align-center p0">
											<a class="button rh-button flip-y" href="services-single-page.html">
												<i class="zmdi zmdi-wrench fa fa-wrench"></i>
												<span>More about service</span>
											</a>
										</div>
									</div><!-- /end .services-item -->

								</div><!-- /end #js-services-list-->

							</div><!-- /end .column -->
						</div>

						<footer class="s-footer row">
							<div class="column small-12 large-7 text-center">
								<a class="button rh-button " href="services-cards.html"><i class="rh rh-van-combo-s rh-fw"></i>
									<span>Faça sua reserva</span>
								</a>
							</div>
						</footer>

					</section><!-- /end .section -->
				</div><!-- /end .s-trapeze -->

				

				<div class="section-boxed bg-secondary s-equal-paddings covered" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/banner-01.jpg, small]">
					<div class="row align-center">
						<div class="column small-12 large-10">

							<div class="media-object stack-for-medium mb0 align-middle">

								<div class="media-object-section">
									<h2 class="h3 headline light text-center">Cadastre-se em nossa newsletter e fique por dentro das novidades.</h2>
								</div>

								<div class="media-object-section pb0">
									<form class="simple-form form-secondary">
										<div class="input-group">
											<input class="input-group-field" type="email" placeholder="Insira seu e-mail">
											<button class="button transparent secondary-white" type="submit"><i class="zmdi zmdi-mail-send fa fa-paper-plane"></i></button>
										</div>
									</form>
								</div>

							</div>

						</div>
					</div>
				</div><!-- /end .section-boxed.s-equal-paddings -->

				<!-- ===== SECTION "FLEET" ===== -->

				<div class="s-trapeze-edges s-fleet">
					<div class="s-trapeze-edges-inner">
						<section class="section s-line">

							<header class="s-header row align-center">
								<div class="column small-12 medium-8 large-5">
									<h2 class="s-headline">Galeria de Fotos<span class="s-headline-decor"></span></h2>
									<p class="subheader">Blanditiis facilis debitis velit quibusdam sapiente recusandae cupiditate quo labore maxime? Deserunt officiis natus iusto quam dolore nulla et facilis nisi aliquid, distinctio facere placeat velit provident!
									</p>
								</div>
							</header>

							<div class="gallery rh-gallery">

								<!-- Fleet gallery item #1 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-01.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-01@lightbox.jpg" data-rel="lightcase:fleetGallery" title="Vehicle image #1 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
										<!-- Show vehicle card-->
									</div><!-- /end .image-hover-buttons -->

									
								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #2 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-02.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-02@lightbox.jpg" data-rel="lightcase:fleetGallery"
										title="Vehicle image #2 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
					
									</div><!-- /end .image-hover-buttons -->

								
								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #3 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-03.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-03@lightbox.jpg" data-rel="lightcase:fleetGallery"
										title="Vehicle image #3 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
							
									</div><!-- /end .image-hover-buttons -->

							
								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #4 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-04.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-04@lightbox.jpg" data-rel="lightcase:fleetGallery"
										title="Vehicle image #4 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
									
									</div><!-- /end .image-hover-buttons -->

			
								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #5 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-05.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-05@lightbox.jpg" data-rel="lightcase:fleetGallery" title="Vehicle image #5 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
										<!-- Show vehicle card-->
										
									</div>

							
								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #6 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-06.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-06@lightbox.jpg" data-rel="lightcase:fleetGallery"
										title="Vehicle image #6 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
						
									</div><!-- /end .image-hover-buttons -->

								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #7 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-07.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-07@lightbox.jpg" data-rel="lightcase:fleetGallery" title="Vehicle image #7 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
							
									</div><!-- /end .image-hover-buttons -->

								</div><!-- /end .gallery-item -->

								<!-- Fleet gallery item #8 -->
								<div class="gallery-item image-hover image-hover-moving">

									<!-- Image-->
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/gallery/gallery-08.jpg, small]"></div>
									</div>

									<!-- Caption-->
									<div class="gallery-image-caption">
										<h3 class="h4 title">Título da Foto</h3>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="img/gallery/gallery-08@lightbox.jpg" data-rel="lightcase:fleetGallery" title="Vehicle image #8 title">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
										<!-- Show vehicle card-->
										
									</div><!-- /end .image-hover-buttons -->

		
								</div><!-- /end .gallery-item -->

							</div><!-- /end .gallery.rh-gallery -->

		

						</section><!-- /end .section -->
					</div><!-- /end .s-trapeze-edges-inner -->
				</div><!-- /end .s-trapeze-edges.s-fleet -->

				<!-- ===== SECTION-TRAPEZE ===== -->

				<div class="section-trapeze primary">
					<div class="trapeze bg-primary">

						<div class="row small-up-1 medium-up-2">

							<figure class="column align-middle">
								<img src="<?php bloginfo('template_url'); ?>/img/trapeze-banner@medium.png" data-interchange="[<?php bloginfo('template_url'); ?>/img/trapeze-banner@small.png, small], [<?php bloginfo('template_url'); ?>/img/trapeze-banner@medium.png, medium]" alt="">
							</figure>

							<article class="column text-center align-self-middle">
								<header class="block-header">
									<h3 class="h3 headline">Aqui podemos inserir uma chamada</h3>
								</header>

								<p>Totam, doloremque, excepturi? Rem laudantium, accusantium porro rerum ratione saepe repellat sint! Omnis numquam facilis labore, placeat fuga iste? Quos, odit omnis. Maxime voluptates, veritatis eos ea. Facere sit eum tenetur expedita.</p>

								<a class="button rh-button secondary mb0" href="#">
									<i class="zmdi zmdi-mail-send fa fa-paper-plane"></i>
									<span>Faça sua reserva</span>
								</a>
							</article>

						</div><!-- /end .row -->

					</div><!-- /end .trapeze -->
				</div><!-- /end .section-trapeze -->

				<!-- ===== SECTION "ADVANTAGES" ===== -->

				<section class="section">

					<header class="s-header row align-center">
						<div class="column small-12 medium-8 large-5">
							<h2 class="s-headline">Vantagens de resevar conosco<span class="s-headline-decor"></span></h2>
							<p class="subheader">Obcaecati explicabo dignissimos fuga veritatis quae sequi recusandae possimus eius, iure, quasi voluptatum, veniam sapiente inventore velit!
							</p>
						</div>
					</header>

					<div class="s-trapeze-2x">
						<!-- s-trapeze-2x-images (left & right trapezes)-->
						<div class="s-trapeze-2x-image" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-trapeze-2x-bg.jpg, large]"></div>
						<div class="s-trapeze-2x-image" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-trapeze-2x-bg.jpg, large]"></div>

						<div class="row small-up-1 medium-up-2 large-up-3 owl-carousel" data-carousel="medium-down" data-owl-options='{"smartSpeed": "500","dotsClass": "rh-owl-dots dots-dark"}'>

							<div class="column">
								<!-- Icon card #1-->
								<article class="card card-post-icon block-shadow">
									<div class="card-media"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/cards/card-04.jpg" alt=""></div>

									<div class="card-divider bg-verde">
										<div class="icon-box circle secondary-verde border large"><i class="rh rh-locations"></i></div>
										<h3 class="h4" data-equalizer-watch="data-equalizer-watch">Transfer In e Out</h3>
									</div>

									<div class="card-section">
										<p>Fechando o Transfer In e Out você ganha um kit Bienvenido com: Chip de Celular para usar aqui  e guia de dicas e informações de Santiago exclusivo para nossos passageiros.
										</p>
									</div>
								</article><!-- /end .card-post-icon-->
							</div>

							<div class="column">
								<!-- Icon card #2-->
								<article class="card card-post-icon block-shadow">
									<div class="card-media"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/cards/card-05.jpg" alt=""></div>

									<div class="card-divider bg-verde">
										<div class="icon-box circle secondary-verde border large"><i class="rh rh-tools-c"></i></div>
										<h3 class="h4" data-equalizer-watch="data-equalizer-watch">Transfer Semicompartilhado</h3>
									</div>

									<div class="card-section">
                                        <p>Nossos veículos são semi-privativos, isso significa que voce terá um preço muito mais acessível sem precisar esperar esperar horas até a van encher, como acontece com os transfer compartilhados.</p>
                                        <p>Operamos somente transfers agendados, você só ira dividir a van caso no mesmo voo que o seu haja algum outro passageiro nosso indo para algum endereço próximo ao seu. Caso contrário voce irá sozinho na van, nós jamais deixamos vocês esperando horas até a van encher, nos jamais ficaremos "pescando" novos passageiros no aeroporto para encher a van!</p>
										
									</div>
								</article><!-- /end .card-post-icon-->
							</div>

							<div class="column">
								<!-- Icon card #3-->
								<article class="card card-post-icon block-shadow">
									<div class="card-media"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/cards/card-06.jpg" alt=""></div>

									<div class="card-divider bg-verde">
										<div class="icon-box circle secondary-verde border large"><i class="rh rh-money-back"></i></div>
										<h3 class="h4" data-equalizer-watch="data-equalizer-watch">Pagamento</h3>
									</div>

									<div class="card-section">
										
										<p>O pagamento é feito na chegada e pode ser em reais, pesos ou dólares. </p>
                                        <p>Câmbio do dia é feito uma média entre o câmbio do aeroporto e da rua Augustina onde tem o melhor cambio.</p>
										
									</div>
								</article><!-- /end .card-post-icon-->
							</div>

						</div><!-- /end .row -->
					</div><!-- /end .s-trapeze-2x -->
				</section><!-- /end .section -->

				<!-- ===== COUNTERS SECTION ===== -->

				<div class="is-fixed s-counters bg-secondary s-border" data-counter data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-pattern-01.jpg, small]">
					<div class="row small-up-1 medium-up-2 large-up-4 expanded collapse counter secondary">

						<div class="column">
							<div class="media-object align-center-middle">
								<div class="media-object-section align-self-top"><i class="counter-icon rh rh-van-f"></i></div>
								<div class="media-object-section">
									<div class="counter-digits js-counter" data-value="365"></div>
									<div class="counter-title">Frota</div>
								</div>
							</div>
						</div>

						<div class="column">
							<div class="media-object align-center-middle">
								<div class="media-object-section align-self-top"><i class="counter-icon rh rh-calendar"></i></div>
								<div class="media-object-section">
									<div class="counter-digits js-counter" data-value="9125"></div>
									<div class="counter-title">Dias trabalhados</div>
								</div>
							</div>
						</div>

						<div class="column">
							<div class="media-object align-center-middle">
								<div class="media-object-section align-self-top"><i class="counter-icon rh rh-case"></i></div>
								<div class="media-object-section">
									<div class="counter-digits js-counter" data-value="1234"></div>
									<div class="counter-title">Reservas</div>
								</div>
							</div>
						</div>

						<div class="column">
							<div class="media-object align-center-middle">
								<div class="media-object-section align-self-top"><i class="counter-icon rh rh-user"></i></div>
								<div class="media-object-section">
									<div class="counter-digits js-counter" data-value="7859"></div>
									<div class="counter-title">Clientes Satisfeitos</div>
								</div>
							</div>
						</div>

					</div><!-- /end .row -->
				</div><!-- /end .s-counters -->

				<!-- ===== SECTION "TESTIMONIALS" ===== -->

				<div class="section-boxed s-half s-testimonials">

					<!-- Section background images -->
					<div class="s-half-image show-for-large" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/half-section-01.jpg, large]"></div>
					<div class="s-half-image show-for-large" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/half-section-02.jpg, large]"></div>

					<div class="row align-center">
						<section class="column small-12 large-10">

							<header class="s-header align-center">
								<h2 class="s-headline"> Depoimentos<span class="s-headline-decor"></span></h2>
							</header>

							<div class="owl-carousel testimonials" data-owl-carousel data-owl-options='{"smartSpeed": "1200","dotsClass": "rh-owl-dots dots-dark"}'>

								<!-- .testimonials-item -->
								<section class="testimonials-item text-center">
									<i class="icon zmdi zmdi-quote fa fa-quote-right"></i>

									<p>Odit atque quae dicta dolore error excepturi officiis consequatur tempora, a neque dolor provident quaerat asperiores vero omnis vel ab quam repellendus eveniet, quas rerum beatae sapiente. Ea accusantium temporibus alias eaque delectus saepe
										obcaecati qui deleniti.</p>

									<div class="testimonials-divider">
										<svg class="testimonials-corner">
											 <use xlink:href='#corner'></use>
										</svg>
									</div>

									<div class="testimonials-meta">
										<div class="media-object align-center">
											<div class="media-object-section">
												<div class="rh-thumbnail"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/users/user-04.jpg" alt="Jerry Derryl, Baltimore Markets" />
												</div>
											</div>
											<div class="media-object-section">
												<span class="h5 author">Nome do cliente</span>
												<span class="company">Brasil/SP</span>
											</div>
										</div>
									</div>
								</section><!-- /end .testimonials-item -->

								<!-- .testimonials-item -->
								<section class="testimonials-item text-center">
									<i class="icon zmdi zmdi-quote fa fa-quote-right"></i>

									<p>Blanditiis porro reprehenderit qui ut itaque modi odio, molestias libero. Autem minus unde quasi sit corporis incidunt quia obcaecati ipsa sapiente saepe voluptas, voluptatibus, dicta explicabo nobis ipsam cupiditate, similique reprehenderit
										nisi accusamus nihil harum.</p>

									<div class="testimonials-divider">
										<svg class="testimonials-corner">
											 <use xlink:href='#corner'></use>
										</svg>
									</div>

									<div class="testimonials-meta">
										<div class="media-object align-center">
											<div class="media-object-section">
												<div class="rh-thumbnail"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/users/user-05.jpg" alt="Kirk Barron, Montana's Cookhouse" />
												</div>
											</div>
											<div class="media-object-section">
												<span class="h5 author">Nome do cliente</span>
												<span class="company">Brasil/RJ</span>
											</div>
										</div>
									</div>

								</section><!-- /end .testimonials-item -->

								<!-- .testimonials-item -->
								<section class="testimonials-item text-center">
									<i class="icon zmdi zmdi-quote fa fa-quote-right"></i>

									<p>Illum quidem commodi, perspiciatis quisquam odio culpa quo esse itaque, numquam, sed nobis voluptatum soluta eligendi, suscipit? Nobis laudantium unde eligendi nihil ipsam cumque praesentium officiis, earum quam non similique, ex illum esse delectus
										beatae suscipit inventore!</p>

									<div class="testimonials-divider">
										<svg class="testimonials-corner">
											 <use xlink:href='#corner'></use>
										</svg>
									</div>

									<div class="testimonials-meta">
										<div class="media-object align-center">
											<div class="media-object-section">
												<div class="rh-thumbnail"><img class="grayscale" src="<?php bloginfo('template_url'); ?>/img/users/user-02.jpg" alt="Elma Simpson, Mode O'Day" />
												</div>
											</div>
											<div class="media-object-section">
												<span class="h5 author">Nome do cliente</span>
												<span class="company">Brasil/MG</span>
											</div>
										</div>
									</div>

								</section><!-- /end .testimonials-item -->

							</div><!-- /end .owl-carousel.testimonials -->

						</section><!-- /end .column -->
					</div><!-- /end .row -->
				</div><!-- /end .section-boxed -->

		

				<!-- ===== CONTACT SECTION ===== -->

				<div class="section-boxed s-equal-paddings bg-primary covered" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/banner-p-02.jpg, small]">
					<div class="row align-center">
						<div class="column small-12 large-10">
							<div class="media-object stack-for-medium text-center align-center-middle mb0">
								<div class="media-object-section">
									<h2 class="h3 headline light text-center">Você tem alguma dúvida, sugestão ou reclamação?</h2>
								</div>
								<div class="media-object-section pb0">
									<a class="button rh-button secondary-white" href="<?php bloginfo('url'); ?>/contato/"><i class="zmdi zmdi-phone-in-talk fa fa-phone"></i>
										<span>Entre em contato</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php endwhile; endif; ?>		
<?php get_footer(); ?>