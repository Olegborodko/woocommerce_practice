<?php
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
  // Yes, WooCommerce is enabled

  // add woocomerce support
  function modis_add_woocomerce_support()
  {
    add_theme_support('woocommerce');
  }

  add_action('after_setup_theme', 'modis_add_woocomerce_support');

  // disable breadcrumb
  remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}