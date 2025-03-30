<?php
/**
 * Classe d'administration du thème Luxora
 *
 * @package Luxora
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Classe Luxora_Admin
 */
class Luxora_Admin {
    /**
     * Instance de la classe
     *
     * @var Luxora_Admin
     */
    private static $instance = null;

    /**
     * Obtenir l'instance de la classe
     *
     * @return Luxora_Admin
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructeur
     */
    private function __construct() {
        add_action('admin_menu', array($this, 'add_theme_page'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('admin_notices', array($this, 'admin_notices'));
    }

    /**
     * Ajouter la page du thème
     */
    public function add_theme_page() {
        add_theme_page(
            __('À propos de Luxora', 'luxora'),
            __('À propos de Luxora', 'luxora'),
            'manage_options',
            'luxora-about',
            array($this, 'render_about_page')
        );
    }

    /**
     * Charger les scripts d'administration
     */
    public function enqueue_admin_scripts($hook) {
        if ('appearance_page_luxora-about' !== $hook) {
            return;
        }

        wp_enqueue_style('luxora-admin-style', LUXORA_URI . '/admin/css/admin.css', array(), LUXORA_VERSION);
        wp_enqueue_script('luxora-admin-script', LUXORA_URI . '/admin/js/admin.js', array('jquery'), LUXORA_VERSION, true);
    }

    /**
     * Afficher les notices d'administration
     */
    public function admin_notices() {
        if (!get_option('luxora_notice_dismissed')) {
            ?>
            <div class="notice notice-info is-dismissible">
                <p>
                    <?php
                    printf(
                        __('Merci d\'avoir choisi Luxora ! Pour commencer, consultez notre %1$sguide de démarrage%2$s.', 'luxora'),
                        '<a href="' . esc_url(admin_url('themes.php?page=luxora-about')) . '">',
                        '</a>'
                    );
                    ?>
                </p>
            </div>
            <?php
        }
    }

    /**
     * Rendre la page À propos
     */
    public function render_about_page() {
        ?>
        <div class="wrap about-wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <div class="about-description">
                <?php esc_html_e('Bienvenue dans Luxora ! Nous espérons que vous apprécierez ce thème.', 'luxora'); ?>
            </div>

            <div class="about-content">
                <div class="feature-section">
                    <h2><?php esc_html_e('Fonctionnalités', 'luxora'); ?></h2>
                    <div class="feature-grid">
                        <div class="feature-item">
                            <h3><?php esc_html_e('Design moderne', 'luxora'); ?></h3>
                            <p><?php esc_html_e('Un design élégant et responsive adapté à tous les appareils.', 'luxora'); ?></p>
                        </div>
                        <div class="feature-item">
                            <h3><?php esc_html_e('WooCommerce', 'luxora'); ?></h3>
                            <p><?php esc_html_e('Support complet de WooCommerce pour votre boutique en ligne.', 'luxora'); ?></p>
                        </div>
                        <div class="feature-item">
                            <h3><?php esc_html_e('Personnalisation', 'luxora'); ?></h3>
                            <p><?php esc_html_e('Options de personnalisation avancées pour adapter le thème à vos besoins.', 'luxora'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="feature-section">
                    <h2><?php esc_html_e('Documentation', 'luxora'); ?></h2>
                    <p>
                        <?php
                        printf(
                            __('Pour plus d\'informations sur l\'utilisation de Luxora, consultez notre %1$sdocumentation%2$s.', 'luxora'),
                            '<a href="https://luxora.com/docs" target="_blank">',
                            '</a>'
                        );
                        ?>
                    </p>
                </div>

                <div class="feature-section">
                    <h2><?php esc_html_e('Support', 'luxora'); ?></h2>
                    <p>
                        <?php
                        printf(
                            __('Si vous avez des questions ou des problèmes, n\'hésitez pas à %1$snous contacter%2$s.', 'luxora'),
                            '<a href="https://luxora.com/support" target="_blank">',
                            '</a>'
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
}

// Initialiser la classe
Luxora_Admin::get_instance(); 