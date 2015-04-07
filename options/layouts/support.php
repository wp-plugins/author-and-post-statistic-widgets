<div>
    <table class="form-table">
        <tbody>
            <tr>
                <td align="center" colspan="2"  style="text-align:left">
                    
                    <h3 style="padding-top:0px; margin-top:1px;">APSW Template tags ( Free &amp; <a href="http://www.gvectors.com/author-and-post-statistic-widgets/" style="text-decoration:none;">Pro</a> Versions )</h3>
                    <p style="font-size:15px;">You can use these template tags add statistic information directly in template files.</p>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;&lt;?php apsw_pu_widget() ?&gt;&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays Popular Users and Posts widget</h4>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;&lt;?php apsw_pp_static_date_widget($from, $to) ?&gt;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays popular posts statistics for certain date period</h4>
                    Example: <code>apsw_pp_static_date_widget('2014-01-16', '2015-01-16')</code>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;&lt;?php apsw_au_static_date_widget($from, $to) ?&gt;&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays most active users statistic for certain date period</h4>
                    Example: <code>apsw_au_static_date_widget('2014-01-16', '2015-01-16')</code>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;&lt;?php apsw_pp_dynamic_date_widget($last) ?&gt;&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Display popular posts list for last X days</h4>
                    Options:
                    <ul>
                    <li>set $last = 1   to display popular posts for yesterday</li>
                    <li>set $last = 7   to display popular posts for past week</li> 
                    <li>set $last = 30  to display popular posts for past month</li>
                    <li>set $last = 0   to display popular posts for current day</li>
                    <li>set $last = -1  or empty to display popular posts for all time</li>
                    </ul>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;&lt;?php apsw_pa_dynamic_date_widget($last = -1) ?&gt;&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays popular authors list for last X days</h4>
                    Options:
                    <ul>
                    <li>set $last = 1  to display popular authors for yesterday</li>
                    <li>set $last = 7  to display popular authors for past week </li>
                    <li>set $last = 30 to display popular authors for past month</li>
                    <li>set $last = 0  to display popular authors for current day</li>
                    <li>set $last = -1 or empty to display popular authors for all time</li>
					</ul>
                    
                    <br />

                    <h3>APSW Shortcodes ( <a href="http://www.gvectors.com/author-and-post-statistic-widgets/" style="text-decoration:none;">Pro</a> Version )</h3>
                    <p style="font-size:15px;">You can use these shortcodes to display different statistic information directly on posts and pages.</p>
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;[apsw_postviews last="7" user="21"]&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays post views of certain user for certain date period.</h4>
                    <strong>"last"</strong> - the number of past days<br />
                    If this attribute is not set, it displays post views for all time.<br />
                    If this attribute is set "0", it displays post views for current day.<br />
                    <strong>"user"</strong> - user id<br />
                    If this attribute is not set this shortcode displays current logged in users' post views statistic<br />
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;[apsw_postcount last="7" user="21"]&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays posts count of certain user for certain date period.</h4>
                    <strong>"last"</strong> - the number of past days<br />
                    If this attribute is not set, it displays posts count for all time.<br />
                    If this attribute is set "0", it displays posts count for current day.<br />
                    <strong>"user"</strong> - user id<br />
                    If this attribute is not set this shortcode displays current logged in users' posts count statistic<br />
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;[apsw_popularpost last="7" user="21" by="comments"]&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays popular posts of certain user for certain date period based on post comments or views.</h4>
                    <strong>"last"</strong> - the number of past days<br />
                    If this attribute is not set, it displays popular posts for all time.<br />
                    If this attribute is set "0", it displays popular posts for current day.<br />
                    <strong>"user"</strong> - user id<br />
                    If this attribute is not set, it displays current logged in users' popular posts statistic<br />
                    <strong>"by"</strong> - the base for counting and choosing popular posts ( values: "comments" or "views" )<br />
                    If this attribute is not set, it takes "comments" as a base.<br />
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;[apsw_activeusers last="7" by="posts"]&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays most active users statistic for certain date period based on users' posts, comments, or posts' views.</h4>
                    <strong>"last"</strong> - the number of past days<br />
                    If this attribute is not set, it displays active users for all time.<br />
                    If this attribute is set "0", it displays active users for current day.<br />
                    <strong>"by"</strong> - the base for counting and choosing active users ( values: "comments", "post counts" or "views" )<br />
                    If this attribute is not set, it takes "comments" as a base.<br />
                    
                    <pre style="border:1px dotted #009900; margin:20px 0px 5px 0px; padding:5px 10px; display:table; line-height:25px; color:#009900;">&nbsp;[apsw_visitors last="7" user="21"]&nbsp;</pre>
                    <h4 style="padding-top:1px; margin-top:1px; margin-bottom:5px;">Displays number of posts visitors (with countries) for certain users posts.</h4>
                    <strong>"last"</strong> - the number of past days<br />
                    If this attribute is not set, it displays visitors for all time.<br />
                    If this attribute is set "0", it displays visitors for current day.<br />
                    <strong>"user"</strong> - user id <br />
                    If this attribute is not set, it displays current logged in users' posts visitors statistic<br />
                    
                    
                    <br />
                    
                    <h3>Need Help?</h3>
                    <p>
                        If you need help with this plugin or if you want to make a suggestion, then please visit to our support Q&amp;A forum.
                        <a href="http://www.gvectors.com/questions/" class="button button-primary" target="_blank">gVectors Support Forum</a>
                    </p>
            </tr>
        </tbody>
    </table>    
</div>