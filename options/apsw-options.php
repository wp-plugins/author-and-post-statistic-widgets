<?php
include_once 'apsw-options-serialized.php';

class APSW_Options {

    private $apsw_options_serialized;
    private $post_types;
    private $custom_taxonomy_types;
    private $apsw_db_helper;

    public function __construct($apsw_db_helper) {
        $this->apsw_db_helper = $apsw_db_helper;
        $this->apsw_options_serialized = new APSW_Options_Serialize();
    }

    public function get_default_options() {
        return $this->apsw_options_serialized;
    }

    /**
     * Builds options page
     */
    public function options_form() {
        $all_post_types = $this->apsw_db_helper->get_published_post_types();
        foreach ($all_post_types as $post_type) {
            $this->post_types[] = $post_type['post_type'];

            if ($post_type['taxonomies']) {
                foreach ($post_type['taxonomies'] as $taxonomies) {
                    $this->custom_taxonomy_types[] = $taxonomies['taxonomy'];
                }
            }
        }

        if (!$this->apsw_options_serialized->post_types) {
            $this->apsw_options_serialized->post_types = $this->post_types;
        }

        if (isset($_POST['submit'])) {

            if (function_exists('current_user_can') && !current_user_can('manage_options')) {
                die(_e('Hacker?', APSW_Core::$text_domain));
            }

            if (function_exists('check_admin_referer')) {
                check_admin_referer('stats_options_form');
            }

            $this->apsw_options_serialized->is_stats_together = $_POST['is_stats_together'];
            $this->apsw_options_serialized->post_types = !$_POST['post_types'] ? $this->post_types : $_POST['post_types'];
            $this->apsw_options_serialized->custom_taxonomy_types = isset($_POST['custom_taxonomy_types']) ? $_POST['custom_taxonomy_types'] : array();
            $this->apsw_options_serialized->is_simple_tabs_default = isset($_POST['is_simple_tabs_default']) ? $_POST['is_simple_tabs_default'] : 0;
            $this->apsw_options_serialized->is_display_author_name = isset($_POST['is_display_author_name']) ? $_POST['is_display_author_name'] : 0;
            $this->apsw_options_serialized->is_display_author_avatar = isset($_POST['is_display_author_avatar']) ? $_POST['is_display_author_avatar'] : 0;
            $this->apsw_options_serialized->is_author_popular_by_post_count = isset($_POST['is_author_popular_by_post_count']) ? $_POST['is_author_popular_by_post_count'] : '1';
            $this->apsw_options_serialized->is_popular_posts_by_post_views = isset($_POST['is_popular_posts_by_post_views']) ? $_POST['is_popular_posts_by_post_views'] : '1';
            $this->apsw_options_serialized->popular_authors_limit = (isset($_POST['popular_authors_limit']) && intval($_POST['popular_authors_limit']) && intval($_POST['popular_authors_limit']) > 0) ? intval($_POST['popular_authors_limit']) : '10';
            $this->apsw_options_serialized->is_post_view_by_ip = isset($_POST['is_post_view_by_ip']) ? $_POST['is_post_view_by_ip'] : '1';
            $this->apsw_options_serialized->is_display_daily_views = isset($_POST['is_display_daily_views']) ? $_POST['is_display_daily_views'] : '0';
            $this->apsw_options_serialized->popular_posts_limit = (isset($_POST['popular_posts_limit']) && intval($_POST['popular_posts_limit']) && intval($_POST['popular_posts_limit']) > 0) ? intval($_POST['popular_posts_limit']) : '10';
            $this->apsw_options_serialized->active_theme_name = isset($_POST['active_theme_name']) ? $_POST['active_theme_name'] : 'smoothness';
            $this->apsw_options_serialized->custom_css = isset($_POST['custom_css']) ? $_POST['custom_css'] : '';
            $this->apsw_options_serialized->apsw_tab_active_bg_color = isset($_POST['apsw_tab_active_bg_color']) ? $_POST['apsw_tab_active_bg_color'] : '#fff';
            $this->apsw_options_serialized->apsw_tab_bg_color = isset($_POST['apsw_tab_bg_color']) ? $_POST['apsw_tab_bg_color'] : '#ccc';
            $this->apsw_options_serialized->apsw_tab_border_color = isset($_POST['apsw_tab_border_color']) ? $_POST['apsw_tab_border_color'] : '#d4d4d1';
            $this->apsw_options_serialized->apsw_tab_active_text_color = isset($_POST['apsw_tab_active_text_color']) ? $_POST['apsw_tab_active_text_color'] : '#2e7da3';
            $this->apsw_options_serialized->apsw_tab_text_color = isset($_POST['apsw_tab_text_color']) ? $_POST['apsw_tab_text_color'] : '#fff';
            $this->apsw_options_serialized->apsw_tab_hover_text_color = isset($_POST['apsw_tab_hover_text_color']) ? $_POST['apsw_tab_hover_text_color'] : '#21759b';

            $this->apsw_options_serialized->update_options();
        }
        ?>
        <div class="wrap">
            <input type="hidden" id="statsCurrentTab" name="statsCurrentTab" value="0"/>
            <div style="float:left; width:40px; height:40px; margin:10px 10px 20px 0px;"><img src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/plugin-icon/apsw-settings-icon.png'); ?>" style="width:48px;"/></div> <h2><?php _e('Author &amp; Post Statistic Widgets Settings', APSW_Core::$text_domain); ?></h2>
            <br style="clear:both" />

            <?php include 'layouts/go-to-pro.php'; ?>

            <form action="<?php echo admin_url(); ?>admin.php?page=<?php echo $this->apsw_options_serialized->apsw_options_page_slug; ?>&updated=true" method="post" name="<?php echo $this->apsw_options_serialized->apsw_options_page_slug; ?>">

                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('stats_options_form');
                }
                ?>
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php _e('General', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-2"><?php _e('Active Users', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-3"><?php _e('Popular Posts', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-4"><?php _e('View counter for posts', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-5"><?php _e('Styles', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-6"><?php _e('Reset Statistics', APSW_Core::$text_domain); ?></a></li>
                        <li><a href="#tabs-7"><?php _e('Support', APSW_Core::$text_domain); ?></a></li>
                    </ul>

                    <?php
                    include 'layouts/settings-general.php';
                    include 'layouts/settings-active-users.php';
                    include 'layouts/settings-popular-posts.php';
                    include 'layouts/settings-view-counter.php';
                    include 'layouts/settings-styles.php';
                    include 'layouts/settings-reset-statistics.php';
                    include 'layouts/support.php';
                    ?>
                    <div style="display: none;">
                        <div id="response_info" >
                            <img width="100" height="100" src="<?php echo plugins_url(APSW_Core::$PLUGIN_DIRECTORY . '/files/img/loader/ajax-loader-200x200.gif'); ?>" />
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
                            loadTheme: "<?php echo $this->apsw_options_serialized->active_theme_name; ?>",
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