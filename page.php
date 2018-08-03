<?php require(get_template_directory().'/_inc/inc_start.php'); ?>
<?php get_header(); ?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 	<!-- ===== PAGE HEADER ===== -->

				<section class="section-boxed page-header bg-secondary-shade" data-interchange="[<?php bloginfo('template_url'); ?>/img/page-headers/page-header-07.jpg, small]">
					<div class="row">
						<div class="column small-12">
							<header class="s-header align-center">
								<h1 class="headline"><?php the_title(); ?></h1>
							</header>
						</div>
					</div>
				</section>

				<!-- ===== BREADCRUMBS ===== -->

				<div class="callout bg-secondary-shade">
					<div class="row">
						<div class="column small-12">
							<nav class="text-center" aria-label="You are here:">
								<ul class="breadcrumbs mb0">
									<li><a class="block-link" href="<?php bloginfo('url'); ?>">Home</a></li>
									<li><span class="show-for-sr"></span><?php the_title(); ?></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>

				<!-- ===== MAIN PART ===== -->

				<main class="mb0">
					<?php if(is_page('reservas')) : ?>
						<?php get_template_part('reservas'); ?>
					<?php elseif(is_page('depoimentos')) : ?>
						<?php get_template_part('depoimentos'); ?>
					<?php elseif(is_page('contato')) : ?>
						<?php get_template_part('contato'); ?>
					<?php else : ?>
					<?php endif; ?>

					<!-- ===== FULL WIDTH BOXED SECTION ===== -->

					<div class="section-boxed s-equal-paddings bg-secondary-shade">
						<div class="row expanded small-up-1 medium-up-1 large-up-3 features">

							<div class="column s-content-box">
								<div class="s-content-box-image">
									<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-link-01.jpg, small]"></div>
								</div>

								<div class="media-object align-center mb0">
									<div class="media-object-section">
										<div class="icon-box circle border primary">
											<i class="rh rh-clock"></i>
											<!-- i.zmdi.zmdi-time.fa-li.fa.fa-fa-clock-o-->
										</div>
									</div>
									<div class="media-object-section">
										<h3 class="h4 headline">Funcionamento:</h3>
										<p>8.00 - 20.00</p>
									</div>
								</div><!-- /end .media-object -->
							</div><!-- /end .s-content-box -->

							<div class="column s-content-box">
								<div class="s-content-box-image">
									<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-link-05.jpg, small]"></div>
								</div>

								<div class="media-object align-center mb0">
									<div class="media-object-section">
										<div class="icon-box circle border primary">
											<i class="rh rh-phone"></i>
											<!-- i.zmdi.zmdi-time.fa-li.fa.fa-fa-clock-o-->
										</div>
									</div>
									<div class="media-object-section">
										<h3 class="h4 headline">Telefone:</h3>
										<ul class="no-bullet">
											<li>
												<a class="phone block-link" href="tel:YourPhoneNumber">+56 941-016-076</a>
											</li>
										</ul>
									</div>
								</div><!-- /end .media-object -->
							</div><!-- /end .s-content-box -->

							<div class="column s-content-box">
								<div class="s-content-box-image">
									<div class="grayscale" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-link-06.jpg, small]"></div>
								</div>

								<div class="media-object align-center mb0">
									<div class="media-object-section">
										<div class="icon-box circle border primary"><i class="rh rh-email"></i>
											<!-- i.zmdi.zmdi-time.fa-li.fa.fa-fa-clock-o-->
										</div>
									</div>
									<div class="media-object-section">
										<h3 class="h4 headline">E-mail</h3>
										<ul class="no-bullet">
											<li>
												<a class="mail block-link" href="mailto:contato@transferbrasil.cl">contato@transferbrasil.cl</a>
											</li>
										</ul>
									</div>
								</div><!-- /end .media-object -->
							</div><!-- /end .s-content-box -->

						</div><!-- /end .row -->
					</div><!-- /end .section-boxed.s-equal-paddings  -->

					<!-- ===== MAP ===== -->

					<div class="row expanded collapse inline-map">
						<div class="column small-12">
							<div class="map" id="inlineMap"></div>
						</div>
					</div>
				</main>

				<!-- ===== FULL WIDTH SECTION - DARK ===== -->

				<div class="section-boxed s-equal-paddings bg-secondary white-color has-overlay" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/banner-06.jpg, small]">
					<div class="row">
						<div class="column small-12 medium-6 large-6 large-offset-1 text-center">
							<h2 class="h3">Siga a gente nas redes</h2>
						</div>
						<div class="column small-12 medium-6 large-4">
							<div class="floating-socials">
								<a href="#"> <i class="zmdi zmdi-twitter fa fa-twitter"></i><small> Twitter</small></a>
								<a href="#"> <i class="zmdi zmdi-facebook fa fa-facebook"></i><small> Facebook</small></a>
								<a href="#"> <i class="zmdi zmdi-instagram fa fa-instagram"></i><small> Instagram</small></a>
								<a href="#"> <i class="zmdi zmdi-youtube fa fa-youtube"></i><small> Youtube</small></a>
							</div>
						</div>
					</div>
				</div><!-- /end .section-boxed.s-equal-paddings -->
  	
<?php endwhile; endif; ?>
<?php get_footer(); ?>