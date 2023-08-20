<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package joyas-shop
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class joyas_shop_Header_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {

		add_action('joyas_shop_header_layout_1_branding', array( $this, 'get_site_branding' ), 10 );

		add_action('joyas_shop_header_layout_1_navigation', array( $this, 'get_site_navigation' ), 10 );

		add_action('joyas_shop_site_header_icon', array( $this, 'get_site_header_icon' ), 10 );

		add_action('joyas_shop_site_header', array( $this, 'site_skip_to_content' ), 5 );


		add_action('joyas_shop_site_header', array( $this, 'site_header_top_bar' ), 10 );

		add_action('joyas_shop_site_header', array( $this, 'site_header_wrap_before' ), 10 );

		
		
		add_action('joyas_shop_site_header', array( $this, 'site_header_layout' ), 30 );

		add_action('joyas_shop_site_header', array( $this, 'site_header_wrap_after' ), 999 );

		add_action('joyas_shop_site_header', array( $this, 'site_hero_sections' ), 9999 );
		
		
		
	}
	/**
	* @return $html
	*/
	function site_header_top_bar(){
		if ( has_nav_menu( 'topbar' ) || !empty(joyas_shop_get_option('__dialogue')) || !empty( joyas_shop_get_option('__fb_pro_link') ) || !empty( joyas_shop_get_option('__tw_pro_link') ) || !empty( joyas_shop_get_option('__you_pro_link') ) ) :
		echo '<div class="top-bar-menu">
		<div class="container"><div class="left-menu">';
		
		if( joyas_shop_get_option('__dialogue') ) : 
			echo esc_html( joyas_shop_get_option('__dialogue') );
		endif;
		echo '</div><div class="right-menu"><div class="top-bar-menu">';

		wp_nav_menu( array(
			'theme_location'    => 'topbar',
			'depth'             => 2,
			'menu_class'  		=> 'menu',
			'menu_id'  			=> 'menu-store',
			'container'			=> 'ul',
			'fallback_cb'       => 'joyas_shop_navwalker::fallback_2',
		) );
		
		echo '</div>';

			echo '<ul class="social-links">';
			
			if( joyas_shop_get_option('__fb_pro_link') != "" ): 
				echo '<li class="social-item-facebook"><a href="'.esc_url( joyas_shop_get_option('__fb_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-facebook"></i></a></li>';				
			endif;
			
			if( joyas_shop_get_option('__tw_pro_link') != "" ): 
				echo '<li class="social-item-twitter"><a href="'.esc_url( joyas_shop_get_option('__tw_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-twitter"></i></a></li>';
			endif;
			if( joyas_shop_get_option('__you_pro_link') != "" ): 
				echo '<li class="social-item-youtube"><a href="'.esc_url( joyas_shop_get_option('__you_pro_link') ).'" target="_blank" rel="nofollow"><i class="icofont-youtube"></i></a></li>';
			 endif;
					
			echo '</ul>';

		echo '</div></div>
		</div>';
		endif;
		//echo wp_kses( $html , $this->alowed_tags() );
	}
	/**
	* @return $html
	*/
	function site_header_wrap_before(){
		
		$html = '<header id="masthead" class="site-header style_1">';	
		
		echo wp_kses( $html , $this->alowed_tags() );
		
	}
	/**
	* @return $html
	*/
	function site_header_wrap_after(){
		
		$html = '</header>';	
		
		echo wp_kses( $html , $this->alowed_tags() );
		
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_skip_to_content(){
		
		echo '<a class="skip-link screen-reader-text" href="#content">'. esc_html__( 'Skip to content', 'joyas-shop' ) .'</a>';
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_header_layout(){
		?>
		<div class="navsticky">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-xl-9 col-lg-9 col-sm-8 col-12 logo-wrap">
					<div class="d-flex align-items-center gap-3">
						<?php do_action('joyas_shop_header_layout_1_branding');?>
						<?php do_action('joyas_shop_header_layout_1_navigation'); ?>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-sm-4 col-12 text-right logo-wrap">
					
					<?php echo wp_kses( $this->get_site_header_icon(), $this->alowed_tags() );?>
						
					
			   	</div>
			</div>
		</div>
		</div>	
		<?php		
	}
	
	
	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function get_site_branding (){
		
		$html = '<div class="logo-wrap">';
		
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html .= get_custom_logo();
			
		}
		if ( display_header_text() == true ){
			
			$html .= '<h3><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
			$html .= get_bloginfo( 'name' );
			$html .= '</a></h3>';
			$description = get_bloginfo( 'description', 'display' );
		
			if ( $description ) :
			    $html .=  '<div class="site-description">'.esc_html($description).'</div>';
			endif;
		}
		
		
		$html .= '</div>';
		
		$html = apply_filters( 'get_site_branding_filter', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
		
	}
	
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_navigation (){
		
		?>
		<nav id="navbar" class="underline">
		<button class="joyas-shop-navbar-close"><i class="icofont-ui-close"></i></button>

		<?php
			wp_nav_menu( array(
				'theme_location'    => 'menu-1',
				'depth'             => 3,
				'menu_class'  		=> 'joyas-main-menu navigation-menu',
				'container'			=> 'ul',
				'walker' 			=> new joyas_shop_navwalker(),
		        'fallback_cb'       => 'joyas_shop_navwalker::fallback',
			) );
		?>
		
		</nav>
        <?php	
		
	}
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_header_icon (){
	 ?>
	<ul class="header-icon d-flex justify-content-end ">
	  <li class="flex-fill flex-grow-1"><?php $this->joyas_search_form();; ?></li>
	   <?php if ( class_exists( 'WooCommerce' ) ) :?>
	   	<li><?php joyas_shop_woocommerce_cart_link(); ?></li>
	<?php endif;?>
	<li class="toggle-list"><button class="joyas-shop-rd-navbar-toggle" tabindex="0" autofocus="true"><i class="icofont-navigation-menu"></i></button></li>
	</ul>
	 <?php
	}
	
	public function joyas_search_form(){
	?>
	 <form  method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="search-field" placeholder="<?php echo esc_attr__('Search …','joyas-shop');?>" value="<?php echo esc_html( get_search_query() );?>" name="s" /> 
        <button type="submit"><i class="bi bi-search"></i></button>
     </form>
	<?php	
	}
	
	public function get_site_breadcrumb (){
		if( function_exists('bcn_display') && ( !is_home() || !is_front_page())  ):?>
        	<div class="joyas-shop-breadcrumbs-wrap"><div class="container"><div class="row"><div class="col-md-12">
            <div class="joyas-shop-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display_list();?>
           </div></div></div></div>
            </div>
        <?php
		endif; 
	}
	/**
	* Get the hero sections
	*
	* @return HTML
	*/
	public function site_hero_sections(){
		if( is_404() ) return;
		if ( is_front_page() && is_active_sidebar( 'slider' ) ) : 
		 dynamic_sidebar( 'slider' );
		else: 
		$header_image = get_header_image();
		?>
        	<?php if( !empty( $header_image ) ) : ?>
            <div id="static_header_banner" class="header-img" style="background-image: url(<?php echo esc_url( $header_image );?>); background-attachment: scroll; background-size: cover; background-position: center center;">
             <?php else: ?>
             <div id="static_header_banner">
            <?php endif;?>
            
           
			
		    	<div class="content-text">
		            <div class="container">
		               	<?php 
							echo '<div class="site-header-text-wrap">';

							if ( is_home() ) {
									echo '<h1 class="page-title-text">';
									echo bloginfo( 'name' );
									echo '</h1>';
									echo '<p class="subtitle">';
									echo esc_html(get_bloginfo( 'description', 'display' ));
									echo '</p>';
							}else if ( function_exists('is_shop') && is_shop() ){
								if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
									echo '<h1 class="page-title-text">';
									echo esc_html( woocommerce_page_title() );
									echo '</h1>';
								}
							}else if( function_exists('is_product_category') && is_product_category() ){
								echo '<h1 class="page-title-text">';
								echo esc_html( woocommerce_page_title() );
								echo '</h1>';
								echo '<p class="subtitle">';
								do_action( 'joyas_shop_archive_description' );
								echo '</p>';
								
							}elseif ( is_singular() ) {
								echo '<h1 class="page-title-text">';
									echo single_post_title( '', false );
								echo '</h1>';
							} elseif ( is_archive() ) {
								
								the_archive_title( '<h1 class="page-title-text">', '</h1>' );
								the_archive_description( '<p class="archive-description subtitle">', '</p>' );
								
							} elseif ( is_search() ) {
								echo '<h1 class="title">';
									printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'joyas-shop' ),  get_search_query() );
								echo '</h1>';
							} elseif ( is_404() ) {
								echo '<h1 class="display-1">';
									esc_html_e( 'Oops! That page can&rsquo;t be found.', 'joyas-shop' );
								echo '</h1>';
							}
							echo '</div>';
		               	?>
		            </div>
		        </div>
		    </div>
		<?php
		endif;
	}
	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function hero_block_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'joyas_shop_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'joyas-shop' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'joyas-shop' );
				echo '</h1>';
			}
		
		echo '</div>';
	}
	private function alowed_tags(){
		
		if( function_exists('joyas_shop_alowed_tags') ){ 
			return joyas_shop_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}



$joyas_shop_header_layout = new joyas_shop_Header_Layout();