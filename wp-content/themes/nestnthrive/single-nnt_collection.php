<?php
/**
 * Single Product Collection Template
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get current collection.
$collection_id = get_the_ID();

// Get meta fields.
$kicker                = get_post_meta( $collection_id, 'nnt_collection_kicker', true );
$intro_summary         = get_post_meta( $collection_id, 'nnt_intro_summary', true );
$disclosure_style      = get_post_meta( $collection_id, 'nnt_affiliate_disclosure_style', true );
$updated_date          = nnt_get_updated_date( $collection_id );
$manual_related        = get_post_meta( $collection_id, 'nnt_related_content_manual', true );

// Get related content.
if ( ! empty( $manual_related ) && is_array( $manual_related ) ) {
    $related_posts = nnt_get_ordered_posts( $manual_related, array( 'nnt_guide', 'nnt_collection' ), 3 );
} else {
    $related_posts = nnt_get_related_by_terms( $collection_id, array( 'nnt_guide', 'nnt_collection' ), array( 'nnt_room_tax', 'nnt_goal_tax' ), 3 );
}

// Get taxonomy terms for breadcrumbs.
$room_terms = get_the_terms( $collection_id, 'nnt_room_tax' );
$goal_terms = get_the_terms( $collection_id, 'nnt_goal_tax' );

// Build breadcrumb items.
$breadcrumb_items = array();
if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) {
    $breadcrumb_items[] = array(
        'label' => $room_terms[0]->name,
        'url'   => get_term_link( $room_terms[0] ),
    );
}
if ( ! is_wp_error( $goal_terms ) && ! empty( $goal_terms ) ) {
    $breadcrumb_items[] = array(
        'label' => $goal_terms[0]->name,
        'url'   => get_term_link( $goal_terms[0] ),
    );
}
?>

<!-- COLLECTION HERO -->
<header class="nnt-article-hero">
    <div class="nnt-article-hero__bg"></div>
    
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-article-hero__content">
            <!-- Breadcrumbs -->
            <?php if ( ! empty( $breadcrumb_items ) ) : ?>
                <div class="nnt-article-hero__crumbs">
                    <?php foreach ( $breadcrumb_items as $index => $item ) : ?>
                        <?php if ( $index > 0 ) : ?>
                            <span class="nnt-article-hero__crumb-sep">/</span>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $item['url'] ); ?>" class="nnt-article-hero__crumb">
                            <?php echo esc_html( $item['label'] ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <h1 class="nnt-article-hero__title"><?php the_title(); ?></h1>
            
            <?php if ( $intro_summary ) : ?>
                <p class="nnt-article-hero__summary"><?php echo esc_html( $intro_summary ); ?></p>
            <?php endif; ?>
            
            <!-- Meta Info -->
            <div class="nnt-article-hero__meta">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="nnt-article-hero__author-image">
                        <?php 
                        // Could be author avatar; using post thumbnail as placeholder.
                        $author_avatar = get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 64 ) );
                        ?>
                        <img src="<?php echo esc_url( $author_avatar ); ?>" alt="<?php the_author(); ?>">
                    </div>
                <?php endif; ?>
                <span><?php printf( esc_html__( 'By %s', 'nestnthrive' ), '<span class="nnt-article-hero__author">' . get_the_author() . '</span>' ); ?></span>
                <span class="nnt-article-hero__sep"></span>
                <span><?php printf( esc_html__( 'Updated %s', 'nestnthrive' ), esc_html( $updated_date ) ); ?></span>
                <span class="nnt-article-hero__sep"></span>
                <span class="nnt-article-hero__verified">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <?php esc_html_e( 'Independently Reviewed', 'nestnthrive' ); ?>
                </span>
            </div>
        </div>
    </div>
</header>

<!-- Affiliate Disclosure -->
<?php if ( $disclosure_style === 'block' ) : ?>
    <div class="nnt-disclosure-bar nnt-disclosure-bar--block">
        <div class="nnt-container">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <?php esc_html_e( 'We purchase products for testing. When you buy through our links, we may earn a commission.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
<?php else : ?>
    <div class="nnt-disclosure-bar nnt-disclosure-bar--inline">
        <div class="nnt-container">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                <?php esc_html_e( 'We purchase products for testing. When you buy through our links, we may earn a commission.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
<?php endif; ?>

<!-- MAIN CONTENT -->
<article class="nnt-article">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-article__content entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<!-- RELATED CONTENT -->
<?php if ( ! empty( $related_posts ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--related">
    <div class="nnt-container">
        <h2 class="nnt-section__title"><?php esc_html_e( 'More for Your Space', 'nestnthrive' ); ?></h2>
        
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

<?php
get_footer();
