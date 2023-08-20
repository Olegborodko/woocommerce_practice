<?php 

class AWR_Application {

	/* For Singleton Pattern */
    private static $_instance = null;
    public static function get_instance() {
 
        if(is_null(self::$_instance)) {
            self::$_instance = new AWR_Application();  
        }

        return self::$_instance;
    }
    
	function add_plugin_links( $actions, $plugin_file ) {

		$links = array();
		
	    if ( AWR_PLUGIN_FILENAME === $plugin_file ) {
	    	
	    	$links['upgrade'] = '<a href="' . AWR_PLUGIN_PRO_STORE_URL . '"" target="_blank" style="font-weight: bold; color: #1da867;">' . __( 'Upgrade to Pro', AWR_PLUGIN_TEXTDOMAIN ) . '</a>';

	    	$links['plugin_homepage'] = '<a href="' . admin_url('tools.php?page=awr_full_reset') . '">' . __('Home', AWR_PLUGIN_TEXTDOMAIN). '</a>';

	   	}

	    return array_merge($links, $actions);
	}

	function add_plugin_meta_links( $links, $file ) {

		if ( AWR_PLUGIN_FILENAME !== $file ) {
			return $links;
		}

		$support_link = '<a target="_blank" href="' . AWR_PLUGIN_SUPPORT . '" title="' . __('Get help', AWR_PLUGIN_TEXTDOMAIN) . '">' . __('Support', AWR_PLUGIN_TEXTDOMAIN) . '</a>';
		$home_link = '<a target="_blank" href="' . AWR_PLUGIN_STORE_URL . '" title="' . __('Plugin Homepage', AWR_PLUGIN_TEXTDOMAIN) . '">' . __('Plugin Homepage', AWR_PLUGIN_TEXTDOMAIN) . '</a>';
		$rate_link = '<a target="_blank" href="' . AWR_PLUGIN_RATING . '" title="' . __('Rate the plugin', AWR_PLUGIN_TEXTDOMAIN) . '">' . __('Rate the plugin ★★★★★', AWR_PLUGIN_TEXTDOMAIN) . '</a>';
		$pro_version = '<a target="_blank" href="' . AWR_PLUGIN_PRO_STORE_URL . '" title="' . __('PRO Version', AWR_PLUGIN_TEXTDOMAIN) . '">' . __('PRO version', AWR_PLUGIN_TEXTDOMAIN) . '</a>';

		$links[] = $pro_version;
		$links[] = $support_link;
		$links[] = $home_link;
		$links[] = $rate_link;

		return $links;
	}

	public function __construct() {
    
		add_action ( 'admin_enqueue_scripts' , array( $this, 'enqueue_css_js' ) );
		add_action ( 'admin_menu', array( $this, 'add_admin_pages') );

		/* include files */
		include_once 'includes/endpoints/all.inc.php';
		include_once 'includes/services/all.inc.php';
		include_once 'includes/models/all.inc.php';
		include_once 'includes/utils/all.inc.php';
		
		/* Includes all the ajax actions */ 
		include_once 'actions.inc.php';
		
		load_plugin_textdomain( AWR_PLUGIN_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages' );

		add_filter( 'plugin_action_links', array( $this, 'add_plugin_links' ) , 10, 2 );
		add_filter('plugin_row_meta', array($this, 'add_plugin_meta_links'), 10, 2);

		//add_action('admin_notices', array($this, 'display_activation_notice') );
		//add_action('admin_notices', array($this, 'display_update_notice' ) );
		//add_action('plugins_loaded', array($this, 'check_plugin_version') );
	}

	function check_plugin_version() {
	    
	    $current_version = AWR_PLUGIN_VERSION; //AWR_PLUGIN_VERSION; // Replace with the current version of your plugin

	    $previous_version = get_transient(AWR_PREVIOUS_VERSION);
	    
	    if ($current_version !== $previous_version) {
	        set_transient(AWR_PLUGIN_UPDATE_NOTICE, true, DAY_IN_SECONDS); // Set transient for 24 hours
	        set_transient(AWR_PREVIOUS_VERSION, $current_version);
	    }
	}

	function display_update_notice() {

	    if ( get_transient(AWR_PLUGIN_UPDATE_NOTICE) ) {
	        ?>
	        <div class="notice notice-success is-dismissible">
	            <p>
	            	<?php 
	            	_e('Thank you for updating <b>Advanced WP Reset</b>! A <b>PRO version</b> with advanced exclusive features is available. <a href="' . AWR_PLUGIN_PRO_STORE_URL . '" target="_blank" style="font-weight: bold; color: #1da867;">Learn more</a>', AWR_PLUGIN_TEXTDOMAIN); ?></p>
	        </div>
	        <?php
	        delete_transient( AWR_PLUGIN_UPDATE_NOTICE );
	    }
	}
	
	function display_activation_notice() {
	    
	    if (get_option(AWR_ACTIVATION_DISPLAYED) !== 'yes') {
	        ?>
	        <div class="notice notice-success is-dismissible">
	            <p>
	            	<?php 
	            	_e('Thank you for activating <b>Advanced WP Reset</b>! A <b>PRO version</b> with advanced exclusive features is available. <a href="' . AWR_PLUGIN_PRO_STORE_URL . '" target="_blank" style="font-weight: bold; color: #1da867;">Learn more</a>', AWR_PLUGIN_TEXTDOMAIN); ?></p>
	        </div>
	        <?php
	        update_option(AWR_ACTIVATION_DISPLAYED, 'yes');
	    }
	}

	function activate() {


		//$this->enqueue_css_js();
	    $this->set_scheduled_tasks();

	    // Show notifications, if not set, we set it to true
        $show_notifications = get_option( AWR_SHOW_NOTIFICATIONS, true); 
        update_option ( AWR_SHOW_NOTIFICATIONS, $show_notifications );

		flush_rewrite_rules();
	}

	function deactivate() {
	    $this->clear_scheduled_tasks();
		flush_rewrite_rules();
	}

	function set_scheduled_tasks() {
	}

	function clear_scheduled_tasks() {
	}

	function enqueue_css_js($hook) {
		
		// Enqueue our js and css in the plugin pages only
		global $awr_tool_submenu;
		
		if($hook != $awr_tool_submenu){
			return;
		}

		// JS
		wp_enqueue_script( 'sweet2_js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11');
		
		wp_enqueue_script( 'awr_app_swal', AWR_PLUGIN_JS_URL . '/app_swal.js' );
		wp_enqueue_script( 'awr_script_js', AWR_PLUGIN_JS_URL . '/app.js', array ('awr_app_swal') );
		wp_enqueue_script( 'awr_reset_js', AWR_PLUGIN_JS_URL . '/app-reset.js', array ('awr_app_swal') );
		wp_enqueue_script( 'awr_tools_js', AWR_PLUGIN_JS_URL . '/app-tools.js', array ('awr_app_swal') );
		wp_enqueue_script( 'awr_snapshot_js', AWR_PLUGIN_JS_URL . '/app-snapshot.js', array ('awr_app_swal') );

		wp_enqueue_script( 'awr_free_js', AWR_PLUGIN_JS_URL . '/free-script.js', array ('awr_app_swal') );
		
		
		// CSS
		wp_enqueue_style( 'awr_style', AWR_PLUGIN_CSS_URL . '/style.css' );
		wp_enqueue_style( 'sweet2_css_custom', AWR_PLUGIN_CSS_URL . '/sweetalert2-custom.css' );
		wp_enqueue_style( 'awr_icon_css', AWR_PLUGIN_CSS_URL . '/icons.css' );
		
		wp_enqueue_style( 'google_css', 'https://fonts.googleapis.com/css2?family=League+Spartan:wght@200;300;400;500;600;700;800&display=swap' );

		require_once 'js.config.inc.php';
	}

	function add_admin_pages() {
		
		global $awr_tool_submenu;
		$awr_tool_submenu = add_submenu_page(
			'tools.php', 
			AWR_PLUGIN_SHORT_NAME, 
			AWR_PLUGIN_SHORT_NAME, 
			'manage_options', 
			"awr_full_reset", 
			array( $this, 'plugin_home_page' ) 
		);
	}

	function plugin_home_page() {
		require_once AWR_PLUGIN_ABSOLUTE_DIR . '/awp-reset-front/templates/home-template.php';
	}

}

?>