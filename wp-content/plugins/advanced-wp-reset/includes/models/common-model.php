<?php 

namespace awr\models;

class CommonModel {
	
	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new CommonModel ();  
		}

		return self::$_instance;
	}

    public function get_show_notifications () {

        // Default value : true
        $show_notifications = get_option( AWR_SHOW_NOTIFICATIONS, true); 

        return $show_notifications;

    }

    public function show_notifications ( $show ) {
    
        return update_option ( AWR_SHOW_NOTIFICATIONS, $show );
    }   
    
	public function remove_dir( $dir ) {
		
		if (is_dir($dir)) {
			
			$objects = scandir($dir);
			
			foreach ($objects as $object) {
			
				if ($object != "." && $object != "..") {
			
					if (is_dir($dir.'/'.$object)) {
						$this->remove_dir($dir.'/'.$object);
					} else {
						unlink($dir.'/'.$object);
					}
			
				}
			
			}
		
			rmdir($dir);
		}
	}

	public function remove_file ( $file ) {
		unlink($file);
	}

	public function starts_with ( $haystack1, $needle ) {
		return 0 === stripos($haystack1, $needle);
	}
    
    // We put in AWR_HIDDEN_BLOCS only hidden blocs
    public function save_hidden_bloc ($bloc_id, $hidden) {
        
        $hidden_blocs = $this->get_hidden_blocs();

        if ( $hidden == 1 ) {
			if ( !in_array( $bloc_id , $hidden_blocs) )
				$hidden_blocs[] = $bloc_id;
        }
        else {

        	if ( in_array( $bloc_id , $hidden_blocs) ) {
        		$index = array_search($bloc_id, $hidden_blocs);
        		if ( $index > -1 )
		        	unset($hidden_blocs[$index]);
        	}
        }

        update_option( AWR_HIDDEN_BLOCS, $hidden_blocs );

        return $hidden_blocs;
    }

    // We put in AWR_HIDDEN_BLOCS only hidden blocs
    public function get_hidden_blocs () {
        
        $hidden_blocs = get_option( AWR_HIDDEN_BLOCS, array() );
        
        $hidden_blocs = $hidden_blocs == false || !is_array($hidden_blocs) ? array() : maybe_unserialize ( $hidden_blocs );

        return $hidden_blocs;
    }

    function time_passed ( $event_timestamp ) {

	    $current_timestamp = time();
	    $time_difference = $current_timestamp - $event_timestamp;
	    $result = '';

	    $years = floor($time_difference / (365 * 24 * 60 * 60));
	    $time_difference %= (365 * 24 * 60 * 60);
	    
	    if ($years > 0) {
	        $result .= $years . 'y ';
	    }

	    $months = floor($time_difference / (30 * 24 * 60 * 60));
	    $time_difference %= (30 * 24 * 60 * 60);

	    if ($months > 0) {
	        $result .= $months . 'm ';
	    }

	    // If there is years, we only print years and months
	    if ( $years > 0 )
	    	return $result . ' ago';

	    $days = floor($time_difference / (24 * 60 * 60));
	    $time_difference %= (24 * 60 * 60);

	    if ($days > 0) {
	        $result .= $days . 'd ';
	    }

	    // If there is months, we only print years and months and days
	    if ( $months > 0 )
	    	return $result . ' ago';

	    $hours = floor($time_difference / (60 * 60));
	    $time_difference %= (60 * 60);
	
		if ($hours > 0) {
	        $result .= $hours . 'h ';
	    }

	    // If there is days, we only print years and months and days
	    if ( $days > 0  )
	    	return $result . ' ago';

	    $minutes = floor($time_difference / 60);
	    
	    if ($minutes > 0) {
	        $result .= $minutes . 'm ';
	    }

	    // If there is hours, we only print years and hours and minutes
	    if ( $hours > 0  )
	    	return $result . ' ago';

	    $seconds = $time_difference % 60;
	    
	    if ($seconds > 0) {
	        $result .= $seconds . 's ';
	    }

	    if ( $result == '' )
	    	return 'now';

	    return $result . ' ago';
	}

    public function log_to_file($message) {
        
        // File path for the log file (adjust the path as needed)
        $log_file = WP_CONTENT_DIR . '/awp_crons.log';

        // Current date and time for the log entry
        $timestamp = date('Y-m-d H:i:s');

        // Log format: [timestamp] message
        $log_entry = "[$timestamp] $message" . PHP_EOL;

        // Append the log entry to the file
        file_put_contents($log_file, $log_entry, FILE_APPEND);
    }

    public function get_system_infos () {

    	$array = array();
		
		$this->add_server_infos ( $array );
		$this->add_wordpress_infos ( $array );
		$this->add_permissions_infos ( $array );
		$this->add_wordpress_config_infos ( $array );
		$this->add_awr_options ( $array );

		return $array;

    }

    private function add_server_infos ( &$array ) {

    	global $wpdb;

    	// Server Environment
		$server_information = array ();
		
		$server_information['server_type'] 			= $_SERVER['SERVER_SOFTWARE'];
		$server_information['php_version '] 		= phpversion();
    	$server_information['mysql_version ']		= $wpdb->db_version();
		$server_information['max_execution_time'] 	= ini_get('max_execution_time');
		$server_information['memory_limit'] 		= ini_get('memory_limit');
		$server_information['server_os'] 			= php_uname('s');

		$array['server_information'] = $server_information;
    }

    private function add_wordpress_infos ( &$array ) {

    	// WordPress Information
    	$wp_information = array ();
    	$wp_information['wordpress'] = get_bloginfo('version');

    	$active_theme = wp_get_theme();

		// Get the active theme name
		$active_theme_name = $active_theme->get('Name');
		$active_theme_version = $active_theme->get('Version');

		// Get the parent theme name (if the active theme is a child theme)
		$parent_theme_name = $active_theme->parent() ? $active_theme->parent()->get('Name') : '';
		$parent_theme_version = $active_theme->parent() ? $active_theme->parent()->get('Version') : '';

		$wp_information['active_theme'] = $active_theme_name . ' [' . $active_theme_version . ']';
		$wp_information['parent_theme'] = $parent_theme_name . ' [' . $parent_theme_version . ']';


		$wp_information['active_plugins'] = array();

		$active_plugins = get_option('active_plugins');

		foreach ($active_plugins as $plugin) {

		    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
		    
		    $wp_information['active_plugins'][] = $plugin_data['Name'] . ' [' . $plugin_data['Version'] . ']';
		}

		$array['wp_information'] = $wp_information;
    }

    private function add_wordpress_config_infos ( &$array ) {

    	// WordPress Information
    	$wp_config = array ();
    	
		$wp_config['WP_DEBUG'        ] = WP_DEBUG ? 'Enabled' : 'Disabled';
		$wp_config['WP_DEBUG_LOG'    ] = WP_DEBUG_LOG ? 'Enabled' : 'Disabled';
		$wp_config['WP_DEBUG_DISPLAY'] = WP_DEBUG_DISPLAY ? 'Enabled' : 'Disabled';
		
		// Get site URL and home URL
		$wp_config['site_url'] = get_site_url();
		$wp_config['home_url'] = get_home_url();

		// Get permalink structure
		$wp_config['permalink_structure'] = get_option('permalink_structure');

		$array['wp_config'] = $wp_config;
    }

    private function add_permissions_infos ( &$array ) {

    	// Check if the "uploads" directory is writable
		$uploads_dir = wp_upload_dir();
		$uploads_path = $uploads_dir['basedir'];
		$uploads_writable = wp_is_writable($uploads_path);

		// Check if the "plugins" directory is writable
		$plugins_path = WP_PLUGIN_DIR;
		$plugins_writable = wp_is_writable($plugins_path);

		// Check if the "themes" directory is writable
		$themes_path = get_theme_root();
		$themes_writable = wp_is_writable($themes_path);

		$array['Permissions'] = array (
			'Uploads directory is writable: ' => ($uploads_writable ? 'Yes' : 'No'),
			'Plugins directory is writable: ' => ($plugins_writable ? 'Yes' : 'No'),
			'Themes directory is writable: ' => ($themes_writable ? 'Yes' : 'No'),
		);
	}

	private function add_awr_options ( &$array ) {
		$this->export_current_plugin_infos_to ($array, true);
	}

	public function export_current_plugin_infos_to ( &$array, $stringify = false ) {

		$array['current_plugin_config'] = array(); 
		
		foreach (AWR_OPTIONS_NAME as $option_constant_name ) {
			$option_name = constant($option_constant_name);
  			$option_value = get_option($option_name);
			$array['current_plugin_config'][$option_name] = $stringify ? json_encode($option_value) : $option_value;
		}
	}
	
}

?>