jQuery(document).ready(function ($) {
    
    $('.apsw_post_taxonomy_types').change(function () {
        if ($(this).is(':checked')) {
            $(this).parent().next('.taxonomy_type_wrapper').css('display', 'block');
        } else {
            $(this).parent().next('.taxonomy_type_wrapper').css('display', 'none');
        }
    });

    $('#stats_all').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
            $('#from').attr('disabled', 'disabled');
            $('#to').attr('disabled', 'disabled');
            $('#from').val('');
            $('#to').val('');
        } else {
            $(this).val('0');
            $('#from').removeAttr('disabled');
            $('#to').removeAttr('disabled');
        }
    });
});