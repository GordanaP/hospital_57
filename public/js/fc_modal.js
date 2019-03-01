/**
 * Empty the modal upon close.
 *
 * @param  {array} formFields
 * @param  {mixed} timepickerField
 * @return void
 */
$.fn.clearOnClose = function(formFields, timepickerField)
{
    $(this).on("hidden.bs.modal", function() {

        // Clear the form content
        $(this).clearForm()

        // Clear the server side errors
        $(this).clearServerErrors(formFields)

        // Remove timepicker
        $(this).clearTimepicker(timepickerField)
    })
}

/**
 * Open a modal.
 *
 * @return void
 */
$.fn.open = function()
{
    $(this).modal('show')
}

/**
 * Close a modal.
 *
 * @return void
 */
$.fn.close = function()
{
    $(this).modal('hide')
}

/**
 * Set the modal autofocus field
 *
 * @param {string} inputId
 * @return {void}
 */
$.fn.setAutofocus = function(inputId)
{
    $(this).on('shown.bs.modal', function () {
        $(this).find("#" + inputId).focus()
    })
}

/**
 * Clear the form content.
 *
 * @return void
 */
$.fn.clearForm = function()
{
    $(this).find('form').trigger('reset');
}

/**
 * Remove all server side errors.
 *
 * @param  {array} targetFields
 * @return void
 */
 $.fn.clearServerErrors = function(targetFields)
 {
     $.each(targetFields, function (index, name){
       clearError(name)
     });
 }

$.fn.clearTimepicker = function(timepickerField)
{
    $(this).find(timepickerField).timepicker('remove');
}

/**
 * Remove the server side error for a specified field.
 *
 * @param  {string} name
 * @return void
 */
function clearError(name)
{
    var field = $("."+name);
    var feedback = $("span."+name).hide();

    field.removeClass('is-invalid');
    feedback.text('');
}
