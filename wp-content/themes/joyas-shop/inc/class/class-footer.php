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
class joyas_shop_Footer_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {
		
		add_action('joyas_shop_site_footer', array( $this, 'site_footer_container_before' ), 5);
		add_action('joyas_shop_site_footer', array( $this, 'site_footer_widgets' ), 10);
		add_action('joyas_shop_site_footer', array( $this, 'site_footer_info' ), 80);
		add_action('joyas_shop_site_footer', array( $this, 'site_footer_container_after' ), 998);
		add_action('joyas_shop_site_footer', array( $this, 'site_footer_back_top' ), 999);
	}
	
	/**
	* joyas-shop foter conteinr before
	*
	* @return $html
	*/
	public function site_footer_container_before (){
		
		$html = ' <footer id="colophon" class="site-footer">';
						
		$html = apply_filters( 'joyas_shop_footer_container_before_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
		
						
	}
	
	/**
	* Footer Container before
	*
	* @return $html
	*/
	function site_footer_widgets(){
		if ( is_active_sidebar( 'footer-1' ) ) { ?>
         <div class="footer_widget_wrap">
         <div class="container">
            <div class="row joyas-shop-flex">
                <?php dynamic_sidebar( 'footer-1' ); ?>
            </div>
         </div>  
         </div>
        <?php }
	}
	
	
	/**
	* joyas-shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_info (){
		$text ='';
		$html = '<div class="container site_info">
					<div class="row">';
			$html .= '<div class="col-12 ">';
			
			if( get_theme_mod('copyright_text') != '' ) 
			{
				$text .= esc_html(  get_theme_mod('copyright_text') );
			}else
			{
				/* translators: 1: Current Year, 2: Blog Name  */
				$text .= sprintf( esc_html__( 'Copyright &copy; %1$s %2$s. All Right Reserved.', 'joyas-shop' ), date_i18n( _x( 'Y', 'copyright date format', 'joyas-shop' ) ), esc_html( get_bloginfo( 'name' ) ) );

			
				
			}

			
			$html  .= apply_filters( 'joyas_shop_footer_copywrite_filter', $text );
				
			/* translators: 1: developer website, 2: WordPress url  */
			$html  .= '<span class="dev_info">'.sprintf( esc_html__( ' %1$s By aThemeArt - Proudly powered by %2$s .', 'joyas-shop' ), '<a href="'. esc_url( 'https://athemeart.net/downloads/joyas/' ) .'" target="_blank" rel="nofollow">'.esc_html_x( 'Joyas Shop Theme', 'credit - theme', 'joyas-shop' ).'</a>',  '<a  href="'.esc_url( __( 'https://wordpress.org', 'joyas-shop' ) ).'" target="_blank" rel="nofollow">'.esc_html_x( 'WordPress', 'credit to cms', 'joyas-shop' ).'</a>' ).'</span>';
			
			$html .= '</div>';
			
			
			
			
		$html .= '	</div>
		  		</div>';
		
		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	/**
	* joyas-shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_container_after (){
		
		$html = '</footer>';
						
		$html = apply_filters( 'joyas_shop_footer_container_after_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	/**
	* joyas-shop foter conteinr after
	*
	* @return $html
	*/
	public function site_footer_back_top (){
		
		$html = '<a id="backToTop" class="ui-to-top active"><i class="icofont-bubble-up"></i></a>';
						
		$html = '<a id="backToTop" class="ui-to-top active"><i class="bi bi-arrow-up-square-fill"></i></a>';				
		$html = apply_filters( 'joyas_shop_site_footer_back_top_filter',$html);		
				
		echo wp_kses( $html, $this->alowed_tags() );
	
	}
	
	
	
	private function alowed_tags(){
		
		if( function_exists('joyas_shop_alowed_tags') ){ 
			return joyas_shop_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

$joyas_shop_footer_layout = new joyas_shop_Footer_Layout();