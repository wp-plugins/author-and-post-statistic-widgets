=== Author and Post Statistic Widgets ===

Contributors: gVectors Team

Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=U22KJYA4VVBME

Tags: popular authors widget, popular post widget, author widget, post widget, author activity, statistics, statistic widget, post statistic, post views, author, post, widget, author posts, author comments, user activity, popular posts, popular authors

Requires at least: 2.7.0

Tested up to: 4.0

Stable tag: 1.3.0

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html

APSW is an easy solution to display authors' activity and popular posts with statistic information in sidebar widgets. 

== Description ==

APSW is an easy solution to display authors' activity and popular posts statistic information in sidebar widgets. This plugin comes with many smart widgets, which show adaptive statistic information depended on current page.

= Features =
* | Free | Widget - Author & Popular Post Statistics
* | Free | Widget - Popular Authors
* | Free | Widget - Popular Posts
* | Free | Dashboard: General Settings
* | Free | Dashboard: Popular Authors Widget Settings
* | Free | Dashboard: Popular Posts Widget Settings
* | Free | Dashboard: Widget Styles Settings
* | Free | Dashboard: Reset Statistics
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab1) | Dashboard: Own Published Posts Statistic
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab2) | Dashboard: Own Posts' Views Statistic
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab3) | Dashboard: Own Posts Popularity Statistic by Views and Comments
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab4) | Dashboard: Own Posts' Readers Statistic by Countries
* | [Pro](http://www.gvectors.com/author-and-post-statistic-widgets/#tab5) | Dashboard: If you're the admin, there is also a statistic for all authors activity and posts popularity

Also you can locate APSW widget content in any place of your template files using these functions:
* `<?php function show_stats_post($from, $to) ?>` - Displays post stat for certain period of time ($from and $to are dates)
* `<?php function show_stats_author($from, $to) ?>` - Displays author stat for certain period of time ($from and $to are dates)
* `<?php function show_stats() ?>` - Displays full statistic info for authors and posts.

**WIDGET - Author & Popular Post Statistics** :
This is a smart widget with two tabs | Author(s) | and | Posts |, which shows different statistic information on different pages, there are two cases: 

**If you're on a single post page**: 

In | Author | tab it displays current post's author avatar, name and his(her) posting activity statistic:
- Total Posts
- Total Comments
- Total Categories
- Number of posts in different categories

And in | Posts | tab it displays current author's most popular posts' titles with number of views or comments.

**If you're on non-single post page**, for example you're on category page, 

* In | Author | tab it displays in tab a list of most active authors with number of published posts
* In | Posts | tab it displays most popular post titles with number of views and comments.

**WIDGET - Popular Authors** :  
This widget only shows most popular author names with number of published posts.

**WIDGET - Popular Posts** : 
This widget only shows most popular post titles with number of views or comments.

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

1.  Author and post statistic widget on non-single post page Screenshot #1
2.  Popular authors and posts widgets Screenshot #2
3.  Author and post statistic widget on single post page, Author tab Screenshot #3
4.  Author and post statistic widget on single post page, Posts tab Screenshot #4
5.  Author and post statistic widget on non-single post page, Posts tab Screenshot #5
6.  Author and post statistic widget on non-single post page, Authors tab Screenshot #6
7.  Dashboard Settings Page, Style tab Screenshot #7
8.  Graphical Statistic for Own and All Popular Posts, Popular Posts tab Screenshot #8
9.  Graphical Statistic of Post Readers by Countries, Visitors per Country tab Screenshot #9

== Frequently Asked Questions ==

= Please Check the Following Resources =
* Plugin Page: <http://www.gvectors.com/author-and-post-statistic-widgets/>
* Support Forum: <http://gvectors.com/questions/>

== Changelog ==

= 1.3.0 =
Added public functions to show statistics 

= 1.2.0 =
Added simple tabs for widgets

= 1.1.1 =
Matching Wordpress 4.0 Standards

= 1.0.0 =
Initial version