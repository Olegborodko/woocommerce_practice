<?php 

namespace awr\endpoints;

/*if (class_exists('AbstractController')) {
	exit(0);
}*/

abstract class AbstractController {

	abstract protected function run ();	

	protected function check () {
		
		// Security and role check
		check_ajax_referer('awr_nonce', 'security');

		if(!current_user_can('administrator')){
			wp_send_json_error(__('Not sufficient permissions!', AWR_PLUGIN_TEXTDOMAIN));
		}

	}

	public final function execute () {

		// Check security nonce and admin role.
		$this->check();

		try {
		
			$this->run ();

			wp_send_json_success();

		} catch( \Exception $e ) {
			wp_send_json_error(__( $e->getMessage() , AWR_PLUGIN_TEXTDOMAIN));
		}
	}
}

?>