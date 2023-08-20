<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( !function_exists( 'joyas_storefront_parent_css' ) ):
    function joyas_storefront_parent_css() {

        wp_enqueue_style( 'joyas_storefront_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array('joyas-shop-google-fonts','bootstrap','bi-icons','icofont','bootstrap','scrollbar','joyas-shop-common','joyas-shop-style') );

    }
endif;
add_action( 'wp_enqueue_scripts', 'joyas_storefront_parent_css', 10 );


if ( !function_exists( 'joyas_storefront_widgets_init' ) ):
    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    function joyas_storefront_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Shop Page / WooCommerce', 'joyas-storefront' ),
            'id'            => 'shop-page',
            'description'   => esc_html__( 'Add widgets here.', 'joyas-storefront' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title"><span>',
            'after_title'   => '</span></h3>',
        ) );
    }
    add_action( 'widgets_init', 'joyas_storefront_widgets_init',99 );
endif;

if( !function_exists('joyas_storefront_disable_from_parent') ):

    add_action('init','joyas_storefront_disable_from_parent',10);
    function joyas_storefront_disable_from_parent(){
        
      global $joyas_shop_header_layout;
      remove_action('joyas_shop_site_header', array( $joyas_shop_header_layout, 'site_header_layout' ), 30 );

      global $joyas_shop_post_related;
      remove_action('joyas_shop_site_content_type', array( $joyas_shop_post_related, 'site_loop_heading' ), 10 );

      global $joyas_shop_post_related;
      remove_action('joyas_shop_loop_navigation', array( $joyas_shop_post_related, 'site_loop_navigation' ), 10 );

      remove_action( 'woocommerce_before_main_content', 'joyas_shop_woocommerce_wrapper_before' );
       remove_action( 'woocommerce_after_main_content', 'joyas_shop_woocommerce_wrapper_after' );
    }
    
endif;

if( !function_exists('joyas_storefront_header_layout') ) : 
    function joyas_storefront_header_layout(){
    ?>
    <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12 logo-wrap">
                   <?php do_action('joyas_shop_header_layout_1_branding');?>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-6 col-12 text-right">
                    <?php do_action('joyas_shop_header_layout_1_navigation'); ?>
                </div>

            </div>
        </div>

        <div id="nav_bar_wrap"> 
            
            <div class="container"> 
                <div class="row align-items-center"> 
                    <?php if ( class_exists( 'WooCommerce' ) ) :?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12 text-right order-1">
                     <?php do_action('joyas_storefront_woocommerce_product_category');?>
                    </div>
                    <?php endif;?>
                     <div class="col-lg-2 col-md-2 col-sm-12 col-12 text-right order-3">
                        <ul class="header-icon d-flex justify-content-end">
                        <?php if ( class_exists( 'WooCommerce' ) ) :?>
                            
                        <li><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','joyas-storefront'); ?>"><i class="bi bi-lock"></i></a></li>
                        <li><?php joyas_shop_woocommerce_cart_link(); ?></li>
                        <?php endif;?>

                        <li class="toggle-list"><button class="joyas-shop-rd-navbar-toggle" tabindex="0" autofocus="true"><i class="icofont-navigation-menu"></i></button></li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>


                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 order-2">
                        
                    <?php   
                    if( class_exists('APSW_Product_Search_Finale_Class_Pro') && class_exists( 'WooCommerce' ) ){
                        do_action('apsw_search_bar_preview');
                        
                    }else if( class_exists('APSW_Product_Search_Finale_Class') && class_exists( 'WooCommerce' ) ){
                        do_action('apsw_search_bar_preview');
                    }else{
                        get_search_form();
                    }
                    ?>
                    </div>

                </div>
                </div>

        </div>
    <?php
    }
    add_action('joyas_shop_site_header', 'joyas_storefront_header_layout', 30 );
endif;


if ( ! function_exists( 'joyas_storefront_woocommerce_product_category' ) ) {
    /**
     * Before Content.
     *
     * @return void
     */
    function joyas_storefront_woocommerce_product_category() {
        //if(  s_get_option('woo_dispaly_all_category_inside_menu') != true ){ return false; }
        
                $args = array(
                    'orderby'    => 'title',
                    'order'      => 'ASC',
                    'parent' => 0,
                    'taxonomy' => 'type',
                );
                $product_categories = get_terms( 'product_cat', $args );
                
                $count = count($product_categories);
                if ( $count > 0 ) :

                echo '<div id="joyas-mega-menu" class="">
                          <div class="btn-mega"><span></span>'.esc_html( esc_html__('ALL CATEGORIES ','joyas-storefront') ).'</div>
                          <ul class="menu">';

                    foreach ( $product_categories as $product_category ) {
                        
                        $args = array(
                            'orderby'    => 'title',
                            'order'      => 'ASC',
                            'parent'   => $product_category->term_id
                        );
                        $product_sub_categories = get_terms( 'product_cat', $args );

                        if ( count($product_sub_categories) > 0 ) :
                        
                        echo '<li class="shopstore-cat-parent"> <a href="' . esc_attr(get_term_link( $product_category )) . '" title="'.esc_attr( $product_category->name ).'"><span class="menu-title">'.esc_html( $product_category->name ).'</span> </a> ';
                        echo "<ul class='children'>";
                        foreach ( $product_sub_categories as $term ) {
                            echo '<li> <a href="' . esc_url( get_term_link( $term ) ) . '" title="'.esc_attr( $term->name ).'" class="">'.esc_html( $term->name ).'</a> ';
                        }
                        echo "</ul>";
                        
                        else:
                            echo '<li> <a href="' . esc_url( get_term_link( $product_category ) ) . '" title="'.esc_attr( $product_category->name ).'" class="">'.esc_html( $product_category->name ).' </a> ';
                        
                        endif;
                        
                        echo '</li>';
                    }
                    echo '</ul>
                    </div>';
                endif;
                
                
                
                
    }
}

add_action( 'joyas_storefront_woocommerce_product_category', 'joyas_storefront_woocommerce_product_category' );


if ( ! function_exists( 'joyas_storefront_woocommerce_wrapper_before' ) ) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function joyas_storefront_woocommerce_wrapper_before() {
        /**
        * Hook - joyas_shop_container_wrap_start    
        *
        * @hooked joyas_shop_container_wrap_start   - 5
        */
        if( is_product() ){
          do_action( 'joyas_shop_container_wrap_start', 'no-sidebar');
        }else{
          do_action( 'joyas_shop_container_wrap_start', 'sidebar-content');
        }
    }
   add_action( 'woocommerce_before_main_content', 'joyas_storefront_woocommerce_wrapper_before' );
}

if ( ! function_exists( 'joyas_storefront_woocommerce_wrapper_after' ) ) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function joyas_storefront_woocommerce_wrapper_after() {
        /**
        * Hook - joyas_shop_container_wrap_end  
        *
        * @hooked container_wrap_end - 999
        */
        if( is_product() ){
          do_action( 'joyas_shop_container_wrap_end', 'no-sidebar');
        }else{
          do_action( 'joyas_shop_container_wrap_end', 'sidebar-content');
        }
    }
add_action( 'woocommerce_after_main_content', 'joyas_storefront_woocommerce_wrapper_after' );
   
}


/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function joyas_storefront_loop_columns() {
    return 3;
}
add_filter( 'loop_shop_columns', 'joyas_storefront_loop_columns', 99);

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function joyas_storefront_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => 3,
        'columns'        => 3,
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'joyas_storefront_related_products_args', 99 );

add_filter( 'woocommerce_upsell_display_args', 'joyas_storefront_related_products_args', 99 );

add_filter( 'woocommerce_cross_sells_columns', 'joyas_storefront_related_products_args', 99 );


 function joyas_storefront_loop_heading() {
        if( is_page() ) return;

        if ( !is_singular() ) :

            the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" >', '</a></h3>' );
        endif;
        
        
    }
add_action('joyas_shop_site_content_type', 'joyas_storefront_loop_heading', 10 );   


function joyas_storefront_theme_setup(){

    // Make theme available for translation.
    load_theme_textdomain( 'joyas-storefront', get_stylesheet_directory_uri() . '/languages' );
    
    add_theme_support( 'custom-header', apply_filters( 'farm_store_custom_header_args', array(
        'default-image' => get_stylesheet_directory_uri() . '/image/custom-header.jpg',
        'default-text-color'     => '000000',
        'width'                  => 1000,
        'height'                 => 350,
        'flex-height'            => true,
        'wp-head-callback'       => 'joyas_shop_header_style',
    ) ) );
    
    register_default_headers( array(
        'default-image' => array(
        'url' => '%s/image/custom-header.jpg',
        'thumbnail_url' => '%s/image/custom-header.jpg',
        'description' => esc_html__( 'Default Header Image', 'joyas-storefront' ),
        ),
    ));

}
add_action( 'after_setup_theme', 'joyas_storefront_theme_setup' );


/**
 * Post Posts Loop Navigation
 * add_action( 'joyas_loop_navigation', $array( $this,'site_loop_navigation' ) ); 
 * @since 1.0.0
 */
function joyas_storefront_loop_navigation( $type = '' ) {
   
     echo '<div class="pagination-custom">';
        the_posts_pagination( array(
            'type' => 'list',
            'mid_size' => 2,
            'prev_text' => esc_html__( 'Previous', 'joyas-storefront' ),
            'next_text' => esc_html__( 'Next', 'joyas-storefront' ),
            'screen_reader_text' => esc_html__( '&nbsp;', 'joyas-storefront' ),
        ) );
    echo '</div>';

}

add_action('joyas_shop_loop_navigation', 'joyas_storefront_loop_navigation', 20 );