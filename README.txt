=== WP-PlugIM ===
Contributors: Michelle MacPhearson
Donate link: http://www.michellemacphearson.com/
Tags: plugim, votebox, widget, social bookmarking, vote, submit, digg
Requires at least: 2.0.2
Tested up to: 2.9
Stable tag: 1.0.3

Adds a "Plug This" button to your blog posts so people can vote for you dynamically (never leaving your site) at PlugIM.com.  Allows custom configuration of votebox position on your blog.

== Installation ==

METHOD A: Easy as Pie Automatic Addition to Your Blog
1. Upload `wp-plugim.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Done!  The PlugIM votebox will appear on your posts automagically!
4. You can head on over to your "Options" ---> "PlugIM Options" panel and select a customer position if you'd like.

METHOD B: Insert PlugIM Votebox at a particular point in a post (not on every post)
1. Upload `wp-plugim.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert <!--plugim--> in any part of the post where you want the PlugIM box to appear. You must do this via the "Code" editor, not the visual editor.

METHOD C:  Insert the PlugIM votebox automatically on every post at a particular point in the "loop"
1. Upload `wp-plugim.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Insert <?php show_plugimbox(); ?> wherever you'd like the votebox to appear, within the Wordpress "loop."

== Frequently Asked Questions ==

= Do I need to be a member of PlugIM to use this? =

No, you do not, although membership is free and allows you to auto-submit new blog posts via RSS.