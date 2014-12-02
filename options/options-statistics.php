<?php
include_once 'options-serialized.php';

class Stats_Options {

    private $options;
    private $post_types;

    public function __construct() {
        $this->options = new Serialize_Options();
    }

    public function get_default_options() {
        return $this->options;
    }

    /**
     * Builds options page
     */
    public function options_form() {
        $default_post_types = get_post_types('', 'names');
        foreach ($default_post_types as $post_type) {
            if ($post_type != 'attachment' && $post_type != 'revision' && $post_type != 'nav_menu_item') {
                $this->post_types[] = $post_type;
            }
        }

        if (empty($this->options->post_types)) {
            $this->options->post_types = $this->post_types;
        }

        if (isset($_POST['submit'])) {

            if (function_exists('current_user_can') && !current_user_can('manage_options')) {
                die(_e('Hacker?', 'statistics_info'));
            }

            if (function_exists('check_admin_referer')) {
                check_admin_referer('stats_options_form');
            }

            $this->options->is_stats_together = $_POST['is_stats_together'];
            $this->options->post_types = empty($_POST['post_types']) ? $this->post_types : $_POST['post_types'];
            $this->options->is_simple_tabs_default = isset($_POST['is_simple_tabs_default']) ? $_POST['is_simple_tabs_default'] : 0;
            $this->options->is_display_author_name = isset($_POST['is_display_author_name']) ? $_POST['is_display_author_name'] : 0;
            $this->options->is_display_author_avatar = isset($_POST['is_display_author_avatar']) ? $_POST['is_display_author_avatar'] : 0;
            $this->options->is_author_popular_by_post_count = isset($_POST['is_author_popular_by_post_count']) ? $_POST['is_author_popular_by_post_count'] : '1';
            $this->options->is_popular_posts_by_post_views = isset($_POST['is_popular_posts_by_post_views']) ? $_POST['is_popular_posts_by_post_views'] : '1';
            $this->options->popular_authors_limit = isset($_POST['popular_authors_limit']) ? $_POST['popular_authors_limit'] : '10';
            $this->options->is_post_view_by_ip = isset($_POST['is_post_view_by_ip']) ? $_POST['is_post_view_by_ip'] : '1';
            $this->options->popular_posts_limit = isset($_POST['popular_posts_limit']) ? $_POST['popular_posts_limit'] : '10';
            $this->options->active_theme_name = isset($_POST['active_theme_name']) ? $_POST['active_theme_name'] : 'smoothness';
            $this->options->custom_css = $_POST['custom_css'];
            $this->options->apsw_tab_active_bg_color = isset($_POST['apsw_tab_active_bg_color']) ? $_POST['apsw_tab_active_bg_color'] : '#fff';
            $this->options->apsw_tab_bg_color = isset($_POST['apsw_tab_bg_color']) ? $_POST['apsw_tab_bg_color'] : '#ccc';
            $this->options->apsw_tab_border_color = isset($_POST['apsw_tab_border_color']) ? $_POST['apsw_tab_border_color'] : '#d4d4d1';
            $this->options->apsw_tab_active_text_color = isset($_POST['apsw_tab_active_text_color']) ? $_POST['apsw_tab_active_text_color'] : '#2e7da3';
            $this->options->apsw_tab_text_color = isset($_POST['apsw_tab_text_color']) ? $_POST['apsw_tab_text_color'] : '#fff';
            $this->options->apsw_tab_hover_text_color = isset($_POST['apsw_tab_hover_text_color']) ? $_POST['apsw_tab_hover_text_color'] : '#21759b';            

            $this->options->updateOptions();
        }
        ?>
        <div class="wrap">
            <input type="hidden" id="statsCurrentTab" name="statsCurrentTab" value="0"/>
            <div style="float:left; width:40px; height:40px; margin:10px 10px 20px 0px;"><img src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/plugin-icon/apsw-settings-icon.png'); ?>" style="width:48px;"/></div> <h2><?php _e('Author &amp; Post Statistic Widgets Settings', Statistic_Info::$text_domain); ?></h2>
            <br style="clear:both" />

            <table width="100%" border="0">
                <tr>
                    <td style="padding:10px; padding-left:0px; vertical-align:top; width:500px;">

                        <table width="100%" border="0" cellspacing="1" class="widefat">
                            <tr>
                                <td style="width:500px; padding-top:10px;">
                                    <div id="home_left_box2" style="margin:0px auto;">
                                        <div id="innerblock">
                                            <div id="gconverter">
                                                <div style="text-align:center;"> <a href="http://www.gvectors.com/author-and-post-statistic-widgets/"><img src="<?php echo plugins_url('author-and-post-statistic-widgets/promo/img/apsw-pro.png'); ?>" style="width:100%; min-width:510px;" /></a>
                                                    <p style="padding-top:0px; white-space:nowrap; text-align:left;"><br />
                                                        <a href="http://www.gvectors.com/advanced-content-pagination/"> <span style="font-size:16px; font-weight:bold; font-family:Georgia, 'Times New Roman', Times, serif;">Author &amp; Post Statistic Widgets PRO</span> &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.gvectors.com/author-and-post-statistic-widgets/" target="_blank" class="button button-primary">Update to Pro Now!</a> <br />
                                                            <span style="font-size:13px; line-height:25px; white-space:nowrap">APSW Pro generates graphical statistic for authors' activity and posts' popularity.</span> </p>
                                                </div>
                                            </div>
                                            <span id="ribbon-left"></span> 
                                        </div>
                                        <div id="frame"> </div>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </td>
                    <td valign="top" style="padding:10px; padding-right:0px;">
                        <table width="100%" border="0" cellspacing="1" class="widefat">
                            <thead>
                                <tr>
                                    <th>&nbsp;Like Author &amp; Post Statistic Widgets plugin?</th>
                                </tr>
                            </thead>
                            <tr valign="top">
                                <td style="background:#FFF; text-align:left; font-size:12px;"><ul>
                                        <li>If you like APSW and want to encourage us to develop and maintain it,why not do any or all of the following:</li>
                                        <li>- Link to it so other folks can find out about it.</li>
                                        <li>- Give it a good rating on <a href="http://wordpress.org/extend/plugins/author-and-post-statistic-widgets/" target="_blank">WordPress.org.</a></li>
                                        <li>- We spend as much of my spare time as possible working on Author &amp; Post Statistic Widgets plugin and any donation is appreciated. Donations play a crucial role in supporting Free and Open Source Software projects.
                                            <div style="width:200px; float:right;">
                                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                                    <input type="hidden" name="cmd" value="_s-xclick">
                                                    <input type="hidden" name="hosted_button_id" value="U22KJYA4VVBME">
                                                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                                                </form>
                                            </div>
                                            <br />
                                            <h4>You have my sincere thanks and appreciation for using <em>APSW</em>.</h4>
                                            <div style="clear:both;"></div>
                                        </li>
                                    </ul></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <form action="<?php echo admin_url(); ?>admin.php?page=<?php echo $this->options->stats_option_page_slug; ?>&updated=true" method="post" name="<?php echo $this->options->stats_option_page_slug; ?>">

                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('stats_options_form');
                }
                ?>
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php _e('General', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-2"><?php _e('Popular Authors', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-3"><?php _e('Popular Posts', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-4"><?php _e('View counter for posts', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-5"><?php _e('Styles', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-6"><?php _e('Reset Statistics', Statistic_Info::$text_domain); ?></a></li>
                        <li><a href="#tabs-7"><?php _e('Support', Statistic_Info::$text_domain); ?></a></li>
                    </ul>

                    <?php
                    include 'layouts/settings-general.php';
                    include 'layouts/settings-popular-authors.php';
                    include 'layouts/settings-popular-posts.php';
                    include 'layouts/settings-view-counter.php';
                    include 'layouts/settings-styles.php';
                    include 'layouts/settings-reset-statistics.php';
                    include 'layouts/support.php';
                    ?>
                    <div style="display: none;">
                        <div id="response_info" >
                            <img width="100" height="100" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/loader/ajax-loader-200x200.gif'); ?>" />
                        </div>
                    </div>
                </div>


                <script type="text/javascript">
                    jQuery(document).ready(function ($) {
                        var statsCurrentTab = $.cookie('statsCurrentTab');
                        if (statsCurrentTab == null) {
                            statsCurrentTab = $('#statsCurrentTab').val();
                            $.cookie('statsCurrentTab', statsCurrentTab, {expires: 7});
                        }
                        $("#tabs").tabs({active: statsCurrentTab});

                        $('#tabs a').click(function (e) {
                            var curTab = $('.ui-tabs-active');
                            statsCurrentTab = curTab.index();
                            $.cookie('statsCurrentTab', statsCurrentTab, {expires: 7});
                        });

                        $("#switcher").themeswitcher({
                            imgpath: "../wp-content/plugins/author-and-post-statistic-widgets/files/js/jquery-ui/images/",
                            themePath: "../wp-content/plugins/author-and-post-statistic-widgets/files/css/jquery-ui-themes/",
                            loadTheme: "<?php echo $this->options->active_theme_name; ?>",
                            height: 285,
                            width: 200
                        });

                        $(function () {
                            $("#from").datepicker({
                                dateFormat: 'yy-mm-dd',
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1,
                                onClose: function (selectedDate) {
                                    $("#to").datepicker("option", "minDate", selectedDate);
                                }
                            });
                            $("#to").datepicker({
                                dateFormat: 'yy-mm-dd',
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1,
                                onClose: function (selectedDate) {
                                    $("#from").datepicker("option", "maxDate", selectedDate);
                                }
                            });
                        });

                    });
                </script>

                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                            <td>
                                <p class="submit">
                                    <input type="submit" id="stats_save_options" class="button button-primary" name="submit" value="<?php _e('Save Changes') ?>" />
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="action" value="update" />                
            </form>
        </div>
        <?php
    }

}
?>