<?php
/**
 * Default theme options.
 *
 * @package joyas-shop
 */

if ( ! function_exists( 'joyas_shop_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function joyas_shop_get_default_theme_options() {

		$defaults = array();
		
		
		/*Posts Layout*/
		$defaults['blog_layout']     				= 'content-sidebar';
		$defaults['single_post_layout']     		= 'content-sidebar';
		
		$defaults['blog_loop_content_type']     	= 'excerpt';
		
		$defaults['blog_meta_hide']     			= false;
		$defaults['signle_meta_hide']     			= false;
		
		/*Posts Layout*/
		$defaults['page_layout']     				= 'content-sidebar';
		
		/*layout*/
		$defaults['copyright_text']					= esc_html__( 'Copyright All right reserved', 'joyas-shop' );
		$defaults['read_more_text']					= esc_html__( 'Continue Reading', 'joyas-shop' );
		$defaults['index_hide_thumb']     			= false;
		
		
		/*Posts Layout*/
		$defaults['__fb_pro_link']     				= '';
		$defaults['__tw_pro_link']     				= '';
		$defaults['__you_pro_link']     		    = '';
		$defaults['__pr_pro_link']     				= '';
		
		$defaults['__primary_color']     			= '#6c757d';
		$defaults['__secondary_color']     			= '#FF4343';
		$defaults['__dialogue']					    = '';

		// Pass through filter.
		$defaults = apply_filters( 'joyas_shop_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
