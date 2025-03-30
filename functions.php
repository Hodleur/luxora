<?php
/**
 * Luxora functions and definitions
 *
 * @package Luxora
 */

if (!defined('LUXORA_VERSION')) {
    define('LUXORA_VERSION', '1.0.0');
}

if (!defined('LUXORA_DIR')) {
    define('LUXORA_DIR', get_template_directory());
}

if (!defined('LUXORA_URI')) {
    define('LUXORA_URI', get_template_directory_uri());
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function luxora_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Register nav menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'luxora'),
        'footer' => esc_html__('Menu Footer', 'luxora'),
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Add support for WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'luxora_setup');

/**
 * Enqueue scripts and styles.
 */
function luxora_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('luxora-style', get_stylesheet_uri(), array(), LUXORA_VERSION);
    
    // Enqueue Tailwind CSS
    wp_enqueue_style('luxora-tailwind', LUXORA_URI . '/assets/css/tailwind.css', array(), LUXORA_VERSION);
    
    // Enqueue main JavaScript file
    wp_enqueue_script('luxora-script', LUXORA_URI . '/assets/js/main.js', array('jquery'), LUXORA_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'luxora_scripts');

/**
 * Include required files
 */
require_once LUXORA_DIR . '/inc/template-functions.php';
require_once LUXORA_DIR . '/inc/template-tags.php';
require_once LUXORA_DIR . '/inc/customizer.php';
require_once LUXORA_DIR . '/inc/woocommerce.php'; 