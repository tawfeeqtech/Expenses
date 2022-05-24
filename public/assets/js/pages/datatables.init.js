$(document).ready(function () {
    var table = $(".datatable").DataTable({
        pageLength: 4,
        lengthMenu: [[4, 10, 20, -1], [4, 10, 20, 'All']],
        columnDefs: [
            { "width": "10px", "targets": 0 },
            { "width": "50%", "targets": 1 },
        ],
        autoWidth: false,

    });

});
