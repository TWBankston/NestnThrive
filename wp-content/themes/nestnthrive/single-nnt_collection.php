<?php
/**
 * Single Collection Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$post_id        = get_the_ID();
$title          = get_the_title();
$excerpt        = get_the_excerpt();
$image_id       = get_post_thumbnail_id();
$updated_date   = get_the_modified_date( 'F j, Y' );
$products_count = get_post_meta( $post_id, 'nnt_products_tested', true );
$products_data  = get_post_meta( $post_id, 'nnt_products_data', true );
$room_terms     = wp_get_post_terms( $post_id, 'nnt_room_tax' );
$room_name      = ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ? $room_terms[0]->name : '';
$related        = nnt_get_related_content( $post_id, 4 );

// If no products data, check if we have content
$has_products = ! empty( $products_data ) && is_array( $products_data );
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
                        array( 'label' => __( 'Reviews', 'nestnthrive' ), 'url' => get_post_type_archive_link( 'nnt_collection' ) ),
                        array( 'label' => $title ),
                    ),
                ) );
                ?>
                
                <?php if ( $room_name ) : ?>
                <div class="nnt-hero__badge"><?php echo esc_html( $room_name ); ?></div>
                <?php endif; ?>
                
                <h1 class="nnt-hero__title"><?php echo esc_html( $title ); ?></h1>
                
                <?php if ( $excerpt ) : ?>
                <p class="nnt-hero__desc"><?php echo esc_html( $excerpt ); ?></p>
                <?php endif; ?>
                
                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-top: 1.5rem; font-size: 0.875rem; color: var(--nnt-stone-500);">
                    <span><?php esc_html_e( 'Updated:', 'nestnthrive' ); ?> <?php echo esc_html( $updated_date ); ?></span>
                    <?php if ( $products_count ) : ?>
                    <span><?php echo esc_html( sprintf( __( '%d products tested', 'nestnthrive' ), intval( $products_count ) ) ); ?></span>
                    <?php endif; ?>
                </div>
                
                <div class="nnt-hero__actions">
                    <a href="#shortlist" class="nnt-btn nnt-btn--primary">
                        <?php esc_html_e( 'Jump to Picks', 'nestnthrive' ); ?>
                    </a>
                </div>
            </div>

            <div class="nnt-hero__image nnt-reveal nnt-delay-200 group">
                <?php if ( $image_id ) : ?>
                    <?php echo wp_get_attachment_image( $image_id, 'nnt-hero', false, array( 'class' => 'nnt-img-zoom' ) ); ?>
                <?php else : ?>
                    <div style="width: 100%; height: 100%; background: var(--nnt-stone-200);"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- SHORTLIST -->
<?php if ( $has_products ) : ?>
<section id="shortlist" class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'The Short List', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'Our top picks at a glance.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--3 nnt-reveal nnt-delay-100">
            <?php foreach ( $products_data as $i => $product ) : ?>
                <div class="nnt-product-card nnt-hover-lift">
                    <div style="padding: 1.5rem; background: var(--nnt-stone-50); border-radius: 0.75rem;">
                        <div style="aspect-ratio: 1; background: #fff; border-radius: 0.5rem; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center;">
                            <?php if ( ! empty( $product['image_url'] ) ) : ?>
                                <img src="<?php echo esc_url( $product['image_url'] ); ?>" alt="<?php echo esc_attr( $product['name'] ?? '' ); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            <?php else : ?>
                                <i data-lucide="package" style="width: 3rem; height: 3rem; color: var(--nnt-stone-300);"></i>
                            <?php endif; ?>
                        </div>
                        <div style="font-size: 0.75rem; color: var(--nnt-forest); font-weight: 600; margin-bottom: 0.5rem;">
                            <?php echo esc_html( sprintf( __( 'Pick #%d', 'nestnthrive' ), $i + 1 ) ); ?>
                        </div>
                        <h3 style="font-weight: 600; color: var(--nnt-stone-900); font-size: 1rem; margin-bottom: 0.5rem;">
                            <?php echo esc_html( $product['name'] ?? '' ); ?>
                        </h3>
                        <?php if ( ! empty( $product['price_note'] ) ) : ?>
                        <p style="font-size: 0.875rem; color: var(--nnt-stone-500);"><?php echo esc_html( $product['price_note'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CONTENT -->
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-content nnt-reveal">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<!-- DETAILED PICKS -->
<?php if ( $has_products ) : ?>
<section id="detailed-picks" class="nnt-section nnt-section--white">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Detailed Picks', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'In-depth look at each recommendation.', 'nestnthrive' ); ?></p>
        </div>

        <?php foreach ( $products_data as $i => $product ) : ?>
        <article class="nnt-product-detail nnt-reveal" style="background: var(--nnt-stone-50); border-radius: 1rem; padding: 2rem; margin-bottom: 2rem;">
            <div style="display: grid; grid-template-columns: 200px 1fr; gap: 2rem;">
                <div style="aspect-ratio: 1; background: #fff; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                    <?php if ( ! empty( $product['image_url'] ) ) : ?>
                        <img src="<?php echo esc_url( $product['image_url'] ); ?>" alt="<?php echo esc_attr( $product['name'] ?? '' ); ?>" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    <?php else : ?>
                        <i data-lucide="package" style="width: 3rem; height: 3rem; color: var(--nnt-stone-300);"></i>
                    <?php endif; ?>
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: var(--nnt-forest); font-weight: 600;"><?php echo esc_html( sprintf( __( 'Pick #%d', 'nestnthrive' ), $i + 1 ) ); ?></span>
                    <h3 style="font-size: 1.25rem; font-weight: 600; color: var(--nnt-stone-900); margin: 0.5rem 0 1rem;"><?php echo esc_html( $product['name'] ?? '' ); ?></h3>
                    
                    <?php if ( ! empty( $product['pros'] ) ) : ?>
                    <div style="margin-bottom: 1rem;">
                        <strong style="font-size: 0.875rem; color: var(--nnt-stone-700);"><?php esc_html_e( 'Pros:', 'nestnthrive' ); ?></strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem; color: var(--nnt-stone-600); font-size: 0.875rem;">
                            <?php foreach ( (array) $product['pros'] as $pro ) : ?>
                            <li><?php echo esc_html( $pro ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $product['cons'] ) ) : ?>
                    <div style="margin-bottom: 1rem;">
                        <strong style="font-size: 0.875rem; color: var(--nnt-stone-700);"><?php esc_html_e( 'Cons:', 'nestnthrive' ); ?></strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem; color: var(--nnt-stone-600); font-size: 0.875rem;">
                            <?php foreach ( (array) $product['cons'] as $con ) : ?>
                            <li><?php echo esc_html( $con ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( ! empty( $product['affiliate_url'] ) ) : ?>
                    <a href="<?php echo esc_url( $product['affiliate_url'] ); ?>" class="nnt-btn nnt-btn--primary" target="_blank" rel="nofollow noopener" style="margin-top: 1rem;">
                        <?php esc_html_e( 'Check Price', 'nestnthrive' ); ?>
                        <i data-lucide="external-link" style="width: 0.875rem; height: 0.875rem; margin-left: 0.5rem;"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- RELATED CONTENT -->
<?php if ( ! empty( $related ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Related Reviews & Guides', 'nestnthrive' ); ?></h2>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $related as $item ) : ?>
                <?php 
                if ( get_post_type( $item ) === 'nnt_guide' ) {
                    get_template_part( 'template-parts/components/card-guide', null, array( 'post' => $item ) );
                } else {
                    get_template_part( 'template-parts/components/card-review', null, array( 'post' => $item ) );
                }
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
