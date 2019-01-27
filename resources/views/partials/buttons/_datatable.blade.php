{{-- dom: 'lBfrtip', --}}
dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
buttons : [
    {
        extend: 'copy',
        text: '<u>C</u>opy',
        key: {
            key: 'c',
            altKey: true
        }
    },
    {
        extend: 'excel',
        text: 'Export to E<u>x</u>cel',
        key: {
            key: 'x',
            altKey: true
        }
    },
    {
        extend: 'pdf',
    },
    {
        extend: 'print',
        text: '<u>P</u>rint',
        key: {
            key: 'p',
            altKey: true
        }
    },
    {
        text: '<i class="fa fa-trash fa-lg text-grey-dark delete-checked"></i>',
        className: 'delete-checked',
    },
]