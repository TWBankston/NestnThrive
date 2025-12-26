<?php
/**
 * Section Component Template Part
 *
 * Reusable section wrapper with title, subtitle, and content area.
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     Section arguments.
 *
 *     @type string $id         Section ID.
 *     @type string $class      Additional CSS classes.
 *     @type string $background Background style: 'default', 'white', 'dark'.
 *     @type string $kicker     Eyebrow/kicker text above title.
 *     @type string $title      Section title.
 *     @type string $subtitle   Section subtitle.
 *     @type string $link_text  Optional link text.
 *     @type string $link_url   Optional link URL.
 *     @type bool   $centered   Whether to center the header.
 * }
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get section arguments.
$section_id    = $args['id'] ?? '';
$extra_classes = $args['class'] ?? '';
$background    = $args['background'] ?? 'default';
$kicker        = $args['kicker'] ?? '';
$title         = $args['title'] ?? '';
$subtitle      = $args['subtitle'] ?? '';
$link_text     = $args['link_text'] ?? '';
$link_url      = $args['link_url'] ?? '';
$centered      = $args['centered'] ?? false;

// Build class string.
$classes = array( 'nnt-section' );

switch ( $background ) {
    case 'white':
        $classes[] = 'nnt-section--white';
        break;
    case 'dark':
        $classes[] = 'nnt-section--dark';
        break;
    case 'alt':
        $classes[] = 'nnt-section--alt';
        break;
}

if ( $centered ) {
    $classes[] = 'nnt-section--centered';
}

if ( $extra_classes ) {
    $classes[] = $extra_classes;
}
?>
<section <?php echo $section_id ? 'id="' . esc_attr( $section_id ) . '"' : ''; ?> class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
    <div class="nnt-container">
        <?php if ( $kicker || $title || $subtitle || ( $link_text && $link_url ) ) : ?>
            <header class="nnt-section__header">
                <?php if ( $centered ) : ?>
                    <div class="nnt-section__header-centered">
                        <?php if ( $kicker ) : ?>
                            <span class="nnt-section__kicker"><?php echo esc_html( $kicker ); ?></span>
                        <?php endif; ?>
                        <?php if ( $title ) : ?>
                            <h2 class="nnt-section__title"><?php echo esc_html( $title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $subtitle ) : ?>
                            <p class="nnt-section__subtitle"><?php echo esc_html( $subtitle ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="nnt-section__header-left">
                        <?php if ( $kicker ) : ?>
                            <span class="nnt-section__kicker"><?php echo esc_html( $kicker ); ?></span>
                        <?php endif; ?>
                        <?php if ( $title ) : ?>
                            <h2 class="nnt-section__title"><?php echo esc_html( $title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $subtitle ) : ?>
                            <p class="nnt-section__subtitle"><?php echo esc_html( $subtitle ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( $link_text && $link_url ) : ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="nnt-section__link">
                            <?php echo esc_html( $link_text ); ?>
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </header>
        <?php endif; ?>

        <div class="nnt-section__content">
