<?php 

namespace awr\services;

use awr\models\ItemsReseterModel as ItemsReseterModel;
use awr\models\ItemsFetcherModel as ItemsFetcherModel;

class ToolsResetService {
	
	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new ToolsResetService();  
		}

		return self::$_instance;
	}

	/**
	 * Runs the reset
	 * @param option: the option to reset : pages, users, ...
	 * @param extra_params : an array ('keep_active_theme': 0/1, 'wp-version': '6.0' for example, the version to switch wp to) or String thaht contains wp-version only, used in CollectionController::run_collection
	 * 
	 * @return 1 if the reset is successfully done
	 * @throws Exception if an error occurs
	 * 
	 */ 
	public function reset ( $option, $extra_params ){

		$reseter = ItemsReseterModel::get_instance();

		try {

			switch( $option ){
				
				// ############### FREE VERSION ################# 

				case 'uploads-files':
					$reseter->uploads_dir();
					break;

				case 'themes-files' :
					$keep_active_theme = is_array($extra_params) && array_key_exists('keep_active_theme', $extra_params) ? $extra_params['keep_active_theme'] : 1;
					$reseter->delete_all_themes($keep_active_theme);
					break;

				case 'plugins-files' :
					$reseter->delete_all_plugins();
					break;

				case 'wp-content-files' :

					$reseter->reset_wp_content_dir();
					break;

				case 'mu-plugins-files' :
					$reseter->reset_mu_plugins_dir();
					break;

				case 'htaccess-files' :
					$reseter->delete_htaccess_file();
					break;

				case 'dropins':
					$reseter->delete_dropins();
					break;

				case 'all-comments' :
					$reseter->delete_comments("all-comments");
					break;

				case 'pending-comments' :
					$reseter->delete_comments("pending-comments");
					break;

				case 'spam-comments' :
					$reseter->delete_comments("spam-comments");
					break;

				case 'trashed-comments' :
					$reseter->delete_comments("trashed-comments");
					break;

				case 'pingbacks' :
					$reseter->delete_comments("pingbacks");
					break;

				case 'trackbacks' :
					$reseter->delete_comments("trackbacks");
					break;
				case 'cache' :
					$reseter->clear_cache();
					break;
					
				default:
					throw new \Exception ( 'Cannot find this option! ' . $option );
			}
			
			return 1;

		}catch (\Exception $e) {
			throw $e;
		}

	}

	/**
	 * Counts the option elements
	 * @param option: the option to reset : pages, users, ...
	 * @param extra_params : an array ('ignore_active_theme': 0/1)
	 * 
	 * @return count
	 * @throws Exception ('Unknown option name: ' . $option);
	 * 
	 */ 
	public function count ( $option, $extra_params = array() ){

		$fetcher = ItemsFetcherModel::get_instance();
		
		switch($option){

			case 'uploads-files' :
				// Get uploads dir path
				$result = $fetcher->count_upload_files ();
				break;
			case 'themes-files' :
				$keep_active_theme = is_array($extra_params) && array_key_exists('keep_active_theme', $extra_params) ? $extra_params['keep_active_theme'] : 1;
				$result = $fetcher->count_themes ( $keep_active_theme );
				break;
			case 'plugins-files' :
				$result = $fetcher->count_plugins (1);
				break;
			case 'wp-content-files' :
				$result = $fetcher->count_wp_content_files();
				break;
			case 'mu-plugins-files' :
				$result = $fetcher->count_mu_plugins();
				break;
			case 'htaccess-files' :
				$result = $fetcher->count_htaccess_files();
				break;
			case 'dropins' :
				$result = $fetcher->count_dropins();
				break;
			case 'all-comments' :
				$result = $fetcher->count_comments("all-comments");
				break;
			case 'pending-comments' :
				$result = $fetcher->count_comments("pending-comments");
				break;
			case 'spam-comments' :
				$result = $fetcher->count_comments("spam-comments");
				break;
			case 'trashed-comments' :
				$result = $fetcher->count_comments("trashed-comments");
				break;
			case 'pingbacks' :
				$result = $fetcher->count_comments("pingbacks");
				break;
			case 'trackbacks' :
				$result = $fetcher->count_comments("trackbacks");
				break;
			
			/* PRO */ 
			case 'wp-version' :
				$result = $fetcher->get_wp_version();
				break;
			case 'all-options':
				$result = $fetcher->count_all_options_to_delete();
				break;
			case 'nav-menus' :
				$result = $fetcher->count_nav_menus();
				break;
			case 'widgets' :
				$result = $fetcher->count_widgets();
				break;
			case 'transients' :
				$result = $fetcher->count_transients();
				break;
			case 'themes-options' :
				$result = $fetcher->count_theme_options();
				break;
			case 'posts' :
				$result = $fetcher->count_posts();
				break;
			case 'pages' :
				$result = $fetcher->count_pages();
				break;
			case 'media' :
				$result = $fetcher->count_media();
				break;
			case 'pages-revisions' :
				$result = $fetcher->count_revisions();
				break;
			case 'pages-drafts' :
				$result = $fetcher->count_pages('draft');
				break;
			case 'pages-auto-draft' :
				$result = $fetcher->count_pages('auto-draft');
				break;
			case 'pages-empty-trash' :
				$result = $fetcher->count_pages('trash');
				break;
			case 'posts-drafts' :
				$result = $fetcher->count_posts('draft');
				break;
			case 'posts-auto-draft' :
				$result = $fetcher->count_posts('auto-draft');
				break;
			case 'posts-empty-trash' :
				$result = $fetcher->count_posts('trash');
				break;
			case 'categories' :
				$result = $fetcher->count_categories();
				break;
			case 'tags' :
				$result = $fetcher->count_tags();
				break;
			case 'all-comments' :
				$result = $fetcher->count_comments("all-comments");
				break;
			case 'pending-comments' :
				$result = $fetcher->count_comments("pending-comments");
				break;
			case 'spam-comments' :
				$result = $fetcher->count_comments("spam-comments");
				break;
			case 'trashed-comments' :
				$result = $fetcher->count_comments("trashed-comments");
				break;
			case 'pingbacks' :
				$result = $fetcher->count_comments("pingbacks");
				break;
			case 'trackbacks' :
				$result = $fetcher->count_comments("trackbacks");
				break;
			case 'user-roles' :
				$result = $fetcher->count_user_roles();
				break;
			case 'users' :
				$result = $fetcher->count_users();
				break;
			case 'empty-custom-tables':
				$result = $fetcher->count_non_empty_custom_tables();
				break;
			case 'drop-custom-tables':
				$result = $fetcher->count_custom_tables();
				break;
			default:
				throw new \Exception ('Cannot find this option! ' . $option);
		}

		return $result;
	}

	public function get_tasks_counted () {

		$tasks = array();

		$fetcher = ItemsFetcherModel::get_instance();
		$items_array = $fetcher->get_tools_array();

		if ( !is_array($items_array) or empty($items_array) )
			return $tasks;

		foreach ($items_array as $item_type => $item_info) {

			if ( !is_array($item_info) or empty($item_info) or !array_key_exists ('table_tasks', $item_info) )
				continue;

			foreach ($item_info['table_tasks'] as $row_task) {
				if ( !array_key_exists('has_total', $row_task) || $row_task['has_total'] == true ){
					
					try{
						$option = $row_task['task'];
						$count = $this->count( $option );
						$tasks[] = array ($option, $count);
					}catch(\Exception $e) {
						continue;
					}
				}
			}
		}

		//var_dump($tasks);

		return $tasks;
	}

	public function get_tasks () {

		$tasks = array();

		$fetcher = ItemsFetcherModel::get_instance();
		$items_array = $fetcher->get_tools_array();

		return $items_array;
	}

	public function get_wp_version_list() {
		return ItemsFetcherModel::get_instance()->get_wp_version_list();
	}

	
}


?>