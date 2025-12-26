<?php
/**
 * Single Goal Hub Template
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get current goal.
$goal_id = get_the_ID();

// Get hero content with fallbacks.
$hero = nnt_get_hero_content( $goal_id );

// Get featured items.
$featured_collections = nnt_get_featured_items( $goal_id, 'nnt_featured_collections', 'nnt_collection' );
$featured_guides      = nnt_get_featured_items( $goal_id, 'nnt_featured_guides', 'nnt_guide' );
$featured_rooms       = nnt_get_featured_terms( $goal_id, 'nnt_featured_rooms', 'nnt_room_tax' );

// Get all guides for this goal.
$all_guides = nnt_get_guides_for_goal( $goal_id, 12 );

// Get other goals.
$other_goals = nnt_get_other_goals( $goal_id, 4 );

// Get featured image.
$hero_image = get_the_post_thumbnail_url( $goal_id, 'nnt-hero' );
?>

<!-- GOAL HERO -->
<section class="nnt-hub-hero">
    <div class="nnt-hub-hero__bg"></div>
    
    <div class="nnt-container">
        <div class="nnt-hub-hero__grid">
            <div class="nnt-hub-hero__content">
                <?php get_template_part( 'template-parts/components/breadcrumbs', null, array(
                    'items' => array(
                        array( 'label' => __( 'Goal Hub', 'nestnthrive' ), 'url' => null ),
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
                <h2 class="nnt-section__title"><?php printf( esc_html__( 'Essential Picks for Better %s', 'nestnthrive' ), esc_html( get_the_title() ) ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( 'Curated tools that solve specific problems.', 'nestnthrive' ); ?></p>
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

<!-- EXPLORE BY ROOM -->
<?php if ( ! empty( $featured_rooms ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--rooms">
    <div class="nnt-container">
        <header class="nnt-section__header nnt-section__header--centered">
            <span class="nnt-section__kicker"><?php esc_html_e( 'Context', 'nestnthrive' ); ?></span>
            <h2 class="nnt-section__title"><?php esc_html_e( 'Explore by Room', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle"><?php printf( esc_html__( '%s looks different depending on the space. Start where you live.', 'nestnthrive' ), esc_html( get_the_title() ) ); ?></p>
        </header>
        
        <div class="nnt-grid nnt-grid--4">
            <?php foreach ( $featured_rooms as $room_term ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $room_term,
                    'type'         => 'room-term',
                    'style'        => 'overlay',
                    'show_excerpt' => false,
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
        <h2 class="nnt-section__title nnt-section__title--bordered"><?php esc_html_e( 'Guides to Help You Get There', 'nestnthrive' ); ?></h2>
        
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

<!-- GOAL PHILOSOPHY -->
<section class="nnt-section nnt-section--dark nnt-section--philosophy">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-room-philosophy">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-room-philosophy__icon"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            <h2 class="nnt-room-philosophy__title"><?php printf( esc_html__( 'What Makes %s Actually Work?', 'nestnthrive' ), esc_html( get_the_title() ) ); ?></h2>
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

<!-- EXPLORE OTHER GOALS -->
<?php if ( ! empty( $other_goals ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--other-goals">
    <div class="nnt-container">
        <h2 class="nnt-section__title"><?php esc_html_e( 'Explore Other Goals', 'nestnthrive' ); ?></h2>
        
        <div class="nnt-grid nnt-grid--4">
            <?php foreach ( $other_goals as $goal ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $goal,
                    'type'         => 'goal',
                    'style'        => 'goal-tile',
                    'show_excerpt' => false,
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
            'title'    => __( 'Clearer spaces start with better decisions.', 'nestnthrive' ),
            'subtitle' => __( 'Join 12,000+ others receiving our weekly curation.', 'nestnthrive' ),
        ) );
        ?>
    </div>
</section>

<?php
get_footer();
