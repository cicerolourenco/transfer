<?php require(get_template_directory().'/_inc/inc_start.php'); ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 <!-- ===== HERO ===== -->

				<div class="section-hero full-height hero-carousel">
					<div class="owl-carousel" data-owl-carousel data-button-type="arrows" data-content-animation="true" data-owl-options='{"autoHeight": "true","dotsContainer": "#hero-carousel-dots .owl-dots", "autoplay": false, "animateOut": "fadeOut", "dotsClass": "hero-owl-dots", "responsive": {"760": {"nav": "true"}}}'>

		


				        <?php if(have_rows('lista_carrossel')) : while(have_rows('lista_carrossel')) : the_row(); ?>
                        <?php
                            $attachment_id = get_sub_field('imagem');
                            $imagem = wp_get_attachment_image_src( $attachment_id, 'carrossel' );
                        ?>

						<div class="h-carousel-item has-overlay" data-interchange="[<?php echo $imagem[0]; ?>, small], [<?php echo $imagem[0]; ?>, medium], [<?php echo $imagem[0]; ?>, large]">
							<div class="row align-center-middle">
								<div class="column small-12 medium-8 large-10 hinge-in-from-middle-x mui-enter js-animate-container text-center hero-content">

									<p class="h4 js-animate-2 slide-in-left mui-enter"><?php the_sub_field('titulo'); ?></p>
									<h1 class="js-animate-1 hinge-in-from-middle-x mui-enter"><span class="mark"><?php the_sub_field('subtitulo'); ?></span></h1>
									<p class="h4 js-animate-2 slide-in-right mui-enter"><?php the_sub_field('texto'); ?></p>

									<div class="button-group align-center">
										<a class="button rh-button slide-in-up mui-enter js-animate-3 mui-enter-active" href="<?php bloginfo('url'); ?>/reservas/"><i class="rh rh-van-pass-s rh-fw"></i>
											<span>Faça sua reserva!</span>
										</a>
									</div>

								</div><!-- /end .column -->
							</div><!-- /end .row -->
						</div><!-- /end .h-carousel-item -->
                        <?php endwhile; endif; ?>
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
									<h2 class="h3 headline">Faça seu orçamento do Transfer!</h2>
								</div>
                                <div class="text-center" style="margin-top: 20px;">
                                    <div class="radio radioreserva">
                                        <label>
                                            <input class="tiporeserva" type="radio" name="tiporeserva" value="1" required <?php if($_POST['tiporeserva']==1) echo 'checked'; ?>>
                                            <span class="custom-radio"><i class="icon-radio-check"></i>
                                            </span>Ida e Volta
                                        </label>
                                    </div>
                                    <div class="radio radioreserva">
                                        <label>
                                            <input class="tiporeserva"  type="radio" name="tiporeserva" value="2" required <?php if($_POST['tiporeserva']==2) echo 'checked'; ?>>
                                            <span class="custom-radio"><i class="icon-radio-check"></i>
                                            </span>Somente Ida
                                        </label>
                                    </div>
                                    <div class="radio radioreserva">
                                        <label>
                                            <input class="tiporeserva"  type="radio" name="tiporeserva" value="3" required <?php if($_POST['tiporeserva']==3) echo 'checked'; ?>>
                                            <span class="custom-radio"><i class="icon-radio-check"></i>
                                            </span>Somente Volta
                                        </label>
                                    </div>
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
									<div class="column small-12 medium-12">
										<button class="button rh-button secondary shadow" type="submit">
											<i class="zmdi zmdi-mail-send"></i>
											<span>COTAR</span>
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
                                    <?php
                                        $attachment_id = get_field('imagem_sobre');
                                        $imagem = wp_get_attachment_image_src( $attachment_id, 'quem-somos' );
                                    ?>
									<img src="<?php echo $imagem[0]; ?>" data-interchange="[<?php echo $imagem[0]; ?>, small], [<?php echo $imagem[0]; ?>, medium], [<?php echo $imagem[0]; ?>, large]" alt="">
								</figure>
							</div><!-- /end .column-->

							<div class="column small-12 medium-7 large-5">
								<article class="s-welcome-content s-line-secondary">

									<header class="s-header">
										<h2 class="s-headline"> Bem-vindo<span class="s-headline-decor"></span></h2>
									</header>

									<?php the_field('texto_sobre'); ?>

									<footer class="s-footer">
										<a class="button rh-button-simple left-vb" href="#">
											<i class="zmdi zmdi-email-open"></i>
										</a>
										<a class="button rh-button secondary-white flip-y right-vb" href="<?php bloginfo('url'); ?>/contato/">
											<i class="zmdi zmdi-more-vert"></i>
											<span>ENTRE EM CONTATO</span>
										</a>
									</footer>

								</article>
							</div><!-- /end .column-->
						</div><!-- /end .row -->

					</div><!-- /end .s-trapeze-edges-inner -->
				</div><!-- /end .s-trapeze-edges -->

				
                    
                    <!-- ===== SECTION "FLEET" ===== -->

				<div class="s-trapeze-edges s-fleet">
					<div class="s-trapeze-edges-inner">
						<section class="section s-line">

							<header class="s-header row align-center">
								<div class="column small-12 medium-8 large-5">
									<h2 class="s-headline">Nossos Veículos<span class="s-headline-decor"></span></h2>
								</div>
							</header>

							<div class="gallery rh-gallery">
                                <?php if(have_rows('lista_veiculos')) : while(have_rows('lista_veiculos')) : the_row(); ?>
								<!-- Fleet gallery item #1 -->
								<div class="gallery-item image-hover">

									<!-- Image-->
                                    <?php
                                        $attachment_id = get_sub_field('imagem');
                                        $imagem = wp_get_attachment_image_src( $attachment_id, 'veiculos' );
                                        $full = wp_get_attachment_image_src( $attachment_id, 'veiculos-grande' );
                                    ?>
									<div class="gallery-image">
										<div class="grayscale" data-interchange="[<?php echo $imagem[0]; ?>, small]"></div>
									</div>

									<div class="image-hover-buttons">
										<!-- Show large image-->
										<a class="button rh-button-simple left-vb small secondary-white" href="<?php echo $full[0]; ?>" data-rel="lightcase:fleetGallery">
											<i class="zmdi zmdi-zoom-in fa fa-search-plus"></i>
										</a>
										<!-- Show vehicle card-->
									</div><!-- /end .image-hover-buttons -->

									
								</div><!-- /end .gallery-item -->
                                <?php endwhile; endif; ?>
								
							</div><!-- /end .gallery.rh-gallery -->

		

						</section><!-- /end .section -->
					</div><!-- /end .s-trapeze-edges-inner -->
				</div><!-- /end .s-trapeze-edges.s-fleet -->

				<!-- ===== SECTION-TRAPEZE ===== -->


                    <!-- ===== SECTION "OUR TEAM" ===== -->

					<section class="section" style="padding-top: 0;">
						<div class="row">
							<div class="column small-12">
								<header class="s-header align-center">
									<h2 class="s-headline"> <span class="mark">Nossa</span>Equipe<span class="s-headline-decor"></span></h2>
								</header>
							</div>
						</div>
						<div class="row small-up-1 medium-up-4 large-up-5 owl-carousel dots-dark" data-carousel="medium-down" data-owl-options='{"responsive": { "0": { "items": "1"}, "640": { "items": "2" },"768": { "items": "3" },"960": { "items": "4" }}}'>
                            <?php if(have_rows('lista_equipe')) : while(have_rows('lista_equipe')) : the_row(); ?>
							<div class="column">
								<article class="card card-team card-slide block-shadow">
                                    <?php
                                        $attachment_id = get_sub_field('foto');
                                        $imagem = wp_get_attachment_image_src( $attachment_id, 'equipe' );
                                    ?>
									<img class="grayscale" src="<?php echo $imagem[0]; ?>" alt="<?php the_sub_field('nome'); ?>">
									<div class="card-divider">
										<h4 class="h5"><?php the_sub_field('nome'); ?></h4>
										<p class="subheader"><?php the_sub_field('cargo'); ?></p>
									</div>
								</article>
							</div><!-- /end .column -->
                            <?php endwhile; endif; ?>
                            


						</div><!-- /end .row -->
					</section><!-- /end .section -->

			
			

				

				<?php /*<div class="section-boxed bg-secondary s-equal-paddings covered" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/banner-01.jpg, small]">
					<div class="row align-center">
						<div class="column small-12 large-10">

							<div class="media-object stack-for-medium mb0 align-middle">

								<div class="media-object-section">
									<h2 class="h3 headline light text-center">Cadastre-se em nossa newsletter e fique por dentro das novidades.</h2>
								</div>

								<div class="media-object-section pb0">
									<div class="simple-form form-secondary">
										<?php echo do_shortcode('[contact-form-7 id="127" title="Newsletter"]'); ?>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div><!-- /end .section-boxed.s-equal-paddings -->*/ ?>

				

				<div class="section-trapeze primary">
					<div class="trapeze bg-primary">

						<div class="row small-up-1 medium-up-2">

							<figure class="column align-middle">
                                <?php
                                    $attachment_id = get_field('foto_destaque');
                                    $imagem = wp_get_attachment_image_src( $attachment_id, 'foto_destaque' );
                                ?>
								<img src="<?php echo $imagem[0]; ?>" data-interchange="[<?php echo $imagem[0]; ?>, small], [<?php echo $imagem[0]; ?>, medium]" alt="">
							</figure>

							<article class="column text-center align-self-middle">
								<header class="block-header">
									<h3 class="h3 headline"><?php the_field('titulo_destaque'); ?></h3>
								</header>

								<p><?php the_field('texto_destaque'); ?></p>

								<a class="button rh-button secondary mb0" href="<?php bloginfo('url'); ?>/reserva/">
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
						</div>
					</header>

					<div class="s-trapeze-2x">
						<!-- s-trapeze-2x-images (left & right trapezes)-->
						<div class="s-trapeze-2x-image" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-trapeze-2x-bg.jpg, large]"></div>
						<div class="s-trapeze-2x-image" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-trapeze-2x-bg.jpg, large]"></div>

						<div class="row small-up-1 medium-up-2 large-up-3 owl-carousel" data-carousel="medium-down" data-owl-options='{"smartSpeed": "500","dotsClass": "rh-owl-dots dots-dark"}'>
                            <?php if(have_rows('lista_vantagens')) : while(have_rows('lista_vantagens')) : the_row(); ?>
							<div class="column">
								<!-- Icon card #1-->
								<article class="card card-post-icon block-shadow">
                                    <?php
                                        $attachment_id = get_sub_field('imagem');
                                        $imagem = wp_get_attachment_image_src( $attachment_id, 'destaque' );
                                    ?>
									<div class="card-media"><img class="grayscale" src="<?php echo $imagem[0]; ?>" alt=""></div>

									<div class="card-divider bg-verde">
										<div class="icon-box circle secondary-verde border large"><i class="fa <?php the_sub_field('icone'); ?>"></i></div>
										<h3 class="h4" data-equalizer-watch="data-equalizer-watch"><?php the_sub_field('titulo'); ?></h3>
									</div>

									<div class="card-section">
										<p><?php the_sub_field('texto'); ?></p>
									</div>
								</article><!-- /end .card-post-icon-->
							</div>
                            <?php endwhile; endif; ?>

						</div><!-- /end .row -->
					</div><!-- /end .s-trapeze-2x -->
				</section><!-- /end .section -->

				<!-- ===== COUNTERS SECTION ===== -->

				<?php /*<div class="is-fixed s-counters bg-secondary s-border" data-counter data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-pattern-01.jpg, small]">
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
				</div><!-- /end .s-counters -->*/ ?>

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
                                <?php query_posts('pagename=depoimentos'); ?>
                                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                                    <?php if(have_rows('depoimentos')) : while(have_rows('depoimentos')) : the_row(); ?>
                                    <!-- .testimonials-item -->
                                    <section class="testimonials-item text-center">
                                        <i class="icon zmdi zmdi-quote fa fa-quote-right"></i>

                                        <p><?php the_sub_field('texto'); ?></p>

                                        <div class="testimonials-divider">
                                            <svg class="testimonials-corner">
                                                 <use xlink:href='#corner'></use>
                                            </svg>
                                        </div>

                                        <div class="testimonials-meta">
                                            <div class="media-object align-center">
                                                <div class="media-object-section">
                                                    <span class="h5 author"><?php the_sub_field('nome'); ?></span>
                                                    <span class="company"><?php the_sub_field('pais'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </section><!-- /end .testimonials-item -->
                                    <?php endwhile; endif; ?>
                                <?php endwhile; wp_reset_query(); endif; ?>

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