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
                }
            
         } });
         

         

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
                    }
                },
                
                
             } );
             
            
           
    
} );