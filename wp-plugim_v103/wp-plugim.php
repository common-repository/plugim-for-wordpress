<?php

/*

Plugin Name: WP PlugIM
Version: 1.0.3
Plugin URI: http://www.michellemacphearson.com
Description: Adds PlugIM button to your WordPress blog posts.
Usage: Three ways to configure

    Basic : By choosing the options under the options menu
    Intermediate: By calling the show_plugimbox() method in the theme tempalate inside the LOOP.
    Advanced: By inserting <!--plugim--> in any part of the post where you want the PlugIM box to appear.

Author: Michelle MacPhearson
Author URI: http://www.michellemacphearson.com
*/

$message = "";

if (!function_exists('smpim_request_handler')) {
    function smpim_request_handler() {
        global $message;

        if ($_POST['sm_action'] == "update options") {
            $smpim_align_v = $_POST['smpim_align_sl'];

    		if(get_option("smpim_box_align")) {
    			update_option("smpim_box_align", $smpim_align_v);
    		} else {
    			add_option("smpim_box_align", $smpim_align_v);
    		}

            $message = '<br clear="all" /> <div id="message" class="updated fade"><p><strong>Option saved. </strong></p></div>';
        }
    }
}

if(!function_exists('smpim_add_menu')) {
    function smpim_add_menu () {
        add_options_page("PlugIM Option", "PlugIM Option", 8, basename(__FILE__), "smpim_displayOptions");
    }
}

if (!function_exists('smpim_displayOptions')) {
    function smpim_displayOptions() {

        global $message;
        echo $message;

		print('<div class="wrap">');
		print('<h2>PlugIM Options</h2>');

        print ('<form name="smpim_form" action="'. get_bloginfo("wpurl") . '/wp-admin/options-general.php?page=wp-plugim.php' .'" method="post">');
?>

		<p>Align:
        <select name="smpim_align_sl" id="smpim_align_sl">
			<option value="Top Left"   <?php if (get_option("smpim_box_align") == "Top Left") echo " selected"; ?> >Top Left</option>
			<option value="Top Right"   <?php if (get_option("smpim_box_align") == "Top Right") echo " selected"; ?> >Top Right</option>
			<option value="Bottom Left"  <?php if (get_option("smpim_box_align") == "Bottom Left") echo " selected"; ?> >Bottom Left</option>
			<option value="Bottom Right"  <?php if (get_option("smpim_box_align") == "Bottom Right") echo " selected"; ?> >Bottom Right</option>
			<option value="None"  <?php if (get_option("smpim_box_align") == "None") echo " selected"; ?> >None</option>
		</select><br /><br /> </p>

<?php
		print ('<p><input type="submit" value="Save &raquo;"></p>');
		print ('<input type="hidden" name="sm_action" value="update options" />');
		print('</form></div>');

    }
}


if (!function_exists('smpim_plugimhtml')) {
	function smpim_plugimhtml($float) {
		global $wp_query;
		$post = $wp_query->post;
		$permalink = get_permalink($post->ID);
        $title = urlencode($post->post_title);
		$plugimhtml = <<<CODE

    <span style="margin: 0px 6px 0px 0px; float: $float;">

	<script type="text/javascript">
	plugim_url = "$permalink";
	plugim_title = "$title";
	</script>
	<script src="http://www.plugim.com/tools/plugthis.js" type="text/javascript"></script>
	</span>
CODE;
	return  $plugimhtml;
	}
}

if (!function_exists('smpim_addbutton')) {
	function smpim_addbutton($content) {

		if ( !is_feed() && !is_page() && !is_archive() && !is_search() && !is_404() ) {
    		if(! preg_match('|<!--plugim-->|', $content)) {
    		    $smpim_align = get_option("smpim_box_align");
    		    if ($smpim_align) {
                    switch ($smpim_align) {
                        case "Top Left":
        		              return smpim_plugimhtml("left").$content;
                              break;
                        case "Top Right":
        		              return smpim_plugimhtml("Right").$content;
                              break;
                        case "Bottom Left":
        		              return $content.smpim_plugimhtml("left");
                              break;
                        case "Bottom Right":
        		              return $content.smpim_plugimhtml("right");
                              break;
                        case "None":
        		              return $content;
                              break;
                        default:
        		              return smpim_plugimhtml("left").$content;
                              break;
                    }
                } else {
        		      return smpim_plugimhtml("left").$content;
                }

    		} else {
                  return str_replace('<!--plugim-->', smpim_plugimhtml(""), $content);
            }
        } else {
			return $content;
        }
	}
}

if (!function_exists('show_plugimbox')) {
	function show_plugimbox($float = "left") {
        global $post;
		$permalink = get_permalink($post->ID);
        $title = urlencode($post->post_title);
		echo <<<CODE

    <span style="margin: 0px 6px 0px 0px; float: $float;">

	<script type="text/javascript">
	plugim_url = "$permalink";
	plugim_title = "$title";
	</script>
	<script src="http://www.plugim.com/tools/plugthis.js" type="text/javascript"></script>
	</span>
CODE;
    }
}

add_filter('the_content', 'smpim_addbutton', 999);
add_action('admin_menu', 'smpim_add_menu');
add_action('init', 'smpim_request_handler');

?>
