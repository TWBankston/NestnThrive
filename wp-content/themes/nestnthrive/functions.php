<?php
/**
 * Nest N Thrive Theme Functions
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Theme constants.
 */
define( 'NNT_THEME_VERSION', '1.0.3' );
define( 'NNT_THEME_DIR', get_template_directory() );
define( 'NNT_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function nnt_theme_setup() {
    // Add theme support.
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
        'search-form',
    ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'align-wide' );
    
    // Custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register navigation menus.
    register_nav_menus( array(
        'primary'   => __( 'Primary Navigation', 'nestnthrive' ),
        'footer'    => __( 'Footer Navigation', 'nestnthrive' ),
    ) );

    // Add custom image sizes.
    add_image_size( 'nnt-card', 400, 300, true );
    add_image_size( 'nnt-hero', 1600, 800, true );
    add_image_size( 'nnt-featured', 800, 600, true );

    // Load text domain.
    load_theme_textdomain( 'nestnthrive', NNT_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'nnt_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function nnt_enqueue_assets() {
    // Main stylesheet.
    wp_enqueue_style(
        'nnt-style',
        get_stylesheet_uri(),
        array(),
        NNT_THEME_VERSION
    );

    // Main script (placeholder for future animations).
    wp_register_script(
        'nnt-main',
        NNT_THEME_URI . '/assets/js/main.js',
        array(),
        NNT_THEME_VERSION,
        true
    );

    // Only enqueue if the file exists.
    if ( file_exists( NNT_THEME_DIR . '/assets/js/main.js' ) ) {
        wp_enqueue_script( 'nnt-main' );
    }
}
add_action( 'wp_enqueue_scripts', 'nnt_enqueue_assets' );

/**
 * Enqueue editor styles.
 */
function nnt_enqueue_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'admin_init', 'nnt_enqueue_editor_styles' );

/**
 * Add custom image sizes to media library.
 *
 * @param array $sizes Existing image sizes.
 * @return array
 */
function nnt_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'nnt-card'     => __( 'Card Image', 'nestnthrive' ),
        'nnt-hero'     => __( 'Hero Image', 'nestnthrive' ),
        'nnt-featured' => __( 'Featured Image', 'nestnthrive' ),
    ) );
}
add_filter( 'image_size_names_choose', 'nnt_custom_image_sizes' );

// =============================================================================
// Helper Functions
// =============================================================================

/**
 * Get effective updated date (override or modified date).
 *
 * @param int    $post_id Post ID (defaults to current post).
 * @param string $format  Date format.
 * @return string
 */
function nnt_get_updated_date( $post_id = null, $format = 'F j, Y' ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }

    // Check for override.
    $override = get_post_meta( $post_id, 'nnt_updated_date_override', true );
    
    if ( ! empty( $override ) ) {
        $date = strtotime( $override );
        if ( $date ) {
            return date_i18n( $format, $date );
        }
    }
    
    return get_the_modified_date( $format, $post_id );
}

/**
 * Get posts by IDs preserving order.
 *
 * @param array  $post_ids  Array of post IDs.
 * @param string $post_type Post type to query.
 * @param int    $limit     Maximum posts to return.
 * @return WP_Post[]
 */
function nnt_get_ordered_posts( $post_ids, $post_type = 'any', $limit = -1 ) {
    if ( empty( $post_ids ) || ! is_array( $post_ids ) ) {
        return array();
    }

    $post_ids = array_map( 'absint', $post_ids );
    $post_ids = array_filter( $post_ids );

    if ( empty( $post_ids ) ) {
        return array();
    }

    return get_posts( array(
        'post_type'      => $post_type,
        'post__in'       => $post_ids,
        'orderby'        => 'post__in',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
    ) );
}

/**
 * Get related posts by shared taxonomy terms.
 *
 * @param int      $post_id    Current post ID.
 * @param string   $post_type  Post type to query.
 * @param string[] $taxonomies Taxonomies to check.
 * @param int      $limit      Maximum posts to return.
 * @return WP_Post[]
 */
function nnt_get_related_by_terms( $post_id, $post_type, $taxonomies, $limit = 4 ) {
    // First check for manual related content.
    $manual_ids = get_post_meta( $post_id, 'nnt_related_content_manual', true );
    
    if ( ! empty( $manual_ids ) && is_array( $manual_ids ) ) {
        return nnt_get_ordered_posts( $manual_ids, $post_type, $limit );
    }

    // Fall back to automatic related by terms.
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
    
    if ( count( $tax_query ) <= 1 ) {
        return array();
    }
    
    return get_posts( array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'post__not_in'   => array( $post_id ),
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
    ) );
}

/**
 * Get posts by taxonomy term.
 *
 * @param string $taxonomy  Taxonomy name.
 * @param int    $term_id   Term ID.
 * @param string $post_type Post type.
 * @param int    $limit     Maximum posts.
 * @param array  $exclude   Post IDs to exclude.
 * @return WP_Post[]
 */
function nnt_get_posts_for_term( $taxonomy, $term_id, $post_type, $limit = -1, $exclude = array() ) {
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
 * Get reading time for a post.
 *
 * @param int $post_id Post ID.
 * @return string
 */
if ( ! function_exists( 'nnt_get_reading_time' ) ) {
    function nnt_get_reading_time( $post_id = null ) {
        if ( ! $post_id ) {
            $post_id = get_the_ID();
        }

        // Check for manual reading time.
        $manual = get_post_meta( $post_id, 'nnt_reading_time', true );
        
        if ( ! empty( $manual ) ) {
            return $manual;
        }
        
        // Calculate from content.
        $content    = get_post_field( 'post_content', $post_id );
        $word_count = str_word_count( wp_strip_all_tags( $content ) );
        $minutes    = max( 1, ceil( $word_count / 200 ) );
        
        return sprintf( '%d min read', $minutes );
    }
}

/**
 * Render affiliate disclosure.
 *
 * @param string $style 'inline' or 'block'.
 */
function nnt_render_disclosure( $style = 'inline' ) {
    $class = 'nnt-disclosure nnt-disclosure--' . esc_attr( $style );
    ?>
    <p class="<?php echo esc_attr( $class ); ?>">
        <?php esc_html_e( 'As an Amazon Associate, we may earn from qualifying purchases.', 'nestnthrive' ); ?>
    </p>
    <?php
}

/**
 * Get all rooms (nnt_room posts).
 *
 * @param int $limit Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_all_rooms( $limit = -1 ) {
    return get_posts( array(
        'post_type'      => 'nnt_room',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ) );
}

/**
 * Get all goals (nnt_goal posts).
 *
 * @param int $limit Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_all_goals( $limit = -1 ) {
    return get_posts( array(
        'post_type'      => 'nnt_goal',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ) );
}

/**
 * Get featured items from post meta.
 *
 * @param int    $post_id   Post ID.
 * @param string $meta_key  Meta key for the featured IDs.
 * @param string $post_type Post type to query.
 * @return WP_Post[]
 */
function nnt_get_featured_items( $post_id, $meta_key, $post_type ) {
    $ids = get_post_meta( $post_id, $meta_key, true );
    
    if ( empty( $ids ) || ! is_array( $ids ) ) {
        return array();
    }
    
    return nnt_get_ordered_posts( $ids, $post_type );
}

/**
 * Get featured terms from post meta.
 *
 * @param int    $post_id  Post ID.
 * @param string $meta_key Meta key for the term IDs.
 * @param string $taxonomy Taxonomy to query.
 * @return WP_Term[]
 */
function nnt_get_featured_terms( $post_id, $meta_key, $taxonomy ) {
    $ids = get_post_meta( $post_id, $meta_key, true );
    
    if ( empty( $ids ) || ! is_array( $ids ) ) {
        return array();
    }
    
    $terms = get_terms( array(
        'taxonomy'   => $taxonomy,
        'include'    => array_map( 'absint', $ids ),
        'orderby'    => 'include',
        'hide_empty' => false,
    ) );
    
    return is_wp_error( $terms ) ? array() : $terms;
}

// =============================================================================
// Template Includes
// =============================================================================

/**
 * Include a template part with optional arguments.
 *
 * @param string $slug Template slug.
 * @param string $name Optional template name.
 * @param array  $args Arguments to pass to the template.
 */
function nnt_template_part( $slug, $name = null, $args = array() ) {
    get_template_part( $slug, $name, $args );
}

// =============================================================================
// Post-to-Term Mapping Functions
// =============================================================================

/**
 * Map a Room CPT post to its corresponding taxonomy term.
 * Matches by slug: nnt_room post_name to nnt_room_tax term slug.
 *
 * @param int|WP_Post $room_post Room post ID or object.
 * @return WP_Term|null
 */
function nnt_map_room_post_to_term( $room_post ) {
    $room_post = get_post( $room_post );
    
    if ( ! $room_post || $room_post->post_type !== 'nnt_room' ) {
        return null;
    }
    
    $term = get_term_by( 'slug', $room_post->post_name, 'nnt_room_tax' );
    
    return $term instanceof WP_Term ? $term : null;
}

/**
 * Map a Goal CPT post to its corresponding taxonomy term.
 * Matches by slug: nnt_goal post_name to nnt_goal_tax term slug.
 *
 * @param int|WP_Post $goal_post Goal post ID or object.
 * @return WP_Term|null
 */
function nnt_map_goal_post_to_term( $goal_post ) {
    $goal_post = get_post( $goal_post );
    
    if ( ! $goal_post || $goal_post->post_type !== 'nnt_goal' ) {
        return null;
    }
    
    $term = get_term_by( 'slug', $goal_post->post_name, 'nnt_goal_tax' );
    
    return $term instanceof WP_Term ? $term : null;
}

/**
 * Get guides for a specific room by matching the room post slug to the room taxonomy.
 *
 * @param int|WP_Post $room_post Room post ID or object.
 * @param int         $limit     Maximum posts to return.
 * @param array       $exclude   Post IDs to exclude.
 * @return WP_Post[]
 */
function nnt_get_guides_for_room( $room_post, $limit = -1, $exclude = array() ) {
    $term = nnt_map_room_post_to_term( $room_post );
    
    if ( ! $term ) {
        return array();
    }
    
    return nnt_get_posts_for_term( 'nnt_room_tax', $term->term_id, 'nnt_guide', $limit, $exclude );
}

/**
 * Get guides for a specific goal by matching the goal post slug to the goal taxonomy.
 *
 * @param int|WP_Post $goal_post Goal post ID or object.
 * @param int         $limit     Maximum posts to return.
 * @param array       $exclude   Post IDs to exclude.
 * @return WP_Post[]
 */
function nnt_get_guides_for_goal( $goal_post, $limit = -1, $exclude = array() ) {
    $term = nnt_map_goal_post_to_term( $goal_post );
    
    if ( ! $term ) {
        return array();
    }
    
    return nnt_get_posts_for_term( 'nnt_goal_tax', $term->term_id, 'nnt_guide', $limit, $exclude );
}

/**
 * Check if a room post has a matching taxonomy term (for admin warnings).
 *
 * @param int|WP_Post $room_post Room post ID or object.
 * @return bool
 */
function nnt_room_has_matching_term( $room_post ) {
    return nnt_map_room_post_to_term( $room_post ) !== null;
}

/**
 * Check if a goal post has a matching taxonomy term (for admin warnings).
 *
 * @param int|WP_Post $goal_post Goal post ID or object.
 * @return bool
 */
function nnt_goal_has_matching_term( $goal_post ) {
    return nnt_map_goal_post_to_term( $goal_post ) !== null;
}

/**
 * Get hero content for a hub post (room or goal).
 * Returns title, subtitle, and supporting line with fallbacks.
 *
 * @param int|WP_Post $post Post ID or object.
 * @return array
 */
function nnt_get_hero_content( $post ) {
    $post = get_post( $post );
    
    if ( ! $post ) {
        return array(
            'title'           => '',
            'subtitle'        => '',
            'supporting_line' => '',
        );
    }
    
    $title = get_post_meta( $post->ID, 'nnt_hero_title', true );
    if ( empty( $title ) ) {
        $title = get_the_title( $post );
    }
    
    $subtitle = get_post_meta( $post->ID, 'nnt_hero_subtitle', true );
    if ( empty( $subtitle ) ) {
        $subtitle = get_the_excerpt( $post );
    }
    
    $supporting_line = get_post_meta( $post->ID, 'nnt_hero_supporting_line', true );
    
    return array(
        'title'           => $title,
        'subtitle'        => $subtitle,
        'supporting_line' => $supporting_line,
    );
}

/**
 * Get other rooms (excluding current).
 *
 * @param int $exclude_id Post ID to exclude.
 * @param int $limit      Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_other_rooms( $exclude_id = 0, $limit = 4 ) {
    return get_posts( array(
        'post_type'      => 'nnt_room',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'post__not_in'   => $exclude_id ? array( $exclude_id ) : array(),
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ) );
}

/**
 * Get other goals (excluding current).
 *
 * @param int $exclude_id Post ID to exclude.
 * @param int $limit      Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_other_goals( $exclude_id = 0, $limit = 4 ) {
    return get_posts( array(
        'post_type'      => 'nnt_goal',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'post__not_in'   => $exclude_id ? array( $exclude_id ) : array(),
        'orderby'        => 'menu_order title',
        'order'          => 'ASC',
    ) );
}

/**
 * Get latest guides.
 *
 * @param int $limit Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_latest_guides( $limit = 6 ) {
    return get_posts( array(
        'post_type'      => 'nnt_guide',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}

/**
 * Get latest collections.
 *
 * @param int $limit Maximum posts.
 * @return WP_Post[]
 */
function nnt_get_latest_collections( $limit = 3 ) {
    return get_posts( array(
        'post_type'      => 'nnt_collection',
        'posts_per_page' => $limit,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
}

// =============================================================================
// Contact Form Handler
// =============================================================================

/**
 * Handle contact form submission.
 */
function nnt_handle_contact_form() {
    if ( ! isset( $_POST['nnt_contact_nonce'] ) || ! wp_verify_nonce( $_POST['nnt_contact_nonce'], 'nnt_contact_form' ) ) {
        return;
    }
    
    $name    = sanitize_text_field( $_POST['nnt_name'] ?? '' );
    $email   = sanitize_email( $_POST['nnt_email'] ?? '' );
    $message = sanitize_textarea_field( $_POST['nnt_message'] ?? '' );
    
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        set_transient( 'nnt_contact_error', __( 'Please fill in all required fields.', 'nestnthrive' ), 30 );
        return;
    }
    
    if ( ! is_email( $email ) ) {
        set_transient( 'nnt_contact_error', __( 'Please enter a valid email address.', 'nestnthrive' ), 30 );
        return;
    }
    
    $to      = get_option( 'admin_email' );
    $subject = sprintf( '[%s] Contact Form: %s', get_bloginfo( 'name' ), $name );
    $body    = sprintf(
        "Name: %s\nEmail: %s\n\nMessage:\n%s",
        $name,
        $email,
        $message
    );
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        sprintf( 'Reply-To: %s <%s>', $name, $email ),
    );
    
    $sent = wp_mail( $to, $subject, $body, $headers );
    
    if ( $sent ) {
        set_transient( 'nnt_contact_success', __( 'Thank you for your message. We\'ll get back to you soon.', 'nestnthrive' ), 30 );
    } else {
        set_transient( 'nnt_contact_error', __( 'There was a problem sending your message. Please try again.', 'nestnthrive' ), 30 );
    }
}
add_action( 'template_redirect', 'nnt_handle_contact_form' );

/**
 * Display admin notice for rooms without matching taxonomy terms.
 */
function nnt_admin_term_warning() {
    $screen = get_current_screen();
    
    if ( ! $screen || $screen->post_type !== 'nnt_room' ) {
        return;
    }
    
    if ( $screen->base === 'post' && isset( $_GET['post'] ) ) {
        $post_id = absint( $_GET['post'] );
        $post    = get_post( $post_id );
        
        if ( $post && ! nnt_room_has_matching_term( $post ) ) {
            printf(
                '<div class="notice notice-warning"><p><strong>%s</strong> %s</p></div>',
                esc_html__( 'Missing Taxonomy Term:', 'nestnthrive' ),
                sprintf(
                    esc_html__( 'No matching Room Tag found for slug "%s". Create a Room Tag with this slug to link guides to this room.', 'nestnthrive' ),
                    esc_html( $post->post_name )
                )
            );
        }
    }
}
add_action( 'admin_notices', 'nnt_admin_term_warning' );

