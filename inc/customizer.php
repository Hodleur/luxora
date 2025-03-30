<?php
/**
 * Personnalisation du thème Luxora
 *
 * @package Luxora
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Ajouter les options de personnalisation
 */
function luxora_customize_register($wp_customize) {
    // Section Couleurs
    $wp_customize->add_section('luxora_colors', array(
        'title' => __('Couleurs', 'luxora'),
        'priority' => 30,
    ));

    // Couleur principale
    $wp_customize->add_setting('primary_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Couleur principale', 'luxora'),
        'section' => 'luxora_colors',
    )));

    // Couleur secondaire
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Couleur secondaire', 'luxora'),
        'section' => 'luxora_colors',
    )));

    // Section Typographie
    $wp_customize->add_section('luxora_typography', array(
        'title' => __('Typographie', 'luxora'),
        'priority' => 35,
    ));

    // Police principale
    $wp_customize->add_setting('primary_font', array(
        'default' => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('primary_font', array(
        'label' => __('Police principale', 'luxora'),
        'section' => 'luxora_typography',
        'type' => 'select',
        'choices' => array(
            'Inter' => 'Inter',
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
        ),
    ));

    // Section En-tête
    $wp_customize->add_section('luxora_header', array(
        'title' => __('En-tête', 'luxora'),
        'priority' => 40,
    ));

    // Logo
    $wp_customize->add_setting('custom_logo', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo', array(
        'label' => __('Logo', 'luxora'),
        'section' => 'luxora_header',
        'mime_type' => 'image',
    )));

    // Section Pied de page
    $wp_customize->add_section('luxora_footer', array(
        'title' => __('Pied de page', 'luxora'),
        'priority' => 45,
    ));

    // Texte du pied de page
    $wp_customize->add_setting('footer_text', array(
        'default' => sprintf(
            __('© %d %s. Tous droits réservés.', 'luxora'),
            date('Y'),
            get_bloginfo('name')
        ),
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('footer_text', array(
        'label' => __('Texte du pied de page', 'luxora'),
        'section' => 'luxora_footer',
        'type' => 'textarea',
    ));

    // Section Blog
    $wp_customize->add_section('luxora_blog', array(
        'title' => __('Blog', 'luxora'),
        'priority' => 50,
    ));

    // Nombre d'articles par page
    $wp_customize->add_setting('posts_per_page', array(
        'default' => 10,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('posts_per_page', array(
        'label' => __('Articles par page', 'luxora'),
        'section' => 'luxora_blog',
        'type' => 'number',
    ));

    // Afficher les métadonnées
    $wp_customize->add_setting('show_meta', array(
        'default' => true,
        'sanitize_callback' => 'luxora_sanitize_checkbox',
    ));

    $wp_customize->add_control('show_meta', array(
        'label' => __('Afficher les métadonnées', 'luxora'),
        'section' => 'luxora_blog',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'luxora_customize_register');

/**
 * Sanitizer pour les cases à cocher
 */
function luxora_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Afficher les styles CSS personnalisés
 */
function luxora_customize_css() {
    $primary_color = get_theme_mod('primary_color', '#007bff');
    $secondary_color = get_theme_mod('secondary_color', '#6c757d');
    $primary_font = get_theme_mod('primary_font', 'Inter');

    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --secondary-color: <?php echo esc_attr($secondary_color); ?>;
            --primary-font: <?php echo esc_attr($primary_font); ?>;
        }

        body {
            font-family: var(--primary-font), sans-serif;
        }

        a {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
    <?php
}
add_action('wp_head', 'luxora_customize_css'); 