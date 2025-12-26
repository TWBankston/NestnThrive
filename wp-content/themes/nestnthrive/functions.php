<?php
/**
 * Nest N Thrive functions and definitions - V2 Aura
 *
 * @package NestNThrive
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'NNT_THEME_VERSION', '2.0.0' );

/**
 * Theme setup.
 */
function nestnthrive_setup() {
    // Add theme support.
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    // Custom image sizes.
    add_image_size( 'nnt-hero', 1200, 800, true );
    add_image_size( 'nnt-featured', 800, 600, true );
    add_image_size( 'nnt-card', 600, 400, true );

    // Register nav menus.
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nestnthrive' ),
        'footer'  => __( 'Footer Menu', 'nestnthrive' ),
    ) );
}
add_action( 'after_setup_theme', 'nestnthrive_setup' );

/**
 * Enqueue scripts and styles.
 */
function nestnthrive_scripts() {
    // Google Fonts - DM Sans.
    wp_enqueue_style( 
        'nestnthrive-fonts', 
        'https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap',
        array(), 
        null 
    );

    // Main stylesheet.
    wp_enqueue_style( 'nestnthrive-style', get_stylesheet_uri(), array( 'nestnthrive-fonts' ), NNT_THEME_VERSION );

    // V2 Aura styles.
    wp_enqueue_style( 'nestnthrive-v2-aura', get_template_directory_uri() . '/assets/css/v2-aura.css', array( 'nestnthrive-style' ), NNT_THEME_VERSION );

    // Lucide icons.
    wp_enqueue_script( 'lucide', 'https://unpkg.com/lucide@latest', array(), null, true );

    // Main JS.
    wp_enqueue_script( 'nestnthrive-main', get_template_directory_uri() . '/assets/js/main.js', array( 'lucide' ), NNT_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'nestnthrive_scripts' );

/**
 * ============================================================
 * HELPER FUNCTIONS
 * ============================================================
 */

/**
 * Get all rooms.
 *
 * @param int $limit Number of rooms to return.
 * @return array Array of WP_Post objects.
 */
function nnt_get_all_rooms( $limit = -1 ) {
    return get_posts( array(
        'post_type'      => 'nnt_room',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get other rooms excluding current.
 *
 * @param int $exclude_id Post ID to exclude.
 * @param int $limit      Number to return.
 * @return array
 */
function nnt_get_other_rooms( $exclude_id, $limit = 4 ) {
    return get_posts( array(
        'post_type'      => 'nnt_room',
        'posts_per_page' => $limit,
        'exclude'        => array( $exclude_id ),
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get all goals.
 *
 * @param int $limit Number of goals to return.
 * @return array
 */
function nnt_get_all_goals( $limit = -1 ) {
    return get_posts( array(
        'post_type'      => 'nnt_goal',
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get other goals excluding current.
 *
 * @param int $exclude_id Post ID to exclude.
 * @param int $limit      Number to return.
 * @return array
 */
function nnt_get_other_goals( $exclude_id, $limit = 4 ) {
    return get_posts( array(
        'post_type'      => 'nnt_goal',
        'posts_per_page' => $limit,
        'exclude'        => array( $exclude_id ),
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get latest collections.
 *
 * @param int $limit Number to return.
 * @return array
 */
function nnt_get_latest_collections( $limit = 6 ) {
    return get_posts( array(
        'post_type'      => 'nnt_collection',
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get latest guides.
 *
 * @param int $limit Number to return.
 * @return array
 */
function nnt_get_latest_guides( $limit = 6 ) {
    return get_posts( array(
        'post_type'      => 'nnt_guide',
        'posts_per_page' => $limit,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ) );
}

/**
 * Get guides for a room.
 *
 * @param WP_Post $room  The room post.
 * @param int     $limit Number to return.
 * @return array
 */
function nnt_get_guides_for_room( $room, $limit = 4 ) {
    // First try to find guides that have this room's term assigned.
    $room_term = get_term_by( 'slug', $room->post_name, 'nnt_room_tax' );
    
    if ( $room_term ) {
        $guides = get_posts( array(
            'post_type'      => 'nnt_guide',
            'posts_per_page' => $limit,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'nnt_room_tax',
                    'field'    => 'term_id',
                    'terms'    => $room_term->term_id,
                ),
            ),
            'post_status'    => 'publish',
        ) );
        
        if ( ! empty( $guides ) ) {
            return $guides;
        }
    }
    
    // Fallback to latest guides.
    return nnt_get_latest_guides( $limit );
}

/**
 * Get guides for a goal.
 *
 * @param WP_Post $goal  The goal post.
 * @param int     $limit Number to return.
 * @return array
 */
function nnt_get_guides_for_goal( $goal, $limit = 4 ) {
    $goal_term = get_term_by( 'slug', $goal->post_name, 'nnt_goal_tax' );
    
    if ( $goal_term ) {
        $guides = get_posts( array(
            'post_type'      => 'nnt_guide',
            'posts_per_page' => $limit,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'nnt_goal_tax',
                    'field'    => 'term_id',
                    'terms'    => $goal_term->term_id,
                ),
            ),
            'post_status'    => 'publish',
        ) );
        
        if ( ! empty( $guides ) ) {
            return $guides;
        }
    }
    
    return nnt_get_latest_guides( $limit );
}

/**
 * Get featured items from post meta.
 *
 * @param int    $post_id   The post ID.
 * @param string $meta_key  The meta key storing IDs.
 * @param string $post_type The post type to fetch.
 * @return array
 */
function nnt_get_featured_items( $post_id, $meta_key, $post_type ) {
    $ids = get_post_meta( $post_id, $meta_key, true );
    
    if ( empty( $ids ) || ! is_array( $ids ) ) {
        // Return latest of this post type as fallback.
        return get_posts( array(
            'post_type'      => $post_type,
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ) );
    }
    
    return get_posts( array(
        'post_type'      => $post_type,
        'post__in'       => $ids,
        'orderby'        => 'post__in',
        'posts_per_page' => count( $ids ),
        'post_status'    => 'publish',
    ) );
}

/**
 * Get featured terms from post meta.
 *
 * @param int    $post_id  The post ID.
 * @param string $meta_key The meta key storing term IDs.
 * @param string $taxonomy The taxonomy.
 * @return array
 */
function nnt_get_featured_terms( $post_id, $meta_key, $taxonomy ) {
    $term_ids = get_post_meta( $post_id, $meta_key, true );
    
    if ( empty( $term_ids ) || ! is_array( $term_ids ) ) {
        // Return all terms as fallback.
        $terms = get_terms( array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'number'     => 4,
        ) );
        return is_wp_error( $terms ) ? array() : $terms;
    }
    
    return get_terms( array(
        'taxonomy'   => $taxonomy,
        'include'    => $term_ids,
        'hide_empty' => false,
    ) );
}

/**
 * Get related content based on shared taxonomies.
 *
 * @param int $post_id The post ID.
 * @param int $limit   Number to return.
 * @return array
 */
function nnt_get_related_content( $post_id, $limit = 4 ) {
    $post_type = get_post_type( $post_id );
    $tax_query = array( 'relation' => 'OR' );
    
    // Get room terms.
    $room_terms = wp_get_post_terms( $post_id, 'nnt_room_tax', array( 'fields' => 'ids' ) );
    if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) {
        $tax_query[] = array(
            'taxonomy' => 'nnt_room_tax',
            'field'    => 'term_id',
            'terms'    => $room_terms,
        );
    }
    
    // Get goal terms.
    $goal_terms = wp_get_post_terms( $post_id, 'nnt_goal_tax', array( 'fields' => 'ids' ) );
    if ( ! is_wp_error( $goal_terms ) && ! empty( $goal_terms ) ) {
        $tax_query[] = array(
            'taxonomy' => 'nnt_goal_tax',
            'field'    => 'term_id',
            'terms'    => $goal_terms,
        );
    }
    
    // If no taxonomy queries, return empty.
    if ( count( $tax_query ) <= 1 ) {
        return array();
    }
    
    return get_posts( array(
        'post_type'      => array( 'nnt_guide', 'nnt_collection' ),
        'posts_per_page' => $limit,
        'exclude'        => array( $post_id ),
        'tax_query'      => $tax_query,
        'orderby'        => 'rand',
        'post_status'    => 'publish',
    ) );
}

/**
 * Calculate reading time.
 *
 * @param string $content The content.
 * @return string
 */
if ( ! function_exists( 'nnt_get_reading_time' ) ) {
    function nnt_get_reading_time( $content ) {
        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $minutes    = max( 1, ceil( $word_count / 200 ) );
        return sprintf( _n( '%d min read', '%d min read', $minutes, 'nestnthrive' ), $minutes );
    }
}

/**
 * Add body classes.
 */
function nestnthrive_body_classes( $classes ) {
    $classes[] = 'nnt-v2';
    
    if ( is_front_page() ) {
        $classes[] = 'nnt-front-page';
    }
    
    return $classes;
}
add_filter( 'body_class', 'nestnthrive_body_classes' );
