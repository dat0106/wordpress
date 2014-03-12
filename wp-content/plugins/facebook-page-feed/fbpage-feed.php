<?php
/*
    Plugin Name: Facebook Page Feed Widget
    Plugin URI: http://wordpress.org/extend/plugins/health-check/
    Description: Widget for adding your Facebook page feed to your site.
    Author: Bobz
    Version: 0.1
    Author URI: http://www.bobz.co
    Text Domain: vb_fbfeed_widget
    Domain Path: /lang
 */

define( 'FBF_VERSION', '0.1' );
define( 'FBF_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FBF_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

include_once ( FBF_PLUGIN_PATH . 'inc/widget.php' );
