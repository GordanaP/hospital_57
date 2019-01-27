<script>

    $('input:radio').change(function() {

        var value = $("form input[type='radio']:checked").val();

        value == 'manual' ? $('#password').removeClass('hidden') : $('#password').addClass('hidden')
    });

</script>