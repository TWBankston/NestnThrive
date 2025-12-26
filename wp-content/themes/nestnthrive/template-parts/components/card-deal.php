<?php
/**
 * Deal Card Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param WP_Post $post The collection post with deal meta.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post = $args['post'] ?? get_post();

if ( ! $post ) {
    return;
}

$title          = get_the_title( $post );
$permalink      = get_permalink( $post );
$excerpt        = get_the_excerpt( $post );
$image_id       = get_post_thumbnail_id( $post );
$deal_badge     = get_post_meta( $post->ID, 'nnt_deal_badge', true );
$original_price = get_post_meta( $post->ID, 'nnt_deal_original_price', true );
$sale_price     = get_post_meta( $post->ID, 'nnt_deal_sale_price', true );

if ( empty( $deal_badge ) ) {
    $deal_badge = __( 'Sale', 'nestnthrive' );
}
?>
<a href="<?php echo esc_url( $permalink ); ?>" class="nnt-card-deal group" style="text-decoration: none;">
    <div class="nnt-card-deal__image">
        <?php if ( $image_id ) : ?>
            <?php echo wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
        <?php endif; ?>
    </div>
    <div>
        <div class="nnt-card-deal__badge"><?php echo esc_html( $deal_badge ); ?></div>
        <h4 class="nnt-card-deal__title"><?php echo esc_html( $title ); ?></h4>
        <?php if ( $excerpt ) : ?>
            <p class="nnt-card-deal__desc"><?php echo esc_html( wp_trim_words( $excerpt, 10 ) ); ?></p>
        <?php endif; ?>
    </div>
</a>

