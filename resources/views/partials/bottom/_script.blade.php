<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/delete_checked.js') }}"></script>
<script src="{{ asset('js/form_helpers.js') }}"></script>
<script src="{{ asset('js/fullcalendar.js') }}"></script>
<script src="{{ asset('js/fc_doctor.js') }}"></script>
<script src="{{ asset('js/fc_modal.js') }}"></script>
<script src="{{ asset('js/fc_event.js') }}"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

<!-- Sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.32.2/sweetalert2.all.min.js"></script>

<!-- Moment -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.23/moment-timezone.min.js"></script>
<!-- Moment plugin to calculate dates for weekdays -->
<script src="https://cdn.jsdelivr.net/npm/moment-weekdaysin@1.0.1/moment-weekdaysin.min.js"></script>

<!-- Fullcalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/gcal.min.js"></script>

<!-- Timepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.js"></script>

<!-- Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        var message = "{!! Session::get('message') !!}";
        var type = "{{ Session::get('type') }}";
        toastr.options = {
            "positionClass": "toast-bottom-right",
        }

        switch(type) {
            case('success'):
                toastr.success(message)
                break;
            case('info'):
                toastr.info(message)
                break;
            case('warning'):
                toastr.warning(message)
                break;
            case('error'):
                toastr.error(message)
                break;
        }
    @endif
</script>

<!-- X-CRSF-Token -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>