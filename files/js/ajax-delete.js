jQuery(document).ready(function($){
    
    $('.ui-widget-overlay').live('click', function(){
        $('#response_info').dialog('close');
    });
    
    $('#delete_stats_between_dates').click(function() {
        
        $('#response_info').dialog({
            modal:true
        });
        
        var deleteAll = $('#stats_all').is(':checked');
        var fromDate;
        var toDate;
        var allDate;
        
        if (deleteAll) {
            allDate = 1;
        } else {
            fromDate = jQuery('#from').val();
            toDate = jQuery('#to').val();
            allDate = 0;
        }
                        
        $.ajax({
            type: 'POST',
            url:ajaxurl,
            data: {
                to:toDate,
                from: fromDate,
                all: allDate,
                action: 'delete_stats_key'
            }
        }).done(function(response){
            $('#response_info').html('<span claas="ajax_stats_response">' + response + '</span>');
            jQuery('#from').val();
            jQuery('#to').val();
            jQuery('#stats_all').attr('checked', false);
        });
    }); 
});