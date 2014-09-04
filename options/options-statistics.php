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
            $this->options->is_display_author_name = $_POST['is_display_author_name'];
            $this->options->is_display_author_avatar = $_POST['is_display_author_avatar'];
            $this->options->is_author_popular_by_post_count = $_POST['is_author_popular_by_post_count'];
            $this->options->is_popular_posts_by_post_views = $_POST['is_popular_posts_by_post_views'];
            $this->options->popular_authors_limit = $_POST['popular_authors_limit'];
            $this->options->is_post_view_by_ip = $_POST['is_post_view_by_ip'];
            $this->options->popular_posts_limit = $_POST['popular_posts_limit'];
            $this->options->active_theme_name = $_POST['active_theme_name'];
            $this->options->custom_css = $_POST['custom_css'];

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

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $this->options->stats_option_page_slug; ?>&updated=true" method="post" name="<?php echo $this->options->stats_option_page_slug; ?>">

                <?php
                if (function_exists('wp_nonce_field')) {
                    wp_nonce_field('stats_options_form');
                }
                ?>
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1"><?php _e('General', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-2"><?php _e('Popular Authors', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-3"><?php _e('Popular Posts', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-4"><?php _e('View counter for posts', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-5"><?php _e('Styles', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-6"><?php _e('Reset Statistics', 'statistics_info'); ?></a></li>
                        <li><a href="#tabs-7"><?php _e('Support', 'statistics_info'); ?></a></li>
                    </ul>
                    <div id="tabs-1">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">
                                        Show author and post statistics in:
                                    </th>
                                    <td>                                
                                        <label>
                                            <input type="radio" <?php checked($this->options->is_stats_together == '1') ?> value="1" name="is_stats_together" id="is_stats_tabbed" />
                                            <span>Tabs</span>
                                        </label><br/>
                                        <label>
                                            <input type="radio" <?php checked($this->options->is_stats_together == '2') ?> value="2" name="is_stats_together" id="is_stats_separate" />
                                            <span>Separate blocks</span>
                                        </label>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        Create statistic for post types:
                                    </th>
                                    <td>                                
                                        <?php
                                        foreach ($this->post_types as $post_type) {
                                            ?>
                                            <label for="<?php echo $post_type ?>">
                                                <input type="checkbox" <?php checked(in_array($post_type, $this->options->post_types)); ?> value="<?php echo $post_type; ?>" name="post_types[]" id="<?php echo $post_type; ?>" />
                                                <span><?php echo $post_type; ?></span>
                                            </label><br/>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <div id="tabs-2">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">
                                        Display Author Full Name:
                                    </th>
                                    <td>                                
                                        <label for="is_display_author_name">
                                            <input type="checkbox" <?php checked($this->options->is_display_author_name == '1') ?> value="<?php echo $this->options->is_display_author_name; ?>" name="is_display_author_name" id="is_display_author_name" />
                                        </label>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">
                                        Display Author Avatar:
                                    </th>
                                    <td>                                
                                        <label for="is_display_author_avatar">
                                            <input type="checkbox" <?php checked($this->options->is_display_author_avatar == '1') ?> value="<?php echo $this->options->is_display_author_avatar; ?>" name="is_display_author_avatar" id="is_display_author_avatar" />
                                        </label>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">Show popular author by posts:</th>
                                    <td>
                                        <fieldset>
                                            <?php
                                            $is_author_popular_by_post_count = $this->options->is_author_popular_by_post_count;
                                            ?>
                                            <label title="by posts count">
                                                <input type="radio" value="1" <?php checked('1' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_count" class=""/> 
                                                <span>Count</span>
                                            </label><br>
                                            <label title="by posts view">
                                                <input type="radio" value="2" <?php checked('2' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_post_view_count" class="" /> 
                                                <span>Views</span>
                                            </label><br>
                                            <label title="by posts comments count">
                                                <input type="radio" value="3" <?php checked('3' == $is_author_popular_by_post_count); ?> name="is_author_popular_by_post_count" id="author_popular_by_posts_comments_count" class="" /> 
                                                <span>Comment Count</span>
                                            </label><br>
                                        </fieldset>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th scope="row">Popular authors limit: </th>
                                    <td>
                                        <fieldset>
                                            <?php
                                            $popular_authors_limit = $this->options->popular_authors_limit;
                                            ?>
                                            <label title="How many popular authors display in widget">
                                                <input type="text" value="<?php echo $popular_authors_limit; ?>" name="popular_authors_limit" id="popular_authors_limit" class=""/>                                        
                                            </label><br>                                   
                                        </fieldset>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tabs-3">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">Show popular posts by: </th>
                                    <td>
                                        <fieldset>
                                            <?php
                                            $is_popular_posts_by_post_views = $this->options->is_popular_posts_by_post_views;
                                            ?>
                                            <label title="by post views">
                                                <input type="radio" value="1" <?php checked('1' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_views" class=""/> 
                                                <span>Views</span>
                                            </label><br>
                                            <label title="by post comments count">
                                                <input type="radio" value="2" <?php checked('2' == $is_popular_posts_by_post_views); ?> name="is_popular_posts_by_post_views" id="posts_popular_by_post_comments" class="" /> 
                                                <span>Comment Count</span>
                                            </label><br>                                    
                                        </fieldset>
                                    </td>
                                </tr>                        

                                <tr valign="top">
                                    <th scope="row">Popular posts limit: </th>
                                    <td>
                                        <fieldset>
                                            <?php
                                            $popular_posts_limit = $this->options->popular_posts_limit;
                                            ?>
                                            <label title="How many popular posts display in widget">
                                                <input type="text" value="<?php echo $popular_posts_limit; ?>" name="popular_posts_limit" id="popular_posts_limit" class=""/>                                        
                                            </label><br>                                   
                                        </fieldset>
                                    </td>
                                </tr>                              
                            </tbody>
                        </table>
                    </div>
                    <div id="tabs-4">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row">Count post view by: </th>
                                    <td>
                                        <fieldset>
                                            <?php
                                            $is_post_view_by_ip = $this->options->is_post_view_by_ip;
                                            ?>
                                            <label title="by ip">
                                                <input type="radio" value="1" <?php checked('1' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_ip" class=""/> 
                                                <span>IP (for each day)</span>
                                            </label><br>
                                            <label title="by page reload">
                                                <input type="radio" value="2" <?php checked('2' == $is_post_view_by_ip); ?> name="is_post_view_by_ip" id="is_post_view_by_page_reload" class="" /> 
                                                <span>Page Reload</span>
                                            </label><br>                                    
                                        </fieldset>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tabs-5">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Jquery UI CSS Theme: ', Statistic_Info::$text_domain); ?></th>
                                    <td>
                                        <label for="switcher">
                                            <div id="switcher" style="display: inline-block;"></div>
                                            <input type="hidden" name="active_theme_name" id="stats_active_theme" value=""/>
                                        </label>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><?php _e('Custom CSS to include in header: ', Statistic_Info::$text_domain); ?></th>
                                    <td>
                                        <label for="custom_css">
                                            <textarea cols="50" rows="10" placeholder="<?php _e('Write here your css to include in header: ', Statistic_Info::$text_domain); ?>" id="custom_css" class="custom_css_area" name="custom_css"><?php echo $this->options->custom_css; ?></textarea>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="tabs-6">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th colspan="4" scope="col"><h2><?php _e('Delete Statistics', Statistic_Info::$text_domain); ?></h2></th>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <fieldset>
                                        <label for="from" title="<?php _e('From Date', Statistic_Info::$text_domain); ?>">
                                            <span><?php _e('From Date:', Statistic_Info::$text_domain); ?></span>
                                            <input type="text" class="fromdate" id="from" name="from" placeholder="<?php _e('Example: 2014-06-25 (Y-m-d)', Statistic_Info::$text_domain); ?>" />
                                        </label>

                                        <label for="to" title="<?php _e('To Date', Statistic_Info::$text_domain); ?>">
                                            <span><?php _e('To Date:', Statistic_Info::$text_domain); ?></span>
                                            <input type="text" class="todate" id="to" name="to" placeholder="<?php _e('Example: 2014-07-25 (Y-m-d)', Statistic_Info::$text_domain); ?>"/>
                                        </label>
                                        <label>
                                            <span><?php _e('Delete All Statistics', Statistic_Info::$text_domain); ?></span>
                                            <input type="checkbox" id="stats_all" name="all" value="0"/>
                                        </label>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <label>
                                        <input class="button button-secondary" type="button" value="Delete" id="delete_stats_between_dates" />
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                        </table>                        
                    </div>
                    <div id="tabs-7">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <td align="center" colspan="2"  style="text-align:left">
                                        <h3>Need Help?</h3>
                                        <p>If you need help with this plugin or if you want to make a suggestion, then please visit to our support Q&amp;A forum.
                                            <a href="http://www.gvectors.com/questions/" class="button button-primary" target="_blank">gVectors Support Forum</a></p>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div style="display: none;">
                        <div id="response_info" >
                            <img width="100" height="100" src="<?php echo plugins_url('author-and-post-statistic-widgets/files/img/loader/ajax-loader-200x200.gif'); ?>" />
                        </div>
                    </div>
                </div>


                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        var statsCurrentTab = $.cookie('statsCurrentTab');
                        if (statsCurrentTab == null) {
                            statsCurrentTab = $('#statsCurrentTab').val();
                            $.cookie('statsCurrentTab', statsCurrentTab, {expires: 7});
                        }
                        $("#tabs").tabs({active: statsCurrentTab});

                        $('#tabs a').click(function(e) {
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

                        $(function() {
                            $("#from").datepicker({
                                dateFormat: 'yy-mm-dd',
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1,
                                onClose: function(selectedDate) {
                                    $("#to").datepicker("option", "minDate", selectedDate);
                                }
                            });
                            $("#to").datepicker({
                                dateFormat: 'yy-mm-dd',
                                defaultDate: "+1w",
                                changeMonth: true,
                                numberOfMonths: 1,
                                onClose: function(selectedDate) {
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