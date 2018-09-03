
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



var Excel = function () {
    var self = this;
    self.limitToExport = 10000;
    self.data = "";
    self.uri = 'data:application/vnd.ms-excel;base64,'
    self.template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">' + 
                    '<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml>'  + 
                    '<x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->' + 
                    '</head><body><table>{table}</table></body></html>';

    self.base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))); },
    self.format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) };

    self.tableToExcel = function (tableId, worksheetName) {
        var table = $(tableId),
            ctx = { worksheet: worksheetName, table: table.html() },
            href = self.uri + self.base64(self.format(self.template, ctx));

        self.data = self.format(self.template, ctx);
        return href;
    }

    self.export = function (tableId, nameSheet, nameFile) {
        self.tableToExcel(tableId, nameSheet); 
        self.writeFile(nameFile);
    }

    self.writeFile = function (nameFile) {
        var contentType = 'application/octet-stream';
        var a = document.createElement('a');
        var blob = new Blob([self.data], { 'type': contentType });
        a.href = window.URL.createObjectURL(blob);
        a.download = nameFile ? nameFile : 'dados.xls';
        a.click();
    }
    return this;
};
