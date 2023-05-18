
$(document).ready(function() {
    console.log('dd')
    var table=$('#event_table').DataTable({
        responsive: !0,    
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
            url: "/events/datatable-list",
            type: 'GET',
            
          
        },
        "columns": [ {
            data: "event_id"
        },
        {
            data: "title"
        },
        {
            data: "artist_name"
        },{
            data: "venue_name"
        },{
            data: "amount"
        },
        {
            data: "date"
        },
        {
            data: "is_active"
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