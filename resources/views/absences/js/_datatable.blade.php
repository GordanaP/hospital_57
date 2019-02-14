var absencesDatatable = absencesTable.DataTable({
    @include('partials.buttons._datatable'),
    "ajax": {
        "url": absencesIndexUrl,
        "type": "GET"
    },
    "deferRender": true,
    "columns": [
        {
            render: function(data, type, row, meta) {
                return '<div class="checkbox"><label class="checkbox-container"><input type="checkbox" class="checkitem" name="absences[]" value="' + row.id + '"><span class="checkmark"></span></label></div>'
            },
            searchable: false,
            sortable: false,
        },
        {
            data: 'id',
        },
        @if (request()->route()->named('absences.index'))
            {
                data: 'doctor',
                render: function(data, type, row, meta) {

                  return '<a href="' + row.link.doctor + '" class="text-teal-light hover:text-teal-dark font-bold">' + data +'</a>'
                },
            },
        @endif
        {
            data: 'start_at',
        },
        {
            data: 'end_at',
        },
        {
            data: 'description',
        },
        {
          render: function(data, type, row, meta) {

            {{-- var link = doctorExists ? row.link.editForDoctor : row.link.edit --}}
            var link = row.link.edit

            return '<a href="' + link + '"><svg class="fill-current text-grey-light hover:text-grey-darker inline-block h-6 w-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2 4v14h14v-6l2-2v10H0V2h10L8 4H2zm10.3-.3l4 4L8 16H4v-4l8.3-8.3zm1.4-1.4L16 0l4 4-2.3 2.3-4-4z"/></svg></a><a href=# id="deleteAbsence" data-user="' + row.id + '"><svg class="fill-current text-grey-light hover:text-grey-darker inline-block h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/></svg></a>'
          },
          searchable: false,
          sortable: false,
        },
        {
            data: 'link.edit',
            visible: false
        },
        {{-- {
            data: 'link.editForDoctor',
            visible: false
        }, --}}
        {
            data: 'link.doctor',
            visible: false
        },
    ],
    responsive: true,
    columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: 1 },
        { responsivePriority: 3, targets: 2 },
        {
            targets: @if (request()->route()->named('absences.index')) 6 @else 5 @endif,
            className: 'dt-body-right'
        }
    ],
    "order": [
        @if (request()->route()->named('absences.index'))
            [3, "asc"],
        @else
            [2, "asc"],
        @endif
    ],
});
