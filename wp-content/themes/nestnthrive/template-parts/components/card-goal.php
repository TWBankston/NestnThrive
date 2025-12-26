<?php
/**
 * Goal Card Component
 *
 * Displays a goal post or goal taxonomy term as a card.
 *
 * @package NestNThrive
 *
 * @var array $args {
 *     @type WP_Post|WP_Term $item  Post or Term object.
 *     @type string          $style Card style: 'goal-tile', 'overlay', 'minimal', 'default'.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$item  = $args['item'] ?? $args['post'] ?? null;
$style = $args['style'] ?? 'goal-tile';

if ( ! $item ) {
    return;
}

// Delegate to main card component with goal-specific settings.
get_template_part( 'template-parts/components/card', null, array(
    'item'         => $item,
    'type'         => 'nnt_goal',
    'style'        => $style,
    'show_excerpt' => true,
    'image_size'   => 'nnt-card',
) );

