// =============  Data Table - (Start) ================= //

$(document).ready(function(){

    var table = $('#datatables_btn').DataTable({

        buttons:['copy', 'csv', 'excel', 'pdf', 'print']

    });


    table.buttons().container()
    .appendTo('#example_wrapper .col-md-6:eq(0)');

});

// =============  Data Table - (End) ================= //
