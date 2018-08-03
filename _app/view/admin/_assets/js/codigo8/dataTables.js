
var frases_datatable = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ linhas por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
};


$(function () {

	// padrão
    $('.tb_dados').DataTable({
        language: frases_datatable,
        pageLength: 100,
        pagingType: 'full_numbers',
        order: [[1, 'asc']]
    });

    $('.tb_dados_desc').DataTable({
        language: frases_datatable,
        pageLength: 100,
        pagingType: 'full_numbers',
        order: [[1, 'desc']]
    });


	// básica
    $('.tb_dados_simples').DataTable({
        language: frases_datatable,
        paging: false,
        searching: false,
        ordering: false,
        info: false
    });


    // Exportable table
    $('.dt_exportable').DataTable({
        dom: 'Bfrtip',
    	language: frases_datatable,
        buttons: [
            //'copy', 'csv', 'excel', 'pdf', 'print'
            'excel', 'pdf', 'print'
        ]
    });
});

