<?php 

namespace awr\models;

class ItemsFetcherModel  {


	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new ItemsFetcherModel ();  
		}

		return self::$_instance;
	}

	// ###############  FREE VERSION #####################

	/**
	 * Count the number of upload files
	 * @return int The number of upload files
	 */
	public function count_upload_files () {
		
		//$uploads_dir = wp_upload_dir(null, false);
		//$total_items = $this->count_items_in_folder($uploads_dir['basedir'], array('.', '..', 'DBR.txt'));

		$uploadPath = wp_upload_dir()['basedir'];  // Get the base directory of the upload folder
		$files = glob($uploadPath . '/*');  // Retrieve all files in the upload folder

		$total_items = count($files);  // Count the number of files
		
		return $total_items;
	}

	/**
	* Calculates the number of files/folders in a folder
	*
	* @param string $folder Folder to start from
	* @param array $exclude Array of names to excludes from the count
	*
	* @return int The number of files and folders
	*/
	private function count_items_in_folder( $folder, $exclude = array() ){

		if( file_exists( $folder ) && is_dir( $folder )) {

			$all_contents = scandir($folder);

			$result = array_diff( $all_contents, $exclude );

			//var_dump($result);

			return count($result);

		}

		return 0;
		
	}

	/**
	* Calculates the number of themes
	*
	* @param int $ignore_active_theme = 1 if you want to ignore active theme
	* @return int The number of themes
	*/
	public function count_themes ( $keep_active_theme = 1 ) {

		$count = $this->count_items_in_folder( 
			WP_CONTENT_DIR . '/themes', 
			array(
				'.', 
				'..', 
				'index.php'
			)
		);

		//$current_theme = get_stylesheet();
		//var_dump($current_theme);

		if($count > 0 && $keep_active_theme){
			
			$current_theme = get_stylesheet();
			
			// If there is a active theme
			if ( $current_theme ) {

				$count--;

				// If the active theme has a parent theme
				$current_theme = wp_get_theme();
				$parent_theme = $current_theme->parent();

				if ( $parent_theme ) 
					$count--;
				
			}
		}

		return $count;
	}

	/**
	* Calculates the number of plugins
	*
	* @param int $ignore_current = 1 if you want to ignore current plugin
	* @return int The number of plugins
	*/
	public function count_plugins ( $ignore_current = 0 ) {

		$plugins_list = get_plugins();
		$total_items = count($plugins_list);

		if ( $ignore_current == 1 )
			$total_items--;
		
		return $total_items;
		
	}

	/**
	* Calculates the number of items in wp-content folder
	*
	* @return int The number of items
	*/
	public function count_wp_content_files () {

		return $this->count_items_in_folder( 
			WP_CONTENT_DIR, 
			array(
				'.', 
				'..', 
				'plugins', 
				'themes', 
				'uploads', 
				'mu-plugins', 
				'index.php', 
				'awp_crons.log'
			)
		);
	}

	public function count_mu_plugins () {

		return $this->count_items_in_folder( 
			WPMU_PLUGIN_DIR, 
			array(
				'.', 
				'..', 
				'index.php'
			)
		);
		
	}

	public function count_htaccess_files () {

		clearstatcache();
		
		$total_items = 0;
		
		if(file_exists(get_home_path() . '.htaccess')){
			$total_items = 1;
		}

		return $total_items;
	}

	public function count_dropins() {

		$total_items = 0;

		//echo 'Calculate dropins';
		$wp_dropins = _get_dropins();

		//var_dump($wp_dropins);
		foreach ( $wp_dropins as $wp_dropin_file => $wp_dropin_desc ) {	
		//	echo trailingslashit(WP_CONTENT_DIR) . $wp_dropin_file . '--';
			if (file_exists( trailingslashit(WP_CONTENT_DIR) . $wp_dropin_file ) )
				$total_items ++;
		}	
		//echo '(' . $total_items . ')';
		return $total_items;
	}

	/**
	* Counts the number of comments according to their type (all comment, pending, spam, trash, pingback, trackback)
	* @param string $comment_type the comment type to count
	* @return int The number of comments
	*/
	public function count_comments($comment_type = 'all-comments'){

		global $wpdb;
		$sql_query = "";

		switch($comment_type){
			case 'all-comments' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments";
				break;
			case 'pending-comments' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments WHERE comment_approved = '0'";
				break;
			case 'spam-comments' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments WHERE comment_approved = 'spam'";
				break;
			case 'trashed-comments' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments WHERE comment_approved = 'trash'";
				break;
			case 'pingbacks' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments WHERE comment_type = 'pingback'";
				break;
			case 'trackbacks' :
				$sql_query = "SELECT COUNT(*) from $wpdb->comments WHERE comment_type = 'trackback'";
				break;
			default:
				throw new \Exception ('unknown comment type: ' . $comment_type);
		}

		$total = $wpdb->get_var($sql_query);
		return intval($total);
	}

	public function get_tools_requiring_reload() {
		return array();
	}

	public function get_tools_array () {

		$uploads_dir_path = "<code>/wp-content/uploads</code>";
		$must_use_path = "<code>/wp-content/mu-plugins</code>";
		$wp_content_path = "<code>/wp-content</code>";
		
		$explanaition_for_themes = "All themes will be deleted.";
		$explanaition_for_themes_for_collections = "All themes will be deleted.";

		$current_user = wp_get_current_user();

		$current_theme = get_stylesheet();

		if ( $current_theme ) {

			$current_theme = wp_get_theme();
			$parent_theme = $current_theme->parent();

			if ( $parent_theme ) {
				$explanaition_for_themes = "All themes will be deleted, except the active one <code>" . $current_theme . "</code> and its parent <code>" . $parent_theme . "</code>. If you want to delete them too, uncheck the checkbox <b>Keep active theme</b>.";

				$explanaition_for_themes_for_collections = "All themes will be deleted, except the active one <code>" . $current_theme . "</code> and its parent <code>" . $parent_theme . "</code>. It will not be deleted.";
		
			} else {
				$explanaition_for_themes = "All themes will be deleted, except the active one <code>" . $current_theme . "</code>. If you want to delete it too, uncheck the checkbox <b>Keep active theme</b>.";

				$explanaition_for_themes_for_collections = "All themes will be deleted, except the active one <code>" . $current_theme . "</code>. It will not be deleted.";
			}
		
		}
		
		$cache_plugins = "";

		// 2. Cache Enabler
		if (class_exists('Cache_Enabler')) {
		    $cache_plugins .= "<code>Cache Enabler <b>(active)</b></code>, ";
		} else 
			$cache_plugins .= "<code>Cache Enabler</code>, ";

	    // 3. W3 Total Cache
		if (function_exists('w3tc_flush_all')) {
		    $cache_plugins .= "<code>W3 Total Cache <b>(active)</b></code>, ";
		} else 
			$cache_plugins .= "<code>W3 Total Cache</code>, ";

		// 4. WP Super Cache
		if (function_exists('wp_cache_clear_cache')) {
		    $cache_plugins .= "<code>WP Super Cache <b>(active)</b></code>, ";
		} else 
			$cache_plugins .= "<code>WP Super Cache</code>, ";

		// 5. WP Fastest Cache
		if (class_exists('WpFastestCache')) {
		    $cache_plugins .= "<code>WP Fastest Cache <b>(active)</b></code>, ";
		} else 
			$cache_plugins .= "<code>WP Fastest Cache</code>, ";

		// 6. Hyper Cache
		if (class_exists('HyperCache')) {
		    $cache_plugins .= "<code>Hyper Cache <b>(active)</b></code>, ";
		} else 
			$cache_plugins .= "<code>Hyper Cache</code>, ";
		
		// 7. Autoptimize
		if (class_exists('autoptimizeCache')) {
		    $cache_plugins .= "<code>Autoptimize <b>(active)</b></code> and ";
		} else 
			$cache_plugins .= "<code>Autoptimize</code> and ";
		
		// 8. LiteSpeed Cache
		if (class_exists('\LiteSpeed\Purge')) {
		    //\LiteSpeed_Cache_API::purge_all();
		    $cache_plugins .= "<code>LiteSpeed Cache <b>(active)</b></code>";
		} else 
			$cache_plugins .= "<code>LiteSpeed Cache</code>";
		

		$items_array = array();

		// Add items related to files
		$items_array['files'] = array(
			'table_title' 	=> 'File management Tools',
			'icon_class' 	=> 'icon-reset-files',

			'table_tasks'  	=> array(
				array(
					'task' => 'uploads-files',
					'action' => 'clean',
					'title' => "Empty 'uploads' folder",
					'deals_with_db' => false,
					'deals_with_files' => true,
					'explanaition' => "All media uploads inside $uploads_dir_path directory will be deleted! This includes images, videos, music, documents, subfolders, etc.",
				),
				array(
					'task' => 'themes-files',
					'action' => 'delete',
					'title' => "Delete all themes",
					'deals_with_db' => true,
					'deals_with_files' => true,
					'explanaition' => $explanaition_for_themes,
					'explanaition_for_collections' => $explanaition_for_themes_for_collections
				),
				array(
					'task' => 'plugins-files',
					'action' => 'delete',
					'title' => "Delete all plugins",
					'deals_with_db' => true,
					'deals_with_files' => true,
					'explanaition' => "All plugins will be deleted except <code>" . AWR_PLUGIN_NAME . "</code>, it will still be installed and active after the reset."
				),
				array(
					'task' => 'wp-content-files',
					'action' => 'clean',
					'title' => "Clean 'wp-content' folder",
					'deals_with_files' => true,
					'deals_with_db' => false,
					'explanaition' => "All files and folders inside $wp_content_path directory will be deleted, except 'index.php' and the following folders: 'plugins', 'themes', 'uploads' and 'mu-plugins'."
				),
				array(
					'task' => 'mu-plugins-files',
					'action' => 'delete',
					'title' => "Delete MU plugins",
					'deals_with_files' => true,
					'deals_with_db' => false,
					'explanaition' => "All Must-use plugins in $must_use_path will be deleted. These are plugins that cannot be disabled except by removing their files from the must-use directory.",
					'available' => true
				),
				array(
					'task' => 'htaccess-files',
					'action' => 'delete',
					'title' => "Delete '.htaccess' file",
					'deals_with_files' => true,
					'deals_with_db' => false,
					'explanaition' => "The .htaccess file will be deleted. This is a critical WordPress core file used to enable or disable features of websites hosted on Apache."
				),
				array(
					'task' => 'dropins',
					'action' => 'delete',
					'title' => "Delete drop-in plugins",
					'deals_with_files' => true,
					'deals_with_db' => false,
					'explanaition' => 'All Drop-in plugins will be deleted. Drop-ins are advanced plugins in the wp-content directory that replace WordPress functionality when present. They can’t be activated, deactivated or uninstalled from the dashboard.',
					'available' => true
				),
				array(
					'task' => 'cache',
					'action' => 'clean',
					'title' => "Purge cache",
					'has_total' => false,
					'deals_with_files' => true,
					'deals_with_db' => true,
					'explanaition' => 'The cache is handled by various plugins and specific code snippets, this feature is compatible with the ' . $cache_plugins,
				)
			)
		);

		// Add items related to comments
		$items_array['comments'] = array(

			'table_title' 	=> 'Comments management Tools',
			'icon_class' 	=> 'icon-reset-comments',
		
			'table_tasks'  	=> array(
				array(
					'task' => 'pending-comments',
					'action' => 'delete',
					'title' => 'Delete pending comments',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'Pending comments will be deleted. These are the comments that are awaiting moderation.'
				),
				array(
					'task' => 'spam-comments',
					'action' => 'delete',
					'title' => 'Delete spam comments',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'Spam comments will be deleted.'
				),
				array(
					'task' => 'trashed-comments',
					'action' => 'delete',
					'title' => 'Delete trashed comments',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'Trashed comments will be deleted. These are comments that you have deleted and sent to the Trash',
				),
				array(
					'task' => 'pingbacks',
					'action' => 'delete',
					'title' => 'Delete pingbacks',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'All Pingbacks will be deleted. Pingbacks allow you to notify other website owners that you have linked to their article on your website.'
				),
				array(
					'task' => 'trackbacks',
					'action' => 'delete',
					'title' => 'Delete trackbacks',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'All Trackbacks will be deleted. Although there are some minor technical differences, a trackback is basically the same things as a pingback.'
				),
				array(
					'task' => 'all-comments',
					'action' => 'delete',
					'title' => 'Delete all comments',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'All kinds of comments and related metas will be deleted.'
				),
			)
		);

		// Tested
		// Add items related to options
		$items_array['options'] = array(

			'table_title' 	=> 'Options management Tools',
			'icon_class' 	=> 'icon-reset-db',
			'in-pro-only' => true,

			'table_tasks'  	=> array(
				array(
					'task' => 'all-options',
					'in-pro-only' => true,
					'action' => 'reset',
					'title' => 'Reset all options',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will reset all the options to default. It will activate the current theme and plugins and then restore your site infos.'
				),
				array(
					'task' => 'nav-menus',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete navigation menus',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all the menus.'
				),
				array(
					'task' => 'widgets',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete widgets',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all the sidebar widgets.'
				),
				array(
					'task' => 'transients',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete transients',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all the transients.'
				),
			)		
		); 

		// Tested 
		// Add items related to posts
		$items_array['posts'] = array(

			'table_title' 	=> 'Posts management Tools',
			'icon_class' 	=> 'icon-reset-posts',
			'in-pro-only' => true,

			'table_tasks'  	=> array(
				array(
					'task' => 'posts',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete posts',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your posts (published, draft, in trash, etc.)',
				),
				array(
					'task' => 'media',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete media',
					'deals_with_db' => true,
					'deals_with_files' => true,
					'explanaition' => 'This will delete all your media from your database and upload folder too',
				),
				array(
					'task' => 'posts-drafts',		
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete drafts',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your posts drafts',
				),
				array(
					'task' => 'posts-auto-draft',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete auto-drafts',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your posts auto-drafts',
				),
				array(
					'task' => 'posts-empty-trash',
					'in-pro-only' => true,
					'action' => 'clean',
					'title' => 'Empty trash',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your trashed posts.',
				),
			)
		);
		
		
		// Tested 
		// Add items related to posts
		$items_array['pages'] = array(

			'table_title' 	=> 'Pages management Tools',
			'icon_class' 	=> 'icon-reset-posts',
			'in-pro-only' => true,

			'table_tasks'  	=> array(
				array(
					'task' => 'pages',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete pages',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your pages (published, draft, in trash, etc.)',
				),
				array(
					'task' => 'pages-revisions',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete revisions',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all the revisions available for your pages.',
				),
				array(
					'task' => 'pages-drafts',		
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete drafts',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your pages drafts',
				),
				array(
					'task' => 'pages-auto-draft',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete auto-drafts',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your pages auto-drafts',
				),
				array(
					'task' => 'pages-empty-trash',
					'in-pro-only' => true,
					'action' => 'clean',
					'title' => 'Empty trash',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your trashed pages',
				),
			)
		);
		
		
		// Tested 
		// Add items related to taxonomies
		$items_array['taxonomies'] = array(

			'table_title' 	=> 'Taxonomies management Tools',
			'icon_class' 	=> 'icon-reset-taxonomies',
			'in-pro-only' => true,
		
			'table_tasks'  	=> array(
				array(
					'task' => 'categories',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete categories',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your categories. The posts assigned to those categories will be deleted.'
				),
				array(
					'task' => 'tags',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete tags',
					'deals_with_files' => false,
					'deals_with_db' => true,
					'explanaition' => 'This will delete all your tags. The posts having those tags will be deleted.'
				),
			)
		);

		
		// Tested 
		// Add items related to users
		$items_array['users'] = array(

			'table_title' 	=> 'Users and Roles management Tools',
			'icon_class' 	=> 'icon-reset-users',
			'in-pro-only' => true,
		
			'table_tasks'  	=> array(
				array(
					'task' => 'user-roles',
					'in-pro-only' => true,
					'action' => 'reset',
					'title' => 'Reset user roles',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => "This will reset the user roles to default, any custom roles created by the theme, plugins, or other scripts will be deleted. Users who were previously assigned those custom roles will no longer have any specific role assigned to them."
				),
				array(
					'task' => 'users',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete all users',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'All users will be removed, keeping only <code>' . $current_user->user_email . '</code>, and the content of the removed users will be reassigned to the latter.',
				),
			)
		);

		
		// Tested
		// Add items related to local data
		$items_array['local-data'] = array(

			'table_title' 	=> 'Local data management Tools',
			'icon_class' 	=> 'icon-local-data',
			'in-pro-only' => true,

			'table_tasks'  	=> array(
				array(
					'task' => 'cookies',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => "Delete cookies",
					'has_total' => false,
					'deals_with_db' => false,
					'deals_with_files' => false,
					'explanaition' => 'This will delete wordPress cookies that handle the authentication and logged-in data. After running this tool, you will be logged out.'
				),
				array(
					'task' => 'local-storage',
					'in-pro-only' => true,
					'action' => 'clean',
					'title' => 'Clear local storage',
					'has_total' => false,
					'deals_with_db' => false,
					'deals_with_files' => false,
					'explanaition' => "Wordpress local storage refers to the HTML5 Web Storage (client side). Local storage allows web applications to store data locally on the user's web browser.",
					'available_for_collections' => false,
				),
				array(
					'task' => 'session',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Delete session data',
					'has_total' => false,
					'deals_with_db' => false,
					'deals_with_files' => false,
					'explanaition' => 'Session storage data will be delete. These are a key-value pairs stored in your server. They help maintain data even when the browser is closed.'
				),
			)
		);
		
		
		// Tested 
		// custom tables
		$items_array['tables'] = array(

			'table_title' 	=> 'Custom tables management Tools',
			'icon_class' 	=> 'icon-empty-table',
			'in-pro-only' => true,
			
			'table_tasks'  	=> array(
				array(
					'task' => 'empty-custom-tables',
					'in-pro-only' => true,
					'action' => 'clean',
					'title' => 'Empty custom tables',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'This will empty data from custom tables. Custom tables are tables created by themes or plugins and that do not belong the WP core tables.',
				),
				array(
					'task' => 'drop-custom-tables',
					'in-pro-only' => true,
					'action' => 'delete',
					'title' => 'Drop custom tables',
					'deals_with_db' => true,
					'deals_with_files' => false,
					'explanaition' => 'This will drop custom tables. Custom tables are tables created by themes or plugins and that do not belong the WP core tables.',
				)
			)
		);

		return $items_array;
	}

	public function get_tool_name ( $task ) {
		
		if ( array_key_exists ($task, AWR_TASKS_NAME) ) {
			return AWR_TASKS_NAME[$task];
		}

		return $task;

	}


	/**
	* Get WP versions
	*
	* @return Array The WP versions
	*/
	public function get_wp_version_list() {
		
		$response = wp_remote_get('https://api.wordpress.org/core/version-check/1.7/');

		if (!is_wp_error($response) && $response['response']['code'] === 200) {
		   
		    $body = wp_remote_retrieve_body($response);
		    $data = json_decode($body, true);
		    $versions = array_column($data['offers'], 'version');
			
			// We get only version numbers
			$versions = is_array( $versions) ? array_values($versions) : array();

			// We get unique values 
			$versions = is_array( $versions) ? array_unique($versions) : array();

			return $versions;
		}

		return array();
	}

	/* PRO VERSION */

	public function count_theme_options() {
		
		global $wpdb;
		
		$count = $wpdb->query("SELECT * FROM `$wpdb->options` WHERE option_name LIKE 'theme_mods\_%' OR option_name LIKE 'mods\_%'");

		return $count;
	}

	public function count_nav_menus() {
		return count(wp_get_nav_menus());
	}

	public function get_widgets () {

		$all_widgets = wp_get_sidebars_widgets();
		return $all_widgets;
	}
	public function count_widgets() {
		return count($this->get_widgets());
		//return count($this->get_widgets_ids());
	}

	public function get_media_ids() {
		global $wpdb;

		$result = $wpdb->get_results("SELECT ID  FROM $wpdb->posts WHERE post_type='attachment';");

		return $result;	
	}

	public function count_media() {
		return count($this->get_media_ids());
	}

	public function count_non_empty_custom_tables () {

		global $wpdb;

		$custom_tables_names = $this->get_custom_table_names();

		$result = 0;

		foreach ($custom_tables_names as $table_name) {

			$is_empty = $wpdb->get_var("SELECT COUNT(*) FROM $table_name") == 0;

			if (!$is_empty) {
			    $result++;
			}
		}

		return $result;
	}

	public function count_custom_tables() {
		return count($this->get_custom_table_names());
	}

	public function get_custom_table_names() {
		
		global $wpdb;
		
		$list = [];

		$all_tables_names = $this->get_table_names();

		$tables_to_ignore = $this->get_wp_and_plugin_names();
		
		foreach($all_tables_names as $table_name) {

			if (in_array($table_name, $tables_to_ignore) === false) {
				$list[] = $table_name;
			}
		}

		return $list;
	}

	private function get_table_names() {
		
		global $wpdb;

		$list = array();

		$all_tables = $wpdb->get_results("SHOW TABLES like '" . ($wpdb->prefix) . "%'" );
		
		foreach ($all_tables as $table){
			foreach ( $table as $element )
				$list[] = $element;
		}

		return $list;
		
	}

	private function get_wp_and_plugin_names () {

		// Here we have no snapshot
		$snapshots_tables = array();//SnapshotModel::get_instance()->get_used_tables ();
		return array_merge( $this->apply_db_prefix_to(AWR_CORE_TABLES), $snapshots_tables );
		
	}

	private function apply_db_prefix_to( $array ) {

		global $wpdb;

		$result = array();

		if ( is_array ($array) ) {

			foreach ( $array as $element ) {
				$result[] = $wpdb->prefix . $element;
			}
		}

		return $result;

	}


	/* #############  TESTED ################### */

	/**
	* Counts the number of users except the current one 
	* @return int The number of users minus 1
	*/	
	public function count_users () {

		$total_items = get_users();
		return count($total_items) - 1;

	}

	/**
	* Counts the number of user roles 
	* @return int The number of user roles
	*/	
	public function count_user_roles () {

		global $wp_roles;

		$total_items = 0;
		
		// Get all roles
		$roles = $wp_roles->roles;

		// Loop through each role and delete custom roles
		foreach ($roles as $role_slug => $role_info) {
		    if ( $wp_roles->is_role($role_slug) && 
		    	!in_array($role_slug, ['administrator', 'editor', 'author', 'contributor', 'subscriber'])
		    ) {
		    	$total_items++;
		    }
		}

		return $total_items;
	}

	/**
	* Gets all categories
	* @return array The categories
	*/
	public function get_all_categories () {
		return get_categories( array ('hide_empty' => false ) );
	}

	/**
	* Counts the categories
	* @return int The number of categories
	*/
	public function count_categories() {
		// We must not calculate 'Uncategorized'
		return count ($this->get_all_categories()) - 1;
	}

	/**
	* Gets all tags
	* @return array The tags
	*/
	public function get_all_tags () {
		return get_tags( array ('hide_empty' => false ) );
	}

	/**
	* Counts the tags
	* @return int The number of tags
	*/
	public function count_tags() {
		// We must not calculate 'Uncategorized'
		return count ($this->get_all_tags());
	}

	/**
	* Counts the revisions
	* @return int The number of revisions
	*/
	public function count_revisions () {
		return count($this->get_all_revisions ());
	}

	/**
	* Gets all revisions
	* @return array The revisions
	*/
	public function get_all_revisions () {

		// Get all the post types
		$post_types = get_post_types();

		// Initialize revision count
		$revisions = array();

		// Loop through each post type
		foreach ($post_types as $post_type) {
		    // Exclude post types that don't support revisions
		    if (post_type_supports($post_type, 'revisions')) {
		        // Get all the posts of the post type
		        $posts = get_posts(array(
		            'post_type' => $post_type,
		            'posts_per_page' => -1,
		        ));
		        
		        // Loop through each post and count revisions
		        foreach ($posts as $post) {
		            $current_revisions = wp_get_post_revisions($post->ID);
		            //$total_revisions += count($current_revisions);
		            $revisions = array_merge ($revisions, $current_revisions);
		        }
		    }
		}

		// Output the total revision count
		return $revisions;

	}

	/**
	* Counts the pages ids
	* @return int The number of pages ids
	*/
	public function count_pages( $status = null  ) {
		return count($this->get_page_ids( $status ));
	}

	/**
	* Gets all pages ids
	* @return array The pages ids
	*/
	public function get_page_ids( $status = null) {
		

		$args = array(
				"numberposts" => -1, 
				"post_status" => 'publish,future,draft,pending,private,trash,auto-draft'
			);

		if( $status != null) 
			$args['post_status'] = $status;

		$posts = get_pages($args);
		
		$ids = [];

		foreach($posts as $post) {
			$ids[] = $post->ID;
		}

		return $ids;
	}

	/**
	* Counts the posts
	* @return int The number of posts
	*/
	public function count_posts( $status = null ) {
		return count($this->get_post_ids( $status ));
	}

	/**
	* Gets all posts
	* @return array The posts
	*/
	public function get_post_ids( $status = null ) {

		$args = array("numberposts" => -1); 

		if ($status != null) {
			$args['post_status'] = $status;
		} /*else 
			$args['post_status'] = 'any'; */

		$posts = get_posts($args);
		$ids = [];

		foreach($posts as $post) {
			$ids[] = $post->ID;
		}

		return $ids;
	}

	/**
	* Counts the transients
	* @return int The number of transients
	*/
	public function count_transients() {
		return count($this->get_transient_list());
	}

	/**
	* Gets all transients
	* @return array The transients
	*/
	public function get_transient_list () {
		
		global $wpdb;

		// Escape some LIKE parts
		$esc_name = '%' . $wpdb->esc_like( '_transient_'         ) . '%';
		$esc_time = '%' . $wpdb->esc_like( '_transient_timeout_' ) . '%';

		// Combine the SQL parts
		$query = "SELECT * FROM `{$wpdb->options}` WHERE option_name LIKE %s AND option_name NOT LIKE %s;";

		// Prepare
		$prepared = $wpdb->prepare( $query, $esc_name, $esc_time );

		// Query
		$transients = $wpdb->get_results( $prepared ) ;

		$result = array();

		foreach($transients as $transient){
			$result[] = $transient->option_name;
		}
		return $result;
	}

	/**
	 * 
	 */
	public function count_all_options_to_delete () {

		global $wpdb;

		return $wpdb->get_var("SELECT count(*) FROM {$wpdb->options}");
	}

	/**
	* Get current WP version
	*
	* @return String The current installed version of WP
	*/
	public function get_wp_version() {
		global $wp_version;
		return $wp_version;
	}
}

?>