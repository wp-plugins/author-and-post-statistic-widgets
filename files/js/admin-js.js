jQuery(document).ready(function ($) {

    $('#is_simple_tabs_default').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#is_display_author_name').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#is_display_author_avatar').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
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