

$(document).ready( function () {
    let table = $('#table-agenda-dia').DataTable( {
        "language": {
            "search": "Filtrar:",
            "lengthMenu": 'Mostrar <select class="form-select form-select-sm" aria-label="Seleção de exibição do número de registros">'+
				'<option value="10">10</option>'+
				'<option value="20">20</option>'+
				'<option value="30">30</option>'+
				'<option value="40">40</option>'+
				'<option value="50">50</option>'+
				'<option value="-1">Todos</option>'+
				'</select> registros',
                "infoEmpty": "Nenhum registro para mostrar",
                "info": "Mostrando _START_ até _END_ de _TOTAL_ entradas",
                "emptyTable": "Nenhum registro disponível na tabela",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo"
                },
                buttons: {
                    copyTitle: 'Copiado para área de transferência',
                    copySuccess: {
                        1: "Copiado um registro para área de transferência",
                        _: "Copiado %d registros para área de transferência"
                    }
                }
            },
            dom: 'lBfrtip',
            
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: 'btn-light',
                    text: '<i class="ms-Icon ms-Icon--Copy"></i> Copiar',
                    titleAttr: 'Copiar',
                    
                },
                {
                    extend: 'excelHtml5',
                    className: 'btn-light',
                    text: '<i class="ms-Icon ms-Icon--ExcelDocument"></i> Excel',
                    titleAttr: 'Excel'
                },
                {
                    extend: 'csvHtml5',
                    className: 'btn-light',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    className: 'btn-light',
                    text: '<i class="ms-Icon ms-Icon--PDF"></i> PDF',
                    titleAttr: 'PDF',
                    download: 'open',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    }

                },
                {
                    extend: 'print',
                    className: 'btn-light',
                    text: '<i class="ms-Icon ms-Icon--Print"></i> Imprimir',
                    titleAttr: 'Imprimir'
                }    
            ]
            
         } );
         
         table.buttons().container().appendTo($('#printExportBar'));
        //  
        

        // 
         

         let tableAgendaMensal = $('#table-agenda-mensal').DataTable( {
            "language": {
                "search": "Filtrar:",
                "lengthMenu": 'Mostrar <select class="form-select form-select-sm" aria-label="Seleção de exibição do número de registros">'+
                    '<option value="10">10</option>'+
                    '<option value="20">20</option>'+
                    '<option value="30">30</option>'+
                    '<option value="40">40</option>'+
                    '<option value="50">50</option>'+
                    '<option value="-1">Todos</option>'+
                    '</select> registros',
                    "infoEmpty": "Nenhum registro para mostrar",
                    "info": "Mostrando _START_ até _END_ de _TOTAL_ entradas",
                    "emptyTable": "Nenhum registro disponível na tabela",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Próximo",
                        "first": "Primeiro",
                        "last": "Último"
                    },
                    buttons: {
                        copyTitle: 'Copiado para área de transferência',
                        copySuccess: {
                            1: "Copiado um registro para área de transferência",
                            _: "Copiado %d registros para área de transferência"
                        }
                    }
                },
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        className: 'btn-light',
                        text: '<i class="ms-Icon ms-Icon--Copy"></i> Copiar',
                        titleAttr: 'Copiar'
                    },
                    {
                        extend: 'excelHtml5',
                        className: 'btn-light',
                        text: '<i class="ms-Icon ms-Icon--ExcelDocument"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend: 'csvHtml5',
                        className: 'btn-light',
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn-light',
                        text: '<i class="ms-Icon ms-Icon--PDF"></i> PDF',
                        titleAttr: 'PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn-light',
                        text: '<i class="ms-Icon ms-Icon--Print"></i> Imprimir',
                        titleAttr: 'Imprimir'
                    }
        
                ]
                
             } );
             tableAgendaMensal.buttons().container().appendTo($('#printExportBarAgendaMensal'));
             $('#table-localizar-agenda').DataTable( {
                "language": {
                    "search": "Filtrar:",
                    "lengthMenu": 'Mostrar <select class="form-select form-select-sm" aria-label="Seleção de exibição do número de registros">'+
                        '<option value="10">10</option>'+
                        '<option value="20">20</option>'+
                        '<option value="30">30</option>'+
                        '<option value="40">40</option>'+
                        '<option value="50">50</option>'+
                        '<option value="-1">Todos</option>'+
                        '</select> registros',
                        "infoEmpty": "Nenhum registro para mostrar",
                        "info": "Mostrando _START_ até _END_ de _TOTAL_ entradas",
                        "emptyTable": "Nenhum registro disponível na tabela",
                        "paginate": {
                            "previous": "Anterior",
                            "next": "Próximo",
                            "first": "Primeiro",
                            "last": "Último"
                        },
                        buttons: {
                            copyTitle: 'Copiado para área de transferência',
                            copySuccess: {
                                1: "Copiado um registro para área de transferência",
                                _: "Copiado %d registros para área de transferência"
                            }
                        }
                    }
                 } );
    
} );