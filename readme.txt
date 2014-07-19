=== Read a Poem - Month by Month ===
Contributors:  dandelionweb, ankitpokhrel
Tags: poem, poetry, month, rotating content, cycling content, custom post type
Requires at least: 3.0
Tested up to: 3.9.1
Stable tag: trunk
Version: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use this plugin to display different post content (poems) each month.

== Description ==

Use this plugin to display content that changes every month. This plugin creates a 'poem' custom post type. Use a shortcode to display a poem on a page or to cycle through a series of posts to display a different poem each month.

* Use the shortcode [poem-current] to display the poem for the given month on a page
* Use the shortcode [poem id=XXX] to display a poem in a pag.
* Developers can add do_shortcode('[poem-current]') to their templates.

If you like this plugin please rate it on WordPress.org


== Installation ==

1. Upload read-a-poem folder to the /wp-content/plugins directory 

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