<?php
/**
 * Goal Card Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param WP_Post $post The goal post object.
 * @param string  $icon Lucide icon name (optional).
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$post = $args['post'] ?? get_post();
$icon = $args['icon'] ?? 'boxes';

if ( ! $post ) {
    return;
}

$title     = get_the_title( $post );
$permalink = get_permalink( $post );
$excerpt   = get_the_excerpt( $post );

// Default icons based on goal slug
$icon_map = array(
    'organization'  => 'boxes',
    'cleaning'      => 'sparkles',
    'lighting'      => 'lamp',
    'small-spaces'  => 'maximize-2',
    'ergonomics'    => 'armchair',
    'work-from-home' => 'laptop',
    'outdoor'       => 'sun',
    'smart-home'    => 'wifi',
);

$slug = $post->post_name;
if ( isset( $icon_map[ $slug ] ) ) {
    $icon = $icon_map[ $slug ];
}
?>
<a href="<?php echo esc_url( $permalink ); ?>" class="nnt-card-goal nnt-hover-lift group">
    <div class="nnt-card-goal__icon">
        <i data-lucide="<?php echo esc_attr( $icon ); ?>" style="width: 1.5rem; height: 1.5rem;"></i>
    </div>
    <h3 class="nnt-card-goal__title"><?php echo esc_html( $title ); ?></h3>
    <?php if ( $excerpt ) : ?>
        <p class="nnt-card-goal__desc"><?php echo esc_html( wp_trim_words( $excerpt, 10 ) ); ?></p>
    <?php endif; ?>
</a>
