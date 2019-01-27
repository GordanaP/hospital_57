/**
 * Send a succes notification to a user.
 *
 * @param  string message
 * @return array
 */
function sendSuccessNotification(message)
{
    return toastr["success"](message)
}

/**
 * Delete a single record.
 *
 * @param  string deleteButton
 * @param  string deleteUrl
 * @param  string datatable
 * @param  string locationField
 * @return void
 */
 function deleteSingleRecord(deleteButton, deleteUrl, datatable, locationField)
 {
     $(document).on('click', '#'+deleteButton, function(e) {
         e.preventDefault();

         var record = $(this).attr('data-user');
         var url = deleteUrl + '/' + record;

         swalDelete(url, datatable, locationField);
     });
 }

/**
 * Delete multiple records.
 *
 * @param  string checkbox
 * @param  string deleteUrl
 * @param  string datatable
 * @param  string locationField
 * @return void
 */
function deleteManyRecords(checkbox, deleteUrl, datatable, locationField)
{
    $(document).on('click', '#delete'+checkbox, function(e) {
        e.preventDefault();

        var data = {
            ids: getCheckedValues(checkbox)
        }

        swalDeleteMany(deleteUrl, datatable, locationField, data)
    });
}

/**
 * Alert the user on deletion a single item
 *
 * @param  string url
 * @param  object datatable
 * @param  string field
 * @return void
 */
function swalDelete(url, datatable, locationField)
{
    swal({
        title: 'Are you sure you want to delete the record?',
        text: 'You will not be able to recover the record.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                type: 'DELETE',
                url: url,
                success: function(response) {
                    countDTRows(datatable) == 1 ? $(locationField).load(location.href + ' ' + locationField) : datatable.ajax.reload();
                    sendSuccessNotification(response.alertMessage)
                }
            })
        }
    });
}

/**
 * Alert the user on deletion multiple items
 *
 * @param  string url
 * @param array data
 * @param  object datatable
 * @param  string field
 * @return void
 */
function swalDeleteMany(url, datatable, locationField, data)
{
    swal({
        title: 'Are you sure you want to delete the records?',
        text: 'You will not be able to recover the records.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.value == true)
        {
            $.ajax({
                type: 'DELETE',
                url: url,
                data: data,
                success: function(response) {
                    countDTRows(datatable) == 1 ? $(locationField).load(location.href + ' ' + locationField) : datatable.ajax.reload();
                    sendSuccessNotification(response.alertMessage)
                    $('.dt-button.delete-checked').removeAttr('id', 'deleteMany').hide()
                    $('#checkAll').prop('checked', false);
                }
            })
        }
    });
}

/**
 * Get a total # of the datatable rows
 *
 * @param  object datatable
 * @return integer
 */
function countDTRows(datatable)
{
    return datatable.data().count();
}

/**
 * Get the checked values.
 *
 * @param  string name
 * @return array
 */
function getCheckedValues(name)
{
    var values = [];

    $('input[name*="' + name + '"]:checked').each(function() {
       values.push($(this).val());
    });

    return values;
}

/**
 * Get the # of checked values.
 *
 * @param  string $name
 * @return integer
 */
function countChecked(name)
{
    return $('input[name*="' + name + '"]:checked').length;
}

/**
 * Check all values in a datatable checkbox.
 *
 * @param  string table
 * @return void
 */
function checkAll(checkbox, table)
{
    var deleteMany = 'delete'+checkbox

    /* Handle datatable check/uncheck all */
    table.on('click', "#checkAll", function () {

        // If all checked, display deleteMany btn
        $('.checkitem').prop('checked', $(this).prop("checked"));
        $('.dt-button.delete-checked').attr('id', deleteMany).show()

        // If all unchecked, remove deleteMany btn
        if($(this).prop("checked") == false) {
            $('.dt-button.delete-checked').removeAttr('id', deleteMany).hide()
        }
    });

    /* Handle datatable check/uncheck a single checkbox  */
    table.on('click', ".checkitem", function () {

        // If one box checked, display hidden btn
        if($(this).prop("checked") == true) {
            $('.dt-button.delete-checked').attr('id', deleteMany).show()
        }

        // If one box unchecked, uncheck checkAll box
        if($(this).prop("checked") == false) {
            $('#checkAll').prop("checked", false)
        }

        // If all boxes are checked, check checkAll box
        if($(".checkitem:checked").length == $(".checkbox").length) {
            $('#checkAll').prop('checked', true)
        }

        // If all boxes unchecked, remove delete button Id
        if($(".checkitem:checked").length == 0) {
            $('.dt-button.delete-checked').removeAttr('id', deleteMany).hide()
        }
    });
}
