<?php
/**
 * modis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package modis
 */

if (!defined('_S_VERSION')) {
  // Replace the version number of the theme on each release.
  define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function modis_setup()
{
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on modis, use a find and replace
   * to change 'modis' to the name of your theme in all the template files.
   */
  load_theme_textdomain('modis', get_template_directory() . '/languages');

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support('title-tag');

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support('post-thumbnails');

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus(
    array(
      'menu-1' => esc_html__('Primary', 'modis'),
    )
  );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  // Set up the WordPress core custom background feature.
  add_theme_support(
    'custom-background',
    apply_filters(
      'modis_custom_background_args',
      array(
        'default-color' => 'ffffff',
        'default-image' => '',
      )
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support('customize-selective-refresh-widgets');

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  add_theme_support(
    'custom-logo',
    array(
      'height' => 250,
      'width' => 250,
      'flex-width' => true,
      'flex-height' => true,
    )
  );
}
add_action('after_setup_theme', 'modis_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function modis_content_width()
{
  $GLOBALS['content_width'] = apply_filters('modis_content_width', 640);
}
add_action('after_setup_theme', 'modis_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function modis_widgets_init()
{
  register_sidebar(
    array(
      'name' => esc_html__('Sidebar', 'modis'),
      'id' => 'sidebar-1',
      'description' => esc_html__('Add widgets here.', 'modis'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );
}
add_action('widgets_init', 'modis_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function modis_scripts()
{
  wp_enqueue_style('modis-style', get_stylesheet_uri(), array(), _S_VERSION);
  wp_style_add_data('modis-style', 'rtl', 'replace');


  wp_enqueue_style('modis-open-iconic-bootstrap', get_template_directory_uri() . "/assets/css/open-iconic-bootstrap.min.css", array(), _S_VERSION);

  wp_enqueue_style('modis-animate', get_template_directory_uri() . "/assets/css/animate.css", array(), _S_VERSION);

  wp_enqueue_style('modis-animate', get_template_directory_uri() . "/assets/css/animate.css", array(), _S_VERSION);

  wp_enqueue_style('modis-owl.carousel', get_template_directory_uri() . "/assets/css/owl.carousel.min.css", array(), _S_VERSION);

  wp_enqueue_style('modis-owl.theme.default', get_template_directory_uri() . "/assets/css/owl.theme.default.min.css", array(), _S_VERSION);

  wp_enqueue_style('modis-magnific-popup', get_template_directory_uri() . "/assets/css/magnific-popup.css", array(), _S_VERSION);

  wp_enqueue_style('modis-aos', get_template_directory_uri() . "/assets/css/aos.css", array(), _S_VERSION);

  wp_enqueue_style('modis-ionicons', get_template_directory_uri() . "/assets/css/ionicons.min.css", array(), _S_VERSION);

  wp_enqueue_style('modis-bootstrap-datepicker', get_template_directory_uri() . "/assets/css/bootstrap-datepicker.css", array(), _S_VERSION);

  wp_enqueue_style('modis-jquery.timepicker', get_template_directory_uri() . "/assets/css/jquery.timepicker.css", array(), _S_VERSION);

  wp_enqueue_style('modis-flaticon', get_template_directory_uri() . "/assets/css/flaticon.css", array(), _S_VERSION);

  wp_enqueue_style('modis-icomoon', get_template_directory_uri() . "/assets/css/icomoon.css", array(), _S_VERSION);

  wp_enqueue_style('modis-icomoon', get_template_directory_uri() . "/assets/css/icomoon.css", array(), _S_VERSION);

  wp_enqueue_style('modis-general', get_template_directory_uri() . "/assets/css/general.css", array(), _S_VERSION);

  wp_enqueue_script('jquery');
  wp_enqueue_script('modis-jquery-migrate-3.0.1', get_template_directory_uri() . '/assets/js/jquery-migrate-3.0.1.min.js', array(), _S_VERSION, true);
  wp_enqueue_script('modis-popper', get_template_directory_uri() . '/assets/js/popper.min.js', array(), _S_VERSION, true);
  wp_enqueue_script('modis-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-jquery.easing.1.3', get_template_directory_uri() . '/assets/js/jquery.easing.1.3.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-jquery.waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-jquery.stellar', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-owl.carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-jquery.magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-aos.js', get_template_directory_uri() . '/assets/js/aos.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-jquery.animateNumber', get_template_directory_uri() . '/assets/js/jquery.animateNumber.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-bootstrap-datepicker', get_template_directory_uri() . '/assets/js/bootstrap-datepicker.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-scrollax', get_template_directory_uri() . '/assets/js/scrollax.min.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-maps.googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false', array(), _S_VERSION, true);

  wp_enqueue_script('modis-google-map', get_template_directory_uri() . '/assets/js/google-map.js', array(), _S_VERSION, true);

  wp_enqueue_script('modis-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

  // wp_enqueue_script( 'modis-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'modis_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}

require get_template_directory() . '/inc/woocommerce.php';