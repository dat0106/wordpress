<?php  
/*
Plugin Name: Facebook Like Box
Plugin URI: http://arturssmirnovs.com/blog/facebook-like-box-wordpress/
Description: Facebook like box for wordpress is plugin that allow you to customize facebook like box easily. This is very useful plugin for websites, communities that use facebook.
Version: 1.1
Author: Arturs Smirnovs
Author URI: http://arturssmirnovs.com/
License: GPL2
*/

/*
Copyright 2014  Arturs Smirnovs  (email : info@arturssmirnovs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function facebook_like_box_admin_menu() { //create menu //call register settings function
	add_menu_page('Facebook Like Box Settings', 'FB Like Box', 'administrator', __FILE__, 'facebook_like_box_settings',plugins_url('/images/icon.png', __FILE__));
	add_action( 'admin_init', 'facebook_like_box_register_settings' );
}

function facebook_like_box_register_settings() { //register settings
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_title');
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_width' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_height' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_colorscheme' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_faces' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_header' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_steam' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_border' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_appid' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_time_enable' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_time' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_overlay' );
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_mobile' );	
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_mobile_width' );	
	register_setting( 'facebook-like-box-settings', 'facebook_like_box_settings_mobile_height' );	
}

function facebook_like_box_activate() { //add default setting values on activation
	add_option( 'facebook_like_box_title', 'iloveyoujurmala', '', 'yes' );
	add_option( 'facebook_like_box_width', '400', '', 'yes' );
	add_option( 'facebook_like_box_height', '290', '', 'yes' );
	add_option( 'facebook_like_box_colorscheme', 'light', '', 'yes' );
	add_option( 'facebook_like_box_faces', 'true', '', 'yes' );
	add_option( 'facebook_like_box_header', 'true', '', 'yes' );
	add_option( 'facebook_like_box_steam', 'false', '', 'yes' );
	add_option( 'facebook_like_box_border', 'true', '', 'yes' );
	add_option( 'facebook_like_box_appid', '', '', 'yes' );
	add_option( 'facebook_like_box_settings_time_enable', 'no', '', 'yes' );
	add_option( 'facebook_like_box_settings_time', '3600', '', 'yes' );
	add_option( 'facebook_like_box_settings_overlay', 'yes', '', 'yes' );
	add_option( 'facebook_like_box_settings_mobile', 'false', '', 'yes' );
	add_option( 'facebook_like_box_settings_mobile_width', '320', '', 'yes' );
	add_option( 'facebook_like_box_settings_mobile_height', '100', '', 'yes' );
}

function facebook_like_box_deactivate() { //delete setting and values on deactivation
	delete_option( 'facebook_like_box_title');
	delete_option( 'facebook_like_box_width' );
	delete_option( 'facebook_like_box_height' );
	delete_option( 'facebook_like_box_colorscheme' );
	delete_option( 'facebook_like_box_faces' );
	delete_option( 'facebook_like_box_header' );
	delete_option( 'facebook_like_box_steam' );
	delete_option( 'facebook_like_box_border' );
	delete_option( 'facebook_like_box_appid' );
	delete_option( 'facebook_like_box_settings_time_enable' );
	delete_option( 'facebook_like_box_settings_time' );
	delete_option( 'facebook_like_box_settings_overlay' );
	delete_option( 'facebook_like_box_settings_mobile' );
	delete_option( 'facebook_like_box_settings_mobile_width' );
	delete_option( 'facebook_like_box_settings_mobile_height' );
}

function facebook_like_box_settings() { //facebook like box settings page

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have permissions to access this page.' ) );
	}

?><div class="wrap">
<h2>Facebook Like Box</h2>
<p>Facebook like box for wordpress is plugin that allow you to customize facebook like box easily.<br />
This is very useful plugin for websites, communities that use facebook.<br />
For more information visit <a href="http://arturssmirnovs.com/" target="_blank">my website</a>.</p>
<form method="post" action="options.php">
<?php settings_fields( 'facebook-like-box-settings' ); ?>
<?php do_settings_sections( 'facebook-like-box-settings' ); ?>
<h3>Like Box Settings</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">Facebook Page Title</th>
<td>http://facebook.com/<input type="text" name="facebook_like_box_title" value="<?php echo get_option('facebook_like_box_title'); ?>" />/</td></tr>
<tr valign="top">
<th scope="row">Box Width</th>
<td><input type="text" name="facebook_like_box_width" value="<?php echo get_option('facebook_like_box_width'); ?>" />px</td>
</tr>
<tr valign="top">
<th scope="row">Box Height</th>
<td><input type="text" name="facebook_like_box_height" value="<?php echo get_option('facebook_like_box_height'); ?>" />px</td>
</tr>
<tr valign="top">
<th scope="row">Box Colorscheme</th>
<td><select name="facebook_like_box_colorscheme"><option value="light" <?php if ('light'==get_option('facebook_like_box_colorscheme')) echo 'selected'; ?>>Light</option><option value="dark" <?php if ('dark'==get_option('facebook_like_box_colorscheme')) echo 'selected'; ?>>Dark</option></select></td>
</tr>
<tr valign="top">
<th scope="row">Enable Faces</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_faces" value="true" <?php if ('true'==get_option('facebook_like_box_faces')) echo 'checked="checked"'; ?>>Show</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_faces" value="false" <?php if ('false'==get_option('facebook_like_box_faces')) echo 'checked="checked"'; ?>>Hide</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Enable Header</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_header" value="true" <?php if ('true'==get_option('facebook_like_box_header')) echo 'checked="checked"'; ?>>Show</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_header" value="false" <?php if ('false'==get_option('facebook_like_box_header')) echo 'checked="checked"'; ?>>Hide</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Enable Steam</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_steam" value="true" <?php if ('true'==get_option('facebook_like_box_steam')) echo 'checked="checked"'; ?>>Show</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_steam" value="false" <?php if ('false'==get_option('facebook_like_box_steam')) echo 'checked="checked"'; ?>>Hide</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Enable Border</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_border" value="true" <?php if ('true'==get_option('facebook_like_box_border')) echo 'checked="checked"'; ?>>Show</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_border" value="false" <?php if ('false'==get_option('facebook_like_box_border')) echo 'checked="checked"'; ?>>Hide</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Appid</th>
<td><input type="text" name="facebook_like_box_appid" value="<?php echo get_option('facebook_like_box_appid'); ?>" /></td>
</tr>
</table>
<h3>Like Box View Settings</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">Cookies</th>
<td><fieldset><label title="Enable"><input type="radio" name="facebook_like_box_settings_time_enable" value="yes" <?php if ('yes'==get_option('facebook_like_box_settings_time_enable')) echo 'checked="checked"'; ?>>Enable</label><br /><label title="Disable"><input type="radio" name="facebook_like_box_settings_time_enable" value="no" <?php if ('no'==get_option('facebook_like_box_settings_time_enable')) echo 'checked="checked"'; ?>>Disable</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Cookies time</th>
<td><input type="text" name="facebook_like_box_settings_time" value="<?php echo get_option('facebook_like_box_settings_time'); ?>" />ms</td>
</tr>
<tr valign="top">
<th scope="row">Body overlay</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_settings_overlay" value="yes" <?php if ('yes'==get_option('facebook_like_box_settings_overlay')) echo 'checked="checked"'; ?>>Enable</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_settings_overlay" value="no" <?php if ('no'==get_option('facebook_like_box_settings_overlay')) echo 'checked="checked"'; ?>>Disable</label><br /></fieldset></td>
</tr>
</table>
<h3>Like Box Settings Mobile</h3>
<table class="form-table">
<tr valign="top">
<th scope="row">On mobile</th>
<td><fieldset><label title="Show"><input type="radio" name="facebook_like_box_settings_mobile" value="true" <?php if ('true'==get_option('facebook_like_box_settings_mobile')) echo 'checked="checked"'; ?>>Show</label><br /><label title="Hide"><input type="radio" name="facebook_like_box_settings_mobile" value="false" <?php if ('false'==get_option('facebook_like_box_settings_mobile')) echo 'checked="checked"'; ?>>Hide</label><br /></fieldset></td>
</tr>
<tr valign="top">
<th scope="row">Mobile Box Width</th>
<td><input type="text" name="facebook_like_box_settings_mobile_width" value="<?php echo get_option('facebook_like_box_settings_mobile_width'); ?>" />px</td>
</tr>
<tr valign="top">
<th scope="row">Mobile Box Height</th>
<td><input type="text" name="facebook_like_box_settings_mobile_height" value="<?php echo get_option('facebook_like_box_settings_mobile_height'); ?>" />px</td>
</tr>
</table>
<?php submit_button(); ?>
</form>
</div><?php

}

function facebook_like_box_scripts() { //Define facebook like box scripts
	wp_enqueue_script('jquery');
    wp_register_script( 'script', plugins_url('script.js', __FILE__) );
    wp_enqueue_script( 'script', array('jquery') );
    wp_register_style( 'style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'style' );
}

function facebook_like_box_styles() {
	if (wp_is_mobile()) { // styles for mobile deveice
		echo "<style> #fb_box {	margin-top: -". get_option('facebook_like_box_settings_mobile_height') / 2 ."px; margin-left: -". get_option('facebook_like_box_settings_mobile_width') / 2 ."px } </style>";
	} else { // styles for desktop deveice
		echo "<style> #fb_box {	margin-top: -". get_option('facebook_like_box_height') / 2 ."px; margin-left: -". get_option('facebook_like_box_width') / 2 ."px } </style>";
	}
}

function facebook_like_box_show() { // Facebook like box show
	if (!isset($_COOKIE["fblb"]) || get_option('facebook_like_box_settings_time_enable') == 'no') {
		if (get_option('facebook_like_box_settings_mobile') == 'false' && wp_is_mobile()) { exit; }
		if (get_option('facebook_like_box_settings_time_enable') == 'yes') {
			setcookie("fblb", "yes", time() + get_option('facebook_like_box_settings_time'), "/", "", "0");
		}
		if (get_option('facebook_like_box_settings_overlay') == 'yes') { ?> <div class="fb_overlay"></div> <?php } ?>
		<div id="fb_box" class="<?php echo get_option('facebook_like_box_colorscheme'); ?>"><?php
		if (wp_is_mobile()) { // settings for mobile deveice
		?><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo get_option('facebook_like_box_title'); ?>&amp;width=<?php echo get_option('facebook_like_box_settings_mobile_width'); ?>&amp;height=<?php echo get_option('facebook_like_box_settings_mobile_height'); ?>&amp;colorscheme=<?php echo get_option('facebook_like_box_colorscheme'); ?>&amp;show_faces=<?php echo get_option('facebook_like_box_faces'); ?>&amp;header=<?php echo get_option('facebook_like_box_header'); ?>&amp;stream=<?php echo get_option('facebook_like_box_steam'); ?>&amp;show_border=<?php echo get_option('facebook_like_box_border'); ?>&amp;appId=<?php echo get_option('facebook_like_box_appid'); ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo get_option('facebook_like_box_settings_mobile_width'); ?>px; height:<?php echo get_option('facebook_like_box_settings_mobile_height'); ?>px;" allowTransparency="true"></iframe><?php
		} else { // settings for desktop deveice
		?><iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo get_option('facebook_like_box_title'); ?>&amp;width=<?php echo get_option('facebook_like_box_width'); ?>&amp;height=<?php echo get_option('facebook_like_box_height'); ?>&amp;colorscheme=<?php echo get_option('facebook_like_box_colorscheme'); ?>&amp;show_faces=<?php echo get_option('facebook_like_box_faces'); ?>&amp;header=<?php echo get_option('facebook_like_box_header'); ?>&amp;stream=<?php echo get_option('facebook_like_box_steam'); ?>&amp;show_border=<?php echo get_option('facebook_like_box_border'); ?>&amp;appId=<?php echo get_option('facebook_like_box_appid'); ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo get_option('facebook_like_box_width'); ?>px; height:<?php echo get_option('facebook_like_box_height'); ?>px;" allowTransparency="true"></iframe><?php
		}
		?><a id="fb_box_close"><img src="<?php echo plugins_url('images/close.png', __FILE__); ?>" alt="Close"></a>
		</div><?php
	}
}

register_activation_hook( __FILE__, 'facebook_like_box_activate' ); //register activation hook
register_deactivation_hook( __FILE__, 'facebook_like_box_deactivate' ); //register deactivation hook
add_action('admin_menu', 'facebook_like_box_admin_menu'); //add facebook like box admin menu
add_action('wp_enqueue_scripts', 'facebook_like_box_scripts'); //add facebook like box scripts
add_action('wp_head', 'facebook_like_box_styles'); //add facebook like box styles to head
add_action( 'get_footer', 'facebook_like_box_show'); //add facebook like box to footer

?>