<?php

/*Add theme menu page*/
 
add_action('admin_menu', 'joyas_admin_menu');

function joyas_admin_menu() {
	
	$joyas_page_title = esc_html__("Learn More joyas",'joyas-shop');
	
	$joyas_menu_title = esc_html__("Learn More joyas",'joyas-shop');
	
	add_theme_page($joyas_page_title, $joyas_menu_title, 'edit_theme_options', 'joyas_theme_info', 'joyas_theme_info_page');
	
}

/*
**
** Premium Theme Feature Page
**
*/

function joyas_theme_info_page(){
	if ( is_admin() ) {
		get_template_part('/inc/premium-screen/index');
		
	} 
}

function joyas_admin_script($joyas_hook){
	
	if($joyas_hook != 'appearance_page_joyas_theme_info') {
		return;
	} 
	wp_enqueue_style( 'joyas-custom-css', get_template_directory_uri() .'/inc/premium-screen/pro-custom.css',array(),'1.0' );

}

add_action( 'admin_enqueue_scripts', 'joyas_admin_script' );



if ( ! class_exists( 'joyas_Admin' ) ) :

/**
 * joyas_Admin Class.
 */
class joyas_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin notice.
	 */
	public function admin_notice() {
		global $joyas_pagenow;

		wp_enqueue_style( 'joyas-message', get_template_directory_uri() . '/inc/premium-screen/message.css', array(), '1.0' );

		// Let's bail on theme activation.
		if ( 'themes.php' == $joyas_pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'joyas_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'joyas_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['joyas-hide-notice'] ) && isset( $_GET['_joyas_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( wp_unslash($_GET['_joyas_notice_nonce']), 'joyas_hide_notices_nonce' ) ) {
				/* translators: %s: plugin name. */
				wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'joyas-shop' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) 
			/* translators: %s: plugin name. */{
				wp_die( esc_html__( 'Cheatin&#8217; huh?', 'joyas-shop' ) );
			}

			$hide_notice = sanitize_text_field( wp_unslash( $_GET['joyas-hide-notice'] ) );
			update_option( 'joyas_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated cresta-message">
        
			<a class="cresta-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'joyas-hide-notice', 'welcome' ) ), 'joyas_hide_notices_nonce', '_joyas_notice_nonce' ) ); ?>"><?php  /* translators: %s: plugin name. */ esc_html_e( 'Dismiss', 'joyas-shop' ); ?></a>
            
			<p><?php printf( /* translators: %s: plugin name. */  esc_html__( 'Welcome! Thank you for choosing joyas! To fully take advantage of the best our theme can offer please make sure you visit our %1$sLearn More Page%2$s.', 'joyas-shop' ), '<a href="' . esc_url( admin_url( 'themes.php?page=joyas_theme_info' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=joyas_theme_info' ) ); ?>"><?php esc_html_e( 'Learn More joyas', 'joyas-shop' ); ?></a>
			</p>
		</div>
		<?php
	}



	

	
}

endif;

return new joyas_Admin();




