<?php
/**
 * Collection Card Component
 *
 * Displays a collection post as a card.
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     @type WP_Post $item       Post object.
 *     @type string  $style      Card style: 'default', 'featured', 'list'.
 *     @type bool    $show_meta  Whether to show meta info.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item      = $args['item'] ?? $args['post'] ?? null;
$style     = $args['style'] ?? 'featured';
$show_meta = $args['show_meta'] ?? true;

if ( ! $item ) {
    return;
}

// Delegate to main card component with collection-specific settings.
get_template_part( 'template-parts/components/card', null, array(
    'item'         => $item,
    'type'         => 'nnt_collection',
    'style'        => $style,
    'show_meta'    => $show_meta,
    'show_excerpt' => true,
    'image_size'   => 'nnt-card-large',
) );

