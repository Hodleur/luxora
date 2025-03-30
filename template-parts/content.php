<?php
/**
 * Template part for displaying posts
 *
 * @package Luxora
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-8'); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title text-3xl font-bold mb-4">', '</h1>');
        else :
            the_title('<h2 class="entry-title text-2xl font-bold mb-4"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
        ?>
            <div class="entry-meta text-gray-600 text-sm mb-4">
                <?php
                printf(
                    esc_html__('Publié le %s par %s', 'luxora'),
                    get_the_date(),
                    get_the_author()
                );
                ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-thumbnail mb-6">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded-lg')); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content prose max-w-none">
        <?php
        if (is_singular()) :
            the_content();
        else :
            the_excerpt();
            ?>
            <a href="<?php echo esc_url(get_permalink()); ?>" class="inline-block mt-4 px-6 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors">
                <?php esc_html_e('Lire la suite', 'luxora'); ?>
            </a>
        <?php endif; ?>
    </div>

    <footer class="entry-footer mt-6 pt-4 border-t">
        <?php
        $categories_list = get_the_category_list(esc_html__(', ', 'luxora'));
        if ($categories_list) {
            printf('<span class="cat-links text-sm text-gray-600">' . esc_html__('Catégories: %1$s', 'luxora') . '</span>', $categories_list);
        }

        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'luxora'));
        if ($tags_list) {
            printf('<span class="tags-links text-sm text-gray-600 ml-4">' . esc_html__('Tags: %1$s', 'luxora') . '</span>', $tags_list);
        }
        ?>
    </footer>
</article> 