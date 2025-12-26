<?php
/**
 * Register custom taxonomies.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom taxonomies.
 */
function nnt_register_taxonomies() {
    // Room Taxonomy - hierarchical (like categories).
    $room_labels = array(
        'name'                       => _x( 'Room Tags', 'taxonomy general name', 'nnt-core' ),
        'singular_name'              => _x( 'Room Tag', 'taxonomy singular name', 'nnt-core' ),
        'search_items'               => __( 'Search Room Tags', 'nnt-core' ),
        'popular_items'              => __( 'Popular Room Tags', 'nnt-core' ),
        'all_items'                  => __( 'All Room Tags', 'nnt-core' ),
        'parent_item'                => __( 'Parent Room Tag', 'nnt-core' ),
        'parent_item_colon'          => __( 'Parent Room Tag:', 'nnt-core' ),
        'edit_item'                  => __( 'Edit Room Tag', 'nnt-core' ),
        'update_item'                => __( 'Update Room Tag', 'nnt-core' ),
        'add_new_item'               => __( 'Add New Room Tag', 'nnt-core' ),
        'new_item_name'              => __( 'New Room Tag Name', 'nnt-core' ),
        'separate_items_with_commas' => __( 'Separate room tags with commas', 'nnt-core' ),
        'add_or_remove_items'        => __( 'Add or remove room tags', 'nnt-core' ),
        'choose_from_most_used'      => __( 'Choose from the most used room tags', 'nnt-core' ),
        'not_found'                  => __( 'No room tags found.', 'nnt-core' ),
        'menu_name'                  => __( 'Room Tags', 'nnt-core' ),
        'back_to_items'              => __( '← Back to Room Tags', 'nnt-core' ),
    );

    $room_args = array(
        'labels'            => $room_labels,
        'public'            => true,
        'publicly_queryable'=> true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'show_tagcloud'     => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'room-tag', 'with_front' => false ),
        'query_var'         => true,
    );

    // Attach to guides and collections.
    register_taxonomy( 'nnt_room_tax', array( 'nnt_guide', 'nnt_collection' ), $room_args );

    // Goal Taxonomy - non-hierarchical (like tags).
    $goal_labels = array(
        'name'                       => _x( 'Goal Tags', 'taxonomy general name', 'nnt-core' ),
        'singular_name'              => _x( 'Goal Tag', 'taxonomy singular name', 'nnt-core' ),
        'search_items'               => __( 'Search Goal Tags', 'nnt-core' ),
        'popular_items'              => __( 'Popular Goal Tags', 'nnt-core' ),
        'all_items'                  => __( 'All Goal Tags', 'nnt-core' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Goal Tag', 'nnt-core' ),
        'update_item'                => __( 'Update Goal Tag', 'nnt-core' ),
        'add_new_item'               => __( 'Add New Goal Tag', 'nnt-core' ),
        'new_item_name'              => __( 'New Goal Tag Name', 'nnt-core' ),
        'separate_items_with_commas' => __( 'Separate goal tags with commas', 'nnt-core' ),
        'add_or_remove_items'        => __( 'Add or remove goal tags', 'nnt-core' ),
        'choose_from_most_used'      => __( 'Choose from the most used goal tags', 'nnt-core' ),
        'not_found'                  => __( 'No goal tags found.', 'nnt-core' ),
        'menu_name'                  => __( 'Goal Tags', 'nnt-core' ),
        'back_to_items'              => __( '← Back to Goal Tags', 'nnt-core' ),
    );

    $goal_args = array(
        'labels'            => $goal_labels,
        'public'            => true,
        'publicly_queryable'=> true,
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'show_tagcloud'     => true,
        'show_admin_column' => true,
        'rewrite'           => array( 'slug' => 'goal-tag', 'with_front' => false ),
        'query_var'         => true,
    );

    // Attach to guides and collections.
    register_taxonomy( 'nnt_goal_tax', array( 'nnt_guide', 'nnt_collection' ), $goal_args );
}
add_action( 'init', 'nnt_register_taxonomies' );

