$(document).ready(function() {
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
     
    $('table.table').DataTable( {
        //ajax:           '../ajax/data/arrays.txt',
        scrollY:        200,
        scrollCollapse: true,
        paging:         false
    } );
 
    // Apply a search to the second table for the demo
    $('#example2').DataTable();
} );