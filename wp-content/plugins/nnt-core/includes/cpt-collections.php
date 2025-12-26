<?php
/**
 * Register Collection Custom Post Type.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register the nnt_collection custom post type.
 */
function nnt_register_collection_cpt() {
    $labels = array(
        'name'                  => _x( 'Collections', 'Post type general name', 'nnt-core' ),
        'singular_name'         => _x( 'Collection', 'Post type singular name', 'nnt-core' ),
        'menu_name'             => _x( 'Collections', 'Admin Menu text', 'nnt-core' ),
        'name_admin_bar'        => _x( 'Collection', 'Add New on Toolbar', 'nnt-core' ),
        'add_new'               => __( 'Add New', 'nnt-core' ),
        'add_new_item'          => __( 'Add New Collection', 'nnt-core' ),
        'new_item'              => __( 'New Collection', 'nnt-core' ),
        'edit_item'             => __( 'Edit Collection', 'nnt-core' ),
        'view_item'             => __( 'View Collection', 'nnt-core' ),
        'all_items'             => __( 'All Collections', 'nnt-core' ),
        'search_items'          => __( 'Search Collections', 'nnt-core' ),
        'parent_item_colon'     => __( 'Parent Collections:', 'nnt-core' ),
        'not_found'             => __( 'No collections found.', 'nnt-core' ),
        'not_found_in_trash'    => __( 'No collections found in Trash.', 'nnt-core' ),
        'featured_image'        => _x( 'Collection Cover Image', 'Overrides the "Featured Image" phrase', 'nnt-core' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'nnt-core' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'nnt-core' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'nnt-core' ),
        'archives'              => _x( 'Collection archives', 'The post type archive label', 'nnt-core' ),
        'insert_into_item'      => _x( 'Insert into collection', 'Overrides the "Insert into post" phrase', 'nnt-core' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this collection', 'Overrides the "Uploaded to this post" phrase', 'nnt-core' ),
        'filter_items_list'     => _x( 'Filter collections list', 'Screen reader text', 'nnt-core' ),
        'items_list_navigation' => _x( 'Collections list navigation', 'Screen reader text', 'nnt-core' ),
        'items_list'            => _x( 'Collections list', 'Screen reader text', 'nnt-core' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'collections', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
        'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'nnt_collection', $args );
}
add_action( 'init', 'nnt_register_collection_cpt' );

