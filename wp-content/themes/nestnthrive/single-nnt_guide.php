<?php
/**
 * Single Guide (How-To) Template
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get current guide.
$guide_id = get_the_ID();

// Get meta fields.
$kicker          = get_post_meta( $guide_id, 'nnt_guide_kicker', true );
$hero_summary    = get_post_meta( $guide_id, 'nnt_hero_summary', true );
$reading_time    = nnt_get_reading_time( $guide_id );
$updated_date    = nnt_get_updated_date( $guide_id );
$show_email_cta  = get_post_meta( $guide_id, 'nnt_email_cta_toggle', true );
$manual_related  = get_post_meta( $guide_id, 'nnt_related_content_manual', true );

// Default email CTA to true if not set.
if ( $show_email_cta === '' ) {
    $show_email_cta = true;
}

// Get related content.
if ( ! empty( $manual_related ) && is_array( $manual_related ) ) {
    $related_posts = nnt_get_ordered_posts( $manual_related, array( 'nnt_guide', 'nnt_collection' ), 3 );
} else {
    $related_posts = nnt_get_related_by_terms( $guide_id, array( 'nnt_guide', 'nnt_collection' ), array( 'nnt_room_tax', 'nnt_goal_tax' ), 3 );
}

// Get taxonomy terms for breadcrumbs.
$room_terms = get_the_terms( $guide_id, 'nnt_room_tax' );
$goal_terms = get_the_terms( $guide_id, 'nnt_goal_tax' );

// Build breadcrumb path.
$breadcrumb_items = array();
$breadcrumb_items[] = array(
    'label' => __( 'Guides', 'nestnthrive' ),
    'url'   => get_post_type_archive_link( 'nnt_guide' ),
);
if ( ! is_wp_error( $goal_terms ) && ! empty( $goal_terms ) ) {
    $breadcrumb_items[] = array(
        'label' => $goal_terms[0]->name,
        'url'   => get_term_link( $goal_terms[0] ),
    );
}
?>

<!-- GUIDE HERO -->
<header class="nnt-article-hero nnt-article-hero--guide">
    <div class="nnt-article-hero__bg"></div>
    
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-article-hero__content">
            <!-- Breadcrumbs -->
            <div class="nnt-article-hero__crumbs">
                <?php foreach ( $breadcrumb_items as $index => $item ) : ?>
                    <?php if ( $index > 0 ) : ?>
                        <span class="nnt-article-hero__crumb-sep">/</span>
                    <?php endif; ?>
                    <?php if ( $item['url'] ) : ?>
                        <a href="<?php echo esc_url( $item['url'] ); ?>" class="nnt-article-hero__crumb">
                            <?php echo esc_html( $item['label'] ); ?>
                        </a>
                    <?php else : ?>
                        <span class="nnt-article-hero__crumb"><?php echo esc_html( $item['label'] ); ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            
            <h1 class="nnt-article-hero__title"><?php the_title(); ?></h1>
            
            <?php if ( $hero_summary ) : ?>
                <p class="nnt-article-hero__summary"><?php echo esc_html( $hero_summary ); ?></p>
            <?php elseif ( has_excerpt() ) : ?>
                <p class="nnt-article-hero__summary"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <?php endif; ?>
            
            <!-- Meta Info -->
            <div class="nnt-article-hero__meta">
                <?php 
                $author_avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 64 ) );
                ?>
                <div class="nnt-article-hero__author-image">
                    <img src="<?php echo esc_url( $author_avatar ); ?>" alt="<?php the_author(); ?>">
                </div>
                <span><?php printf( esc_html__( 'By %s', 'nestnthrive' ), '<span class="nnt-article-hero__author">' . get_the_author() . '</span>' ); ?></span>
                <span class="nnt-article-hero__sep"></span>
                <span class="nnt-article-hero__reading-time">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <?php echo esc_html( $reading_time ); ?>
                </span>
                <span class="nnt-article-hero__sep"></span>
                <span><?php printf( esc_html__( 'Updated %s', 'nestnthrive' ), esc_html( $updated_date ) ); ?></span>
            </div>
        </div>
    </div>
</header>

<!-- MAIN CONTENT -->
<article class="nnt-article nnt-article--guide">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-article__content entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<!-- RELATED CONTENT -->
<?php if ( ! empty( $related_posts ) ) : ?>
<section class="nnt-section nnt-section--related">
    <div class="nnt-container">
        <header class="nnt-section__header">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Keep Improving Your Space', 'nestnthrive' ); ?></h2>
            <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_guide' ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'View all guides', 'nestnthrive' ); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </header>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $related_posts as $related_post ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $related_post,
                    'type'         => $related_post->post_type,
                    'style'        => 'default',
                    'show_meta'    => true,
                    'show_excerpt' => true,
                    'image_size'   => 'nnt-card',
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EMAIL CTA -->
<?php if ( $show_email_cta ) : ?>
<section class="nnt-section nnt-section--white nnt-section--newsletter">
    <div class="nnt-container nnt-container--narrow">
        <?php
        get_template_part( 'template-parts/components/newsletter-form', null, array(
            'style'    => 'centered',
            'title'    => __( 'Thoughtful upgrades, explained simply.', 'nestnthrive' ),
            'subtitle' => __( 'Join 15,000+ readers receiving our calm, practical guides twice a month.', 'nestnthrive' ),
        ) );
        ?>
    </div>
</section>
<?php endif; ?>

<?php
get_footer();

