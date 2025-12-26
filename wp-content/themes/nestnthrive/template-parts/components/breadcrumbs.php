<?php
/**
 * Breadcrumbs Component Template Part
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     Breadcrumbs arguments.
 *
 *     @type array  $items      Array of breadcrumb items (optional, auto-generated if not provided).
 *     @type string $separator  Separator between items.
 * }
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get arguments.
$custom_items = $args['items'] ?? null;
$separator    = $args['separator'] ?? '›';

// Build breadcrumb items.
$items = array();

// Always start with home.
$items[] = array(
    'label' => __( 'Home', 'nestnthrive' ),
    'url'   => home_url( '/' ),
);

// Use custom items if provided.
if ( $custom_items && is_array( $custom_items ) ) {
    $items = array_merge( $items, $custom_items );
} else {
    // Auto-generate based on current page.
    if ( is_singular() ) {
        $post_type = get_post_type();
        $post_type_obj = get_post_type_object( $post_type );
        
        // Add post type archive if it exists.
        if ( $post_type_obj && $post_type_obj->has_archive ) {
            $items[] = array(
                'label' => $post_type_obj->labels->name,
                'url'   => get_post_type_archive_link( $post_type ),
            );
        }
        
        // Add taxonomy terms if applicable.
        if ( in_array( $post_type, array( 'nnt_guide', 'nnt_collection' ), true ) ) {
            // Check for room taxonomy.
            $room_terms = get_the_terms( get_the_ID(), 'nnt_room_tax' );
            if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) {
                $term = $room_terms[0];
                $items[] = array(
                    'label' => $term->name,
                    'url'   => get_term_link( $term ),
                );
            }
        }
        
        // Add current page.
        $items[] = array(
            'label' => get_the_title(),
            'url'   => null, // Current page, no link.
        );
    } elseif ( is_post_type_archive() ) {
        $post_type_obj = get_queried_object();
        if ( $post_type_obj ) {
            $items[] = array(
                'label' => $post_type_obj->labels->name,
                'url'   => null,
            );
        }
    } elseif ( is_tax() ) {
        $term = get_queried_object();
        if ( $term ) {
            $items[] = array(
                'label' => $term->name,
                'url'   => null,
            );
        }
    } elseif ( is_page() ) {
        // Build page ancestry.
        $ancestors = get_post_ancestors( get_the_ID() );
        $ancestors = array_reverse( $ancestors );
        
        foreach ( $ancestors as $ancestor_id ) {
            $items[] = array(
                'label' => get_the_title( $ancestor_id ),
                'url'   => get_permalink( $ancestor_id ),
            );
        }
        
        // Add current page.
        $items[] = array(
            'label' => get_the_title(),
            'url'   => null,
        );
    }
}

// Don't render if only home.
if ( count( $items ) <= 1 ) {
    return;
}
?>
<nav class="nnt-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'nestnthrive' ); ?>">
    <ol class="nnt-breadcrumbs__list" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ( $items as $index => $item ) : ?>
            <li class="nnt-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <?php if ( $item['url'] ) : ?>
                    <a href="<?php echo esc_url( $item['url'] ); ?>" itemprop="item">
                        <span itemprop="name"><?php echo esc_html( $item['label'] ); ?></span>
                    </a>
                <?php else : ?>
                    <span itemprop="name" aria-current="page"><?php echo esc_html( $item['label'] ); ?></span>
                <?php endif; ?>
                <meta itemprop="position" content="<?php echo esc_attr( $index + 1 ); ?>">
                
                <?php if ( $index < count( $items ) - 1 ) : ?>
                    <span class="nnt-breadcrumbs__separator" aria-hidden="true"><?php echo esc_html( $separator ); ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>

<style>
/* Breadcrumbs Styles - Move to main stylesheet in production */
.nnt-breadcrumbs {
    margin-bottom: 1.5rem;
}

.nnt-breadcrumbs__list {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 0.875rem;
}

.nnt-breadcrumbs__item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nnt-breadcrumbs__item a {
    color: var(--wp--preset--color--warm-brown);
    text-decoration: none;
}

.nnt-breadcrumbs__item a:hover {
    color: var(--wp--preset--color--warm-gold);
}

.nnt-breadcrumbs__item span[aria-current="page"] {
    color: var(--wp--preset--color--charcoal);
}

.nnt-breadcrumbs__separator {
    color: var(--wp--preset--color--warm-brown);
    opacity: 0.5;
}
</style>

