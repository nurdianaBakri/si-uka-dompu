$(function () {
    $('.js-basic-example').DataTable({
        responsive: true, 
        "autoWidth" : true, 
        "paging": false,
        "scrollY": 800,
        "scrollX": true, 
    }); 

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});