<!-- ===== SITE FOOTER ===== -->

				<footer class="site-footer bg-secondary-shade is-fixed s-border" data-interchange="[<?php bloginfo('template_url'); ?>/img/sections/s-pattern-02.jpg, small]">

					<!-- fotter row -->
					<div class="row">

						<!-- 1st footer column -->
						<div class="column small-12 medium-4 large-3">

							<div class="site-footer-section">

								<div class="site-footer-logo">
									<a href="index.html">
										<span class="text-hide">Transfer Brasil</span>
										<img src="<?php bloginfo('template_url'); ?>/img/transfer-brasil.png" alt="Transfer Brasil">
										<!-- <svg class="primary"><use xlink:href="#"></use></svg> -->
									</a>
								</div>
								<p class="subheader"><small>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque aut qui nemo! Repellendus laboriosam fugiat unde necessitatibus consequuntur.</small></p>
								<hr class="primary">

								

							</div><!-- /end .site-footer-section -->
						</div><!-- /end 1st footer column -->

						<!-- 2nd & 3rd footer columns wrap -->
						<div class="column small-12 medium-8 large-8 large-offset-1">
							<div class="row small-up-1 large-up-2 is-collapsed-child">

								<!-- 2nd footer column -->
								<div class="column site-footer-middle-column">

									<div class="site-footer-section row">
										<h3 class="h5 headline">Informações e Contatos:</h3>
										<ul class="zmdi-hc-ul zmdi-hc-ul-2x fa-ul fa-ul-2x featured-list-bordered">
											<li>
												<i class="zmdi-hc-li zmdi-hc-2x zmdi zmdi-pin fa-li fa fa-map-marker"></i>
												<button class="block-link" type="button" data-open="js-map-fullscreen"><?php the_field('endereco','options'); ?></button>
											</li>
											<li>
												<i class="zmdi-hc-li zmdi-hc-2x zmdi zmdi-phone fa-li fa fa-phone"></i>
												<ul class="no-bullet">
													<li><a class="phone block-link" href="tel:YourPhoneNumber"><?php the_field('telefone','options'); ?></a></li>
												</ul>
											</li>
											<li><i class="zmdi-hc-li zmdi-hc-2x zmdi zmdi-email fa-li fa fa-envelope"></i>
												<ul class="no-bullet">
													<li><a class="mail block-link" href="mailto:<?php the_field('email','options'); ?>"><?php the_field('email','options'); ?></a></li>
												</ul>
											</li>
										</ul> <!-- /end .featured-list-bordered -->

									</div><!-- /end .site-footer-section -->

	


								</div><!-- /end 2nd footer column -->

								<!-- 3rd footer column -->
								<div class="column">

									<div class="site-footer-section">
										<h3 class="h5 headline">Siga a gente</h3>
										<div class="button-group socials">
											<a class="button hollow secondary-white" href="#"><i class="zmdi zmdi-facebook fa fa-facebook icon"></i></a>
											<a class="button hollow secondary-white" href="#"><i class="zmdi zmdi-google fa fa-google icon"></i></a>
											<a class="button hollow secondary-white" href="#"><i class="zmdi zmdi-linkedin fa fa-linkedin icon"></i></a>
											<a class="button hollow secondary-white" href="#"><i class="zmdi zmdi-instagram fa fa-instagram icon"></i></a>
											<a class="button hollow secondary-white" href="#"><i class="zmdi zmdi-youtube fa fa-youtube icon"></i></a>
										</div>
									</div><!-- /end .site-footer-section -->

									<div class="site-footer-section">
										<h3 class="h5 headline">Cadastre-se</h3>
										<div class="form-secondary newsletter">
											<?php echo do_shortcode('[contact-form-7 id="127" title="Newsletter"]'); ?>
										</div>
									</div><!-- /end .site-footer-section -->


								</div><!-- /end 3rd footer column -->
							</div>
						</div><!-- /end 2nd & 3rd footer columns wrap -->
					</div><!-- /end footer-row -->

					<div class="site-footer-bottom">
						<div class="row small-up-1 medium-up-2 align-justify align-middle">
							<div class="column">
								<p class="copyright">Transfer Brasil - Todos direitos reservados &copy; 2018.  <a href="http://www.123esite.com.br" target="_blank">123esite</a>.</p>
							</div>
							<div class="column">
								<ul class="menu vertical medium-horizontal">
									<li><a class="block-link" href="#">Política de privacidade</a></li>
									<li><a class="block-link" href="#">Termos e condições</a></li>
								</ul>
							</div>
						</div>
					</div><!-- /end .site-footer-bottom -->
				</footer><!-- /end .site-footer -->

				<!-- ===== MOBILE BOTTOM BAR ===== -->

				<div class="mobile-bottom-bar bg-secondary-shade flex-container align-justify hide-for-large" id="js-bottom-bar" data-magellan>
					<div class="buuton-group">
						<a class="button hollow secondary-white small" href="tel:+12345678900"><i class="zmdi fa zmdi-phone fa-phone" aria-hidden="true"></i></a>
						<a class="button hollow secondary-white small" href="mailto:YourEmailAddres"><i class="zmdi fa zmdi-email fa-mail" aria-hidden="true"></i></a>
					</div>
					<div class="buuton-group">
						<a class="button hollow secondary-white small" href="#js-top-bar"><i class="zmdi zmdi-long-arrow-up fa fa-arrow-up" aria-hidden="true"></i></a>
						<button class="button hollow secondary-white button" type="button" data-toggle="js-main-off-canvas-right"><span class="burger-icon"></span>Menu</button>
					</div>
				</div><!-- /end .mobile-bottom-bar -->

				<!-- ===== SCROLL UP BUTTON ===== -->

				<div class="scroll-up show-for-large" id="js-scroll-up" data-magellan>
					<a class="flex-container align-center align-bottom" href="#js-top-bar"><i class="rh rh-van-fleet" aria-hidden="true"></i>
						<span class="show-for-sr">Scroll up</span>
					</a>
				</div>

			</div><!-- /end .off-canvas-content -->
		</div><!-- /end .off-canvas-wrapper -->

		<!-- ===== POPUP AND MODAL WINDOWS ===== -->

		<!-- Form Alert -->
		<div id="form-alert-popup" class="reveal tiny" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>
			<div class="text-center">
				<div class="block-header ajax-message"></div>
				<button class="button rh-button flip-y" data-close aria-label="Close modal">
					<i class="zmdi zmdi-close fa fa-close"></i>
					<span>Close window</span>
				</button>
			</div>
		</div>

		<!-- Googlemap reveal modals -->
		<div class="small reveal reveal-map" id="js-map-small" data-reveal>
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>

			<div class="map" id="js-reveal-map-small"></div>
		</div>

		<div class="large reveal reveal-map" id="js-map-large" data-reveal>
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>

			<div class="map" id="js-reveal-map-large"></div>
		</div>

		<div class="full reveal reveal-map" id="js-map-fullscreen" data-reveal>
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>

			<div class="map" id="js-reveal-map-fullscreen"></div>
		</div>

		<!-- Topbar search modal-->
		<div class="reveal reveal-search" id="js-topbar-search" data-reveal data-animation-in="fade-in" data-animation-out="fade-out">
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>

			<form class="form-secondary" data-abide novalidate>
				<label>
					<input class="input-group-field" type="search" placeholder="Type &amp; hit enter" required>
					<span class="form-error" data-abide-error>Digite o que está procurando e tecle enter.</span>
				</label>
				<input type="submit" hidden>
			</form>
		</div>

		<!-- Register/Login modal-->
		<div class="reveal" id="js-modal-account" data-reveal data-animation-in="scale-in-up" data-animation-out="scale-out-down">
			<button class="close-button" data-close aria-label="Close modal"><span></span></button>

			<div class="js-tabs-container">

				<!-- Tabs buttons -->
				<ul class="tabs secondary expanded" id="js-modal-tabs" data-tabs data-auto-focus="false">
					<li class="tabs-title is-active">
						<a href="#js-modal-login-panel"> <i class="zmdi zmdi-sign-in zmdi-hc-fw fa fa-sign-in fa-fw"></i>Sign in</a>
					</li>
					<li class="tabs-title">
						<a href="#js-modal-register-panel"> <i class="zmdi zmdi-account-add zmdi-hc-fw fa fa-user-plus fa-fw"></i>New account</a>
					</li>
				</ul>

				<!-- Tabs content -->
				<div class="tabs-content" data-tabs-content="js-modal-tabs" data-auto-focus="false">

					<div class="tabs-panel is-active" id="js-modal-login-panel">
						<!-- Login form-->
						<form data-abide novalidate>
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-account fa fa-user"></span>
									<input class="input-group-field" type="text" placeholder="Your name" required>
								</span>
							</label>
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-email fa fa-envelope"></span>
									<input class="input-group-field" type="email" placeholder="Your mail" required>
								</span>
							</label>
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-phone fa fa-phone"></span>
									<input class="input-group-field" type="text" data-type-phone placeholder="Your phone number" required>
								</span>
							</label>
							<label>
								<span class="input-group">
									<span class="input-group-label zmdi zmdi-lock fa fa-lock"></span>
									<input class="input-group-field" type="password" data-type-phone placeholder="Your password" required>
								</span>
							</label>
							<div class="text-center">
								<button class="button rh-button " type="submit"><i class="zmdi zmdi-lock fa fa-unlock"></i>
									<span>Login</span>
								</button>
							</div>
						</form>
						<!-- /end Login form-->
					</div>

					<div class="tabs-panel" id="js-modal-register-panel">

						<!-- Register form-->
						<form data-abide novalidate>
							<fieldset>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-account fa fa-user"></span>
										<input class="input-group-field" type="text" placeholder="Your name" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-email fa fa-envelope"></span>
										<input class="input-group-field" type="email" placeholder="Your mail" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-phone fa fa-phone"></span>
										<input class="input-group-field" type="text" data-type-phone placeholder="Your phone number" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-lock fa fa-lock"></span>
										<input class="input-group-field" type="password" data-type-phone placeholder="Your password" required>
									</span>
								</label>
								<label>
									<span class="input-group">
										<span class="input-group-label zmdi zmdi-lock fa fa-lock"></span>
										<input class="input-group-field" type="password" data-type-phone placeholder="Repeat your password" required>
									</span>
								</label>
							</fieldset>
							<fieldset>
								<div class="checkbox inline">
									<label>
										<input type="checkbox">
										<span class="custom-checkbox"><i class="icon-check"></i>
										</span>Subscribe me to the newsletter
									</label>
								</div>
							</fieldset>
							<div class="text-center">
								<button class="button rh-button " type="submit"><i class="zmdi zmdi-check-square fa fa-check-square"></i>
									<span>Register</span>
								</button>
							</div>
						</form><!-- /end Register form-->

					</div><!-- /end .tabs-panel -->
				</div><!-- /end .tabs-content -->
			</div><!-- /end .js-tabs-container -->

		</div><!-- /end Register/Login moda -->

		<!-- ===== SCRIPTS ===== -->

		<script src="<?php bloginfo('template_url'); ?>/js/vendor/animsition.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/foundation.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/what-input.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/owl.carousel.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/shuffle.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/inputmask.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/inputmask.phone.extensions.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/lightcase.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery.waypoints.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery.incremental-counter.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/slick.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery.barrating.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/jquery.countdown.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/flatpickr.min.js"></script>
		<script src="<?php bloginfo('template_url'); ?>/js/vendor/imagesloaded.pkgd.min.js"></script>

		<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>

		<!-- googleMaps-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEsZ-9mpuN91VEIej35-L0yJktp2ZvxGM&callback=initMap" async defer></script>

		<!-- An alternative way to include Google fonts -->
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>-->
		<!-- <script>WebFont.load({google: {families: ['Poppins:400,600,700','Lato:400,300,300italic,400italic,700,900']}});</script>-->
       
        <?php if(is_page('reservas')) : ?>
         <?php $v_tipos = array(1=>'Ida e volta', 2=>'Somente ida', 3=>'Somente volta'); ?>
         <script>
        var $datePickerDate = $('.js-datepicker-date'),
        $datePickerTime = $('.js-datepicker-time'),
        $datePickerGroup = $('.js-datepicker-group'),
        $fleetForm = $('#js-fleet-form'),
        $form = $('form'),
        $modalTabs = $('#js-modal-tabs'),
        $phone = $('[data-type-phone]'),
        $radio = $('.tiporeserva'),
        $chegada = $('.chegada'),
        $partida = $('.partida'),
        $chegadaInput = $('.chegadainput'),
        $partidaInput = $('.partidainput'),
        __FORM = __FORM || {};
        __FORM.forms = {
		init: function(){
			__FORM.forms.flatpickrInit();
            __FORM.forms.phoneInputMask();
			/*__FORM.forms.resetFormInRevealTab();
			__FORM.forms.resetFormOnCloseReveal();*/
			__FORM.forms.selectPlaceholder();
			//__FORM.forms.setUpListeners();
		},
            
        // ---------------------------------------------------------------------
		// Phone inputmask
		// ---------------------------------------------------------------------
		phoneInputMask: function () {
			if (!$phone.length) return;
            if($phone.length > 10) {
                var $im = new Inputmask('(99) 99999-9999'); 
            } else {  
                var $im = new Inputmask('(99) 9999-99999');
            }  
			
			if ($phone) { $im.mask($phone); }
		},

		/*setUpListeners: function() {
			//$form.on('submit', function(e) { e.preventDefault(); });

			$form.on('formvalid.zf.abide', function(ev, frm) {

				$formAlert.html(function() {
					$(this).addClass('tiny').find('.ajax-message').html('Aguarde, por favor...');
				}).foundation('open');
				__FORM.forms.sendData();
			});
		},*/
		// ---------------------------------------------------------------------
		// Flatpickr plugin initialization
		// ---------------------------------------------------------------------
		flatpickrInit: function () {
			var dpDate,	dpTime, $tipoReserva;
            
                       
                $tipoReserva = '<?php echo $v_tipos[$_POST['tiporeserva']] ?>';
                
                if($tipoReserva == "Somente ida") {
                   $chegada.css('display','block');
                   $partida.css('display','none');
                   $partidaInput.removeAttr('required data-invalid');
                   $chegadaInput.attr('required data-invalid');
                   $partidaInput.removeClass('is-invalid-input');
                    $chegadaInput.removeClass('is-invalid-input');
                    $partidaInput.removeClass('is-invalid-input');
                    
                } else if($tipoReserva == "Somente volta") {
                   $chegada.css('display','none');
                    $partida.css('display','block');
                    $partidaInput.attr('required data-invalid');
                   $chegadaInput.removeAttr('required data-invalid');
                    $chegadaInput.removeClass('is-invalid-input');
                    $partidaInput.removeClass('is-invalid-input');
                } else {
                    $partida.css('display','block');
                    $chegada.css('display','block');
                    $partidaInput.attr('required data-invalid');
                    $chegadaInput.attr('required data-invalid');
                    $chegadaInput.removeClass('is-invalid-input');
                    $partidaInput.removeClass('is-invalid-input');
                }
           
           

			if ($datePickerDate.length > 0) {
				dpDate = $datePickerDate.flatpickr({
					enableTime: false,
					noCalendar: false,
                    dateFormat: "d-m-Y",
					allowInput: true
				});
			}

			if ($datePickerTime.length > 0) {
				dpTime =  $datePickerTime.flatpickr({
					enableTime: true,
					noCalendar: true,
					time_24hr: true,
					allowInput: true
				});
			}

			if ($datePickerGroup.length > 0) {
                
               dpDate[0].set('minDate', '<?=(Reserva::get_min_date())->format('d-m-Y')?>');
                dpDate[1].set('minDate', '<?=(Reserva::get_min_date())->format('d-m-Y')?>');

				/*$datePickerDate.on('focus', function() {
					if (!$datePickerTime.attr('required') ) {
						$datePickerTime.prop('required',true);
					}
				});*/
                if($tipoReserva == "Somente ida") {
                 
                    dpDate[0].config.onChange = [function (selectedDates) {
                        console.log(selectedDates[0]);
                        dpTime[0].setDate(selectedDates[0]);
                        dpDate[1].set('minDate', selectedDates[0]);
                    }];

                    dpDate[0].config.onClose = [function () {
                        setTimeout(function () {
                            return dpTime[0].open();
                        }, 1);
                    }];
                } else if($tipoReserva == "Somente volta") {
                   
                    dpDate[1].config.onChange = [function (selectedDates) {
                        dpTime[1].setDate(selectedDates[0]);
                        dpDate[0].set('maxDate', selectedDates[0]);
                    }];

                    dpDate[1].config.onClose = [function () {
                        setTimeout(function () {
                            return dpTime[1].open();
                        }, 1);
                    }];
                } else {
                     
                   dpDate[0].config.onChange = [function (selectedDates) {
                        console.log(selectedDates[0]);
                        dpTime[0].setDate(selectedDates[0]);
                        dpDate[1].set('minDate', selectedDates[0]);
                    }];

                    dpDate[0].config.onClose = [function () {
                        setTimeout(function () {
                            return dpTime[0].open();
                        }, 1);
                    }];
                    dpDate[1].config.onChange = [function (selectedDates) {
                        dpTime[1].setDate(selectedDates[0]);
                        dpDate[0].set('maxDate', selectedDates[0]);
                    }];

                    dpDate[1].config.onClose = [function () {
                        setTimeout(function () {
                            return dpTime[1].open();
                        }, 1);
                    }];
                }
			}
		},
		// ---------------------------------------------------------------------
		// Function resets the form after changing the active tab
		// in the reveal modal window
		// ---------------------------------------------------------------------
		/*resetFormInRevealTab: function () {
			if (!$modalTabs.length) return;

			$modalTabs.on('change.zf.tabs', function() {
				var panel = $(this).siblings('.tabs-content').children('.tabs-panel');

				if ( panel.hasClass('is-active') ) {
					panel.children('form').foundation('resetForm');
				}
			});
		},*/
		// ---------------------------------------------------------------------
		// Function resets the form after closing the reveal modal window
		// ---------------------------------------------------------------------
		/*resetFormOnCloseReveal: function () {
			var reveal = $('[data-reveal]');

			if (!reveal.length) return;

			reveal.on('closed.zf.reveal', function() {
				var revealForm = $(this).find('form');
				if(revealForm.length) {
					if (!$(this).hasClass('reveal-map')) {
						revealForm.foundation('resetForm').get(0).reset();
					}
				}
			});
		},*/
		// ---------------------------------------------------------------------
		// Select placeholder color
		// ---------------------------------------------------------------------
		selectPlaceholder: function () {
			var select = $('select');

			if (!select.length) return;

			select.on('change', function() {
				if ($(this).hasClass('placeholder')) {
					$(this).removeClass('placeholder');
				}
			});
		},
		// ---------------------------------------------------------------------
		/*sendData: function() {
			// console.log('Sending the message');
			var form = $(this),
				url = 'includes/mail.php',
				defObject =  __FORM.forms.ajaxForm(form, url);

			if (defObject) {
				defObject.done(function(ans) {
					var mes = ans.mes,
						status = ans.status;

					if (status === 'OK') {
						__FORM.forms.succesPopup(mes);
						// console.log(mes);
					} else {
						__FORM.forms.errorPopup(mes);
						// console.log(mes);
					}
				});
			}
		},*/
		// ---------------------------------------------------------------------
		/*ajaxForm: function(form, url) {

			var data = form.serialize();
			return $.ajax({
				type: 'POST',
				url: url,
				dataType: 'JSON',
				data: data
			}).fail(function(ans) {
				// console.log('Errors in PHP');
				__FORM.forms.errorPopup(ans);

			});
		},*/
		// ---------------------------------------------------------------------
		/*succesPopup: function (mes) {
			// console.log('Popup successful!');
			$formAlert.removeClass('tiny').html(function () {
				$(this).find('.ajax-message').html('<div class=\'icon-box secondary circle large\'><i class=\'zmdi zmdi-check-all fa fa-check\'></i></div><h3>' + mes + '</h3>');
				$(this).on('closed.zf.reveal', function() {
					$form.foundation('resetForm').get(0).reset();
					__FORM.forms.resetBarrating();
				});
			}).foundation('open');
		},
		// ---------------------------------------------------------------------
		errorPopup: function (mes) {
			// console.log('Popup error!');
			$formAlert.removeClass('tiny').html(function () {
				$(this).find('.ajax-message').html('<div class=\'icon-box alert circle large\'><i class=\'zmdi zmdi-alert-triangle fa fa-warning\'></i></div><h4>' + mes + '</h4>');
			}).foundation('open');
		}*/

	}; // /end of __FORM.forms
                $(document).ready(function() {
                     __FORM.forms.init();
                })
               
            
            </script>
        <?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>