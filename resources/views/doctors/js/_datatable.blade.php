var doctorsDatatable = doctorsTable.DataTable({
    @include('partials.datatable._dom'),
    buttons : [
        @include('partials.datatable._buttons'),
        {
            text: '<i class="fa fa-trash fa-lg text-grey-dark delete-checked"></i>',
            className: 'delete-checked',
            attr:  {
                id: 'deleteDoctors'
            }
        },
    ],
    "ajax": {
        "url": doctorsIndexUrl,
        "type": "GET"
    },
    "deferRender": true,
    "columns": [
        {
            render: function(data, type, row, meta) {
                return '<div class="checkbox"><label class="checkbox-container"><input type="checkbox" class="checkitemDoctors" name="doctors[]" value="' + row.id + '"><span class="checkmark"></span></label></div>'
            },
            searchable: false,
            sortable: false,
        },
        {
            data: 'id',
        },
        {
            data: 'image_path',
            render: function(data, type, row, meta) {
                return data ? '<img src="' + data + '" alt="" class="rounded-full w-2/5">' : '-'
            },
            searchable: false,
            sortable: false,
        },
        {
            data: 'name',
        },
        {
            data: 'specialty',
        },
        {
            data: 'user',
            render: function(data, type, row, meta) {
                return data ? '<a href="' + row.link.user + '" class="text-teal-light hover:text-teal-dark font-bold">' + data + '</a>' : '<span class="text-teal-light hover:text-teal-dark font-bold">-</span>'
            },
        },
        {
            render: function(data, type, row, meta) {
                return row.hasWorkSchedule ? '<a href="' + row.link.calendar + '"><svg style="color:' + row.color + '" class="fill-current text-grey-light hover:text-grey-darker inline-block h-6 w-11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/></svg></a>' : '-'
            },
            searchable: false,
            sortable: false,
        },
        {
            render: function(data, type, row, meta) {
                return '<a href="' + row.link.show + '"><svg class="fill-current text-grey-light hover:text-grey-darker inline-block h-8 w-12 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M.2 10a11 11 0 0 1 19.6 0A11 11 0 0 1 .2 10zm9.8 4a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg></a><a href="' + row.link.edit + '"><svg class="fill-current text-grey-light hover:text-grey-darker inline-block h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 4v14h14v-6l2-2v10H0V2h10L8 4H2zm10.3-.3l4 4L8 16H4v-4l8.3-8.3zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a><a href="#" id="deleteDoctor" data-user="' + row.id + '"><svg class="fill-current text-grey-light hover:text-grey-darker inline-block h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></a>'
            },
            searchable: false,
            sortable: false,
        },
        {
            data: 'link.show',
            visible: false
        },
        {
            data: 'link.edit',
            visible: false
        },
        {
            data: 'link.user',
            visible: false
        },
        {
            data: 'link.calendar',
            visible: false
        },
        {
            data: 'hasWorkSchedule',
            visible: false
        },
        {
            data: 'color',
            visible: false
        },
    ],
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
        {
            targets: [2,6],
            className: 'text-center'
        },
        {
            targets: 7,
            className: 'dt-body-right'
        }
    ],
    "order": [
        [ 1, "desc" ]
    ],
});
