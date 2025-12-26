<?php
/**
 * Single Room Hub Template
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get current room.
$room_id = get_the_ID();

// Get hero content with fallbacks.
$hero = nnt_get_hero_content( $room_id );

// Get featured items.
$featured_collections = nnt_get_featured_items( $room_id, 'nnt_featured_collections', 'nnt_collection' );
$featured_guides      = nnt_get_featured_items( $room_id, 'nnt_featured_guides', 'nnt_guide' );
$featured_goals       = nnt_get_featured_terms( $room_id, 'nnt_featured_goals', 'nnt_goal_tax' );

// Get all guides for this room.
$all_guides = nnt_get_guides_for_room( $room_id, 12 );

// Get other rooms.
$other_rooms = nnt_get_other_rooms( $room_id, 4 );

// Get featured image.
$hero_image = get_the_post_thumbnail_url( $room_id, 'nnt-hero' );

// Check for missing term mapping (admin warning only).
$has_matching_term = nnt_room_has_matching_term( $room_id );
?>

<!-- ROOM HERO -->
<section class="nnt-hub-hero">
    <div class="nnt-hub-hero__bg"></div>
    
    <div class="nnt-container">
        <div class="nnt-hub-hero__grid">
            <div class="nnt-hub-hero__content">
                <?php get_template_part( 'template-parts/components/breadcrumbs', null, array(
                    'items' => array(
                        array( 'label' => __( 'Room Hub', 'nestnthrive' ), 'url' => null ),
                    ),
                ) ); ?>
                
                <h1 class="nnt-hub-hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>
                
                <?php if ( $hero['subtitle'] ) : ?>
                    <p class="nnt-hub-hero__subtitle"><?php echo esc_html( $hero['subtitle'] ); ?></p>
                <?php endif; ?>
                
                <?php if ( $hero['supporting_line'] ) : ?>
                    <div class="nnt-hub-hero__quote">
                        <p><?php echo esc_html( $hero['supporting_line'] ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ( $hero_image ) : ?>
                <div class="nnt-hub-hero__image-wrap">
                    <div class="nnt-hub-hero__image">
                        <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero['title'] ); ?>">
                        <div class="nnt-hub-hero__image-overlay"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- FEATURED COLLECTIONS -->
<?php if ( ! empty( $featured_collections ) ) : ?>
<section class="nnt-section nnt-section--collections">
    <div class="nnt-container">
        <header class="nnt-section__header">
            <div class="nnt-section__header-left">
                <h2 class="nnt-section__title"><?php esc_html_e( 'Essential Upgrades', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( 'The foundational items that define a productive workspace.', 'nestnthrive' ); ?></p>
            </div>
        </header>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $featured_collections as $collection ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $collection,
                    'type'         => 'collection',
                    'style'        => 'featured',
                    'show_excerpt' => true,
                    'image_size'   => 'nnt-card',
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- IMPROVE BY GOAL -->
<?php if ( ! empty( $featured_goals ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--goals">
    <div class="nnt-container">
        <header class="nnt-section__header nnt-section__header--centered">
            <span class="nnt-section__kicker"><?php esc_html_e( 'Outcomes', 'nestnthrive' ); ?></span>
            <h2 class="nnt-section__title"><?php esc_html_e( 'Improve This Room by Goal', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle"><?php esc_html_e( 'Choose the result you want—we\'ll guide you to the right setup.', 'nestnthrive' ); ?></p>
        </header>
        
        <div class="nnt-grid nnt-grid--4">
            <?php foreach ( $featured_goals as $goal_term ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $goal_term,
                    'type'         => 'goal-term',
                    'style'        => 'goal-tile',
                    'show_excerpt' => true,
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FEATURED GUIDES -->
<?php if ( ! empty( $featured_guides ) ) : ?>
<section class="nnt-section nnt-section--guides">
    <div class="nnt-container">
        <h2 class="nnt-section__title nnt-section__title--bordered"><?php esc_html_e( 'Guides to Get It Right', 'nestnthrive' ); ?></h2>
        
        <div class="nnt-guides-featured">
            <?php 
            $first_guide = array_shift( $featured_guides );
            if ( $first_guide ) :
            ?>
                <!-- Hero Guide -->
                <article class="nnt-guide-hero">
                    <?php $guide_image = get_the_post_thumbnail_url( $first_guide->ID, 'nnt-featured' ); ?>
                    <?php if ( $guide_image ) : ?>
                        <div class="nnt-guide-hero__image">
                            <img src="<?php echo esc_url( $guide_image ); ?>" alt="<?php echo esc_attr( get_the_title( $first_guide ) ); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="nnt-guide-hero__content">
                        <div class="nnt-guide-hero__meta">
                            <?php $kicker = get_post_meta( $first_guide->ID, 'nnt_guide_kicker', true ); ?>
                            <?php if ( $kicker ) : ?>
                                <span class="nnt-kicker"><?php echo esc_html( $kicker ); ?></span>
                            <?php endif; ?>
                            <span class="nnt-meta__item"><?php echo esc_html( nnt_get_reading_time( $first_guide->ID ) ); ?></span>
                        </div>
                        <h3 class="nnt-guide-hero__title">
                            <a href="<?php echo esc_url( get_permalink( $first_guide ) ); ?>">
                                <?php echo esc_html( get_the_title( $first_guide ) ); ?>
                            </a>
                        </h3>
                        <p class="nnt-guide-hero__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $first_guide ), 30 ) ); ?></p>
                        <a href="<?php echo esc_url( get_permalink( $first_guide ) ); ?>" class="nnt-button nnt-button--primary">
                            <?php esc_html_e( 'Read the Guide', 'nestnthrive' ); ?>
                        </a>
                    </div>
                </article>
            <?php endif; ?>
            
            <?php if ( ! empty( $featured_guides ) ) : ?>
                <div class="nnt-guides-list">
                    <?php foreach ( $featured_guides as $guide ) : ?>
                        <?php
                        get_template_part( 'template-parts/components/card', null, array(
                            'item'         => $guide,
                            'type'         => 'guide',
                            'style'        => 'list',
                            'show_meta'    => true,
                            'show_excerpt' => true,
                        ) );
                        ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ROOM PHILOSOPHY -->
<section class="nnt-section nnt-section--dark nnt-section--philosophy">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-room-philosophy">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-room-philosophy__icon"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path><line x1="16" y1="8" x2="2" y2="22"></line><line x1="17.5" y1="15" x2="9" y2="15"></line></svg>
            <h2 class="nnt-room-philosophy__title"><?php printf( esc_html__( 'What makes a great %s?', 'nestnthrive' ), esc_html( get_the_title() ) ); ?></h2>
            <div class="nnt-room-philosophy__content">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<!-- ALL GUIDES LIST -->
<?php if ( ! empty( $all_guides ) ) : ?>
<section class="nnt-section nnt-section--all-guides">
    <div class="nnt-container">
        <header class="nnt-section__header">
            <h2 class="nnt-section__title"><?php printf( esc_html__( 'All %s Guides', 'nestnthrive' ), esc_html( get_the_title() ) ); ?></h2>
        </header>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $all_guides as $guide ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $guide,
                    'type'         => 'guide',
                    'style'        => 'text-only',
                    'show_excerpt' => true,
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EXPLORE OTHER ROOMS -->
<?php if ( ! empty( $other_rooms ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--other-rooms">
    <div class="nnt-container">
        <h2 class="nnt-section__title"><?php esc_html_e( 'Explore Other Rooms', 'nestnthrive' ); ?></h2>
        
        <div class="nnt-grid nnt-grid--4">
            <?php foreach ( $other_rooms as $room ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $room,
                    'type'         => 'room',
                    'style'        => 'overlay',
                    'show_excerpt' => false,
                    'image_size'   => 'nnt-card',
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EMAIL CTA -->
<section class="nnt-section nnt-section--newsletter">
    <div class="nnt-container nnt-container--narrow">
        <?php
        get_template_part( 'template-parts/components/newsletter-form', null, array(
            'style'    => 'compact',
            'title'    => __( 'Thoughtful upgrades, one room at a time.', 'nestnthrive' ),
            'subtitle' => __( 'Join 12,000+ others receiving our weekly curation.', 'nestnthrive' ),
        ) );
        ?>
    </div>
</section>

<?php
get_footer();
