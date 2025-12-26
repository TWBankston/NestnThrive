<?php
/**
 * Template Name: About Page
 * 
 * About Page Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$title   = get_the_title();
$content = get_the_content();
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-hero">
            <div class="nnt-hero__content nnt-reveal">
                <?php
                get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                    'items' => array(
                        array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                        array( 'label' => __( 'About', 'nestnthrive' ) ),
                    ),
                ) );
                ?>
                
                <h1 class="nnt-hero__title"><?php echo esc_html( $title ); ?></h1>
                
                <p class="nnt-hero__desc">
                    <?php esc_html_e( 'We help you build a home that works for you—through honest reviews and practical advice.', 'nestnthrive' ); ?>
                </p>
            </div>

            <div class="nnt-hero__image nnt-reveal nnt-delay-200 group">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'nnt-hero', array( 'class' => 'nnt-img-zoom' ) ); ?>
                <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&q=80&w=2000" alt="<?php esc_attr_e( 'About Nest N Thrive', 'nestnthrive' ); ?>" class="nnt-img-zoom">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- MISSION -->
<section class="nnt-section nnt-section--white">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title" style="text-align: center;"><?php esc_html_e( 'Our Mission', 'nestnthrive' ); ?></h2>
            <p style="font-size: 1.25rem; color: var(--nnt-stone-600); text-align: center; line-height: 1.8; max-width: 42rem; margin: 1.5rem auto 0;">
                <?php esc_html_e( 'Home should feel calm, not chaotic. We believe the right tools and thoughtful choices can transform everyday spaces into places where you actually want to be.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- HOW WE CURATE -->
<?php get_template_part( 'template-parts/components/trust-block' ); ?>

<!-- CONTENT -->
<?php if ( $content ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-content nnt-reveal">
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EDITORIAL STANDARDS -->
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; margin-bottom: 3rem;">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Our Editorial Standards', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle"><?php esc_html_e( 'What makes a Nest N Thrive recommendation.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--2 nnt-reveal nnt-delay-100" style="max-width: 64rem; margin: 0 auto;">
            <div style="background: #fff; padding: 2rem; border-radius: 1rem; border-left: 4px solid var(--nnt-forest);">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--nnt-stone-900); margin-bottom: 0.75rem;">
                    <i data-lucide="check" style="width: 1.25rem; height: 1.25rem; color: var(--nnt-forest); margin-right: 0.5rem;"></i>
                    <?php esc_html_e( 'Hands-On Testing', 'nestnthrive' ); ?>
                </h3>
                <p style="color: var(--nnt-stone-600); font-size: 0.9375rem;">
                    <?php esc_html_e( 'Every product is tested in real home environments. We use them as intended before making recommendations.', 'nestnthrive' ); ?>
                </p>
            </div>

            <div style="background: #fff; padding: 2rem; border-radius: 1rem; border-left: 4px solid var(--nnt-forest);">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--nnt-stone-900); margin-bottom: 0.75rem;">
                    <i data-lucide="check" style="width: 1.25rem; height: 1.25rem; color: var(--nnt-forest); margin-right: 0.5rem;"></i>
                    <?php esc_html_e( 'No Pay-for-Play', 'nestnthrive' ); ?>
                </h3>
                <p style="color: var(--nnt-stone-600); font-size: 0.9375rem;">
                    <?php esc_html_e( 'Brands cannot pay for placement or favorable reviews. Our recommendations are based solely on merit.', 'nestnthrive' ); ?>
                </p>
            </div>

            <div style="background: #fff; padding: 2rem; border-radius: 1rem; border-left: 4px solid var(--nnt-forest);">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--nnt-stone-900); margin-bottom: 0.75rem;">
                    <i data-lucide="check" style="width: 1.25rem; height: 1.25rem; color: var(--nnt-forest); margin-right: 0.5rem;"></i>
                    <?php esc_html_e( 'Regular Updates', 'nestnthrive' ); ?>
                </h3>
                <p style="color: var(--nnt-stone-600); font-size: 0.9375rem;">
                    <?php esc_html_e( 'We revisit and update our guides as products change or better options become available.', 'nestnthrive' ); ?>
                </p>
            </div>

            <div style="background: #fff; padding: 2rem; border-radius: 1rem; border-left: 4px solid var(--nnt-forest);">
                <h3 style="font-size: 1.125rem; font-weight: 600; color: var(--nnt-stone-900); margin-bottom: 0.75rem;">
                    <i data-lucide="check" style="width: 1.25rem; height: 1.25rem; color: var(--nnt-forest); margin-right: 0.5rem;"></i>
                    <?php esc_html_e( 'Transparent Affiliates', 'nestnthrive' ); ?>
                </h3>
                <p style="color: var(--nnt-stone-600); font-size: 0.9375rem;">
                    <?php esc_html_e( 'We may earn a commission when you buy through our links. This never influences our picks.', 'nestnthrive' ); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
