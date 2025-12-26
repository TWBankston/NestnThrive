<?php
/**
 * Main Index Template (Fallback)
 *
 * @package NestNThrive
 */

get_header();
?>

<div class="nnt-container">
    <?php get_template_part( 'template-parts/components/breadcrumbs' ); ?>
    
    <?php if ( have_posts() ) : ?>
        <div class="nnt-card-grid">
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/components/card', null, array(
                    'post' => get_post(),
                    'type' => get_post_type(),
                ) );
            endwhile;
            ?>
        </div>

        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No content found.', 'nestnthrive' ); ?></p>
    <?php endif; ?>
</div>

<?php
get_footer();

