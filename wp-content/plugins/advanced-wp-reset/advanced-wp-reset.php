<?php

/*
Plugin Name: Advanced WordPress Reset
Plugin URI: http://sigmaplugin.com/downloads/advanced-wordpress-reset
Description: One-click resets, restores, and more to speed up your WordPress development, testing & troubleshooting. Join +30.000 developpers, designers, marketers and content developper who make their lives easier and more productive with a 4,9 rated Plugin.
Version: 2.0
Requires at least: 4.0
Author: Younes JFR.
Author URI: http://www.sigmaplugin.com
Contributors: symptote
Text Domain: advanced-wp-reset
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
$awr_object = null;

if ( is_dir( __DIR__ . '/pro' ) ) { 


	require_once 'pro/advanced-wp-reset-pro.class.php';
	require_once 'pro/pro-config.inc.php';
	require_once 'config.inc.php';

	if ( ! defined( "AWR_PRO_PLUGIN_JS_URL" ) ) {
		define( "AWR_PRO_PLUGIN_JS_URL", AWR_PLUGIN_ABSOLUTE_URL . '/pro/assets/js' );
	}

	if ( class_exists ( 'AWR_Application_Pro' ) ){
		$awr_object = new AWR_Application_Pro();
	}
	
} else {

	require_once 'advanced-wp-reset.class.php';
	require_once 'free-config.inc.php';
	require_once 'config.inc.php';

	if ( class_exists ( 'AWR_Application' ) ){
		$awr_object = new AWR_Application();
	}
   	
}


// Activation
register_activation_hook ( __FILE__, array ( $awr_object, 'activate' ) );

// Deactivation
register_deactivation_hook ( __FILE__, array ( $awr_object, 'deactivate' ) );
