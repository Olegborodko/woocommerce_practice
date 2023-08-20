<?php

namespace awr\endpoints;

use awr\utils\AjaxOutputter as AjaxOutputter;
use awr\services\ToolsResetService as ToolsResetService;

class ToolsResetController extends AbstractController {

	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new ToolsResetController();  
		}

		return self::$_instance;
	}

	public function run (){

		$this->run_reset();
	}

	public function get_tool_reset_service_instance() {
		return \awr\services\ToolsResetService::get_instance();
	}

	/**
	* Runs the reset of options (plugins, users, pages, ...),
	* - The option to reset is sent via : $_REQUEST['item_to_reset']
	* - In case the option requires to keep the current theme, the param $_REQUEST['keep_active_theme'] is set to true.
	* - In case the option is 'reset wp core version', the $_REQUEST['wp_version_switch'] mentions the new version to install
	* 
	* @return an AjaxOutputter object
	* 
	*/
	private function run_reset () {

		// Check if the user can run this function
		$this->check();
		
		// Get the item to reset and the options if any
		$item_to_reset 	= sanitize_html_class($_REQUEST['item_to_reset']);
		$options 		= array_key_exists('options', $_REQUEST) ? $_REQUEST['options'] : null;

		$extra_params = array();

		if( is_array ($options) && isset($options['keep_active_theme']) ) {
			$extra_params['keep_active_theme'] = sanitize_html_class($options['keep_active_theme']);
		}
		/*if( is_array ($options) && isset($options['target_wp_version']) ) {
			$extra_params['target_wp_version'] = $options['target_wp_version'];
		}*/

		try {

			$result = $this->get_tool_reset_service_instance()->reset ( $item_to_reset, $extra_params );

			$action = AWR_AJAX_ACTION_KEEP;

			if ( in_array ( $item_to_reset, array ( "cookies", "session" ) ) )
				$action = AWR_AJAX_ACTION_RELOAD;
				
			(new AjaxOutputter())
	            ->setAction($action)
	            ->setCode(1)
	            ->setMessage($result)
	            ->generate();
	        
	    } catch( \Exception $e ) {

	    	(new AjaxOutputter())
                ->setCode(0)
                ->setMessage($e->getMessage())
                ->generate();
	    }
	} 

	/**
	* Counts the number of items to reset
	*
	* @return an AjaxOutputter object, the number of items is put in the message attribute of AjaxOutputter object
	* 
	*/
	public function count_option_items (){
		
		$this->check();

		$option = sanitize_html_class($_REQUEST['awr_item_type']);
		$keep_active_theme = ( isset($_REQUEST['awr_keep_active_theme']) && $_REQUEST['awr_keep_active_theme'] == 0 ) ? false : true;

		$extra_params = array ( 
			'keep_active_theme' => $keep_active_theme, 
		);

		try {

			$result = $this->get_tool_reset_service_instance()->count ( $option, $extra_params );

			(new AjaxOutputter())
	                ->setCode(1)
	                ->setMessage($result)
	                ->generate();
	                
	    } catch( \Exception $e ) {

	    	(new AjaxOutputter())
                ->setCode(0)
                ->setMessage($e->getMessage())
                ->generate();
	    }

		wp_die(); // Always die after ajax call
	}

	public function count_all_options_items (){
		
		$this->check();

		try {

			$tasks = ToolsResetService::get_instance()->get_tasks_counted();

			(new AjaxOutputter())
		                ->setCode(1)
		                ->setMessage(json_encode($tasks))
		                ->generate();
		 
		} catch( \Exception $e ) {

	    	(new AjaxOutputter())
                ->setCode(0)
                ->setMessage($e->getMessage())
                ->generate();
	    }

		wp_die(); // Always die after ajax call
		
	}
}
