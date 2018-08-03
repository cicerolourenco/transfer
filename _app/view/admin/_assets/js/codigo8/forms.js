



$(document).ready(function() {
    $('.confirm_del').on('click', function(e) {
        var destino = $(this).attr('href');
        e.preventDefault();
        if(!$(this).attr('disabled')) {
            alertify
                .theme("bootstrap")
                .okBtn("Sim")
                .cancelBtn("Cancelar")
                .confirm("Confirma a exclusão deste item?", function (ev) {
                    window.location.href = destino;
                }, function(ev) {
                    ev.preventDefault();
                });
        }
    });

});



$(function () {
    $('.bt_editar').on('click', function() {
        $(this).closest('.card').toggleClass('editar ver');
    });

    $('.bt_cancelar').on('click', function() {
        if($(this).closest('.card').hasClass('inserir')) {
            window.location.href = $(this).attr('data-destino');
        } else {
            $(this).closest('form').find('label.error').remove();
            $(this).closest('.card').toggleClass('editar ver');
        }
    });
});    


//    Material Date Picker plugin
$(function () {
    //moment.locale('pt-br');
    $('.diahorapicker').bootstrapMaterialDatePicker({ weekStart : 0, format: 'DD/MM/YYYY HH:mm', lang: 'pt-br' });
    $('.diapicker').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format: 'DD/MM/YYYY', lang: 'pt-br' });
    $('.horapicker').bootstrapMaterialDatePicker({ date: false, format: 'HH:mm', lang: 'pt-br' });

    //events
    $('#quando_parte').bootstrapMaterialDatePicker({ weekStart : 0, format : 'DD/MM/YYYY HH:mm', lang: 'pt-br' });
    $('#quando_chega').bootstrapMaterialDatePicker({ weekStart : 0, language: 'pt', format : 'DD/MM/YYYY HH:mm', minDate : new Date(), lang: 'pt-br' }).on('change', function(e, date) {
        $('#quando_parte').bootstrapMaterialDatePicker('setMinDate', date);
    });
});



// Contador
$(document).ready(function() {
    $('.card input[type="text"], .card textarea').on('keyup', function() {
        var limite = $(this).attr('maxlength');
        var pai = $(this).closest('.form-line');
        var contador = $(pai).find('.help-info');
        var tamanho = $(this).val().length;
        var numero = limite - tamanho;
        
        if (numero<=0) { // se for maior que o limite, corta
            $(this).val($(this).val().substring(0, limite));
            $(pai).addClass('error');
            window.setTimeout(function() {
                $(pai).removeClass('error');
            }, 2000);
            numero = 0;
        }
        $(contador).text(numero);
    });
});


var Notifica = {

	show: function(msg, tipo) {
		if(tipo=='erro')
		{
			var bg = 'bg-red';
			var tempo = 3000;
		}
		else
		{
			var bg = 'bg-green';
			var tempo = 1000;
		}
			

        $.notify({
            message: msg
        },
        {
            type: bg,
            allow_dismiss: true,
            newest_on_top: true,
            timer: tempo,
            placement: {
                from: 'bottom',
                align: 'center'
            },
            animate: {
                enter: 'animated fadeInUp',
                exit: 'animated fadeOutDown'
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (true ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });   

	}
};




/* --------------------------- */
/*         VALIDAÇÃO           */
/* --------------------------- */

var Valida = {
    regras: {
        url: "required",
        /*senha1: {
            required: true,
            minlength: 1
        },*/
        senha2: {
            /*required: true,
            minlength: 1,*/
            equalTo: "#senha1"
        },
        email: {
            required: true,
            email: true
        }
    },

    mensagens: {
        url: "Please enter a valid url",
        /*senha1: {
            required: "Digite a senha"
        },*/
        senha2: {
            //required: "Confirme a senha",
            equalTo: "Senhas inconsistentes"
        },
        email: "E-mail inválido"
    },

    highlight: function (input) {
        $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
        $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
        $(element).parents('.form-group').append(error);
    },

    submitHandler: function() {
        $(this).closest('.card').find('.botoes .preloader, .botoes button').toggle();
    }
};


$(function () {

    // .agree
    //$.validator.addMethod("agreeRequired", $.validator.methods.required, "Obrigatório para prosseguir");
    //$.validator.addClassRules("agree", {agreeRequired: true});

    $('#form_principal').validate({
        rules: Valida.regras,
        messages: Valida.mensagens,
        highlight: Valida.highlight,
        unhighlight: Valida.unhighlight,
        errorPlacement: Valida.errorPlacement
    });
});
