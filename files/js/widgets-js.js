jQuery(document).ready(function ($) {

    /**
     * widget before/after html
     */
    $(document).delegate('.apsw_before_widget_chk', 'change', function () {
        if ($(this).is(':checked')) {
            $(this).parent('.apsw_widget_before_after_wrapper').children('.apsw_widget_custom_args').css('display', 'block');
        } else {
            $(this).parent('.apsw_widget_before_after_wrapper').children('.apsw_widget_custom_args').css('display', 'none');
        }
    });

    /**
     * widget title before/after html
     */
    $(document).delegate('.apsw_before_title_chk', 'change', function () {
        if ($(this).is(':checked')) {
            $(this).parent('.apsw_title_before_after_wrapper').children('.apsw_title_custom_args').css('display', 'block');
        } else {
            $(this).parent('.apsw_title_before_after_wrapper').children('.apsw_title_custom_args').css('display', 'none');
        }
    });

    /**
     * widget body before/after html
     */
    $(document).delegate('.apsw_before_body_chk', 'change', function () {
        if ($(this).is(':checked')) {
            $(this).parent('.apsw_body_before_after_wrapper').children('.apsw_body_custom_args').css('display', 'block');
        } else {
            $(this).parent('.apsw_body_before_after_wrapper').children('.apsw_body_custom_args').css('display', 'none');
        }
    });



    var fromId = '';
    var toId = '';

    $(document).delegate('.fromdate', 'click', function () {
        fromId = $(this).attr('id');
        toId = $(this).parents('.widget-content').find('.todate').attr('id');

        $("#" + fromId).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#" + toId).datepicker("option", "minDate", selectedDate);
            }
        });

        $("#" + toId).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#" + fromId).datepicker("option", "maxDate", selectedDate);
            }
        });
        $(this).parents('.widget-content').find('.date_title').focus();
        $(this).focus();
    });

    $(document).delegate('.todate', 'click', function () {
        toId = $(this).attr('id');
        fromId = $(this).parents('.widget-content').find('.fromdate').attr('id');
        $("#" + fromId).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#" + toId).datepicker("option", "minDate", selectedDate);
            }
        });

        $("#" + toId).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function (selectedDate) {
                $("#" + fromId).datepicker("option", "maxDate", selectedDate);
            }
        });
        $(this).parents('.widget-content').find('.date_title').focus();
        $(this).focus();
    });

});