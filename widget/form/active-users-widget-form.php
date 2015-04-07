<?php
$instance_before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
$instance_after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';
$instance_before_title = isset($instance['before_title']) ? $instance['before_title'] : '';
$instance_after_title = isset($instance['after_title']) ? $instance['after_title'] : '';
$instance_before_body = isset($instance['before_body']) ? $instance['before_body'] : '';
$instance_after_body = isset($instance['after_body']) ? $instance['after_body'] : '';
?>
<p>
    <label class="" for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
    <input type="text" 
           class="widefat date_title" 
           id="<?php echo $this->get_field_id('title'); ?>"
           name="<?php echo $this->get_field_name('title'); ?>" 
           value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label class="" for="<?php echo $this->get_field_id('from'); ?>"><?php _e('From Date:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
    <input type="text" 
           class="widefat fromdate" 
           id="<?php echo $this->get_field_id('from'); ?>"
           name="<?php echo $this->get_field_name('from'); ?>" 
           value="<?php echo esc_attr($instance['from']); ?>"
           placeholder="<?php _e('Example: 2014-06-25 (Y-m-d)', APSW_Core::$APSW_TEXT_DOMAIN); ?>" />
</p>

<p>
    <label class="" for="<?php echo $this->get_field_id('to'); ?>"><?php _e('To Date:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
    <input type="text" 
           class="widefat todate" 
           id="<?php echo $this->get_field_id('to'); ?>"
           name="<?php echo $this->get_field_name('to'); ?>" 
           value="<?php echo esc_attr($instance['to']); ?>" 
           placeholder="<?php _e('Example: 2014-07-25 (Y-m-d)', APSW_Core::$APSW_TEXT_DOMAIN); ?>"/>
</p>

<?php if ($this->apsw_options_serialized->is_display_custom_html_for_widgets) { ?>

    <div class="apsw_widget_before_after_wrapper">
        <label class="" for="<?php echo $this->get_field_id('apsw_widget_custom_args'); ?>"><?php _e('Use widget custom before/after html:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
        <input type="checkbox"                   
               class="checkbox apsw_before_widget_chk"
               id="<?php echo $this->get_field_id('apsw_widget_custom_args'); ?>"
               name="<?php echo $this->get_field_name('apsw_widget_custom_args'); ?>"
               <?php checked($instance['apsw_widget_custom_args'] == '1'); ?> value="1"/>

        <div style="display: <?php echo checked($instance['apsw_widget_custom_args'] == '1') ? 'block' : 'none'; ?>;" class="apsw_widget_custom_args">
            <p>
                <label class="" for="<?php echo $this->get_field_id('before_widget'); ?>"><?php _e('Before Widget:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML before the widget', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('before_widget'); ?>"
                          name="<?php echo $this->get_field_name('before_widget'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_before_widget; ?></textarea>
            </p>
            <p>
                <label class="" for="<?php echo $this->get_field_id('after_widget'); ?>"><?php _e('After Widget:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML after the widget', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('after_widget'); ?>"
                          name="<?php echo $this->get_field_name('after_widget'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_after_widget; ?></textarea>
            </p>
        </div>
    </div>
    <p></p>

    <div class="apsw_title_before_after_wrapper">
        <label class="" for="<?php echo $this->get_field_id('apsw_title_custom_args'); ?>"><?php _e('Use title custom before/after html:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
        <input type="checkbox"                   
               class="checkbox apsw_before_title_chk"
               id="<?php echo $this->get_field_id('apsw_title_custom_args'); ?>"
               name="<?php echo $this->get_field_name('apsw_title_custom_args'); ?>"
               <?php checked($instance['apsw_title_custom_args'] == '1'); ?> value="1"/>

        <div style="display: <?php echo checked($instance['apsw_title_custom_args'] == '1') ? 'block' : 'none'; ?>;" class="apsw_title_custom_args">
            <p>
                <label class="" for="<?php echo $this->get_field_id('before_title'); ?>"><?php _e('Before Title:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML before the title', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('before_title'); ?>"
                          name="<?php echo $this->get_field_name('before_title'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_before_title; ?></textarea>
            </p>
            <p>
                <label class="" for="<?php echo $this->get_field_id('after_title'); ?>"><?php _e('After Title:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML after the title', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('after_title'); ?>"
                          name="<?php echo $this->get_field_name('after_title'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_after_title; ?></textarea>
            </p>
        </div>
    </div>
    <p></p>

    <div class="apsw_body_before_after_wrapper">
        <label class="" for="<?php echo $this->get_field_id('apsw_body_custom_args'); ?>"><?php _e('Use body custom before/after html:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label>
        <input type="checkbox"                   
               class="checkbox apsw_before_body_chk"
               id="<?php echo $this->get_field_id('apsw_body_custom_args'); ?>"
               name="<?php echo $this->get_field_name('apsw_body_custom_args'); ?>"
               <?php checked($instance['apsw_body_custom_args'] == '1'); ?> value="1"/>

        <div style="display: <?php echo checked($instance['apsw_body_custom_args'] == '1') ? 'block' : 'none'; ?>;" class="apsw_body_custom_args">
            <p>
                <label class="" for="<?php echo $this->get_field_id('before_body'); ?>"><?php _e('Before Body:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML before the body', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('before_body'); ?>"
                          name="<?php echo $this->get_field_name('before_body'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_before_body; ?></textarea>
            </p>
            <p>
                <label class="" for="<?php echo $this->get_field_id('after_body'); ?>"><?php _e('After Body:', APSW_Core::$APSW_TEXT_DOMAIN); ?></label><br>
                <textarea placeholder="<?php _e('HTML after the body', APSW_Core::$APSW_TEXT_DOMAIN); ?>"
                          id="<?php echo $this->get_field_id('after_body'); ?>"
                          name="<?php echo $this->get_field_name('after_body'); ?>"
                          class="widefat" rows="4" cols="20"><?php echo $instance_after_body; ?></textarea>
            </p>
        </div>
    </div>
    <p></p>
<?php } ?>