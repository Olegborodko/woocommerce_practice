<?php 

if ( !defined( 'ABSPATH' ) || !is_main_site() ) {
	die();
}

if ( !defined("AWR_PLUGIN_FILENAME") ) {
	define( "AWR_PLUGIN_FILENAME", AWR_PLUGIN_TEXTDOMAIN . '/' . AWR_PLUGIN_TEXTDOMAIN . '.php' );
}

if ( ! defined( "AWR_PLUGIN_ABSOLUTE_FILE_PATH" ) ) {
	define( "AWR_PLUGIN_ABSOLUTE_FILE_PATH", WP_PLUGIN_DIR . '/' . AWR_PLUGIN_FILENAME );
}

if ( ! defined( "AWR_PLUGIN_ABSOLUTE_DIR" ) ) {
	define( "AWR_PLUGIN_ABSOLUTE_DIR", WP_PLUGIN_DIR . '/' . AWR_PLUGIN_TEXTDOMAIN );
}

if ( ! defined( "AWR_PLUGIN_ABSOLUTE_URL" ) ) {
	define( "AWR_PLUGIN_ABSOLUTE_URL", plugins_url() . '/' . AWR_PLUGIN_TEXTDOMAIN );
}


if ( ! defined( "AWR_LIB_PATH" ) ) {
	define( "AWR_LIB_PATH", AWR_PLUGIN_ABSOLUTE_DIR . '/libs' );
}

if ( ! defined( "AWR_PLUGIN_IMG_URL" ) ) {
	define( "AWR_PLUGIN_IMG_URL", AWR_PLUGIN_ABSOLUTE_URL . '/awp-reset-front/img' );
}

if ( ! defined( "AWR_PLUGIN_CSS_URL" ) ) {
	define( "AWR_PLUGIN_CSS_URL", AWR_PLUGIN_ABSOLUTE_URL . '/awp-reset-front/css' );
}

if ( ! defined( "AWR_PLUGIN_JS_URL" ) ) {
	define( "AWR_PLUGIN_JS_URL", AWR_PLUGIN_ABSOLUTE_URL . '/awp-reset-front/js' );
}

if ( ! defined( "AWR_PLUGIN_INCLUDES_URL" ) ) {
	define( "AWR_PLUGIN_INCLUDES_URL", AWR_PLUGIN_ABSOLUTE_URL . '/includes' );
}

if ( ! defined( "AWR_PLUGIN_INCLUDES_PATH" ) ) {
	define( "AWR_PLUGIN_INCLUDES_PATH", AWR_PLUGIN_ABSOLUTE_DIR . '/includes' );
}

if ( ! defined( "AWR_WP_SNAPSHOT_DIR" ) ) {
	define( "AWR_WP_SNAPSHOT_DIR", AWR_PLUGIN_ABSOLUTE_DIR . '/snapshots' );
}

define("AWR_CORE_TABLES", array('commentmeta', 'comments', 'links', 'options', 'postmeta', 'posts', 'term_relationships', 'term_taxonomy', 'termmeta', 'terms', 'usermeta', 'users'));


define("AWP_PRO_RESET_OPTION_KEEP_INFOS", 'keep');
define("AWP_PRO_RESET_OPTION_RESET_INFOS", 'reset');
define("AWP_PRO_RESET_OPTION_EDIT_INFOS", 'edit');

//define ('AWR_OPTIONS_TO_IGNORE', array_merge ( AWR_WP_OPTIONS, AWR_OPTIONS ) );

define ('LICENCE_STATE_NOTFOUND', 'not_found');
define ('LICENCE_STATE_VALID', 'valid');
define ('LICENCE_STATE_INVALID', 'invalid');
define ('LICENCE_STATE_EXPIRED', 'expired');

define ('AWR_TASKS_NAME', array (
		'uploads-files' => "Empty 'uploads' folder",
		'themes-files' => "Delete all themes",
		'plugins-files' => "Delete all plugins",
		'wp-content-files' => "Clean 'wp-content' folder",
		'mu-plugins-files' => "Delete MU plugins",
		'htaccess-files' => "Delete '.htaccess' file",
		'dropins' => "Delete drop-in plugins",
		'cache' => "Clear cache",
		'pending-comments' => 'Delete pending comments',
		'spam-comments' => 'Delete spam comments',
		'trashed-comments' => 'Delete trashed comments',
		'pingbacks' => 'Delete pingbacks',
		'trackbacks' => 'Delete trackbacks',
		'all-comments' => 'Delete all comments',
		'all-options' => 'Reset all options',
		'nav-menus' => 'Delete navigation menus',
		'widgets' => 'Delete widgets',
		'transients' => 'Delete transients',
		'posts' => 'Delete posts',
		'media' => 'Delete media',
		'posts-drafts' => 'Delete drafts',
		'posts-auto-draft' => 'Delete auto-drafts',
		'posts-empty-trash' => 'Empty trash',
		'pages' => 'Delete pages',
		'pages-revisions' => 'Delete revisions',
		'pages-drafts' => 'Delete drafts',
		'pages-auto-draft' => 'Delete auto-drafts',
		'pages-empty-trash' => 'Empty trash',
		'categories' => 'Delete categories',
		'tags' => 'Delete tags',
		'user-roles' => 'Reset user roles',
		'users' => 'Delete all users',
		'cookies' => "Delete cookies",
		'local-storage' => 'Clear local storage',
		'session' => 'Delete session data',
		'empty-custom-tables' => 'Empty custom tables',
		'drop-custom-tables' => 'Drop custom tables',
	));

?>