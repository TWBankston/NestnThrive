<?php
/**
 * Room Card Component
 *
 * Displays a room post or room taxonomy term as a card.
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     @type WP_Post|WP_Term $item  Post or Term object.
 *     @type string          $style Card style: 'overlay', 'minimal', 'default'.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item  = $args['item'] ?? $args['post'] ?? null;
$style = $args['style'] ?? 'overlay';

if ( ! $item ) {
    return;
}

// Delegate to main card component with room-specific settings.
get_template_part( 'template-parts/components/card', null, array(
    'item'         => $item,
    'type'         => 'nnt_room',
    'style'        => $style,
    'show_excerpt' => true,
    'image_size'   => 'nnt-card-large',
) );

