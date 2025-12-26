<?php
/**
 * Register Room Custom Post Type.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the nnt_room custom post type.
 */
function nnt_register_room_cpt() {
    $labels = array(
        'name'                  => _x( 'Rooms', 'Post type general name', 'nnt-core' ),
        'singular_name'         => _x( 'Room', 'Post type singular name', 'nnt-core' ),
        'menu_name'             => _x( 'Rooms', 'Admin Menu text', 'nnt-core' ),
        'name_admin_bar'        => _x( 'Room', 'Add New on Toolbar', 'nnt-core' ),
        'add_new'               => __( 'Add New', 'nnt-core' ),
        'add_new_item'          => __( 'Add New Room', 'nnt-core' ),
        'new_item'              => __( 'New Room', 'nnt-core' ),
        'edit_item'             => __( 'Edit Room', 'nnt-core' ),
        'view_item'             => __( 'View Room', 'nnt-core' ),
        'all_items'             => __( 'All Rooms', 'nnt-core' ),
        'search_items'          => __( 'Search Rooms', 'nnt-core' ),
        'parent_item_colon'     => __( 'Parent Rooms:', 'nnt-core' ),
        'not_found'             => __( 'No rooms found.', 'nnt-core' ),
        'not_found_in_trash'    => __( 'No rooms found in Trash.', 'nnt-core' ),
        'featured_image'        => _x( 'Room Cover Image', 'Overrides the "Featured Image" phrase', 'nnt-core' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'nnt-core' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'nnt-core' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'nnt-core' ),
        'archives'              => _x( 'Room archives', 'The post type archive label', 'nnt-core' ),
        'insert_into_item'      => _x( 'Insert into room', 'Overrides the "Insert into post" phrase', 'nnt-core' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this room', 'Overrides the "Uploaded to this post" phrase', 'nnt-core' ),
        'filter_items_list'     => _x( 'Filter rooms list', 'Screen reader text', 'nnt-core' ),
        'items_list_navigation' => _x( 'Rooms list navigation', 'Screen reader text', 'nnt-core' ),
        'items_list'            => _x( 'Rooms list', 'Screen reader text', 'nnt-core' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'room', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-home',
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'nnt_room', $args );
}
add_action( 'init', 'nnt_register_room_cpt' );

