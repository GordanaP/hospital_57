function errorResponse(errors, modal)
{
    if(errors) {
        displayErrors(errors)
        clearErrorOnNewInput()
    }
}

function displayErrors(errors)
{
    for (error in errors)
    {
        var field = $("."+error)
        var feedback = $("span."+error).show()

        // Attach server side validation
        displayServerError(field, feedback, errors[error][0])
    }
}

function clearErrorOnNewInput()
{
    $("input, textarea").on('keydown', function () {

        clearError($(this).attr('name'));
    });

    $('input[type="file"]').change(function(){

        var id = $(this).attr('id');

        clearError(id)
    })

    $("select").on('change', function () {

        var select_id = $(this).attr('id');
        var id = select_id.charAt(0) == '_' ? select_id.substring(1) : select_id

        clearError(id)
    });

    $("input[type=checkbox], input[type=radio]").click(function() {

        var id = $(this).parents(':eq(1)').attr('id');
        var name = $(this).parents(':eq(1)').attr('name');

        var splitted = name ? name.split("-") : ''
        var splitted_name = splitted[1]

        clearError(name)
        clearError(id)
    })
}

function displayServerError(field, feedback, error)
{
    // field.addClass('is-invalid')
    feedback.text(error)
}

function clearError(name)
{
    var field = $("."+name);
    var feedback = $("span."+name).hide();

    // field.removeClass('is-invalid');
    feedback.text('');
}
