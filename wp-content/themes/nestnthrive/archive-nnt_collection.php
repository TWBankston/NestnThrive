<?php
/**
 * Archive Collection Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$collections = nnt_get_latest_collections( 12 );
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; max-width: 48rem; margin: 0 auto;">
            <?php
            get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                'items' => array(
                    array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                    array( 'label' => __( 'Reviews', 'nestnthrive' ) ),
                ),
            ) );
            ?>
            
            <h1 class="nnt-hero__title" style="margin-top: 1rem;"><?php esc_html_e( 'Product Reviews', 'nestnthrive' ); ?></h1>
            
            <p class="nnt-hero__desc" style="max-width: 36rem; margin: 1rem auto;">
                <?php esc_html_e( 'Hands-on reviews and comparisons of the products we actually use and recommend.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- COLLECTIONS GRID -->
<?php if ( ! empty( $collections ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-grid nnt-grid--3 nnt-reveal">
            <?php foreach ( $collections as $collection ) : ?>
                <?php get_template_part( 'template-parts/components/card-review', null, array( 'post' => $collection ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php else : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; padding: 4rem 2rem;">
            <p style="color: var(--nnt-stone-500);"><?php esc_html_e( 'No reviews found. Check back soon!', 'nestnthrive' ); ?></p>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
