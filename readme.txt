=== Read a Poem - Month by Month ===
Contributors:  dandelionweb, ankitpokhrel
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JEMTB4U8SYFL6
Tags: poem, poetry, month, shortcode, custom post type, dynamic, quotes, writer
Requires at least: 3.0
Tested up to: 4.2.2
Stable tag: trunk
Version: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use this plugin to display dynamic fresh post content (poems) each month. Could be used for inspirational quotes or any monthly message. 

== Description ==

Read a Poem - Month by Month is a simple way to display fresh website content to site visitors every month. The plugin can be used for any post content, you aren't restricted to poems.

Add your poems to the Read a Poem post entry. Enter 12 poems and then assign them to a month. Add the shortcode to a page to display a different poem each month.

* Use the shortcode [poem-current] to display a different poem each month
* Use the shortcode [poem id=XXX] to display a specific poem
* Shortcodes can be used in a page, post, or a text widget
* Developers can add do_shortcode('[poem-current]') to their templates

If you like this plugin please rate it on WordPress.org

= Donations: =
I appreciate all donations, no matter the size. Further development of this plugin is not contingent on donations, but they are a nice incentive. To donate click on the "donate to this plugin" link in the sidebar below the Authors.

== Installation ==

1. Install via the WordPress.org plugin directory or by uploading the read-a-poem folder to the /wp-content/plugins directory 

2. Activate the plugin through the Plugins menu in WordPress

3. Add your poem in the new 'Read a Poem' custom post type section of the admin.

4. To display a given poem on a page/post in your site -- go to the "All Poems" screen and copy the poem's shortcode [poem id=XXX]. Paste the shortcode into your site where you want to display your poem.

5. To cycle through and display a different poem each month.... 
  * begin by adding 12 poems to the Read a Poem post type
  * then go to Assign to Month and designate which poem is to be displayed each month
  * Add the shortcode [poem-current] to a page

6. DEVELOPERS: include echo do_shortcode("[poem-current]"); in the template where you want the poems to display.

== Frequently Asked Questions ==

= Can this plugin display monthly content other than poetry? =
Yes! The custom post type is called Read a Poem but you can use it for any content that you want to change on a month by month basis.

= What shortcodes do I use for this plugin? =

1. From the All Poems page you can grab the poem's shortcode - go to the "All Poems" screen and copy the poem's shortcode [poem id=XXX]  id=XXX will be the specific id number for your poem.
2. [poem-current] will display the poem assigned to the current month

= Does the plugin provide a widget? =

No, just use the appropriate shortcode in a text widget. If your theme doesn't support shortcodes in widgets, use the Black Studio TinyMCE Widget plugin and place the shortcode in a visual editor widget.

= How do I include Read a Poem in a page template? =
include echo do_shortcode("[poem-current]"); in the template where you want the poems to display.

= Can I see a Demo of this plugin in action? =
The plugin was written for use here http://dsmartin.ca/read-a-poem/

== Screenshots ==

1. Install and activate the plugin.  Then navigate to the new "Read a Poem" custom post type in the admin. 

2. Each poem can be displayed using the shortcode provided on the "All Poems" page

3. Assign a poem to a month then use the shortcode [poem-current] 

== Upgrade Notice ==

= 1 =
* Initial Release

== Changelog ==

= 1 =
* Initial release