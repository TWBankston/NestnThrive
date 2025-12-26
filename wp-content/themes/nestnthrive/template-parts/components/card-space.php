<?php
/**
 * Space/Room Card Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param WP_Post $post     The room post object.
 * @param string  $size     Card size: 'default' or 'small'.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post = $args['post'] ?? get_post();
$size = $args['size'] ?? 'default';

if ( ! $post ) {
    return;
}

$title     = get_the_title( $post );
$permalink = get_permalink( $post );
$excerpt   = get_the_excerpt( $post );
$image_id  = get_post_thumbnail_id( $post );
?>
<a href="<?php echo esc_url( $permalink ); ?>" class="nnt-card-space group">
    <div class="nnt-card-space__image nnt-img-zoom-container">
        <?php if ( $image_id ) : ?>
            <?php echo wp_get_attachment_image( $image_id, 'nnt-card', false, array( 'class' => 'nnt-img-zoom' ) ); ?>
        <?php else : ?>
            <div style="width: 100%; height: 100%; background: var(--nnt-stone-200);"></div>
        <?php endif; ?>
        <div class="nnt-card-space__overlay"></div>
    </div>
    <h3 class="nnt-card-space__title"><?php echo esc_html( $title ); ?></h3>
    <?php if ( $size !== 'small' && $excerpt ) : ?>
        <p class="nnt-card-space__desc"><?php echo esc_html( wp_trim_words( $excerpt, 8 ) ); ?></p>
    <?php endif; ?>
</a>

