jQuery(document).ready(function ($) {
    $('#apsw_colorpickerHolder1').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_active_bg_color').val('#' + hex);
        }
    });
    $('#apsw_colorpickerHolder2').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_bg_color').val('#' + hex);
        }
    });
    $('#apsw_colorpickerHolder3').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_border_color').val('#' + hex);
        }
    });
    $('#apsw_colorpickerHolder4').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_active_text_color').val('#' + hex);
        }
    });
    $('#apsw_colorpickerHolder5').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_text_color').val('#' + hex);
        }
    });
    $('#apsw_colorpickerHolder6').ColorPicker({
        flat: true,
        onChange: function (hsb, hex, rgb) {
            $('#apsw_tab_hover_text_color').val('#' + hex);
        }
    });
});