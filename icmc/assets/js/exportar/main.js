pdfMake.fonts = 
    {
        Roboto     : {
                        normal     : 'Roboto-Regular.ttf',
                        bold       : 'Roboto-Medium.ttf',
                        italics    : 'Roboto-Italic.ttf',
                        bolditalics: 'Roboto-Italic.ttf'
                    },
        FabricMDL2Icons    :{
                        normal: 'fabric-icons-a9789667.ttf'
    }}
    var fonts = pdfMake.fonts   
    console.log(fonts) 
    // function processDoc() {





        
    //     https://pdfmake.github.io/docs/fonts/custom-fonts-client-side/
        
    //     Update pdfmake's global font list, using the fonts available in
    //     the customized vfs_fonts.js file (do NOT remove the Roboto default):
    //     window.pdfMake.fonts = {
    //         Roboto     : {
    //             normal     : 'Roboto-Regular.ttf',
    //             bold       : 'Roboto-Medium.ttf',
    //             italics    : 'Roboto-Italic.ttf',
    //             bolditalics: 'Roboto-Italic.ttf'
    //         },
    //         Fabric: {
    //             normal     : 'fabric-icons-a9789667.ttf',
    //             bold       : 'fabric-icons-a9789667.ttf',
    //             italics    : 'fabric-icons-a9789667.ttf',
    //             bolditalics: 'fabric-icons-a9789667.ttf'
    //         },
    //         Fa: {
    //             normal     : 'fa-regular-400.ttf',
    //             bold       : 'fa-solid-900.ttf',
    //             italics    : 'fa-brands-400.ttf',
    //             bolditalics: 'fa-v4compatibility.ttf'
    //         }
    //         };
    //     modify the PDF to use a different default font:
    //     doc.style.font = "Fabric";
        
    //     var i = 1;
    //   }

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
                        columns: [ 0, 1 , 2, 3, 4],
                        defaultStyle: {
                            font: 'FabricMDL2Icons',
                            icon: { font: 'FabricMDL2Icons' },
                            text: '', style: 'icon' 
                        },
                        customize: function(doc){
                            console.log(doc.content[1].table.columns[3][1])
                            if(doc){
                                for (var i = 1; i < doc.content[1].table.body.length; i++) { 
                                    doc.content[1].table.body[3][i] = { image: 'data:image/png;base64,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' }
                                }
                            }
                        }
                    }
                        
                    
                    
                },
                {
                    extend: 'print',
                    className: 'btn-light',
                    text: '<i class="ms-Icon ms-Icon--Print"></i> Imprimir',
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4],
                        content: [
                            {
                                text: '\F31F ',
                                font: 'FabricUI',
                            }
                        ]
                    }
                    
                }    
            ]
            
         } );
         
         var docDefinition = {
             
             defaultStyle: {
                 font: 'FabricMDL2Icons',
                 icon: { font: 'FabricMDL2Icons' },
                 text: '', style: 'ms-Icon ms-Icon--Wheelchair' 
                },
            }
            pdfMake.createPdf(docDefinition, table, fonts)

           

         table.buttons().container().appendTo($('#printExportBar'));
         var idx = table
         .columns( 3 )
         .data()
         .eq(0)

         console.log(idx)
         for(let i =0; i <= idx.length; i++){
            if(idx[i] === '<i class="ms-Icon ms-Icon--Wheelchair fs-3" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="" data-mdb-original-title="Este visitante possui necessidade especial" aria-label="Este visitante possui necessidade especial"></i>'){
                console.log(idx[i])

            }
            
         }
     
         
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
                        titleAttr: 'PDF',
                        download: 'open',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-light',
                        text: '<i class="ms-Icon ms-Icon--Print"></i> Imprimir',
                        titleAttr: 'Imprimir',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5]
                        }
                    }
        
                ]
                
             } );
             tableAgendaMensal.buttons().container().appendTo($('#printExportBarAgendaMensal'));
             let tableLocalizarAgenda =  $('#table-localizar-agenda').DataTable( {
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
                        "emptyTable": "Nenhum registro disponível",
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
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
        
                        },
                        {
                            extend: 'print',
                            className: 'btn-light',
                            text: '<i class="ms-Icon ms-Icon--Print"></i> Imprimir',
                            titleAttr: 'Imprimir',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5]
                            }
                        }    
                    ]
                 } );
                 tableLocalizarAgenda.buttons().container().appendTo($('#printExportBarLocalizarAgenda'));
    
} );