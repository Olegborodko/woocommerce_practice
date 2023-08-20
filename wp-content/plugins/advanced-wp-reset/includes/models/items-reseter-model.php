<?php 

namespace awr\models;

use awr\models\ItemsFetcherModel as ItemsFetcherModel;
use awr\models\CommonModel;

class ItemsReseterModel  {

	/* For Singleton Pattern */
	private static $_instance = null;
 	private function __construct() {  
   	}
 
   	public static function get_instance() {
 
		if(is_null(self::$_instance)) {
			self::$_instance = new ItemsReseterModel ();  
		}

		return self::$_instance;
	}
	
	/**
	* Deletes all files and folders in "uploads" directory
	*
	* @return is_null
	*/
	public function uploads_dir(){
		
		// Get uploads dir path
		$uploads_dir = wp_upload_dir(null, false);

		clearstatcache();

		if(file_exists($uploads_dir['basedir']))
			$this->delete_folder_content($uploads_dir['basedir'], $uploads_dir['basedir'], false);

		global $wpdb;
			
		$wpdb->delete( 'wp_posts', array( 'post_type' => "attachment" ) );
		$wpdb->delete( 'wp_postmeta', array( 'meta_key' => "_wp_attached_file" ) );
		$wpdb->delete( 'wp_postmeta', array( 'meta_key' => "_wp_attachment_metadata" ) );

	}

	/**
	* Deletes all content in a folder without deleting the folder itself
	*
	* @param string $folder current folder
	* @param string $original_folder original folder
	* @param bool $delete_original_folder Either to delete or no the original folder
	*
	* @return bool
	*/
	private function delete_folder_content( $folder, $original_folder, $delete_original_folder = false ){

		// Get all files and folders names excluding . and .. and "DBR.txt"
		$all_files = array_diff(scandir($folder), array('.', '..'));

		foreach($all_files as $file){
			if(is_dir($folder . DIRECTORY_SEPARATOR . $file)){
				$this->delete_folder_content($folder . DIRECTORY_SEPARATOR . $file, $original_folder, $delete_original_folder);
			}else{
				@unlink($folder . DIRECTORY_SEPARATOR . $file);
			}
		}

		// Delete the original folder if $delete_original_folder == true, otherwise keep it. Delete all other content folders
		if($delete_original_folder == true || $folder != $original_folder){
			$result = @rmdir($folder);
			return $result;
		}else{
			return true;
		}
	}

	public function delete_theme( $theme_stylesheet ) {

		$themes_directory = get_theme_root();
		$theme_folder_path = $themes_directory . '/' . $theme_stylesheet;

		CommonModel::get_instance()->remove_dir($theme_folder_path);

	}

	/**
	* Deletes all themes
	*
	* @param bool $keep_active_theme Keep default theme
	*
	* @return null
	*/
	public function delete_all_themes($keep_active_theme = 1){

		// Return all themes
		$all_themes = wp_get_themes(array('errors' => null));

		$active_theme = get_template();
		$active_child = get_stylesheet();

		if( $keep_active_theme == 1 ){
			unset($all_themes[$active_theme]);
			unset($all_themes[$active_child]);
		}

		foreach($all_themes as $name_slug => $theme){
			$this->delete_theme($theme->get_stylesheet());
		}

		// After deleting all themes, update DB option
		if( $keep_active_theme == 0 ){
			update_option('template', '');
			update_option('stylesheet', '');
			update_option('current_theme', '');
		}
	}

	public function delete_dropins( $report_errors = true ) {

		$deleted = $found = 0;
		
		$dropins = _get_dropins();
		//var_dump ( $dropins );
		foreach( $dropins as $wp_dropin_file => $temp ) {

			if ( file_exists( trailingslashit(WP_CONTENT_DIR) . $wp_dropin_file ) ) {
				$found++;

				$deleted += unlink(trailingslashit(WP_CONTENT_DIR) . $wp_dropin_file) ? 1 : 0;
			}
		}

	  if ($report_errors && $found - $deleted != 0) {
	    return new \WP_Error(1, ($found - $deleted) . ' dropins could not be deleted.');
	  }

	  return $deleted;
	}

	/**
	* Deletes all plugins
	*
	* @return null
	*/
	public function delete_all_plugins(){

	  	//require_once WP_CONTENT_DIR . '/../wp-load.php';

	  	$plugins_list = get_plugins();

		// Keep this plugin
		unset($plugins_list[AWR_PLUGIN_FILENAME]);
		
		if(!empty($plugins_list)){
			deactivate_plugins(array_keys($plugins_list));
			delete_plugins(array_keys($plugins_list));
		}
	}

	/**
	* Deletes all 'wp-content' folder content except these folders: 'plugins', 'themes', 'uploads', 'mu-plugins' and 'index.php'
	*
	* @return null
	*/
	public function reset_wp_content_dir(){

		if(!file_exists(WP_CONTENT_DIR))
			return;

		// Get all folders and files in 'wp-content' except the array in prameter.
		$all_files = array_diff(scandir(WP_CONTENT_DIR), array('.', '..', 'plugins', 'themes', 'uploads', 'mu-plugins', 'index.php', 'awp_crons.log'));

		// Delete
		foreach($all_files as $file){
			if(is_dir(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . $file)){
				$this->delete_folder_content(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . $file, "", true);
			}else{
				@unlink(WP_CONTENT_DIR . DIRECTORY_SEPARATOR . $file);
			}
		}
	}

	/**
	* Deletes all 'mu-plugins' content
	*
	* @return null
	*/
	public function reset_mu_plugins_dir(){

		if(!file_exists(WPMU_PLUGIN_DIR))
			return;

		// Get all folders and files in 'mu-plugins' except the array in prameter
		$all_files = array_diff(scandir(WPMU_PLUGIN_DIR), array('.', '..', 'index.php'));

		// Delete
		foreach($all_files as $file){
			if(is_dir(WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . $file)){
				$this->delete_folder_content(WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . $file, "", true);
			}else{
				@unlink(WPMU_PLUGIN_DIR . DIRECTORY_SEPARATOR . $file);
			}
		}
	}

	/**
	* Deletes the type of comments in parameter
	*
	* @param string $comment_type the comment type to delete
	*
	* @return null
	*/
	public function delete_comments($comment_type){

		global $wpdb;
		$sql_query = "";

		switch($comment_type){
			case 'all-comments' :
				$sql_query = "DELETE from `$wpdb->comments`";
				$wpdb->query("TRUNCATE TABLE `$wpdb->commentmeta`");
				break;
			case 'pending-comments' :
				$sql_query = "DELETE from `$wpdb->comments` WHERE comment_approved = '0'";
				break;
			case 'spam-comments' :
				$sql_query = "DELETE from `$wpdb->comments` WHERE comment_approved = 'spam'";
				break;
			case 'trashed-comments' :
				$sql_query = "DELETE from `$wpdb->comments` WHERE comment_approved = 'trash'";
				break;
			case 'pingbacks' :
				$sql_query = "DELETE from `$wpdb->comments` WHERE comment_type = 'pingback'";
				break;
			case 'trackbacks' :
				$sql_query = "DELETE from `$wpdb->comments` WHERE comment_type = 'trackback'";
				break;
			default:
				return " - ";
		}

		$total = $wpdb->get_var($sql_query);
		return $total;
	}

	/**
	 * Deletes .htaccess file
	 *
	 * @return null
	 */
	public function delete_htaccess_file( $report_errors = true ){

		$htaccess_file = get_home_path() . '.htaccess';

		clearstatcache();

		if( $report_errors && !is_readable($htaccess_file)){
            throw new \Exception('Cannot be deleted! The Htaccess file does not exist!');
		}

		if( $report_errors && !is_writable($htaccess_file)){
			throw new \Exception('Cannot be deleted! Htaccess file is not writable!');
		}

		if( $report_errors && !unlink($htaccess_file) ){
			throw new \Exception('Cannot be deleted! Unknown error!');
		} else 
			return 1;
	}

	//////////////////////

	/**
	* deletes session variables both in the server and in the client
	*
	* @return bool
	*/
	public function destroy_session() {
		session_destroy();
	}

	public function delete_media() {
		$media_list = ItemsFetcherModel::get_instance()->get_media_ids();

		foreach($media_list as $item) {
			wp_delete_post($item->ID, true);
		}
	}

	public function clear_cache() {

		wp_cache_flush();

		// 2. Cache Enabler:
		if (class_exists('Cache_Enabler')) {
		    //ce_clear_cache();
		    \Cache_Enabler::clear_complete_cache();
		}

	    // 3. W3 Total Cache
		if (function_exists('w3tc_flush_all')) {
		    w3tc_flush_all();
		}

		// 4. WP Super Cache:
		if (function_exists('wp_cache_clear_cache')) {
		    wp_cache_clear_cache();
		}

		// 5. Clear WP Fastest Cache
		if (class_exists('WpFastestCache')) {
		    $wp_fastest_cache = new \WpFastestCache();
		    $wp_fastest_cache->deleteCache(true);
		}

		// 6. Clear Hyper Cache
		if (class_exists('HyperCache')) {
		    \HyperCache::$instance->hook_hyper_cache_clean();
		}

		// 7. Autoptimize:
		if (class_exists('autoptimizeCache')) {
		    \autoptimizeCache::clearall();
		}

		// 8. Clear LiteSpeed Cache
		if (class_exists('\LiteSpeed\Purge')) {
		    \LiteSpeed\Purge::purge_all();
		}
		
		return true;
	}

}

?>