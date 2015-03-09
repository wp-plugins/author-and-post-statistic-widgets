<?php
$instance_before_widget = isset($instance['before_widget']) ? $instance['before_widget'] : '';
$instance_after_widget = isset($instance['after_widget']) ? $instance['after_widget'] : '';
$instance_before_title = isset($instance['before_title']) ? $instance['before_title'] : '';
$instance_after_title = isset($instance['after_title']) ? $instance['after_title'] : '';
$instance_before_body = isset($instance['before_body']) ? $instance['before_body'] : '';
$instance_after_body = isset($instance['after_body']) ? $instance['after_body'] : '';
?>
<p>
    <label class="" for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:', APSW_Core::$text_domain); ?></label>
    <input type="text" 
           class="widefat apsw_date_title" 
           id="<?php echo $this->get_field_id('title'); ?>"
           name="<?php echo $this->get_field_name('title'); ?>" 
           value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<p>
    <label class="" for="<?php echo $this->get_field_name('interval'); ?>"><?php _e('Select date interval:', APSW_Core::$text_domain); ?></label>
    <select class="widefat apsw_date_interval" name="<?php echo $this->get_field_name('apsw_date_interval'); ?>">
        <option value="1" <?php selected($instance['apsw_date_interval'], '1'); ?>><?php _e('Today', APSW_Core::$text_domain); ?></option>
        <option value="2" <?php selected($instance['apsw_date_interval'], '2'); ?>><?php _e('Yesterday', APSW_Core::$text_domain); ?></option>
        <option value="3" <?php selected($instance['apsw_date_interval'], '3'); ?>><?php _e('Last 7 Days', APSW_Core::$text_domain); ?></option>
        <option value="4" <?php selected($instance['apsw_date_interval'], '4'); ?>><?php _e('Last 30 Days', APSW_Core::$text_domain); ?></option>
        <option value="5" <?php selected($instance['apsw_date_interval'], '5'); ?>><?php _e('Last 90 Days', APSW_Core::$text_domain); ?></option>
        <option value="6" <?php selected($instance['apsw_date_interval'], '6'); ?>><?php _e('Last 365 Days', APSW_Core::$text_domain); ?></option>
        <option value="7" <?php selected($instance['apsw_date_interval'], '7'); ?>><?php _e('All Time', APSW_Core::$text_domain); ?></option>
    </select>
</p>

<div class="apsw_widget_before_after_wrapper">
    <label class="" for="<?php echo $this->get_field_id('apsw_widget_custom_args'); ?>"><?php _e('Use widget custom before/after html:', APSW_Core::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox apsw_before_widget_chk"
           id="<?php echo $this->get_field_id('apsw_widget_custom_args'); ?>"
           name="<?php echo $this->get_field_name('apsw_widget_custom_args'); ?>"
           <?php checked($instance['apsw_widget_custom_args'] == '1'); ?> value="1"/>    

    <div style="display: <?php echo checked($instance['apsw_widget_custom_args'] == '1') ? 'block' : 'none'; ?>;" class="apsw_widget_custom_args">
        <p>
            <label class="" for="<?php echo $this->get_field_id('before_widget'); ?>"><?php _e('Before Widget:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML before the widget', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('before_widget'); ?>"
                      name="<?php echo $this->get_field_name('before_widget'); ?>"><?php echo $instance_before_widget; ?></textarea>
        </p>
        <p>
            <label class="" for="<?php echo $this->get_field_id('after_widget'); ?>"><?php _e('After Widget:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML after the widget', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('after_widget'); ?>"
                      name="<?php echo $this->get_field_name('after_widget'); ?>"><?php echo $instance_after_widget; ?></textarea>
        </p>
    </div>
</div>
<p></p>

<div class="apsw_title_before_after_wrapper">
    <label class="" for="<?php echo $this->get_field_id('apsw_title_custom_args'); ?>"><?php _e('Use title custom before/after html:', APSW_Core::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox apsw_before_title_chk"
           id="<?php echo $this->get_field_id('apsw_title_custom_args'); ?>"
           name="<?php echo $this->get_field_name('apsw_title_custom_args'); ?>"
           <?php checked($instance['apsw_title_custom_args'] == '1'); ?> value="1"/>

    <div style="display: <?php echo checked($instance['apsw_title_custom_args'] == '1') ? 'block' : 'none'; ?>" class="apsw_title_custom_args">
        <p>
            <label class="" for="<?php echo $this->get_field_id('before_title'); ?>"><?php _e('Before Title:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML before the title', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('before_title'); ?>"
                      name="<?php echo $this->get_field_name('before_title'); ?>"><?php echo $instance_before_title; ?></textarea>
        </p>
        <p>
            <label class="" for="<?php echo $this->get_field_id('after_title'); ?>"><?php _e('After Title:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML after the title', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('after_title'); ?>"
                      name="<?php echo $this->get_field_name('after_title'); ?>"><?php echo $instance_after_title; ?></textarea>
        </p>
    </div>

</div>
<p></p>

<div class="apsw_body_before_after_wrapper"> 
    <label class="" for="<?php echo $this->get_field_id('apsw_body_custom_args'); ?>"><?php _e('Use body custom before/after html:', APSW_Core::$text_domain); ?></label>
    <input type="checkbox"                   
           class="checkbox apsw_before_body_chk"
           id="<?php echo $this->get_field_id('apsw_body_custom_args'); ?>"
           name="<?php echo $this->get_field_name('apsw_body_custom_args'); ?>"
           <?php checked($instance['apsw_body_custom_args'] == '1'); ?> value="1"/>

    <div style="display: <?php echo checked($instance['apsw_body_custom_args'] == '1') ? 'block' : 'none'; ?>" class="apsw_body_custom_args">
        <p>
            <label class="" for="<?php echo $this->get_field_id('before_body'); ?>"><?php _e('Before Body:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML before the body', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('before_body'); ?>"
                      name="<?php echo $this->get_field_name('before_body'); ?>"><?php echo $instance_before_body; ?></textarea>
        </p>
        <p>
            <label class="" for="<?php echo $this->get_field_id('after_body'); ?>"><?php _e('After Body:', APSW_Core::$text_domain); ?></label><br>
            <textarea placeholder="<?php _e('HTML after the body', APSW_Core::$text_domain); ?>"
                      id="<?php echo $this->get_field_id('after_body'); ?>"
                      name="<?php echo $this->get_field_name('after_body'); ?>"><?php echo $instance_after_body; ?></textarea>
        </p>
    </div>
</div>
<p></p>