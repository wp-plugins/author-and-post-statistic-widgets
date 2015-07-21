=== Author and Post Statistic Widgets ===

Contributors: gVectors Team
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=U22KJYA4VVBME
Tags: popular authors widget, popular post widget, author widget, post widget, author activity, statistics, statistic widget, post statistic, post views, author, post, widget, author posts, author comments, user activity, popular posts, popular authors
Requires at least: 2.7.0
Tested up to: 4.2.2
Stable tag: 1.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

APSW is an easy solution to display authors' activity and popular posts with statistic information in sidebar widgets. 

== Description ==

APSW is an easy solution to display authors' activity and popular posts statistic information in sidebar widgets. This plugin comes with many smart widgets, which show adaptive statistic information depended on current page.

= Features =
* | Free | Widget - Author & Popular Post Statistics
* | Free | Widget - Popular Authors ( limited by from/to dates )
* | Free | Widget - Popular Authors ( for current and last day, week, month, year... )
* | Free | Widget - Popular Posts ( limited by from/to dates )
* | Free | Widget - Popular Posts ( for current and last day, week, month, year... )
* | Free | Page views statistic under post content
* | Free | Dashboard: General Settings
* | Free | Dashboard: Popular Authors Widget Settings
* | Free | Dashboard: Popular Posts Widget Settings
* | Free | Dashboard: Widget Styles Settings
* | Free | Dashboard: Reset Statistics
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab1) | Dashboard: Own Published Posts Graphical Statistic
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab2) | Dashboard: Own Posts' Views Graphical Statistic
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab3) | Dashboard: Own Posts Popularity Graphical Statistic
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab4) | Dashboard: Own Posts' Readers Graphical Statistic by Countries
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab5) | Dashboard: If you're the admin, there is also a statistic for all authors activity and posts popularity


**WIDGET - Author & Popular Post Statistics** :
This is a smart widget with two tabs | Author(s) | and | Posts |, which show different statistic information on different pages, there are two cases: 

**If you're on a single post page**: 

* In | Author | tab it displays current post's author avatar, name and his(her) posting activity statistic:
* In | Posts  | tab it displays current author's most popular posts' titles with number of views or comments.

**If you're on non-single post page**:

* In | Author | tab it displays in tab a list of most active authors with number of published posts
* In | Posts | tab it displays most popular post titles with number of views and comments.

**WIDGET - Popular Authors**:  This widget only shows most popular author names with number of published posts.

**WIDGET - Popular Posts**:  This widget only shows most popular post titles with number of views or comments.

= DASHBOARD =

**Menu: Dashboard > Statistic Widgets**

Here you can manage all widgets. There are 5 tabs with widget settings options:

1. General Settings:
    * Show author and post statistics in - Tabs or Separate blocks
    * Create statistic for post types - Posts, Pages, etc...co
2. Popular Authors Widget Settings:
    * Display Author Full Name - yes/no
    * Display Author Avatar - yes/no
    * Show popular author by posts - Count, Views or Comments
    * Number of popular authors on widgets
3. Popular Posts Widget Settings:
    * Show popular posts by number of views or comments
    * Number of popular posts on widgets
    * View counter for posts - this is the logic of counting post readers, this can be counted based on IP (one time per day) or just based on number of visits (Page Reload) on post page.
4. Widget Styles Settings:
    * Because of the Author & Post Statistic Widget use jQuery Ui, it has a lot of styles and you can choose which style should be used on displaying this widget.
    * Also you can insert custom CSS
5. Reset Statistics:
    * Here you can remove all statistic information or for certain time period.

**Menu: Users > User Statistics**


== Installation ==

1. Activate plugin.
2. Go to Dashboard -> Appearance -> Widgets to add/remove APSW Widgets
3. Go to Dashboard -> Statistic Widgets to manage widget settings.

== Screenshots ==

1.  Author and post statistic widget (Author View) Screenshot #1
2.  Author and post statistic widget (Posts View) Screenshot #2
3.  General Widget - Popular Posts Screenshot #3
4.  General Widget - Popular Authors Screenshot #4
5.  General Widget - Popular Posts Screenshot #5
6.  General Widget - Popular Authors Screenshot #6
7.  General Widget Settings - Popular Authors and Posts Screenshot #7
8.  Dynamic Widget Settings - Popular Authors and Posts Screenshot #8
9.  Page views statistic under post content #9
10. Graphical Statistic for Own and All Popular Posts, Popular Posts tab Screenshot #8

== Frequently Asked Questions ==

= APSW Template tags ( Free & Pro Versions ) =

You can use these template tags add statistic information directly in template files.


**Displays Popular Users and Posts widget**
`
<?php apsw_pu_widget() ?> 
`

**Displays popular posts statistics for certain date period**
`
<?php apsw_pp_static_date_widget($from, $to) ?>
`
Example: `apsw_pp_static_date_widget('2014-01-16', '2015-01-16')`

**Displays most active users statistic for certain date period**
`
<?php apsw_au_static_date_widget($from, $to) ?> 
`
Example: `apsw_au_static_date_widget('2014-01-16', '2015-01-16')`

**Display popular posts list for last X days**
`
<?php apsw_pp_dynamic_date_widget($last) ?> 
`
Options:

* set $last = 1 to display popular posts for yesterday
* set $last = 7 to display popular posts for past week
* set $last = 30 to display popular posts for past month
* set $last = 0 to display popular posts for current day
* set $last = -1 or empty to display popular posts for all time

**Displays popular authors list for last X days**
`
<?php apsw_pa_dynamic_date_widget($last = -1) ?> 
`
Options:

* set $last = 1 to display popular authors for yesterday
* set $last = 7 to display popular authors for past week
* set $last = 30 to display popular authors for past month
* set $last = 0 to display popular authors for current day
* set $last = -1 or empty to display popular authors for all time


= APSW Shortcodes | Graphical Statistic ( Pro Version ) =

You can use these shortcodes to display different statistic information directly on posts and pages.

`
[apsw_postviews last="7" user="21"] 
`
**Displays post views of certain user for certain date period.**

* "last" - the number of past days
* If this attribute is not set, it displays post views for all time.
* If this attribute is set "0", it displays post views for current day.
* "user" - user id
* If this attribute is not set this shortcode displays current logged in users' post views statistic

`
[apsw_postcount last="7" user="21"] 
`
**Displays posts count of certain user for certain date period.**

* "last" - the number of past days
* If this attribute is not set, it displays posts count for all time.
* If this attribute is set "0", it displays posts count for current day.
* "user" - user id
* If this attribute is not set this shortcode displays current logged in users' posts count statistic

`
[apsw_popularpost last="7" user="21" by="comments"] 
`
**Displays popular posts of certain user for certain date period based on post comments or views.**

* "last" - the number of past days
* If this attribute is not set, it displays popular posts for all time.
* If this attribute is set "0", it displays popular posts for current day.
* "user" - user id
* If this attribute is not set, it displays current logged in users' popular posts statistic
* "by" - the base for counting and choosing popular posts ( values: "comments" or "views" )
* If this attribute is not set, it takes "comments" as a base.

`
[apsw_activeusers last="7" by="posts"] 
`
**Displays most active users statistic for certain date period based on users' posts, comments, or posts' views.**

* "last" - the number of past days
* If this attribute is not set, it displays active users for all time.
* If this attribute is set "0", it displays active users for current day.
* "by" - the base for counting and choosing active users ( values: "comments", "post counts" or "views" )
* If this attribute is not set, it takes "comments" as a base.

`
[apsw_visitors last="7" user="21"] 
`
**Displays number of posts visitors (with countries) for certain users posts.**

* "last" - the number of past days
* If this attribute is not set, it displays visitors for all time.
* If this attribute is set "0", it displays visitors for current day.
* "user" - user id
* If this attribute is not set, it displays current logged in users' posts visitors statistic


= Also Please Check the Following Resources =
* Plugin Page: <http://www.gvectors.com/author-and-post-statistic-widgets/>
* Support Forum: <http://gvectors.com/questions/>

== Changelog ==

= 1.5.0 =
Fixed Bug: Posts' incorrect daily views count

= 1.4.9 =
Fixed Bug: Compatibility with WordPress 4.2 version

= 1.4.8 =
Fixed Bug: Invalid argument issue in "Author & Post" Widget

= 1.4.7 =
* Added: Template Tags to locate widget information in template files
`
function apsw_pp_static_date_widget($from, $to)
function apsw_au_static_date_widget($from, $to)
function apsw_pu_widget()
function apsw_pp_dynamic_date_widget($last = -1)
function apsw_pa_dynamic_date_widget($last = -1)
`
* Added: Option to hide/show custom html fields on widget settings area
* Fixed Bug: Issues with unicode characters

= 1.4.6 =
* Fixed Bug: Ultimate Member Integration problem on WEB Servers w/o DomObject support

= 1.4.5 =
* Changed: jQuery UI widget tabs to better and modern tab layout 
* Changed: jQuery UI admin section tabs to better and modern tab layout 
* Added: Integration with User Profile Plugins
	- BuddyPress, Ultimate Member, Users Ultra, UserPro

= 1.4.4 =
* Fixed Bug: Invalid argument issue for post types

= 1.4.3 =
* Added: Button in options page to reset APSW options

= 1.4.2 =
* Fixed Bug: serialize/unserialize Warning issue

= 1.4.1 =
* Added: "Settings" link on plugins page
* Changed: "Popular Authors" widget to "Active Users" widget
* Changed: "Active Users" logic by "comments count"
* Changed: "Simple Tabs" option ON by default

= 1.4.0 =
* Added: General Widget for Popular Authors with dynamic period of stat date
* Added: General Widget for Popular Posts with dynamic period of stat date
* Added: Widget display settings for custom post types
* Added: "Page Views" statistic information under post content
* Added: Language translation support with .mo and .po files
* Fixed Bug: Correction with some statistic information and incomplete cat/post lists

= 1.3.2 =
* Fixed Bug: Problem with "Popular Authors" widget on Wordpress multi-sites

= 1.3.1 =
* Fixed Bug: Problem with options page redirection on Wordpress multi-sites

= 1.3.0 =
Added: Public functions to show statistics directly from template file

= 1.2.0 =
Added: Simple tabs for widgets on front-end

= 1.1.1 =
Matching Wordpress 4.0 Standards

= 1.0.0 =
Initial version