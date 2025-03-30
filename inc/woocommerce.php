<?php
/**
 * Support WooCommerce pour Luxora
 *
 * @package Luxora
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Vérifier si WooCommerce est actif
 */
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    return;
}

/**
 * Ajouter le support WooCommerce
 */
function luxora_woocommerce_setup() {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'luxora_woocommerce_setup');

/**
 * Désactiver les styles WooCommerce par défaut
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Ajouter les styles WooCommerce personnalisés
 */
function luxora_woocommerce_scripts() {
    wp_enqueue_style('luxora-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), LUXORA_VERSION);
}
add_action('wp_enqueue_scripts', 'luxora_woocommerce_scripts');

/**
 * Modifier le nombre de colonnes dans la grille des produits
 */
function luxora_woocommerce_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'luxora_woocommerce_columns');

/**
 * Modifier le nombre de produits par page
 */
function luxora_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'luxora_products_per_page');

/**
 * Modifier le nombre de produits liés
 */
function luxora_related_products_args($args) {
    $args['posts_per_page'] = 3;
    $args['columns'] = 3;
    return $args;
}
add_filter('woocommerce_output_related_products_args', 'luxora_related_products_args');

/**
 * Modifier le nombre de miniatures dans la galerie
 */
function luxora_gallery_thumbnail_columns() {
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'luxora_gallery_thumbnail_columns');

/**
 * Modifier la taille des miniatures
 */
function luxora_gallery_thumbnail_size($size) {
    return array(
        'width' => 100,
        'height' => 100,
        'crop' => 1,
    );
}
add_filter('woocommerce_gallery_thumbnail_size', 'luxora_gallery_thumbnail_size');

/**
 * Modifier la taille de l'image principale
 */
function luxora_single_product_archive_thumbnail_size($size) {
    return array(
        'width' => 600,
        'height' => 600,
        'crop' => 1,
    );
}
add_filter('single_product_archive_thumbnail_size', 'luxora_single_product_archive_thumbnail_size');

/**
 * Modifier le nombre de produits dans le panier
 */
function luxora_cart_item_quantity($product_quantity, $cart_item_key, $cart_item) {
    $product_quantity = woocommerce_quantity_input(array(
        'input_name'   => "cart[{$cart_item_key}][qty]",
        'input_value'  => $cart_item['quantity'],
        'max_value'    => $cart_item['data']->get_max_purchase_quantity(),
        'min_value'    => '0',
        'product_name' => $cart_item['data']->get_name(),
    ), $cart_item['data'], false);
    return $product_quantity;
}
add_filter('woocommerce_cart_item_quantity', 'luxora_cart_item_quantity', 10, 3);

/**
 * Modifier le texte du bouton "Ajouter au panier"
 */
function luxora_add_to_cart_text() {
    return __('Ajouter au panier', 'luxora');
}
add_filter('woocommerce_product_single_add_to_cart_text', 'luxora_add_to_cart_text');
add_filter('woocommerce_product_add_to_cart_text', 'luxora_add_to_cart_text');

/**
 * Modifier le texte du bouton "Lire la suite"
 */
function luxora_read_more_text() {
    return __('Lire la suite', 'luxora');
}
add_filter('woocommerce_product_read_more_text', 'luxora_read_more_text');

/**
 * Modifier le texte du bouton "Voir le panier"
 */
function luxora_view_cart_text() {
    return __('Voir le panier', 'luxora');
}
add_filter('woocommerce_add_to_cart_text', 'luxora_view_cart_text');

/**
 * Modifier le texte du bouton "Continuer les achats"
 */
function luxora_continue_shopping_text() {
    return __('Continuer les achats', 'luxora');
}
add_filter('woocommerce_continue_shopping_text', 'luxora_continue_shopping_text');

/**
 * Modifier le texte du bouton "Procéder au paiement"
 */
function luxora_proceed_to_checkout_text() {
    return __('Procéder au paiement', 'luxora');
}
add_filter('woocommerce_order_button_text', 'luxora_proceed_to_checkout_text'); 