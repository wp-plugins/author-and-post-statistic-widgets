<p>
    <label class="" for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', Statistic_Info::$text_domain); ?></label>
    <input type="text" 
           class="widefat date_title" 
           id="<?php echo $this->get_field_id('title'); ?>"
           name="<?php echo $this->get_field_name('title'); ?>" 
           value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label class="" for="<?php echo $this->get_field_id('from'); ?>"><?php _e('From Date:', Statistic_Info::$text_domain); ?></label>
    <input type="text" 
           class="widefat fromdate" 
           id="<?php echo $this->get_field_id('from'); ?>"
           name="<?php echo $this->get_field_name('from'); ?>" 
           value="<?php echo esc_attr($instance['from']); ?>"
           placeholder="<?php _e('Example: 2014-06-25 (Y-m-d)', Statistic_Info::$text_domain); ?>" />
</p>

<p>
    <label class="" for="<?php echo $this->get_field_id('to'); ?>"><?php _e('To Date:', Statistic_Info::$text_domain); ?></label>
    <input type="text" 
           class="widefat todate" 
           id="<?php echo $this->get_field_id('to'); ?>"
           name="<?php echo $this->get_field_name('to'); ?>" 
           value="<?php echo esc_attr($instance['to']); ?>" 
           placeholder="<?php _e('Example: 2014-07-25 (Y-m-d)', Statistic_Info::$text_domain); ?>"/>
</p>

<p>
    <label class="" for="<?php echo $this->get_field_id('widget_custom_args'); ?>"><?php _e('Use widget custom before/after html:', Statistic_Info::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox before_widget_chk"
           id="<?php echo $this->get_field_id('widget_custom_args'); ?>"
           name="<?php echo $this->get_field_name('widget_custom_args'); ?>"
           <?php checked($instance['widget_custom_args'] == 'on'); ?> />
</p>


<div style="display: <?php echo checked($instance['widget_custom_args'] == 'on') ? 'block' : 'none'; ?>;">
    <p>
        <label class="" for="<?php echo $this->get_field_id('before_widget'); ?>"><?php _e('Before Widget:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML before the widget', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('before_widget'); ?>"
                  name="<?php echo $this->get_field_name('before_widget'); ?>"><?php echo $instance['before_widget']; ?></textarea>
    </p>
    <p>
        <label class="" for="<?php echo $this->get_field_id('after_widget'); ?>"><?php _e('After Widget:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML after the widget', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('after_widget'); ?>"
                  name="<?php echo $this->get_field_name('after_widget'); ?>"><?php echo $instance['after_widget']; ?></textarea>
    </p>
</div>

<p>
    <label class="" for="<?php echo $this->get_field_id('title_custom_args'); ?>"><?php _e('Use title custom before/after html:', Statistic_Info::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox before_title_chk"
           id="<?php echo $this->get_field_id('title_custom_args'); ?>"
           name="<?php echo $this->get_field_name('title_custom_args'); ?>"
           <?php checked($instance['title_custom_args'] == 'on'); ?> />
</p>

<div style="display: <?php echo checked($instance['title_custom_args'] == 'on') ? 'block' : 'none'; ?>;">
    <p>
        <label class="" for="<?php echo $this->get_field_id('before_title'); ?>"><?php _e('Before Title:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML before the title', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('before_title'); ?>"
                  name="<?php echo $this->get_field_name('before_title'); ?>"><?php echo $instance['before_title']; ?></textarea>
    </p>
    <p>
        <label class="" for="<?php echo $this->get_field_id('after_title'); ?>"><?php _e('After Title:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML after the title', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('after_title'); ?>"
                  name="<?php echo $this->get_field_name('after_title'); ?>"><?php echo $instance['after_title']; ?></textarea>
    </p>
</div>

<p>
    <label class="" for="<?php echo $this->get_field_id('post_widget_body_custom_args'); ?>"><?php _e('Use body custom before/after html:', Statistic_Info::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox before_body_chk"
           id="<?php echo $this->get_field_id('post_widget_body_custom_args'); ?>"
           name="<?php echo $this->get_field_name('post_widget_body_custom_args'); ?>"
           <?php checked($instance['post_widget_body_custom_args'] == 'on'); ?> />
</p>

<div style="display: <?php echo checked($instance['post_widget_body_custom_args'] == 'on') ? 'block' : 'none'; ?>;">
    <p>
        <label class="" for="<?php echo $this->get_field_id('before_body'); ?>"><?php _e('Before Body:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML before the body', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('before_body'); ?>"
                  name="<?php echo $this->get_field_name('before_body'); ?>"><?php echo $instance['before_body']; ?></textarea>
    </p>
    <p>
        <label class="" for="<?php echo $this->get_field_id('after_body'); ?>"><?php _e('After Body:', Statistic_Info::$text_domain); ?></label><br>
        <textarea placeholder="<?php _e('HTML after the body', Statistic_Info::$text_domain); ?>"
                  id="<?php echo $this->get_field_id('after_body'); ?>"
                  name="<?php echo $this->get_field_name('after_body'); ?>"><?php echo $instance['after_body']; ?></textarea>
    </p>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.before_widget_chk').change(function() {
            if ($(this).is(':checked')) {
                $(this).parent().next('div').css('display', 'block');
            } else {
                $(this).parent().next('div').css('display', 'none');                        
            }
        });   
                                                                                                                        
        $('.before_title_chk').change(function() {
            if ($(this).is(':checked')) {
                $(this).parent().next('div').css('display', 'block');
            } else {
                $(this).parent().next('div').css('display', 'none');                        
            }
        }); 
                                        
        $('.before_body_chk').change(function() {
            if ($(this).is(':checked')) {
                $(this).parent().next('div').css('display', 'block');
            } else {
                $(this).parent().next('div').css('display', 'none');                        
            }
        }); 
                                                                                                                                                                    
        $(document).ajaxSuccess(function() {
            if (jQuery('.before_widget_chk').is(':checked')) {
                jQuery(this).parent().next('div').css('display', 'block');
            } else {
                jQuery(this).parent().next('div').css('display', 'none');
            } 
        });
                                                                                                                
        $(document).ajaxSuccess(function() {
            if (jQuery('.before_title_chk').is(':checked')) {
                jQuery(this).parent().next('div').css('display', 'block');
            } else {
                jQuery(this).parent().next('div').css('display', 'none');
            } 
        });
                                        
        $(document).ajaxSuccess(function() {
            if (jQuery('.before_body_chk').is(':checked')) {
                jQuery(this).parent().next('div').css('display', 'block');
            } else {
                jQuery(this).parent().next('div').css('display', 'none');
            } 
        });
    });    
</script>

<script type="text/javascript">
    var fromId = '';
    var toId = '';
        
    jQuery('.fromdate').live('click', function(){
        
        fromId = jQuery(this).attr('id');
        toId = jQuery(this).parents('.widget-content').find('.todate').attr('id'); 
        
        jQuery( "#" + fromId ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                jQuery( "#" +  toId).datepicker( "option", "minDate", selectedDate );
            }
        });
            
        jQuery( "#" + toId ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                jQuery( "#" + fromId ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        jQuery(this).parents('.widget-content').find('.date_title').focus();
        jQuery(this).focus();
    });
        
    jQuery('.todate').live('click', function(){
        toId = jQuery(this).attr('id');
        fromId = jQuery(this).parents('.widget-content').find('.fromdate').attr('id');
        jQuery( "#" + fromId ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                jQuery( "#" +  toId).datepicker( "option", "minDate", selectedDate );
            }
        });
            
        jQuery( "#" + toId ).datepicker({
            dateFormat: 'yy-mm-dd',
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                jQuery( "#" + fromId ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        jQuery(this).parents('.widget-content').find('.date_title').focus();
        jQuery(this).focus();
    });
</script>
