<?php 

/**
* Resets the database back to its initial status just like a fresh installation
*
* @return null
*/

namespace awr\endpoints;

use awr\utils\AjaxOutputter as AjaxOutputter;

class FullResetController extends AbstractController {

	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new FullResetController();  
		}

		return self::$_instance;
	}

	public function get_full_reset_service() {
		return 'awr\services\FullResetService';
	}

	// add_action('wp_ajax_awr_full_reset', array ( FullResetController::get_instance(), 'execute' )  );
	public function run (){

		// Verify ajax nonce before doing anything
		$this->check();

		$reset_form_data = $_REQUEST['reset_form_data'];

		//var_dump($reset_form_data);
		try {
			$FullResetService = $this->get_full_reset_service();
			$result = $FullResetService::get_instance()->execute ( $reset_form_data ) ;
			
			$this->get_ajax_output ( $reset_form_data, $result );

		} catch( \Exception $e ) {

	    	(new AjaxOutputter())
                ->setCode(0)
                ->setMessage($e->getMessage())
                ->generate();
	    }
		wp_die(); // Always die after ajax call 

	}

	public function get_ajax_output ( $blog_infos_array, $result, $keep = 0, $force_reload = 0 ) {

		if ( $keep == 1 ) {

			(new AjaxOutputter())
				->setCode($result)
				->generate();

		}

		$action = $force_reload == 1 ? AWR_AJAX_ACTION_RELOAD : AWR_AJAX_ACTION_KEEP;

		if ( $result == 1 ) {

			if ( is_array($blog_infos_array) && array_key_exists( 'plugins', $blog_infos_array) ) {

				$plugins = $blog_infos_array['plugins'];

				foreach ( $plugins as $plugin ) {

					if( $plugin['filename'] == AWR_PLUGIN_FILENAME ) {

						$action = $plugin['action'] == 'activate' ? AWR_AJAX_ACTION_RELOAD : AWR_AJAX_ACTION_REDIRECT;
						
						break;
						
					}
				}
			} else {
				$action = AWR_AJAX_ACTION_RELOAD;
			}
		}

		(new AjaxOutputter())
				->setAction($action)
				->setCode($result)
				->generate();

	}

}

?>