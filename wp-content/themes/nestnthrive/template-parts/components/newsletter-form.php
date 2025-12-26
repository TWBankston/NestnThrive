<?php
/**
 * Newsletter Form Component Template Part
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     Form arguments.
 *
 *     @type string $title      Form title.
 *     @type string $subtitle   Form subtitle.
 *     @type string $style      Form style: 'default', 'compact', 'centered'.
 *     @type string $background Background: 'default', 'dark', 'white'.
 * }
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get form arguments.
$title      = $args['title'] ?? __( 'A calmer home—one upgrade at a time.', 'nestnthrive' );
$subtitle   = $args['subtitle'] ?? __( 'Occasional guides, room resets, and curated finds. No spam, ever.', 'nestnthrive' );
$style      = $args['style'] ?? 'default';
$background = $args['background'] ?? 'default';

// Build class string.
$classes = array(
    'nnt-newsletter',
    'nnt-newsletter--' . sanitize_html_class( $style ),
    'nnt-newsletter--' . sanitize_html_class( $background ),
);
?>
<div id="newsletter" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <div class="nnt-newsletter__content">
        <?php if ( $style === 'centered' ) : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-newsletter__icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        <?php endif; ?>
        
        <?php if ( $title ) : ?>
            <h2 class="nnt-newsletter__title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        
        <?php if ( $subtitle ) : ?>
            <p class="nnt-newsletter__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <?php endif; ?>
        
        <form class="nnt-newsletter__form" action="#newsletter" method="post">
            <input 
                type="email" 
                name="nnt_newsletter_email" 
                placeholder="<?php esc_attr_e( 'Enter your email', 'nestnthrive' ); ?>" 
                class="nnt-newsletter__input"
                required
            >
            <button type="submit" class="nnt-newsletter__button">
                <?php esc_html_e( 'Join the list', 'nestnthrive' ); ?>
            </button>
        </form>
    </div>
</div>

