<?php
/**
 * Fonctions de template tags pour Luxora
 *
 * @package Luxora
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Afficher la date de publication
 */
function luxora_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    echo '<span class="posted-on">' . $time_string . '</span>';
}

/**
 * Afficher l'auteur
 */
function luxora_posted_by() {
    echo '<span class="byline"> ' . sprintf(
        esc_html_x('par %s', 'post author', 'luxora'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    ) . '</span>';
}

/**
 * Afficher les catégories
 */
function luxora_categories_list() {
    $categories_list = get_the_category_list(esc_html__(', ', 'luxora'));
    if ($categories_list) {
        printf('<span class="cat-links">' . esc_html__('Catégories : %1$s', 'luxora') . '</span>', $categories_list);
    }
}

/**
 * Afficher les tags
 */
function luxora_tags_list() {
    $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'luxora'));
    if ($tags_list) {
        printf('<span class="tags-links">' . esc_html__('Tags : %1$s', 'luxora') . '</span>', $tags_list);
    }
}

/**
 * Afficher les commentaires
 */
function luxora_comments_link() {
    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    __('Laisser un commentaire<span class="screen-reader-text"> sur %s</span>', 'luxora'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }
}

/**
 * Afficher l'image à la une
 */
function luxora_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()) {
        echo '<div class="post-thumbnail">';
        the_post_thumbnail();
        echo '</div>';
    } else {
        echo '<a class="post-thumbnail" href="' . esc_url(get_permalink()) . '" aria-hidden="true" tabindex="-1">';
        the_post_thumbnail('post-thumbnail', array('alt' => the_title_attribute(array('echo' => false))));
        echo '</a>';
    }
}

/**
 * Afficher le lien "Lire la suite"
 */
function luxora_read_more_link() {
    echo '<a class="read-more" href="' . esc_url(get_permalink()) . '">' . sprintf(
        wp_kses(
            __('Lire la suite<span class="screen-reader-text"> "%s"</span>', 'luxora'),
            array(
                'span' => array(
                    'class' => array(),
                ),
            )
        ),
        wp_kses_post(get_the_title())
    ) . '</a>';
}

/**
 * Afficher la navigation des articles
 */
function luxora_post_navigation() {
    the_post_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Article précédent', 'luxora') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Article suivant', 'luxora') . '</span> <span class="nav-title">%title</span>',
    ));
} 