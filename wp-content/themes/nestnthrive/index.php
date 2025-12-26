<?php
/**
 * Fallback Index Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();
?>

<section class="nnt-section nnt-section--white">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-reveal">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article class="nnt-content">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div style="text-align: center; padding: 4rem 2rem;">
                    <h1><?php esc_html_e( 'Nothing Found', 'nestnthrive' ); ?></h1>
                    <p style="color: var(--nnt-stone-500);"><?php esc_html_e( 'The page you\'re looking for doesn\'t exist.', 'nestnthrive' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nnt-btn nnt-btn--primary" style="margin-top: 1.5rem;">
                        <?php esc_html_e( 'Go Home', 'nestnthrive' ); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
