<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package joyas-shop
 */


?>

<aside id="secondary" class="widget-area">
	<?php 
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        dynamic_sidebar( 'sidebar-1' );
    }else{ ?>
        <div id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</div>
		<div id="archives" class="widget">
			<h3 class="widget-title"><span><?php esc_html_e( 'Archives', 'joyas-shop' ); ?></span></h3>
			<ul><?php wp_get_archives( array( 'type' => 'monthly' ) ); ?></ul>
		</div>
		<div id="meta" class="widget">
			<h3 class="widget-title"><span><?php esc_html_e( 'Meta', 'joyas-shop' ); ?></span></h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div>
    <?php }?>
</aside><!-- #secondary -->
