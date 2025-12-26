<?php
/**
 * Archive Room Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$rooms = nnt_get_all_rooms( -1 );
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; max-width: 48rem; margin: 0 auto;">
            <?php
            get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                'items' => array(
                    array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                    array( 'label' => __( 'Spaces', 'nestnthrive' ) ),
                ),
            ) );
            ?>
            
            <h1 class="nnt-hero__title" style="margin-top: 1rem;"><?php esc_html_e( 'Explore Spaces', 'nestnthrive' ); ?></h1>
            
            <p class="nnt-hero__desc" style="max-width: 36rem; margin: 1rem auto;">
                <?php esc_html_e( 'Find inspiration and practical solutions for every room in your home.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- SPACES GRID -->
<?php if ( ! empty( $rooms ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-grid nnt-grid--3 nnt-reveal">
            <?php foreach ( $rooms as $room ) : ?>
                <?php get_template_part( 'template-parts/components/card-space', null, array( 'post' => $room ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php else : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; padding: 4rem 2rem;">
            <p style="color: var(--nnt-stone-500);"><?php esc_html_e( 'No spaces found. Check back soon!', 'nestnthrive' ); ?></p>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>

