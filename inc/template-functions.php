<?php
/**
 * Fonctions de template pour Luxora
 *
 * @package Luxora
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Afficher le logo du site
 */
function luxora_site_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . get_bloginfo('name') . '</a>';
    }
}

/**
 * Afficher le menu principal
 */
function luxora_primary_menu() {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class' => 'primary-menu',
        'container' => false,
        'fallback_cb' => false,
    ));
}

/**
 * Afficher le menu du footer
 */
function luxora_footer_menu() {
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'menu_class' => 'footer-menu',
        'container' => false,
        'fallback_cb' => false,
    ));
}

/**
 * Afficher le titre de la page
 */
function luxora_page_title() {
    if (is_home()) {
        echo esc_html(get_bloginfo('name'));
    } elseif (is_singular()) {
        echo get_the_title();
    } elseif (is_archive()) {
        echo get_the_archive_title();
    } elseif (is_search()) {
        echo sprintf(esc_html__('Résultats de recherche pour : %s', 'luxora'), get_search_query());
    } elseif (is_404()) {
        echo esc_html__('Page non trouvée', 'luxora');
    }
}

/**
 * Afficher la pagination
 */
function luxora_pagination() {
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => '&larr;',
        'next_text' => '&rarr;',
    ));
}

/**
 * Afficher les métadonnées de l'article
 */
function luxora_post_meta() {
    echo '<div class="post-meta">';
    echo '<span class="post-date">' . get_the_date() . '</span>';
    echo '<span class="post-author">' . get_the_author() . '</span>';
    echo '</div>';
}

/**
 * Afficher le contenu de l'article
 */
function luxora_post_content() {
    if (is_singular()) {
        the_content();
    } else {
        the_excerpt();
    }
}

/**
 * Afficher les catégories de l'article
 */
function luxora_post_categories() {
    $categories = get_the_category();
    if ($categories) {
        echo '<div class="post-categories">';
        foreach ($categories as $category) {
            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
        }
        echo '</div>';
    }
}

/**
 * Afficher les tags de l'article
 */
function luxora_post_tags() {
    $tags = get_the_tags();
    if ($tags) {
        echo '<div class="post-tags">';
        foreach ($tags as $tag) {
            echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">#' . esc_html($tag->name) . '</a>';
        }
        echo '</div>';
    }
} 