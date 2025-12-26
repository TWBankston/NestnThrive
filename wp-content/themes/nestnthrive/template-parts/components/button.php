<?php
/**
 * Button Component
 *
 * Reusable button with consistent styling.
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     @type string $url      Link URL.
 *     @type string $text     Button text.
 *     @type string $style    Button style: 'primary', 'secondary', 'outline', 'ghost'.
 *     @type string $size     Button size: 'default', 'small', 'large'.
 *     @type string $icon     Optional icon position: 'none', 'arrow', 'external'.
 *     @type array  $attrs    Additional attributes.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$url    = $args['url'] ?? '#';
$text   = $args['text'] ?? __( 'Learn More', 'nestnthrive' );
$style  = $args['style'] ?? 'primary';
$size   = $args['size'] ?? 'default';
$icon   = $args['icon'] ?? 'none';
$attrs  = $args['attrs'] ?? array();

// Build class string.
$classes = array(
    'nnt-button',
    'nnt-button--' . sanitize_html_class( $style ),
    'nnt-button--' . sanitize_html_class( $size ),
);

if ( $icon !== 'none' ) {
    $classes[] = 'nnt-button--has-icon';
}

// Build attributes string.
$attr_string = '';
foreach ( $attrs as $key => $value ) {
    $attr_string .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
}

?>
<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"<?php echo $attr_string; ?>>
    <span><?php echo esc_html( $text ); ?></span>
    <?php if ( $icon === 'arrow' ) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-button__icon"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
    <?php elseif ( $icon === 'external' ) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-button__icon"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
    <?php endif; ?>
</a>

