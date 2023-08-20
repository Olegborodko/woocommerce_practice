<?php 

add_action('wp_ajax_AWR_SHOW_NOTIFICATIONS', array ( \awr\endpoints\CommonController::get_instance(), 'show_notifications' )   );
add_action('wp_ajax_awr_system_infos', array ( \awr\endpoints\CommonController::get_instance(), 'get_system_infos' )   );
add_action('wp_ajax_awr_change_nav_tab', array ( \awr\endpoints\CommonController::get_instance(), 'change_nav_menu' ) );
add_action('wp_ajax_awr_save_hidden_bloc', array ( \awr\endpoints\CommonController::get_instance(), 'save_hidden_bloc' ) );

add_action('wp_ajax_awr_count_option_items', array ( \awr\endpoints\ToolsResetController::get_instance(), 'count_option_items' ) );
add_action('wp_ajax_awr_get_tools_counts', array ( \awr\endpoints\ToolsResetController::get_instance(), 'count_all_options_items' ) );

add_action('wp_ajax_awr_reset_options', array ( \awr\endpoints\ToolsResetController::get_instance(), 'execute' ) );

// Add actions for Ajax
add_action('wp_ajax_awr_full_reset', array ( \awr\endpoints\FullResetController::get_instance(), 'execute' )  );


function awr_init_session() {
    if ( ! session_id() ) {
        session_start();
    }
}
// Start session on init hook.
add_action( 'init', 'awr_init_session' );

?>