<?php
/**
 * Template Name: Deals Hub
 * 
 * Deals Hub Page Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

// Get active deals
$active_deals = get_posts( array(
    'post_type'      => 'nnt_collection',
    'posts_per_page' => 12,
    'meta_query'     => array(
        array(
            'key'     => 'nnt_deal_active',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) );

// Get expired deals (within last 30 days)
$expired_deals = get_posts( array(
    'post_type'      => 'nnt_collection',
    'posts_per_page' => 4,
    'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'     => 'nnt_deal_active',
            'value'   => '0',
            'compare' => '=',
        ),
        array(
            'key'     => 'nnt_deal_expires_at',
            'value'   => date( 'Y-m-d', strtotime( '-30 days' ) ),
            'compare' => '>=',
            'type'    => 'DATE',
        ),
    ),
) );

// Get room and goal terms for filtering
$room_terms = get_terms( array( 'taxonomy' => 'nnt_room_tax', 'hide_empty' => false ) );
$goal_terms = get_terms( array( 'taxonomy' => 'nnt_goal_tax', 'hide_empty' => false ) );
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; max-width: 48rem; margin: 0 auto;">
            <?php
            get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                'items' => array(
                    array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                    array( 'label' => __( 'Deals', 'nestnthrive' ) ),
                ),
            ) );
            ?>
            
            <div class="nnt-hero__badge" style="margin: 1rem auto;">
                <i data-lucide="percent" style="width: 0.875rem; height: 0.875rem; margin-right: 0.5rem;"></i>
                <?php esc_html_e( 'Curated Discounts', 'nestnthrive' ); ?>
            </div>
            
            <h1 class="nnt-hero__title"><?php esc_html_e( 'Deals & Finds', 'nestnthrive' ); ?></h1>
            
            <p class="nnt-hero__desc" style="max-width: 36rem; margin: 1rem auto;">
                <?php esc_html_e( "Limited-time finds and worthwhile discounts on products we've actually tested. Updated regularly.", 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- BROWSE BY CATEGORY -->
<?php if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) : ?>
<section class="nnt-section nnt-section--stone" style="padding-top: 2rem; padding-bottom: 2rem;">
    <div class="nnt-container">
        <div class="nnt-reveal" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 0.75rem;">
            <span style="font-size: 0.875rem; font-weight: 500; color: var(--nnt-stone-500); padding: 0.5rem 0; margin-right: 0.5rem;">
                <?php esc_html_e( 'Browse by:', 'nestnthrive' ); ?>
            </span>
            <?php foreach ( $room_terms as $term ) : ?>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" style="padding: 0.5rem 1rem; background: #fff; border: 1px solid var(--nnt-stone-200); border-radius: 9999px; font-size: 0.875rem; color: var(--nnt-stone-600); text-decoration: none; transition: all 0.2s;">
                    <?php echo esc_html( $term->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ACTIVE DEALS -->
<?php if ( ! empty( $active_deals ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Active Deals', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'Current discounts on products we recommend.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--3 nnt-reveal nnt-delay-100">
            <?php foreach ( $active_deals as $deal ) : ?>
                <?php get_template_part( 'template-parts/components/card-review', null, array( 
                    'post'  => $deal, 
                    'badge' => get_post_meta( $deal->ID, 'nnt_deal_badge', true ) ?: __( 'Sale', 'nestnthrive' ),
                ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php else : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; padding: 4rem 2rem;">
            <div style="width: 4rem; height: 4rem; background: var(--nnt-stone-100); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i data-lucide="inbox" style="width: 2rem; height: 2rem; color: var(--nnt-stone-400);"></i>
            </div>
            <h2 style="font-size: 1.25rem; color: var(--nnt-stone-800); margin-bottom: 0.5rem;"><?php esc_html_e( 'No active deals right now', 'nestnthrive' ); ?></h2>
            <p style="color: var(--nnt-stone-500);"><?php esc_html_e( 'Check back soon or subscribe to get notified when new deals drop.', 'nestnthrive' ); ?></p>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- HOW WE HANDLE DEALS -->
<section class="nnt-section nnt-section--forest">
    <div class="nnt-container nnt-reveal">
        <div class="nnt-trust">
            <h2 class="nnt-trust__title"><?php esc_html_e( 'How We Handle Deals', 'nestnthrive' ); ?></h2>
            
            <div class="nnt-trust__grid">
                <div class="nnt-trust__item">
                    <div class="nnt-trust__icon">
                        <i data-lucide="check-circle"></i>
                    </div>
                    <h3 class="nnt-trust__heading"><?php esc_html_e( 'Already Tested', 'nestnthrive' ); ?></h3>
                    <p class="nnt-trust__desc"><?php esc_html_e( "We only feature deals on products we've already reviewed and recommend.", 'nestnthrive' ); ?></p>
                </div>

                <div class="nnt-trust__item">
                    <div class="nnt-trust__icon">
                        <i data-lucide="clock"></i>
                    </div>
                    <h3 class="nnt-trust__heading"><?php esc_html_e( 'Updated Regularly', 'nestnthrive' ); ?></h3>
                    <p class="nnt-trust__desc"><?php esc_html_e( 'We check prices daily and remove expired deals promptly.', 'nestnthrive' ); ?></p>
                </div>

                <div class="nnt-trust__item">
                    <div class="nnt-trust__icon">
                        <i data-lucide="badge-check"></i>
                    </div>
                    <h3 class="nnt-trust__heading"><?php esc_html_e( 'No Pressure', 'nestnthrive' ); ?></h3>
                    <p class="nnt-trust__desc"><?php esc_html_e( "A deal is only good if it's on something you actually need.", 'nestnthrive' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RECENTLY EXPIRED -->
<?php if ( ! empty( $expired_deals ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title" style="color: var(--nnt-stone-400);"><?php esc_html_e( 'Recently Expired', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'These deals have ended, but the reviews are still valid.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100" style="opacity: 0.6;">
            <?php foreach ( $expired_deals as $deal ) : ?>
                <?php get_template_part( 'template-parts/components/card-review', null, array( 
                    'post'  => $deal, 
                    'badge' => __( 'Expired', 'nestnthrive' ),
                ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>

