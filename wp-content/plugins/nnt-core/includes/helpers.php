<?php
/**
 * Helper functions for NNT Core.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get posts by IDs preserving order.
 *
 * @param array  $post_ids   Array of post IDs.
 * @param string $post_type  Post type to query.
 * @param int    $limit      Maximum number of posts to return.
 * @return WP_Post[]
 */
function nnt_get_posts_by_ids( array $post_ids, string $post_type = 'any', int $limit = -1 ): array {
    if ( empty( $post_ids ) ) {
        return array();
    }

    $post_ids = array_map( 'absint', $post_ids );
    $post_ids = array_filter( $post_ids );

    if ( empty( $post_ids ) ) {
        return array();
    }

    $args = array(
        'post_type'      => $post_type,
        'post__in'       => $post_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    );

    return get_posts( $args );
}

/**
 * Get terms by IDs preserving order.
 *
 * @param array  $term_ids  Array of term IDs.
 * @param string $taxonomy  Taxonomy name.
 * @return WP_Term[]
 */
function nnt_get_terms_by_ids( array $term_ids, string $taxonomy ): array {
    if ( empty( $term_ids ) ) {
        return array();
    }

    $term_ids = array_map( 'absint', $term_ids );
    $term_ids = array_filter( $term_ids );

    if ( empty( $term_ids ) ) {
        return array();
    }

    $terms = get_terms(
        array(
            'taxonomy'   => $taxonomy,
            'include'    => $term_ids,
            'orderby'    => 'include',
            'hide_empty' => false,
        )
    );

    return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Get effective updated date (override or modified date).
 *
 * @param int    $post_id       Post ID.
 * @param string $meta_key      Meta key for override date.
 * @param string $format        Date format.
 * @return string
 */
function nnt_get_effective_date( int $post_id, string $meta_key = 'nnt_updated_date_override', string $format = 'F j, Y' ): string {
    $override = get_post_meta( $post_id, $meta_key, true );
    
    if ( ! empty( $override ) ) {
        $date = strtotime( $override );
        if ( $date ) {
            return date_i18n( $format, $date );
        }
    }
    
    return get_the_modified_date( $format, $post_id );
}

/**
 * Get related posts by shared taxonomy terms.
 *
 * @param int      $post_id       Current post ID.
 * @param string   $post_type     Post type to query.
 * @param string[] $taxonomies    Taxonomies to check for shared terms.
 * @param int      $limit         Maximum posts to return.
 * @return WP_Post[]
 */
function nnt_get_related_posts( int $post_id, string $post_type, array $taxonomies, int $limit = 4 ): array {
    $tax_query = array( 'relation' => 'OR' );
    
    foreach ( $taxonomies as $taxonomy ) {
        $terms = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
        
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
            $tax_query[] = array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $terms,
            );
        }
    }
    
    // If no terms found, return empty.
    if ( count( $tax_query ) <= 1 ) {
        return array();
    }
    
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'post__not_in'   => array( $post_id ),
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
    );
    
    return get_posts( $args );
}

/**
 * Get posts by taxonomy term.
 *
 * @param string $taxonomy   Taxonomy name.
 * @param int    $term_id    Term ID.
 * @param string $post_type  Post type to query.
 * @param int    $limit      Maximum posts to return.
 * @param array  $exclude    Post IDs to exclude.
 * @return WP_Post[]
 */
function nnt_get_posts_by_term( string $taxonomy, int $term_id, string $post_type, int $limit = -1, array $exclude = array() ): array {
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => $taxonomy,
                'field'    => 'term_id',
                'terms'    => $term_id,
            ),
        ),
    );
    
    if ( ! empty( $exclude ) ) {
        $args['post__not_in'] = array_map( 'absint', $exclude );
    }
    
    return get_posts( $args );
}

/**
 * Sanitize array of integers.
 *
 * @param mixed $value Value to sanitize.
 * @return array
 */
function nnt_sanitize_int_array( $value ): array {
    if ( is_string( $value ) ) {
        $value = json_decode( $value, true );
    }
    
    if ( ! is_array( $value ) ) {
        return array();
    }
    
    return array_values( array_filter( array_map( 'absint', $value ) ) );
}

/**
 * Sanitize boolean value.
 *
 * @param mixed $value Value to sanitize.
 * @return bool
 */
function nnt_sanitize_boolean( $value ): bool {
    return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
}

/**
 * Check if current user can edit posts.
 *
 * @return bool
 */
function nnt_user_can_edit(): bool {
    return current_user_can( 'edit_posts' );
}

/**
 * Get reading time estimate.
 *
 * @param int $post_id Post ID.
 * @return string
 */
if ( ! function_exists( 'nnt_get_reading_time' ) ) {
    function nnt_get_reading_time( int $post_id ): string {
        $manual_time = get_post_meta( $post_id, 'nnt_reading_time', true );
        
        if ( ! empty( $manual_time ) ) {
            return $manual_time;
        }
        
        $content    = get_post_field( 'post_content', $post_id );
        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $minutes    = max( 1, ceil( $word_count / 200 ) );
        
        return sprintf( '%d min read', $minutes );
    }
}

/**
 * Get all room terms (from nnt_room_tax).
 *
 * @param bool $hide_empty Whether to hide terms with no posts.
 * @return WP_Term[]
 */
function nnt_get_all_room_terms( bool $hide_empty = true ): array {
    $terms = get_terms(
        array(
            'taxonomy'   => 'nnt_room_tax',
            'hide_empty' => $hide_empty,
        )
    );
    
    return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Get all goal terms (from nnt_goal_tax).
 *
 * @param bool $hide_empty Whether to hide terms with no posts.
 * @return WP_Term[]
 */
function nnt_get_all_goal_terms( bool $hide_empty = true ): array {
    $terms = get_terms(
        array(
            'taxonomy'   => 'nnt_goal_tax',
            'hide_empty' => $hide_empty,
        )
    );
    
    return is_wp_error( $terms ) ? array() : $terms;
}

