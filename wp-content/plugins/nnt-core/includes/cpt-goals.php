<?php
/**
 * Register Goal Custom Post Type.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the nnt_goal custom post type.
 */
function nnt_register_goal_cpt() {
    $labels = array(
        'name'                  => _x( 'Goals', 'Post type general name', 'nnt-core' ),
        'singular_name'         => _x( 'Goal', 'Post type singular name', 'nnt-core' ),
        'menu_name'             => _x( 'Goals', 'Admin Menu text', 'nnt-core' ),
        'name_admin_bar'        => _x( 'Goal', 'Add New on Toolbar', 'nnt-core' ),
        'add_new'               => __( 'Add New', 'nnt-core' ),
        'add_new_item'          => __( 'Add New Goal', 'nnt-core' ),
        'new_item'              => __( 'New Goal', 'nnt-core' ),
        'edit_item'             => __( 'Edit Goal', 'nnt-core' ),
        'view_item'             => __( 'View Goal', 'nnt-core' ),
        'all_items'             => __( 'All Goals', 'nnt-core' ),
        'search_items'          => __( 'Search Goals', 'nnt-core' ),
        'parent_item_colon'     => __( 'Parent Goals:', 'nnt-core' ),
        'not_found'             => __( 'No goals found.', 'nnt-core' ),
        'not_found_in_trash'    => __( 'No goals found in Trash.', 'nnt-core' ),
        'featured_image'        => _x( 'Goal Cover Image', 'Overrides the "Featured Image" phrase', 'nnt-core' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'nnt-core' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'nnt-core' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'nnt-core' ),
        'archives'              => _x( 'Goal archives', 'The post type archive label', 'nnt-core' ),
        'insert_into_item'      => _x( 'Insert into goal', 'Overrides the "Insert into post" phrase', 'nnt-core' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this goal', 'Overrides the "Uploaded to this post" phrase', 'nnt-core' ),
        'filter_items_list'     => _x( 'Filter goals list', 'Screen reader text', 'nnt-core' ),
        'items_list_navigation' => _x( 'Goals list navigation', 'Screen reader text', 'nnt-core' ),
        'items_list'            => _x( 'Goals list', 'Screen reader text', 'nnt-core' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'goal', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-flag',
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'nnt_goal', $args );
}
add_action( 'init', 'nnt_register_goal_cpt' );

