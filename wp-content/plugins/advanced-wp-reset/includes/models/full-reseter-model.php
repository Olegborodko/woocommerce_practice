<?php 

namespace awr\models;

use awr\models\CommonModel;

class FullReseterModel  {

	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new FullReseterModel ();  
		}

		return self::$_instance;
	}

	// #####################  FREE VERSION ###################################

	
	public function export_blog_infos_to ( &$blog_infos_array ) {

		$blog_infos_array['blog_info'] = array (

			'name' 			=> get_bloginfo('name'),
			'description' 	=> get_bloginfo('description'),
			'admin_email' 	=> get_option('admin_email'),
			'site_url' 		=> site_url(),
			'home_url' 		=> home_url(),
			'is_public' 	=> get_option('blog_public'),
			'timezone_string' => get_option('timezone_string'),
			'gmt_offset' 	=> get_option('gmt_offset'),
			'language' 		=> get_option('WPLANG'),

		
		);
		
	}

	public function import_blog_infos_from ( $blog_infos_array ) {

		// Modifier le titre du blog
		if ( array_key_exists ('name', $blog_infos_array['blog_info']))	
			update_option('blogname', $blog_infos_array['blog_info']['name']);

		// Modifier la description du blog
		if ( array_key_exists ('description', $blog_infos_array['blog_info']))	
			update_option('blogdescription', $blog_infos_array['blog_info']['description']);

		// Modifier l'adresse email de l'administrateur
		if ( array_key_exists ('admin_email', $blog_infos_array['blog_info']))	
			update_option('admin_email', $blog_infos_array['blog_info']['admin_email']);

		// Modifier l'URL de la page d'accueil
		if ( array_key_exists ('site_url', $blog_infos_array['blog_info'])) {
			update_option('siteurl', $blog_infos_array['blog_info']['site_url']);
		}

		// Modifier l'URL de la page d'accueil
		if ( array_key_exists ('home_url', $blog_infos_array['blog_info'])) {
			update_option('home', $blog_infos_array['blog_info']['site_url']);
		}

		// Modifier l'URL de la page d'accueil
		if ( array_key_exists ('is_public', $blog_infos_array['blog_info'])) {
			update_option('blog_public', $blog_infos_array['blog_info']['is_public']);
		}

		// Modifier la timezone
		if ( array_key_exists ('gmt_offset', $blog_infos_array['blog_info'])) {
			update_option('gmt_offset', $blog_infos_array['blog_info']['gmt_offset']);
		}

		// Modifier la timezone
		if ( array_key_exists ('timezone_string', $blog_infos_array['blog_info'])) {
			update_option('timezone_string', $blog_infos_array['blog_info']['timezone_string']);
		}

		// Modifier la langue
		if ( array_key_exists ('language', $blog_infos_array['blog_info'])) {
			update_option('WPLANG', $blog_infos_array['blog_info']['language']);
		}

	}

	public function export_current_plugin_infos_to ( &$blog_infos_array ) {
		CommonModel::get_instance()->export_current_plugin_infos_to($blog_infos_array);
	}

	public function get_current_themes_infos_to ( &$blog_infos_array ) {
		
        /*$current_theme = wp_get_theme();
        $current_theme_text_domain = $current_theme->get('TextDomain');

        $themes = wp_get_themes();

        $blog_infos_array['themes'] = array();
        
		foreach ($themes as $theme) { 

            $theme_text_domain  = $theme->get('TextDomain');
            
            $blog_infos_array['themes'][] = array( 
            	'textdomain' => $theme_text_domain, 
            	'action' => $current_theme_text_domain == $theme_text_domain ? 'activate' : 'deactivate' 
            );
        }*/

        $current_theme_stylesheet = get_stylesheet();
        
        $themes = wp_get_themes();

        $blog_infos_array['themes'] = array();
        
		foreach ($themes as $theme_stylesheet => $theme) { 

            $blog_infos_array['themes'][] = array( 
            	'name' => $theme->get('Name'), 
            	'stylesheet' => $theme_stylesheet, 
            	'action' => $current_theme_stylesheet == $theme_stylesheet ? 'activate' : 'deactivate' 
            );
        }

	}

	public function add_additionnal_configs ( $user_id ) {

		global $wpdb;

		// Say to wordpress that we will not use generated password
		if(get_user_meta($user_id, 'default_password_nag'))
			update_user_meta($user_id, 'default_password_nag', false);

		if(get_user_meta($user_id, $wpdb->prefix . 'default_password_nag'))
			update_user_meta($user_id, $wpdb->prefix . 'default_password_nag', false);

	}

	public function install_fresh_wp ( $user ) {

		// wp_install( string $blog_title, string $user_name, string $user_email, bool $is_public, string $deprecated = '', string $user_password = '', string $language = '' )

		return wp_install('default', $user->user_login, $user->user_email, 0);
	
	}

	public function set_admin_password ( $user_id, $user ) {

		//global $wpdb, $user;
		global $wpdb;

		$query = $wpdb->prepare("UPDATE `$wpdb->users` SET user_pass = %s, user_activation_key = '' WHERE ID = %d", $user->user_pass, $user_id);
		$wpdb->query($query);

	}
	
	// This function drop all tables except 'users'
	public function drop_tables ( $keep_users_table = false ) {

		global $wpdb;

		$prefix = str_replace('_', '\_', $wpdb->prefix );
		$tables = $wpdb->get_col("SHOW TABLES LIKE '{$prefix}%'" );

		//echo "SHOW TABLES LIKE '{$prefix}%'";

		foreach( $tables as $table ){

			if ( $keep_users_table && $table == $wpdb->users ) 
				continue;

			$wpdb->query("DROP TABLE `$table`");
		
		}

	}

	public function rename_tables ( $keep_users_table = false ) {

		global $wpdb;

		// We delete first all previous backup tables

		try {

			$old_backup_tables = $wpdb->get_col("SHOW TABLES LIKE 'awr_bkp_%'" );

			foreach( $old_backup_tables as $old_backup_table ){
				$wpdb->query("DROP TABLE `$old_backup_table`");
			}

			// Rename all current tables to awr_bkp_...
			$prefix = str_replace('_', '\_', $wpdb->prefix );
			$tables = $wpdb->get_col("SHOW TABLES LIKE '{$prefix}%'" );

			foreach( $tables as $table ){

				if ( $keep_users_table && $table == $wpdb->users ) {
					$this->copy_table ( $table, 'awr_bkp_' . $table );
					continue;
				}
	  			$wpdb->query("RENAME TABLE `$table` TO `awr_bkp_$table`");
			
			}
		}catch( \Exception $e ) {
			throw $e;
		}

	}

	public function copy_table ( $source_table, $destination_table ) {

		global $wpdb;

		// Prepare SQL queries to get the table structure and data
	    $source_table_structure_query = "SHOW CREATE TABLE `{$source_table}`";
	    $source_table_data_query = "SELECT * FROM `{$source_table}`";

	    // Get the source table structure
	    $source_table_structure = $wpdb->get_results($source_table_structure_query, ARRAY_A);

	    if ( empty($source_table_structure) ) {
	        // Source table does not exist or an error occurred
	        return false;
	    }

	    // Extract the table creation SQL
	    $source_table_creation_sql = $source_table_structure[0]['Create Table'];

	    // Create the destination table with the same structure as the source table
	    $wpdb->query("DROP TABLE IF EXISTS `{$destination_table}`");

	    $source_table_creation_sql = str_replace($source_table, $destination_table, $source_table_creation_sql );

	    $wpdb->query($source_table_creation_sql);
	    $wpdb->query("INSERT INTO `{$destination_table}` SELECT * FROM `{$source_table}`");
	}
	
	public function activate_current_theme () {

		$current_theme = wp_get_theme();
        switch_theme($current_theme->get_stylesheet());
	}

	public function activate_current_plugin_and_delete_others () {

		$plugins = get_plugins();

        // Loop through each plugin
        foreach ($plugins as $plugin_path => $plugin_data) { 

            if ( AWR_PLUGIN_FILENAME == $plugin_path ) {
            	activate_plugin($plugin_path);
            } else {
	            deactivate_plugins($plugin_path);
				//echo $plugin_path . ' - ';
				$this->delete_plugin($plugin_path);
			}
        }

	}
	
	public function handle_themes ( $sent_themes ) {

		if ( !is_array($sent_themes) || empty($sent_themes) )
			return;
		
		foreach ( $sent_themes as $theme_infos ) {

			// theme_infos = {'name' => '...', 'stylesheet' => '.....', 'action' => '...' }

			$action = $theme_infos['action'];
			$theme_stylesheet = $theme_infos['stylesheet'];

			if ( $theme_stylesheet == null ) continue;

			if ($action == 'deactivate') continue;

		    if ($action == 'activate') {
			   	//echo "<br />switch_theme " . $theme_stylesheet;
			    switch_theme($theme_stylesheet);
			}
			
			if ($action == 'uninstall') {
			    //echo "<br />wp_delete_theme " . $theme_stylesheet;
			    $this->delete_theme($theme_stylesheet);
			}

		}
	}

	public function import_current_plugin_infos_from ( &$blog_infos_array ) {

        foreach (AWR_OPTIONS_NAME as $option_constant_name ) {
		  	$option_name = constant($option_constant_name);
		  	update_option ( $option_name, $blog_infos_array['current_plugin_config'][ $option_name ], false );
		}
    }

	
	public function delete_theme( $theme_stylesheet ) {

		$themes_dir = get_theme_root();
		$theme_directory = $themes_dir . '/' . $theme_stylesheet;

		CommonModel::get_instance()->remove_dir($theme_directory);

	}

	public function delete_plugin( $filename ) {

		$dirname = dirname($filename);
		
		// If the plugin is in only one file without folder, 
		if ( $dirname == "." ) {
			$plugin_file = WP_PLUGIN_DIR . '/' . $filename;
			CommonModel::get_instance()->remove_file($plugin_file);
		} 
		// If the plugin is in a folder 
		else {
			$plugin_directory = WP_PLUGIN_DIR . '/' . $dirname;
			CommonModel::get_instance()->remove_dir($plugin_directory);
		}
	}

	
	public function get_current_admin_user () {

		global $current_user;

		if($current_user->user_login != 'admin')
			$user = get_user_by('login', 'admin');

		if(empty($user->user_level ) || $user->user_level < 10)
			$user = $current_user;

		return $user;

	}
	
	public function activate_current_plugin () {

		$plugins = get_plugins();

        $current_plugin_text_domain = AWR_PLUGIN_TEXTDOMAIN;

        // Loop through each plugin
        foreach ($plugins as $plugin_path => $plugin_data) { 

            $plugin_text_domain = $plugin_data['TextDomain'];

            if ( $current_plugin_text_domain == $plugin_text_domain ) {
            	activate_plugin($plugin_path);
            }
        }

	}
}

?>