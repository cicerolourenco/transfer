(function($) {
	'use strict';

	$(function() { $(document).foundation(); });

	/*------------------------------------------------------------------------------
		GLOBAL VARIABLES
	------------------------------------------------------------------------------*/

	var $body = $('body'),
		$window = $(window),
		$wrapper = $('.wrapper'),
		$preventDefaultsElements = [
			'a[href^="#"]',
			'#js-topbar-search-toggler',
			'#js-topbar-map-toggler',
			'.js-reveal-toogler',
			'a[class*="carousel-button-"]'
		],
		$cardFlip = $('.card-flip'),

		$lightcase = $('[data-rel^="lightcase"]'),
		$lightcaseZoom = $('[data-rel^="lightcase-zoom"]'),
		$lightcaseFade = $('[data-rel^="lightcase-fade"]'),
		$lightcaseFleetCards = $('[data-rel="ligh!tcase:fleetcards"]'),

		$share = $('.share'),
		$datePickerDate = $('.js-datepicker-date'),
		$datePickerTime = $('.js-datepicker-time'),
		$datePickerGroup = $('.js-datepicker-group'),
		$form = $('form'),
		$fleetForm = $('#js-fleet-form'),
		$barratingElements = $('[data-rating-stars]'),
		$phone = $('[data-type-phone]'),
		$formAlert = $('#form-alert-popup'),
		$langBar = $('#js-langbar'),
		$heroCarousel = $('#js-hero-carousel'),
		$headerMenuButton = $('#js-header-nav-btn'),
		$mainNav = $('#js-site-navigation'),
		$bl = $('.block-link'),
		$countdown = $('.countdown'),
		$progressbar = $('[role="progressbar"]'),
		$reveal = $('.reveal'),
		$shortButton = $('.short-on-mobile'),
		$tabs = $('[data-tabs], [data-responsive-accordion-tabs]'),
		$modalTabs = $('#js-modal-tabs'),
		$slickThumbMain = $('[id*="js-slick-main"]'), /* single image id from thumbnails carousel */
		$slickThumbs = $('[id*="js-slick-thumbs"]'), /* thumbnails carousel id*/
		$fleetGrid = $('#js-fleet-grid'),
		$tabVideoContainer = '.product-info',
		$productCardToggle = $('#js-fleet-toggle-cards'),
		$productPanelToggle = $('#js-fleet-toggle-panels'),
		$videoCover = $('.video-cover'),
		$vimeoApiUrl = 'https://player.vimeo.com/api/player.js',
		$youtubeApiUrl = 'https://www.youtube.com/iframe_api',
		$sList = $('#js-services-list'),
		$sBtnList = $('#js-services-button-list'),
		$sFirstItem = $('#js-services-item-1'),
		$sFirstItemLabel = $('#js-services-item-1-label'),
		$bottomBar = $('#js-bottom-bar'),
		$scrollUp = $('#js-scroll-up'),
		$owlCarousel = $('[data-owl-carousel]');

	/*------------------------------------------------------------------------------
		MAIN OBJECT
	------------------------------------------------------------------------------*/

	var __RENTHIRE = __RENTHIRE || {};

	/*------------------------------------------------------------------------------
		CAROUSELS
	------------------------------------------------------------------------------*/

	__RENTHIRE.carousels = {
		init: function() {
			__RENTHIRE.carousels.respCarouselInit();
			__RENTHIRE.carousels.thumbnailsCarousel();
			__RENTHIRE.carousels.owlCarouselInit($owlCarousel);
		},

		respCarouselInit: function() {
			__RENTHIRE.carousels.respCarousel('[data-carousel="medium-down"]', 'large');
			__RENTHIRE.carousels.respCarousel('[data-carousel="small-only"]', 'medium');
		},

		/*
			RESPONSIVE CAROUSEL FOR CARDS
			Carousel for medium and small screen
			resolutions only ( < 1024px )
			Dependencies:
				- owl-carousel
				- foundation mediaquery
			HTML: data-carousel='medium-down'
		*/
		respCarousel: function(element, breakpoint) {
			$.each($(element), function(index, el) {
				var slider = $(el),
					inlineOptions = slider.data('owl-options');

				if (Foundation.MediaQuery.atLeast(breakpoint)) {
					if (slider.hasClass('owl-carousel')) {

						slider.trigger('destroy.owl.carousel');
						slider.removeClass('owl-carousel owl-loaded');
						slider.find('.owl-stage-outer').children().unwrap();
					}
				} else {
					slider.addClass('owl-carousel').owlCarousel($.extend({
						items: 1,
						dots: true,
						responsive: {
							0: {
								items: 1
							},
							640: {
								items: 2
							}
						}
					}, inlineOptions)).trigger('refresh.owl.carousel');
				}
			});
		},
		// ---------------------------------------------------------------------
		// Thumbnails images carousel (slick.js)
		// ---------------------------------------------------------------------
		thumbnailsCarousel: function() {
			$slickThumbMain.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				prevArrow: '<button type="button" class="button rh-button-simple flip-y left-vb small rh-slick-prev"><i class="zmdi zmdi-chevron-left fa fa-chevron-left"><i><span class="show-for-sr">Previous Slide</span></button>',
				nextArrow: '<button type="button" class="button rh-button-simple flip-y right-vb small rh-slick-next"><i class="zmdi zmdi-chevron-right fa fa-chevron-right"><i><span class="show-for-sr">Next Slide</span></button>',
			});
			$slickThumbs.slick({
				variableWidth: true,
				slidesToShow: 3,
				slidesToScroll: 1,
				arrows: false,
				centerMode: true,
				focusOnSelect: true
			});
		},
		// ---------------------------------------------------------------------
		// Template carousel buttons (.rh-button-simple)
		// ---------------------------------------------------------------------
		owlRhButtons: function(element, target, icon) {
			var buttonsOptions = element.data('button-color'),
				buttonsOptionsArr,
				prevButton = ' ',
				nextButton = ' ',
				buttonData;

			if (buttonsOptions) {
				buttonsOptionsArr = buttonsOptions.split(' ');
				prevButton += buttonsOptionsArr[0];
				nextButton += buttonsOptionsArr[1];

			} else {
				prevButton = '';
				nextButton = '';
			}

			if (target === 'prev') {
				buttonData = 'rh-button-simple' + prevButton + ' left-vb';
			} else {
				if (target === 'next') {
					buttonData = 'rh-button-simple' + nextButton + ' right-vb flip-y';
				} else {
					buttonData = '';
				}
			}
			return '<button class="button ' + buttonData + '">' + (icon ? ('<i class="' + icon + '"></i>') : '') + '</button>';
		},
		// ---------------------------------------------------------------------
		// Animate content on load
		// ---------------------------------------------------------------------
		owlContentAnimate: function(element, event) {

			var activeItem = $(element).find('.owl-item.active'),
				elContainer = activeItem.find('.js-animate-container');

			if (event === 'show') {
				elContainer.addClass('mui-enter-active');

				setTimeout(function() {
					elContainer.find('.js-animate-1').addClass('mui-enter-active').show();
				}, 700);

				setTimeout(function() {
					elContainer.find('.js-animate-2').addClass('mui-enter-active').show();
				}, 1000);

				setTimeout(function() {
					elContainer.find('.js-animate-3').addClass('mui-enter-active').show();
				}, 1300);

			} else {
				if (event === 'hide') {
					$(element).find('.mui-enter-active').removeClass('mui-enter-active');
				} else return;
			}
		},
		// ---------------------------------------------------------------------
		// OWL Carousel plugin initialization
		// ---------------------------------------------------------------------
		owlCarouselInit: function(carEl, options) {
			$.each($(carEl), function(index, el) {
				var carousel = $(el),
					buttonType = carousel.data('button-type'),
					inlineOWLOptions = carousel.data('owl-options'),
					navButtons,
					navContainerClass;

				if (buttonType === 'arrows') {
					navButtons = [
						'<button class="carousel-button-prev"><span>Prev</span></button>',
						'<button class="carousel-button-next"><span>Next</span></button>',
					];
					navContainerClass = 'owl-nav owl-arrow-buttons';
				} else {
					if (buttonType === 'rh-buttons') {
						navButtons = [
							__RENTHIRE.carousels.owlRhButtons(carousel, 'prev', 'zmdi zmdi-chevron-left zmdi-hc-lg'),
							__RENTHIRE.carousels.owlRhButtons(carousel, 'next', 'zmdi zmdi-chevron-right zmdi-hc-lg')
						];
						navContainerClass = 'owl-nav owl-rh-buttons';
					} else {
						navButtons = false;
					}
				}

				carousel.on('initialized.owl.carousel', function() {
					if ($(this).data('content-animation')) {
						__RENTHIRE.carousels.owlContentAnimate($(this), 'show');
					} else return;
				}).owlCarousel($.extend({
					items: 1,
					loop: true,
					dots: true,
					autoplay: true,
					autoplayTimeout: 8000,
					autoplayHoverPause: true,
					smartSpeed: 1200,
					navText: navButtons,
					navContainerClass: navContainerClass ? navContainerClass : false,

				}, options ? options : null, inlineOWLOptions)).on('translate.owl.carousel', function(e) {
					if ($(this).data('content-animation')) {
						__RENTHIRE.carousels.owlContentAnimate($(this), 'hide');
					} else return;
				}).on('translated.owl.carousel', function(e) {
					if ($(this).data('content-animation')) {
						__RENTHIRE.carousels.owlContentAnimate($(this), 'show');
					} else return;
				});
			});
		}
	}; // /end of __RENTHIRE.carousels

	/*------------------------------------------------------------------------------
		FORMS
	------------------------------------------------------------------------------*/

	__RENTHIRE.forms = {
		init: function(){
			__RENTHIRE.forms.flatpickrInit();
			__RENTHIRE.forms.foundationSlider();
			__RENTHIRE.forms.resetBarrating();
			__RENTHIRE.forms.resetFormInRevealTab();
			__RENTHIRE.forms.resetFormOnCloseReveal();
			__RENTHIRE.forms.selectPlaceholder();
			__RENTHIRE.forms.setUpListeners();
		},

		setUpListeners: function() {
			//$form.on('submit', function(e) { e.preventDefault(); });

			$form.on('formvalid.zf.abide', function(ev, frm) {

				$formAlert.html(function() {
					$(this).addClass('tiny').find('.ajax-message').html('Wait, please...');
				}).foundation('open');
				__RENTHIRE.forms.sendData();
			});
		},
		// ---------------------------------------------------------------------
		// Flatpickr plugin initialization
		// ---------------------------------------------------------------------
		flatpickrInit: function () {
			var dpDate,	dpTime;

			if ($datePickerDate.length > 0) {
				dpDate = $datePickerDate.flatpickr({
					enableTime: false,
					noCalendar: false,
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

				$datePickerDate.on('focus', function() {
					if (!$datePickerTime.attr('required')) {
						$datePickerTime.prop('required',true);
					}
				});

				dpDate[0].config.onChange = [function (selectedDates) {
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
		},
		// ---------------------------------------------------------------------
		// Foundation slider actions
		// ---------------------------------------------------------------------
		foundationSlider: function () {
			// Reinitialisation foundation "Slider" plugin after loading "OffCanvas" plugin
			if (($fleetForm.length > 0) && Foundation.OffCanvas) Foundation.reInit('slider');
		},
		// ---------------------------------------------------------------------
		// Reset barrating value
		// ---------------------------------------------------------------------
		resetBarrating: function () {
			if (!$form.length) return;

			$form.on('reset', function() {
				var brate = $(this).find('[data-rating-stars]');

				if (!brate.length) return;

				brate.barrating('clear');
				Foundation.reInit('slider');
			});
		},
		// ---------------------------------------------------------------------
		// Function resets the form after changing the active tab
		// in the reveal modal window
		// ---------------------------------------------------------------------
		resetFormInRevealTab: function () {
			if (!$modalTabs.length) return;

			$modalTabs.on('change.zf.tabs', function() {
				var panel = $(this).siblings('.tabs-content').children('.tabs-panel');

				if ( panel.hasClass('is-active') ) {
					panel.children('form').foundation('resetForm');
				}
			});
		},
		// ---------------------------------------------------------------------
		// Function resets the form after closing the reveal modal window
		// ---------------------------------------------------------------------
		resetFormOnCloseReveal: function () {
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
		},
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
		sendData: function() {
			// console.log('Sending the message');
			var form = $(this),
				url = 'includes/mail.php',
				defObject =  __RENTHIRE.forms.ajaxForm(form, url);

			if (defObject) {
				defObject.done(function(ans) {
					var mes = ans.mes,
						status = ans.status;

					if (status === 'OK') {
						__RENTHIRE.forms.succesPopup(mes);
						// console.log(mes);
					} else {
						__RENTHIRE.forms.errorPopup(mes);
						// console.log(mes);
					}
				});
			}
		},
		// ---------------------------------------------------------------------
		ajaxForm: function(form, url) {

			var data = form.serialize();
			return $.ajax({
				type: 'POST',
				url: url,
				dataType: 'JSON',
				data: data
			}).fail(function(ans) {
				// console.log('Errors in PHP');
				__RENTHIRE.forms.errorPopup(ans);

			});
		},
		// ---------------------------------------------------------------------
		succesPopup: function (mes) {
			// console.log('Popup successful!');
			$formAlert.removeClass('tiny').html(function () {
				$(this).find('.ajax-message').html('<div class=\'icon-box secondary circle large\'><i class=\'zmdi zmdi-check-all fa fa-check\'></i></div><h3>' + mes + '</h3>');
				$(this).on('closed.zf.reveal', function() {
					$form.foundation('resetForm').get(0).reset();
					__RENTHIRE.forms.resetBarrating();
				});
			}).foundation('open');
		},
		// ---------------------------------------------------------------------
		errorPopup: function (mes) {
			// console.log('Popup error!');
			$formAlert.removeClass('tiny').html(function () {
				$(this).find('.ajax-message').html('<div class=\'icon-box alert circle large\'><i class=\'zmdi zmdi-alert-triangle fa fa-warning\'></i></div><h4>' + mes + '</h4>');
			}).foundation('open');
		}

	}; // /end of __RENTHIRE.forms

	/*------------------------------------------------------------------------------
		VIDEO
	------------------------------------------------------------------------------*/

	__RENTHIRE.video = {
		init: function() {
			__RENTHIRE.video.videoCover();
			__RENTHIRE.video.tabVideoControl($tabVideoContainer);
		},
		// ---------------------------------------------------------------------
		videoCover: function () {
			if (!$videoCover.length) return;

			var videoButton = $videoCover.find('.video-play-button'),
				videoIframe = $videoCover.find('iframe');

			videoIframe.attr('data-src',  videoIframe.attr('src'));
			videoIframe.attr('src', '');

			videoButton.on('click touchstart', function(e) {

				e.preventDefault();

				var curCover = $(this).closest('.video-cover'),
					curVideo = curCover.find('video').get(0),
					curVideoIframe = curCover.find('iframe');

				if (curVideoIframe.length) {
					curCover.addClass('is-active');
					curVideoIframe.attr('src', curVideoIframe.attr('data-src'));
				}
				if ($(curVideo).length) {
					curCover.addClass('is-active');
					curVideo.play();
				}
			});
		},
		// ---------------------------------------------------------------------
		// Function stops an iframe of Vimeo video from playing
		// when tab is not active
		// ---------------------------------------------------------------------
		tabVideoVimeo: function (tabVideo, tabs) {
			var iframe = tabVideo.find('iframe'),
				vplayer = new Vimeo.Player(iframe);

			tabs.on('change.zf.tabs', function() {
				if (!tabVideo.hasClass('is-active')) vplayer.pause();
			});
		},
		// ---------------------------------------------------------------------
		// Function stops an iframe of Youtube video from playing
		// when tab is not active
		// ---------------------------------------------------------------------
		tabVideoYoutube: function (tabVideo, tabs) {
			var iframe = tabVideo.find('iframe');

			tabs.on('change.zf.tabs', function() {
				iframe.each(function(i, el) {
					if (!window.YT)
						return;
					el.contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
				});
			});
		},
		// ---------------------------------------------------------------------
		// Function stops an iframe or HTML5 <video> from playing
		// when tab is not active
		// ---------------------------------------------------------------------
		tabVideoHtml5: function (tabVideo, tabs) {
			var iframe = tabVideo.find('iframe').get(0),
				video = tabVideo.find('video').get(0);

			tabs.on('change.zf.tabs', function() {

				if (!tabVideo.hasClass('is-active')) {
					if (iframe) {
						var iframeSrc = iframe.src;
						iframe.src = iframeSrc;
					}
					if (video) {
						video.pause();
					}
				}
			});
		},
		// ---------------------------------------------------------------------
		tabVideoControl: function (el) {
			var tabsContainer = $(el),
				tabs = tabsContainer.find('.tabs'),
				tabsPanel = tabsContainer.find('.tabs-panel[class*=\'js-tabvideo\']');

			if (tabsPanel.length > 0) {
				if (tabsPanel.hasClass('js-tabvideo')) {
					__RENTHIRE.video.tabVideoHtml5(tabsPanel, tabs);
				}
				if (tabsPanel.hasClass('js-tabvideo-youtube')) {
					__RENTHIRE.documentOnReady.loadScript($youtubeApiUrl, function () {
						__RENTHIRE.video.tabVideoYoutube(tabsPanel, tabs);
					});
				}
				if (tabsPanel.hasClass('js-tabvideo-vimeo')) {
					__RENTHIRE.documentOnReady.loadScript($vimeoApiUrl, function () {
						__RENTHIRE.video.tabVideoVimeo(tabsPanel, tabs);
					});
				}
			}
		}
	}; // /end of __RENTHIRE.video

	/*----------------------------------------------------------------------------*/

	__RENTHIRE.documentOnResize = {
		init: function () {
			$(window).on('changed.zf.mediaquery', function(event, newSize, oldSize) {
				__RENTHIRE.carousels.respCarouselInit();
				__RENTHIRE.documentOnReady.transformBtns();
				__RENTHIRE.documentOnReady.updateFoundationCanvas();
				__RENTHIRE.documentOnReady.servicesTabsHelpers();
				__RENTHIRE.documentOnReady.bottomBar();

				if (Foundation.MediaQuery.current === 'small' || Foundation.MediaQuery.current === 'medium') {
					if($mainNav.css('display') !== 'none') {
						$mainNav.css('display', 'none');
					}
				}  else {
					$mainNav.css('display', 'block');
				}
			});
		},
	}; // /end of __RENTHIRE.documentOnResize

	/*----------------------------------------------------------------------------*/

	__RENTHIRE.documentOnReady = {

		init: function () {
			__RENTHIRE.documentOnReady.barratingStars();
			__RENTHIRE.documentOnReady.blockLinkAction();
			__RENTHIRE.documentOnReady.cardFlipAction();
			__RENTHIRE.documentOnReady.countdown();
			__RENTHIRE.documentOnReady.disableHover();
			__RENTHIRE.documentOnReady.disableDefaultEvents();
			__RENTHIRE.documentOnReady.tabsAnimation();
			__RENTHIRE.documentOnReady.lightcasePlugin();
			__RENTHIRE.documentOnReady.phoneInputMask();
			__RENTHIRE.documentOnReady.postShareButton();
			__RENTHIRE.documentOnReady.productCardToggleView();
			__RENTHIRE.documentOnReady.progressbar();
			__RENTHIRE.documentOnReady.revealActiveClass();
			__RENTHIRE.documentOnReady.servicesTabsHelpers();
			__RENTHIRE.documentOnReady.switchLanguage();
			__RENTHIRE.documentOnReady.transformBtns();
			__RENTHIRE.documentOnReady.updateFoundationCanvas();
			__RENTHIRE.documentOnReady.bottomBar();
			__RENTHIRE.documentOnReady.pageLoader();
			__RENTHIRE.documentOnReady.dropdownMobileMenu();

			__RENTHIRE.forms.init();
			__RENTHIRE.carousels.init();
			__RENTHIRE.video.init();
			__RENTHIRE.documentOnResize.init();
		},
		// ---------------------------------------------------------------------
		// Barrating
		// ---------------------------------------------------------------------
		barratingStars: function () {
			$barratingElements.each(function(index,el) {
				var barTheme;

				if ($(el).data('rating-stars') !== '') {
					barTheme = $(el).data('rating-stars');
				} else {
					barTheme = 'css-stars';
				}

				$(el).barrating({
					theme: barTheme
				});
			});
		},
		// ---------------------------------------------------------------------
		// Countdown
		// ---------------------------------------------------------------------
		countdown: function () {
			if (!$countdown.length) return;

			$countdown.countdown({
				render: function(data) {
					$(this.el).html(
						'<div class=\'column\'>' + this.leadingZeros(data.days, 3) + '<span>days</span></div><div class=\'column\'>' + this.leadingZeros(data.hours, 2) + '<span>hrs</span></div><div class=\'column\'>' + this.leadingZeros(data.min, 2) + '<span>min</span></div><div class=\'column\'>' + this.leadingZeros(data.sec, 2) + '<span>sec</span></div>');
				}
			});
		},
		// ---------------------------------------------------------------------
		// Disable element default events
		// ---------------------------------------------------------------------
		disableDefaultEvents: function () {
			$.each($preventDefaultsElements, function(i, val) {
				$(val).on('click', function(e) { e.preventDefault(); });
			});
		},
		// ---------------------------------------------------------------------
		// Disable hover event on scroll
		// ---------------------------------------------------------------------
		disableHover: function () {
			var timer;

			window.addEventListener('scroll', function() {
				clearTimeout(timer);
				if (!$body.hasClass('disable-hover')) {
					$body.addClass('disable-hover');
				}
				timer = setTimeout(function() {
					$body.removeClass('disable-hover');
				}, 500);

			}, false);
		},
		// ---------------------------------------------------------------------
		// Tabs animation
		// ---------------------------------------------------------------------
		tabsAnimation: function () {
			if (!$tabs.length) return;

			$tabs.on('change.zf.tabs', function() {
				var panel = $(this).closest('.js-tabs-container').find('.tabs-panel.is-active');
				Foundation.Motion.animateIn(panel, 'fade-in', function() {});
			});
		},
		// ---------------------------------------------------------------------
		// Lightcase - lightbox plugin
		// ---------------------------------------------------------------------
		lightcasePlugin: function () {

			if ($lightcase.length > 0) {
				$lightcase.lightcase({
					overlayOpacity: 0.9,
					maxWidth: 1280,
					maxHeight: 720,
					shrinkFactor: 0.85,
					showSequenceInfo: false,
					transition: 'scrollHorizontal',
					speedIn: 500,
				});
			}

			if ($lightcaseZoom.length > 0) {
				$lightcaseZoom.lightcase({
					overlayOpacity: 0.9,
					maxWidth: 1280,
					maxHeight: 720,
					transition: 'elastic'
				});
			}

			if ($lightcaseFade.length > 0) {
				$lightcaseFade.lightcase({
					overlayOpacity: 0.9,
					maxWidth: 1280,
					maxHeight: 720,
					transition: 'fade'
				});
			}

			if ($lightcaseFleetCards.length > 0) {
				$lightcaseFleetCards.lightcase({
					overlayOpacity: 0.9,
					maxWidth: 1280,
					maxHeight: 720,
					onStart: {
						addCustomClass: function () {
							$('#lightcase-case').addClass('lightcase-fleetcards');
						}
					},
					onClose: {
						removeCustomClass: function () {
							$('#lightcase-case').removeClass('lightcase-fleetcards');
						}
					}
				});
			}
		},
		// ---------------------------------------------------------------------
		// Phone inputmask
		// ---------------------------------------------------------------------
		phoneInputMask: function () {
			if (!$phone.length) return;

			var $im = new Inputmask('999-999-9999');
			if ($phone) { $im.mask($phone); }
		},
		// ---------------------------------------------------------------------
		// Topbar switch language widget
		// ---------------------------------------------------------------------
		switchLanguage: function () {
			if (!$langBar.length) return;

			var lngLink = $langBar.find('.menu').find('a'),
				lngCurr = $langBar.children('button');

			lngLink.on('click ', function(e) {
				e.preventDefault();
				e.stopPropagation();

				var $this = $(this),
					lng = $this.attr('data-lang'),
					langFlag = $this.attr('data-flag').toLowerCase(),
					iconPattern = '<span class="flag-icon flag-icon-' + langFlag + '"></span>' + lng;

				lngCurr.html(iconPattern);
				$('#js-langbar-menu').foundation('close');
			});
		},
		// ---------------------------------------------------------------------
		// Share button
		// ---------------------------------------------------------------------
		postShareButton: function () {
			if (!$share.length) return;

			$share.each(function(index, el) {
				var shareBtn = $(el).children('button')[0];

				$(shareBtn).on('click touchstart', function(e) {
					e.preventDefault();
					e.stopPropagation();

					$(this).parents('.column').siblings('.column').find('.share .tooltip.is-active').removeClass('is-active');
					$(this).siblings('.tooltip').toggleClass('is-active');
				});

				$body.on('click touchstart', function() {
					$share.find('.tooltip').removeClass('is-active');
				});
			});
		},
		// ---------------------------------------------------------------------
		// Toggle vehicle card
		// ---------------------------------------------------------------------
		productCardToggleView: function () {
			var extendCard = $fleetGrid.find('.card-product.extended');

			$productCardToggle.on('click touchstart', function() {
				$productPanelToggle.removeAttr('disabled');

				if ($fleetGrid.hasClass('medium-up-2')) {
					$fleetGrid.removeClass('medium-up-2').addClass('medium-up-2');

					extendCard.each(function(index, item) {
						$(item).addClass('stacked');
						Foundation.Motion.animateIn($(item), 'fade-in');
					});

				} else {
					$fleetGrid.addClass('medium-up-2');

					extendCard.each(function(index, item) {
						$(item).addClass('stacked');
						Foundation.Motion.animateIn($(item), 'fade-in');
					});
				}

				$(this).prop('disabled', true);
			});

			$productPanelToggle.on('click touchstart', function() {
				$productCardToggle.removeAttr('disabled');
				$fleetGrid.removeClass('medium-up-2');

				extendCard.each(function(index, item) {
					$(item).removeClass('stacked');
					Foundation.Motion.animateIn($(item), 'fade-in');
				});

				$(this).prop('disabled', true);
			});
		},
		// ---------------------------------------------------------------------
		// Add active class to Reveal Moadal windows
		// ---------------------------------------------------------------------
		revealActiveClass: function () {
			if (!$reveal.length) return;

			$reveal.on('open.zf.reveal', function() {
				var $this = $(this);

				if (!$this.hasClass('is-active')) {
					setTimeout(function () {
						$this.addClass('is-active');
					}, 1000);
				}
			}).on('closed.zf.reveal', function() {
				if ($(this).hasClass('is-active')) { $(this).removeClass('is-active'); }
			});
		},
		// ---------------------------------------------------------------------
		// Transformation normal template button to short button (.button-simple)
		// on small screen sizes
		// ---------------------------------------------------------------------
		transformBtns: function () {
			if (Foundation.MediaQuery.current === 'small') {
				$shortButton.removeClass('rh-button').addClass('rh-button-simple');
			} else {
				$shortButton.removeClass('rh-button-simple').addClass('rh-button');
			}
		},
		// ---------------------------------------------------------------------
		//Update Foundation Canvas (e.g. sidebar on fleet-grid pages)
		// ---------------------------------------------------------------------
		updateFoundationCanvas: function () {
			var breakpoint = Foundation.MediaQuery.current;

			if (Foundation.MediaQuery.atLeast('large')) {
				$fleetForm.removeClass('off-canvas position-left callout');
			} else {
				if (!$fleetForm.hasClass('off-canvas position-left callout')) {
					$fleetForm.addClass('off-canvas position-left callout');
				}
			}
		},
		// ---------------------------------------------------------------------
		// Card-flip
		// ---------------------------------------------------------------------
		cardFlipAction: function () {
			var cardFlipBtn = $cardFlip.find('.card-flip-button'),
				cardFlipBtnClose = $cardFlip.find('[data-close]');

			$cardFlip.on('click touchstart', function(e) {
				if ($(this).hasClass('is-active')) {
					e.stopPropagation();
				}
			});

			cardFlipBtn.on('click touchstart', function(e) {
				e.preventDefault();

				var card = $(this).closest('.card-flip'),
					siblCards = card.closest('.column').siblings('.column').children('.card-flip');

				card.addClass('is-active');
				siblCards.removeClass('is-active');
			});

			cardFlipBtnClose.on('click touchstart', function(e) {
				e.preventDefault();
				$(this).closest('.card-flip').removeClass('is-active');
			});

			$body.on('click touchstart', function() {
				$cardFlip.removeClass('is-active');
			});
		},
		// ---------------------------------------------------------------------
		// Block-link
		// ---------------------------------------------------------------------
		blockLinkAction: function () {
			$bl.each(function (i,el) {
				var $this = $(el),
					blString =  $this.html(),
					blArr = blString.split('');

				$this.html(function () {
					var resString='',
						symbol;

					$.each(blArr, function(i, el) {
						if (el === ' ') { el = '&nbsp;'; }

						symbol = '<span>' + el +  '</span>';
						resString = resString + symbol;

						return resString;
					});
					return resString;
				});
			});
		},
		// ---------------------------------------------------------------------

		// Append custom js to head
		// ---------------------------------------------------------------------
		loadScript: function (url, callback) {
			var head = document.getElementsByTagName('head')[0],
				script = document.createElement('script');

			script.src = url;
			script.onreadystatechange = callback;
			script.onload = callback;

			head.appendChild(script);
		},
		// ---------------------------------------------------------------------
		// Animsition jQuery loader
		// ---------------------------------------------------------------------
		pageLoader: function () {
			if (!$body.hasClass('no-loader')) {
				var pageInAnimation = $body.attr('data-animation-in') || 'fade-in',
					pageOutAnimation = $body.attr('data-animation-out') || 'fade-out',
					pageInDuration = $body.attr('data-speed-in') || 700,
					pageOutDuration = $body.attr('data-speed-out') || 500,
					pageLoaderIcon = $body.attr('data-animation-icon') || 'loader-light.svg';

				$wrapper.animsition({
				  inClass: pageInAnimation,
				  outClass: pageOutAnimation,
				  inDuration: pageInDuration,
				  outDuration: pageOutDuration,
				  linkElement: '.animsition-link, .site-navigation a:not([target="_blank"]):not([href^="#"])',
				  // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
				  loading: true,
				  loadingParentElement: 'body', //animsition wrapper element
				  loadingClass: 'animsition-loading',
				  loadingInner: '<img src="http://transferbrasil.cl/wp-content/themes/tematransfer/img/loading.png">', // e.g '<img src="loading.svg" />'
				  timeout: false,
				  timeoutCountdown: 5000,
				  onLoadEvent: true,
				  browser: [ 'animation-duration', '-webkit-animation-duration'],
				  // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
				  // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
				  overlay : false,
				  overlayClass : 'animsition-overlay-slide',
				  overlayParentElement : 'body',
				  transition: function(url){ window.location.href = url; }
				});
			}

		},
		// ---------------------------------------------------------------------
		// Progressbar value
		// ---------------------------------------------------------------------
		progressbar: function () {
			$progressbar.each(function(index){
				var $this = $(this),
					val = $this.attr('aria-valuenow'),
					meter = $this.children('.progress-meter');
				meter.css({'width': val + '%'});
			});
		},
		// ---------------------------------------------------------------------
		// Show active item in custom section #2 on medium screens
		// (e.g. section "Services" on homepage)
		// ---------------------------------------------------------------------
		servicesTabsHelpers: function() {
			var sListActive = $sList.find('.is-active'),
				sBtnListActive = $sBtnList.find('.is-active');

			if (Foundation.MediaQuery.current === 'medium') {
				if ((sListActive.length === 0) && (sBtnListActive.length === 0)) {
					$sFirstItem.addClass('is-active');
					$sFirstItemLabel.closest('.js-services-button').addClass('is-active');
				}
			}
		},
		// ---------------------------------------------------------------------
		// Showing bottom panel on medium and small screens
		// & scrollup-arrow on large screens
		// ---------------------------------------------------------------------
		bottomBar: function () {
			if (!$bottomBar.length || !$scrollUp.length) return;

			var position,
				direction,
				previous,
				stickyEl;

			$(window).scroll(function() {
				if (!Foundation.MediaQuery.atLeast('large')) {
					$scrollUp.removeClass('is-stuck');
					stickyEl = $bottomBar;
				} else {
					$bottomBar.removeClass('is-stuck');
					stickyEl = $scrollUp;
				}

				if ($(this).scrollTop() >= position) {
					direction = 'down';
					if (direction !== previous) {
						stickyEl.removeClass('is-stuck');
						previous = direction;
					}
				} else {
					direction = 'up';
					if (direction !== previous) {
						stickyEl.addClass('is-stuck');
						previous = direction;
					}
				}

				position = $(this).scrollTop();

				if ($(this).scrollTop() <= 550) {
					stickyEl .removeClass('is-stuck');
				}
			});
		},
		// ---------------------------------------------------------------------
		dropdownMobileMenu: function () {
			var responsiveMenu = $mainNav.children('.main-menu')[0];

			if (!$(responsiveMenu).data('responsive-menu')) return;

			$mainNav.on('click touchstart', function (e) {
				e.stopPropagation();
			}).on('off.zf.toggler', function() {
				// console.log('toggle off');
				$(this).removeClass('is-active');
				$headerMenuButton.removeClass('is-active');
			}).on('on.zf.toggler', function() {
				// console.log('toggle on');
				$(this).addClass('is-active');
				$headerMenuButton.addClass('is-active');
			});

			$body.on('click', function () {
				if ($mainNav.hasClass('is-active')) {
					// console.log('expanded');
					$headerMenuButton.removeClass('is-active');
					$mainNav.removeClass('is-active').foundation('toggle');
				}
			});
		}
	}; // /end of __RENTHIRE.documentOnReady

	$(document).ready(function() {

		__RENTHIRE.documentOnReady.init();

		// Re-initialize Google maps when the modal window is already open
		$(document).on('open.zf.reveal', function()  {
			$.each($('.reveal-map'), function(index, el) {
				var mapContainer = $(el).find('[id*=\'js-reveal-map\']')[0];

				if ($(el).attr('aria-hidden') === 'false') {
					mapCall(mapContainer, $mapOptions);
				}
			});
		});

		/*------------------------------------------------------------------------------
			COUNT TO + WAYPOINT
		------------------------------------------------------------------------------*/

		var $executed = false;

		$('[data-counter]').each(function() {
			var $waypoints = $(this).waypoint({
				handler: function(direction) {
					if (!$executed) {
						$executed = true;
						$('.js-counter').incrementalCounter({
							digits: 4,
							// container : '<div class="num-wrap"><div class="num">`0</div></div>'
						});
					}
				},
				offset: '90%'
			});
		});

		$('.progress').each(function(index,el) {

			var val = $(el).attr('aria-valuenow') + '%',
				meter = $(el).find('span');

			meter.css('width', '0');

			var $waypoints = $(el).waypoint({
					handler: function(direction) {
						meter.css('width', val);
					},
					offset: '90%'
				});
		});
	}); // /end of function "ready"

})(jQuery);

/*------------------------------------------------------------------------------
	SHUFFLE.JS
------------------------------------------------------------------------------*/

var Shuffle = window.shuffle;

var mGrid = function (element) {
		this.element = element;
		this.shuffle = new Shuffle(element, {
			itemSelector: '.column',
			sizer: element.querySelector('.column'),
		});
		this.addFilterButtons();
	};

mGrid.prototype.toArray = function (arrayLike) {
	return Array.prototype.slice.call(arrayLike);
};

mGrid.prototype.addFilterButtons = function () {
	var options = document.querySelector('.filter-options');

	if (!options) {
		return;
	}

	var filterButtons = this.toArray(options.children);

	filterButtons.forEach(function (button) {
		button.addEventListener('click', this._handleFilterClick.bind(this), false);
	}, this);
};

mGrid.prototype._handleFilterClick = function (evt) {
	var btn = evt.currentTarget;
	var isActive = btn.classList.contains('active');
	var btnGroup = btn.getAttribute('data-group');

	this._removeActiveClassFromChildren(btn.parentNode);

	var filterGroup;

	if (isActive) {
		btn.classList.remove('active');
	} else {
		btn.classList.add('active');
		filterGroup = btnGroup;
	}

	this.shuffle.filter(filterGroup);
};

mGrid.prototype._removeActiveClassFromChildren = function (parent) {
	var children = parent.children;
	for (var i = children.length - 1; i >= 0; i--) {
		children[i].classList.remove('active');
	}
};

document.addEventListener('DOMContentLoaded', function () {
	var $mElement = document.getElementById('massonry-grid'),
		$mCardElement = document.getElementById('massonry-card-grid');

	if ($mCardElement !== null) {
		var images = $mCardElement.querySelectorAll('.orbit-container img'),
			imgLoad = imagesLoaded(images);

		imgLoad.on('done', function(instance) {
		//   console.log('DONE  - all images have been successfully loaded');
		  window.mGrid = new mGrid($mCardElement);
		});

	}

	if ($mElement !== null) {
		window.mGrid = new mGrid($mElement);
	}
});

/*------------------------------------------------------------------------------
	GOOGLE MAPS FUNCTIONS
------------------------------------------------------------------------------*/

var $mapStyles = [{
		"featureType": "administrative",
		"elementType": "labels.text.fill",
		"stylers": [{
			"color": "#333333"
		}]
	}, {
		"featureType": "landscape",
		"elementType": "all",
		"stylers": [{
			"color": "#f2f2f2"
		}]
	}, {
		"featureType": "poi",
		"elementType": "all",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "road",
		"elementType": "all",
		"stylers": [{
			"saturation": -100
		}, {
			"lightness": 45
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "all",
		"stylers": [{
			"visibility": "simplified"
		}]
	}, {
		"featureType": "road.highway",
		"elementType": "geometry.fill",
		"stylers": [{
			"color": "#ffdd39"
		}]
	}, {
		"featureType": "road.arterial",
		"elementType": "geometry.fill",
		"stylers": [{
			"hue": "#cc4b37"
		}]
	}, {
		"featureType": "road.arterial",
		"elementType": "labels.icon",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "road.local",
		"elementType": "geometry.fill",
		"stylers": [{
			"color": "#ffffff"
		}]
	}, {
		"featureType": "transit",
		"elementType": "all",
		"stylers": [{
			"visibility": "off"
		}]
	}, {
		"featureType": "water",
		"elementType": "all",
		"stylers": [{
			"color": "#c2c4c4"
		}, {
			"visibility": "on"
		}]
	}];

var $position = {
		lat: -33.4289917,
		lng: -70.6223225
	},
	$mapOptions = {
		center: $position,
		zoom: 17,
		scrollwheel: false,
		styles: $mapStyles
	},
	$mapElements = ['inlineMap','js-reveal-map-small','js-reveal-map-large','js-reveal-map-fullscreen','el-map-1','el-map-2','el-map-3','el-map-4'];

function mapCall($element,$options) {
	if ($element !== null) {
		var $marker = new google.maps.Marker({
			position: $position,
			map: new google.maps.Map($element, $options),
			icon: {
				anchor: new google.maps.Point(16, 16),
				url: 'http://transferbrasil.cl/wp-content/themes/tematransfer/img/map-marker.png'
			}
		});
	}
}

function initMap() {
	for (var i = 0; i < $mapElements.length; i++) {
		var mapElement = document.getElementById($mapElements[i]);
		mapCall(mapElement, $mapOptions);
	}
}
