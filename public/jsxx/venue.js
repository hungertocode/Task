$(document).ready(function() {

    var table=$('#venue_table').DataTable({
        responsive: !0,
        // dom: "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
        
        dom: 'Blfrtip',


        buttons:[
           {
               extend: 'print',
               exportOptions: {
                   columns: [ ':visible:not(:last-child)' ]
               }
           },
           {
               extend: 'copyHtml5',
               exportOptions: {
                   columns: [ ':visible:not(:last-child)' ]

               }
           },
           {
               extend: 'excelHtml5',
               exportOptions: {
                   columns: [ ':visible:not(:last-child)' ]

               }
           },
           {
               extend: 'pdfHtml5',
               exportOptions: {
                   columns: [ ':visible:not(:last-child)' ]

               }
           },
       ],
        lengthMenu: [5, 10, 25, 50, 75, 100],
        pageLength: 10,
        paging: true,
        language: {
            lengthMenu: "Display _MENU_",
            processing:'<img  src="/img/loader.gif" >'         
        
        },
        order: [
            [0, "desc"]
        ],
        processing: true,
        "serverSide": true,
        "ajax": {
            url: "/venues/datatable-list",
            type: 'GET',
            
          
        },
        "columns": [ {
            data: "venue_id"
        },
        {
            data: "venue_name"
        },
        {
            data: "venue_address"
        }, 
        {
            data: "contact_number"
        },
        {
            data: "is_active"
        },
        {
            data: "created_at"
        },
       
        {
            data: "view"
        }
    ]

    });

    table.on('processing.dt', function(e, settings, processing) {
        if (processing) {
          $('#loading').show();
        } else {
          $('#loading').hide();
        }
      });
});