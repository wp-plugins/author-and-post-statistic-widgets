<?php

class APSW_CSS {

    private $options;

    function __construct($options) {
        $this->options = $options;
    }

    /**
     * load simple tabs custom css
     */
    function load_custom_css() {
        ?>
        <style type="text/css">

            .stats_tabs ul {
                margin: 0;
                padding: 0;
            }

            .stats_tabs .tabs-menu {
                height: 30px;
                clear: both;
                list-style-type: none;
            }

            ul.tabs-menu li {
                height: 30px;
                line-height: 30px;
                float: left;
                margin-right: 1px;
                background-color: <?php echo $this->options->apsw_tab_bg_color; ?>;
                border-top: 1px solid <?php echo $this->options->apsw_tab_border_color; ?>;
                border-right: 1px solid <?php echo $this->options->apsw_tab_border_color; ?>;
                border-left: 1px solid <?php echo $this->options->apsw_tab_border_color; ?>;
                list-style-type: none;
                padding: 0;
            }

            .stats_tabs .tabs-menu li.current {
                position: relative;
                background-color: <?php echo $this->options->apsw_tab_active_bg_color; ?>;
                border-bottom: 1px solid <?php echo $this->options->apsw_tab_active_bg_color; ?>;
                z-index: 5;
            }

            .stats_tabs .tabs-menu li a {
                height: 30px;
                line-height: 30px;
                padding: 0 10px;
                display: block;
                text-transform: uppercase;
                color: <?php echo $this->options->apsw_tab_text_color; ?>;
                text-decoration: none; 
            }

            .stats_tabs .tabs-menu .current a {
                color: <?php echo $this->options->apsw_tab_active_text_color; ?>;
            }

            .stats_tabs .tabs-menu li:not(.current) a:hover {
                color: <?php echo $this->options->apsw_tab_hover_text_color; ?>;
            }

            .stats_tabs .tab {
                border: 1px solid <?php echo $this->options->apsw_tab_border_color; ?>;
                background-color: <?php echo $this->options->apsw_tab_active_bg_color; ?>;
                margin-bottom: 20px;
                width: auto;
            }

            .stats_tabs .tab-content {
                width: 100%;
                display: none;
            }

            .stats_tabs #tabs-1 {
                display: block;   
            }


        </style>
        <?php
    }

}
?>
