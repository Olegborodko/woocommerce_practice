<?php 

namespace awr\services;

use awr\models\FullReseterModel as FullReseterModel;

class FullResetService {
	
	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new FullResetService ();  
		}

		return self::$_instance;
	}

	public function execute ( $reset_form_data ) {

		require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

		// Get admin user
		$user = FullReseterModel::get_instance()->get_current_admin_user ();

		$type = $reset_form_data['type'];

		$user_id = -1;

		switch ( $type ){
			
			case '': 
				throw new \Exception('Empty reset type');
			case 'default': 
				$user_id = $this->perform_default_reset( $user, $reset_form_data );;
				break;

			default:
				throw new \Exception('Unknown reset type: ' . $type);
		
		}

		// Reconnect the current user.
		wp_set_auth_cookie( $user_id );

		return 1;

	}

	public function perform_default_reset( $user, $reset_form_data ) {
		
		try {

			FullReseterModel::get_instance()->export_blog_infos_to ( $reset_form_data );

			FullReseterModel::get_instance()->export_current_plugin_infos_to ( $reset_form_data );

			FullReseterModel::get_instance()->get_current_themes_infos_to ( $reset_form_data );

			// Move tables to backup tables
			FullReseterModel::get_instance()->rename_tables ( true );
			// Install Fresh wordpress
			$result = FullReseterModel::get_instance()->install_fresh_wp ( $user );
			$user_id = $result['user_id'];

			// Set admin password
			FullReseterModel::get_instance()->set_admin_password ( $user_id, $user ) ;
			FullReseterModel::get_instance()->add_additionnal_configs ( $user_id );
			
			if ( array_key_exists('themes', $reset_form_data) )
				FullReseterModel::get_instance()->handle_themes ( $reset_form_data['themes'] );
	
			FullReseterModel::get_instance()->import_blog_infos_from ( $reset_form_data );
			FullReseterModel::get_instance()->import_current_plugin_infos_from( $reset_form_data );

			// Activate current theme and plugin
			FullReseterModel::get_instance()->activate_current_theme ();
			FullReseterModel::get_instance()->activate_current_plugin ();
			
			return $user_id;

		}catch( \Exception $e) {
			throw $e;
		}
	}

}
