<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package joyas-shop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('joyas-shop-single-post') ); ?>>

 	 <?php
    /**
    * Hook - joyas_shop_posts_blog_media.
    *
    * @hooked joyas_shop_posts_formats_thumbnail - 10
    */
    do_action( 'joyas_shop_posts_blog_media' );
    ?>
    <div class="post">
               
		<?php
        /**
        * Hook - joyas-shop_site_content_type.
        *
		* @hooked site_loop_heading - 10
        * @hooked render_meta_list	- 20
		* @hooked site_content_type - 30
        */
		
		$meta = array();
		
		if ( is_singular() ) :
			
			if( joyas_shop_get_option('signle_meta_hide') != true ){
				
				$meta = array( 'author', 'date', 'category', 'comments' );
			}
			$meta  	 = apply_filters( 'joyas_shop_single_post_meta', $meta );
			
		else :
			if( joyas_shop_get_option('blog_meta_hide') != true ){
				
				$meta = array( 'author', 'date' );
			}
			$meta  	 = apply_filters( 'joyas_shop_blog_meta', $meta );
		 endif;
	
		
		 do_action( 'joyas_shop_site_content_type', $meta  );
        ?>
      
       
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->
