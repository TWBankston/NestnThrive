<?php
/**
 * Front Page Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

// Get content
$rooms       = nnt_get_all_rooms( 6 );
$goals       = nnt_get_all_goals( 8 );
$collections = nnt_get_latest_collections( 3 );
$guides      = nnt_get_latest_guides( 4 );
$deals       = get_posts( array(
    'post_type'      => 'nnt_collection',
    'posts_per_page' => 3,
    'meta_query'     => array(
        array(
            'key'     => 'nnt_deal_active',
            'value'   => '1',
            'compare' => '=',
        ),
    ),
) );
?>

<!-- HERO SECTION -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-hero">
            <div class="nnt-hero__content nnt-reveal">
                <div class="nnt-hero__badge">
                    <?php esc_html_e( 'Curated Home', 'nestnthrive' ); ?>
                </div>
                <h1 class="nnt-hero__title">
                    <?php esc_html_e( 'Make your home a nest.', 'nestnthrive' ); ?><br>
                    <span class="nnt-hero__title-accent"><?php esc_html_e( 'Then thrive.', 'nestnthrive' ); ?></span>
                </h1>
                <p class="nnt-hero__desc">
                    <?php esc_html_e( 'Practical, honest recommendations for calmer spaces—one upgrade at a time. No fluff, just what works.', 'nestnthrive' ); ?>
                </p>
                <div class="nnt-hero__actions">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_collection' ) ); ?>" class="nnt-btn nnt-btn--primary">
                        <?php esc_html_e( 'Browse Reviews', 'nestnthrive' ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_room' ) ); ?>" class="nnt-btn nnt-btn--secondary">
                        <?php esc_html_e( 'Explore Spaces', 'nestnthrive' ); ?>
                    </a>
                </div>
            </div>

            <div class="nnt-hero__image nnt-reveal nnt-delay-200 group">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?auto=format&fit=crop&q=80&w=2000" alt="<?php esc_attr_e( 'Calm Living Space', 'nestnthrive' ); ?>" class="nnt-img-zoom">
                
                <div class="nnt-hero__floating-card">
                    <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                        <div style="padding: 0.5rem; background: var(--nnt-stone-100); border-radius: 0.5rem; color: var(--nnt-forest);">
                            <i data-lucide="check-circle-2" style="width: 1.25rem; height: 1.25rem;"></i>
                        </div>
                        <div>
                            <p style="font-size: 0.75rem; font-weight: 600; color: var(--nnt-stone-900); margin-bottom: 0.25rem;"><?php esc_html_e( 'Editor Tested', 'nestnthrive' ); ?></p>
                            <p style="font-size: 0.625rem; color: var(--nnt-stone-500); line-height: 1.4;"><?php esc_html_e( 'Every product is physically tested in a real home environment.', 'nestnthrive' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- EXPLORE SPACES -->
<?php if ( ! empty( $rooms ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <div>
                <h2 class="nnt-section__title"><?php esc_html_e( 'Explore Spaces', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( 'Find inspiration for every corner of your home.', 'nestnthrive' ); ?></p>
            </div>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_room' ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'View all spaces', 'nestnthrive' ); ?>
                <i data-lucide="arrow-right" style="width: 1rem; height: 1rem;"></i>
            </a>
        </div>

        <div class="nnt-grid nnt-grid--3 nnt-reveal nnt-delay-100">
            <?php foreach ( $rooms as $room ) : ?>
                <?php get_template_part( 'template-parts/components/card-space', null, array( 'post' => $room ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- SHOP BY GOAL -->
<?php if ( ! empty( $goals ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Shop by Goal', 'nestnthrive' ); ?></h2>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_goal' ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'View all goals', 'nestnthrive' ); ?>
            </a>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $goals as $goal ) : ?>
                <?php get_template_part( 'template-parts/components/card-goal', null, array( 'post' => $goal ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EDITOR'S PICKS -->
<?php if ( ! empty( $collections ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( "Editor's Picks", 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'Deep dives and comparisons on the gear we rely on.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--3">
            <?php 
            $delay = 100;
            foreach ( $collections as $collection ) : 
            ?>
                <div class="nnt-reveal nnt-delay-<?php echo esc_attr( $delay ); ?>">
                    <?php get_template_part( 'template-parts/components/card-review', null, array( 'post' => $collection ) ); ?>
                </div>
            <?php 
                $delay += 100;
            endforeach; 
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- TRUST BLOCK -->
<?php get_template_part( 'template-parts/components/trust-block' ); ?>

<!-- SETUP GUIDES -->
<?php if ( ! empty( $guides ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-section__header--centered nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Setup Guides', 'nestnthrive' ); ?></h2>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_guide' ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'View all guides', 'nestnthrive' ); ?>
            </a>
        </div>

        <div class="nnt-guides-masonry nnt-reveal nnt-delay-100">
            <?php 
            $guide_index = 0;
            foreach ( $guides as $guide ) : 
                $is_featured = ( $guide_index === 2 ); // 3rd card is featured (larger)
                $room_terms = wp_get_post_terms( $guide->ID, 'nnt_room_tax' );
                $tag = ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ? $room_terms[0]->name : '';
                $image_id = get_post_thumbnail_id( $guide );
            ?>
                <a href="<?php echo esc_url( get_permalink( $guide ) ); ?>" class="nnt-guide-masonry-card<?php echo $is_featured ? ' nnt-guide-masonry-card--featured' : ''; ?>">
                    <div class="nnt-guide-masonry-card__image">
                        <?php if ( $image_id ) : ?>
                            <?php echo wp_get_attachment_image( $image_id, $is_featured ? 'nnt-featured' : 'nnt-card' ); ?>
                        <?php else : ?>
                            <div style="width: 100%; height: 100%; background: var(--nnt-stone-200);"></div>
                        <?php endif; ?>
                        <?php if ( $tag ) : ?>
                            <span class="nnt-guide-masonry-card__tag"><?php echo esc_html( $tag ); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="nnt-guide-masonry-card__content">
                        <h3 class="nnt-guide-masonry-card__title"><?php echo esc_html( get_the_title( $guide ) ); ?></h3>
                        <p class="nnt-guide-masonry-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $guide ), 12 ) ); ?></p>
                        <span class="nnt-guide-masonry-card__link"><?php esc_html_e( 'Read Guide →', 'nestnthrive' ); ?></span>
                    </div>
                </a>
            <?php 
                $guide_index++;
            endforeach; 
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- DEALS & FINDS -->
<?php if ( ! empty( $deals ) ) : ?>
<section class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <div>
                <h2 class="nnt-section__title"><?php esc_html_e( 'Deals & Finds', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( "Limited-time finds and worthwhile discounts we'd actually buy.", 'nestnthrive' ); ?></p>
            </div>
            <?php 
            $deals_page = get_page_by_path( 'deals' );
            if ( $deals_page ) : 
            ?>
            <a href="<?php echo esc_url( get_permalink( $deals_page ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'See all deals', 'nestnthrive' ); ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="nnt-grid nnt-grid--3 nnt-reveal nnt-delay-100">
            <?php foreach ( $deals as $deal ) : ?>
                <?php get_template_part( 'template-parts/components/card-deal', null, array( 'post' => $deal ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
