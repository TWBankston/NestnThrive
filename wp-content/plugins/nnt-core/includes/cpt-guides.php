<?php
/**
 * Register Guide Custom Post Type.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the nnt_guide custom post type.
 */
function nnt_register_guide_cpt() {
    $labels = array(
        'name'                  => _x( 'Guides', 'Post type general name', 'nnt-core' ),
        'singular_name'         => _x( 'Guide', 'Post type singular name', 'nnt-core' ),
        'menu_name'             => _x( 'Guides', 'Admin Menu text', 'nnt-core' ),
        'name_admin_bar'        => _x( 'Guide', 'Add New on Toolbar', 'nnt-core' ),
        'add_new'               => __( 'Add New', 'nnt-core' ),
        'add_new_item'          => __( 'Add New Guide', 'nnt-core' ),
        'new_item'              => __( 'New Guide', 'nnt-core' ),
        'edit_item'             => __( 'Edit Guide', 'nnt-core' ),
        'view_item'             => __( 'View Guide', 'nnt-core' ),
        'all_items'             => __( 'All Guides', 'nnt-core' ),
        'search_items'          => __( 'Search Guides', 'nnt-core' ),
        'parent_item_colon'     => __( 'Parent Guides:', 'nnt-core' ),
        'not_found'             => __( 'No guides found.', 'nnt-core' ),
        'not_found_in_trash'    => __( 'No guides found in Trash.', 'nnt-core' ),
        'featured_image'        => _x( 'Guide Cover Image', 'Overrides the "Featured Image" phrase', 'nnt-core' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'nnt-core' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'nnt-core' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'nnt-core' ),
        'archives'              => _x( 'Guide archives', 'The post type archive label', 'nnt-core' ),
        'insert_into_item'      => _x( 'Insert into guide', 'Overrides the "Insert into post" phrase', 'nnt-core' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this guide', 'Overrides the "Uploaded to this post" phrase', 'nnt-core' ),
        'filter_items_list'     => _x( 'Filter guides list', 'Screen reader text', 'nnt-core' ),
        'items_list_navigation' => _x( 'Guides list navigation', 'Screen reader text', 'nnt-core' ),
        'items_list'            => _x( 'Guides list', 'Screen reader text', 'nnt-core' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'guides', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-book-alt',
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'nnt_guide', $args );
}
add_action( 'init', 'nnt_register_guide_cpt' );

