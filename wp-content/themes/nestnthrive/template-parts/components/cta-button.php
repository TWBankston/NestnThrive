<?php
/**
 * CTA Button Component Template Part
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     Button arguments.
 *
 *     @type string $text   Button text.
 *     @type string $url    Button URL.
 *     @type string $style  Button style: 'primary', 'secondary', 'outline'.
 *     @type string $size   Button size: 'default', 'small', 'large'.
 *     @type bool   $arrow  Whether to show arrow icon.
 *     @type string $class  Additional CSS classes.
 * }
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get button arguments.
$text   = $args['text'] ?? __( 'Learn More', 'nestnthrive' );
$url    = $args['url'] ?? '#';
$style  = $args['style'] ?? 'primary';
$size   = $args['size'] ?? 'default';
$arrow  = $args['arrow'] ?? false;
$class  = $args['class'] ?? '';

// Build class string.
$classes = array(
    'nnt-button',
    'nnt-button--' . sanitize_html_class( $style ),
    'nnt-button--' . sanitize_html_class( $size ),
);

if ( $class ) {
    $classes[] = $class;
}
?>
<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <?php echo esc_html( $text ); ?>
    <?php if ( $arrow ) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-button__arrow"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
    <?php endif; ?>
</a>

