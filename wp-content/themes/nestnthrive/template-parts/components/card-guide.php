<?php
/**
 * Guide Card Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param WP_Post $post The guide post object.
 * @param string  $tag  Optional tag text.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post = $args['post'] ?? get_post();
$tag  = $args['tag'] ?? '';

if ( ! $post ) {
    return;
}

$title     = get_the_title( $post );
$permalink = get_permalink( $post );
$excerpt   = get_the_excerpt( $post );
$image_id  = get_post_thumbnail_id( $post );

// Get room terms for tag
if ( empty( $tag ) ) {
    $room_terms = wp_get_post_terms( $post->ID, 'nnt_room_tax' );
    if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) {
        $tag = $room_terms[0]->name;
    }
}
?>
<a href="<?php echo esc_url( $permalink ); ?>" class="nnt-card-guide nnt-hover-lift group">
    <div class="nnt-card-guide__image nnt-img-zoom-container">
        <?php if ( $image_id ) : ?>
            <?php echo wp_get_attachment_image( $image_id, 'nnt-card', false, array( 'class' => 'nnt-img-zoom' ) ); ?>
        <?php else : ?>
            <div style="width: 100%; height: 100%; background: var(--nnt-stone-100);"></div>
        <?php endif; ?>
        <?php if ( $tag ) : ?>
            <span class="nnt-card-guide__tag"><?php echo esc_html( $tag ); ?></span>
        <?php endif; ?>
    </div>
    <h3 class="nnt-card-guide__title"><?php echo esc_html( $title ); ?></h3>
    <?php if ( $excerpt ) : ?>
        <p class="nnt-card-guide__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 15 ) ); ?></p>
    <?php endif; ?>
    <span class="nnt-card-guide__link"><?php esc_html_e( 'Read Guide →', 'nestnthrive' ); ?></span>
</a>
