

var Tela = {
	init: function() {
		Tela.detecta();
		$(window).on('resize', function() {Tela.detecta()});
	},


	detecta: function() {//console.log('detecta');
		
		// detecta o elemento visível neste div que está lá no "_inc/inc_topbar.php"
		var tamanho = $('#users-device-size').find('div:visible').first().attr('id');

		// remove todas as classes (não sabemos qual está ativa) e adiciona só a correta
		$('body').removeClass('body-xs body-sm body-md body-lg').addClass('body-'+tamanho);
	}
};

$(document).ready(Tela.init());

