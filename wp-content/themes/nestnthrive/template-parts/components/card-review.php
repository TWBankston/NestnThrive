<?php
/**
 * Review/Collection Card Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param WP_Post $post  The collection post object.
 * @param string  $badge Optional badge text.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post  = $args['post'] ?? get_post();
$badge = $args['badge'] ?? '';

if ( ! $post ) {
    return;
}

$title     = get_the_title( $post );
$permalink = get_permalink( $post );
$excerpt   = get_the_excerpt( $post );
$image_id  = get_post_thumbnail_id( $post );

// Get room terms for badge
if ( empty( $badge ) ) {
    $room_terms = wp_get_post_terms( $post->ID, 'nnt_room_tax' );
    if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) {
        $badge = $room_terms[0]->name;
    }
}
?>
<article class="nnt-card-review nnt-hover-lift group">
    <div class="nnt-card-review__image nnt-img-zoom-container">
        <?php if ( $image_id ) : ?>
            <?php echo wp_get_attachment_image( $image_id, 'nnt-featured', false, array( 'class' => 'nnt-img-zoom' ) ); ?>
        <?php else : ?>
            <div style="width: 100%; height: 100%; background: var(--nnt-stone-200);"></div>
        <?php endif; ?>
        <?php if ( $badge ) : ?>
            <div class="nnt-card-review__badge"><?php echo esc_html( $badge ); ?></div>
        <?php endif; ?>
    </div>
    <h3 class="nnt-card-review__title">
        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
    </h3>
    <div class="nnt-card-review__stars">
        <i data-lucide="star" style="width: 0.875rem; height: 0.875rem;"></i>
        <i data-lucide="star" style="width: 0.875rem; height: 0.875rem;"></i>
        <i data-lucide="star" style="width: 0.875rem; height: 0.875rem;"></i>
        <i data-lucide="star" style="width: 0.875rem; height: 0.875rem;"></i>
        <i data-lucide="star" style="width: 0.875rem; height: 0.875rem;"></i>
    </div>
    <?php if ( $excerpt ) : ?>
        <p class="nnt-card-review__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?></p>
    <?php endif; ?>
    <span class="nnt-card-review__link"><?php esc_html_e( 'Read Review', 'nestnthrive' ); ?></span>
</article>

