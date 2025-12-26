<?php
/**
 * Card Component Template Part
 *
 * Supports multiple card types: room, goal, guide, collection, term
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     Card arguments.
 *
 *     @type WP_Post|WP_Term $item       Post or Term object.
 *     @type string          $type       Card type: 'guide', 'collection', 'room', 'goal', 'room-term', 'goal-term'.
 *     @type string          $style      Card style: 'default', 'minimal', 'featured', 'overlay', 'list'.
 *     @type string          $size       Card size: 'default', 'small', 'large'.
 *     @type bool            $show_meta  Whether to show meta info.
 *     @type bool            $show_excerpt Whether to show excerpt.
 *     @type string          $image_size Custom image size.
 * }
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get card arguments with defaults.
$item         = $args['item'] ?? $args['post'] ?? null;
$card_type    = $args['type'] ?? 'default';
$card_style   = $args['style'] ?? 'default';
$card_size    = $args['size'] ?? 'default';
$show_meta    = $args['show_meta'] ?? true;
$show_excerpt = $args['show_excerpt'] ?? true;
$image_size   = $args['image_size'] ?? 'nnt-card';

if ( ! $item ) {
    return;
}

// Determine if this is a term or post.
$is_term = $item instanceof WP_Term;

// Get card data based on type.
if ( $is_term ) {
    $permalink    = get_term_link( $item );
    $title        = $item->name;
    $excerpt      = $item->description;
    $thumbnail_id = get_term_meta( $item->term_id, 'thumbnail_id', true );
    $kicker       = '';
} else {
    $post         = get_post( $item );
    $permalink    = get_permalink( $post );
    $title        = get_the_title( $post );
    $excerpt      = get_the_excerpt( $post );
    $thumbnail_id = get_post_thumbnail_id( $post );
    
    // Get kicker based on post type.
    $kicker = '';
    switch ( $post->post_type ) {
        case 'nnt_guide':
            $kicker = get_post_meta( $post->ID, 'nnt_guide_kicker', true );
            break;
        case 'nnt_collection':
            $kicker = get_post_meta( $post->ID, 'nnt_collection_kicker', true );
            break;
    }
    
    $card_type = $card_type === 'default' ? $post->post_type : $card_type;
}

// Build class string.
$classes = array(
    'nnt-card',
    'nnt-card--' . sanitize_html_class( $card_type ),
    'nnt-card--' . sanitize_html_class( $card_style ),
    'nnt-card--' . sanitize_html_class( $card_size ),
);

// Render based on style.
switch ( $card_style ) :
    case 'overlay':
        // Room/Goal card with overlay text
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <div class="nnt-card__image-wrap">
                <?php if ( $thumbnail_id ) : ?>
                    <?php echo wp_get_attachment_image( $thumbnail_id, $image_size, false, array( 'loading' => 'lazy', 'class' => 'nnt-card__img' ) ); ?>
                <?php else : ?>
                    <div class="nnt-card__placeholder"></div>
                <?php endif; ?>
                <div class="nnt-card__overlay"></div>
            </div>
            <div class="nnt-card__content">
                <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
                <?php if ( $show_excerpt && $excerpt ) : ?>
                    <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 10 ) ); ?></p>
                <?php endif; ?>
            </div>
        </a>
        <?php
        break;

    case 'minimal':
        // Simple room/goal card with underline
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <div class="nnt-card__image-wrap">
                <?php if ( $thumbnail_id ) : ?>
                    <?php echo wp_get_attachment_image( $thumbnail_id, $image_size, false, array( 'loading' => 'lazy', 'class' => 'nnt-card__img' ) ); ?>
                <?php else : ?>
                    <div class="nnt-card__placeholder"></div>
                <?php endif; ?>
            </div>
            <div class="nnt-card__content">
                <div class="nnt-card__info">
                    <div>
                        <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
                        <?php if ( $show_excerpt && $excerpt ) : ?>
                            <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 8 ) ); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="nnt-card__arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                    </div>
                </div>
            </div>
        </a>
        <?php
        break;

    case 'goal-tile':
        // Goal tile card with icon
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <div class="nnt-card__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </div>
            <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
            <?php if ( $show_excerpt && $excerpt ) : ?>
                <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 12 ) ); ?></p>
            <?php endif; ?>
        </a>
        <?php
        break;

    case 'featured':
        // Featured collection/guide card
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <div class="nnt-card__image-wrap">
                <?php if ( $thumbnail_id ) : ?>
                    <?php echo wp_get_attachment_image( $thumbnail_id, $image_size, false, array( 'loading' => 'lazy', 'class' => 'nnt-card__img' ) ); ?>
                <?php else : ?>
                    <div class="nnt-card__placeholder"></div>
                <?php endif; ?>
                <?php if ( $kicker ) : ?>
                    <span class="nnt-card__badge"><?php echo esc_html( $kicker ); ?></span>
                <?php endif; ?>
            </div>
            <div class="nnt-card__content">
                <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
                <?php if ( $show_excerpt && $excerpt ) : ?>
                    <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?></p>
                <?php endif; ?>
                <span class="nnt-card__link">
                    <?php esc_html_e( 'View Collection', 'nestnthrive' ); ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </span>
            </div>
        </a>
        <?php
        break;

    case 'list':
        // Horizontal list-style card for guides
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <?php if ( $thumbnail_id ) : ?>
                <div class="nnt-card__image-wrap">
                    <?php echo wp_get_attachment_image( $thumbnail_id, 'thumbnail', false, array( 'loading' => 'lazy', 'class' => 'nnt-card__img' ) ); ?>
                </div>
            <?php endif; ?>
            <div class="nnt-card__content">
                <?php if ( $kicker ) : ?>
                    <span class="nnt-card__kicker"><?php echo esc_html( $kicker ); ?></span>
                <?php endif; ?>
                <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
                <?php if ( $show_excerpt && $excerpt ) : ?>
                    <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 15 ) ); ?></p>
                <?php endif; ?>
            </div>
        </a>
        <?php
        break;

    case 'text-only':
        // Text-only list item for guide lists
        ?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <h3 class="nnt-card__title"><?php echo esc_html( $title ); ?></h3>
            <?php if ( $show_excerpt && $excerpt ) : ?>
                <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 18 ) ); ?></p>
            <?php endif; ?>
            <?php if ( $kicker ) : ?>
                <span class="nnt-card__kicker"><?php echo esc_html( $kicker ); ?></span>
            <?php endif; ?>
        </a>
        <?php
        break;

    default:
        // Default card style (guide/collection)
        ?>
        <article class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
            <?php if ( $thumbnail_id ) : ?>
                <a href="<?php echo esc_url( $permalink ); ?>" class="nnt-card__image-link">
                    <div class="nnt-card__image-wrap">
                        <?php echo wp_get_attachment_image( $thumbnail_id, $image_size, false, array( 'loading' => 'lazy', 'class' => 'nnt-card__img' ) ); ?>
                    </div>
                </a>
            <?php endif; ?>

            <div class="nnt-card__content">
                <?php if ( $show_meta && ! $is_term ) : ?>
                    <div class="nnt-card__meta">
                        <?php if ( $kicker ) : ?>
                            <span class="nnt-card__kicker"><?php echo esc_html( $kicker ); ?></span>
                        <?php endif; ?>
                        <?php if ( in_array( $card_type, array( 'nnt_guide', 'guide' ), true ) ) : ?>
                            <span class="nnt-card__reading-time"><?php echo esc_html( nnt_get_reading_time( $post->ID ) ); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <h3 class="nnt-card__title">
                    <a href="<?php echo esc_url( $permalink ); ?>">
                        <?php echo esc_html( $title ); ?>
                    </a>
                </h3>

                <?php if ( $show_excerpt && $excerpt ) : ?>
                    <p class="nnt-card__excerpt"><?php echo esc_html( wp_trim_words( $excerpt, 20 ) ); ?></p>
                <?php endif; ?>

                <span class="nnt-card__link">
                    <?php esc_html_e( 'Read Guide', 'nestnthrive' ); ?>
                </span>
            </div>
        </article>
        <?php
        break;
endswitch;
