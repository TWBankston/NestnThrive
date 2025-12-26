<?php
/**
 * Register custom meta fields.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register all post meta fields.
 */
function nnt_register_meta_fields() {
    // =========================================================================
    // Room Meta Fields (nnt_room)
    // =========================================================================
    
    register_post_meta( 'nnt_room', 'nnt_hero_title', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_room', 'nnt_hero_subtitle', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_room', 'nnt_hero_supporting_line', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_textarea_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_room', 'nnt_featured_collections', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    register_post_meta( 'nnt_room', 'nnt_featured_guides', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    register_post_meta( 'nnt_room', 'nnt_featured_goals', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    // =========================================================================
    // Goal Meta Fields (nnt_goal)
    // =========================================================================

    register_post_meta( 'nnt_goal', 'nnt_hero_subtitle', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_goal', 'nnt_hero_supporting_line', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_textarea_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_goal', 'nnt_featured_collections', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    register_post_meta( 'nnt_goal', 'nnt_featured_guides', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    register_post_meta( 'nnt_goal', 'nnt_featured_rooms', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    // =========================================================================
    // Guide Meta Fields (nnt_guide)
    // =========================================================================

    register_post_meta( 'nnt_guide', 'nnt_guide_kicker', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_guide', 'nnt_hero_summary', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_textarea_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_guide', 'nnt_reading_time', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_guide', 'nnt_updated_date_override', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_guide', 'nnt_email_cta_toggle', array(
        'type'              => 'boolean',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'nnt_sanitize_boolean',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => true,
    ) );

    register_post_meta( 'nnt_guide', 'nnt_related_content_manual', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    // =========================================================================
    // Collection Meta Fields (nnt_collection)
    // =========================================================================

    register_post_meta( 'nnt_collection', 'nnt_collection_kicker', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_collection', 'nnt_intro_summary', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_textarea_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_collection', 'nnt_updated_date_override', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    register_post_meta( 'nnt_collection', 'nnt_affiliate_disclosure_style', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'nnt_sanitize_disclosure_style',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => 'inline',
    ) );

    register_post_meta( 'nnt_collection', 'nnt_related_content_manual', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array( 'type' => 'integer' ),
            ),
        ),
        'sanitize_callback' => 'nnt_sanitize_int_array',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    // Products tested count.
    register_post_meta( 'nnt_collection', 'nnt_products_tested', array(
        'type'              => 'integer',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'absint',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => 0,
    ) );

    // Products data (repeatable group stored as serialized array).
    register_post_meta( 'nnt_collection', 'nnt_products_data', array(
        'type'              => 'array',
        'single'            => true,
        'show_in_rest'      => array(
            'schema' => array(
                'type'  => 'array',
                'items' => array(
                    'type'       => 'object',
                    'properties' => array(
                        'name'          => array( 'type' => 'string' ),
                        'image_url'     => array( 'type' => 'string' ),
                        'price_note'    => array( 'type' => 'string' ),
                        'rating'        => array( 'type' => 'number' ),
                        'affiliate_url' => array( 'type' => 'string' ),
                        'pros'          => array( 'type' => 'array', 'items' => array( 'type' => 'string' ) ),
                        'cons'          => array( 'type' => 'array', 'items' => array( 'type' => 'string' ) ),
                    ),
                ),
            ),
        ),
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => array(),
    ) );

    // =========================================================================
    // Deal Meta Fields (on nnt_collection)
    // =========================================================================

    // Deal active flag.
    register_post_meta( 'nnt_collection', 'nnt_deal_active', array(
        'type'              => 'boolean',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'nnt_sanitize_boolean',
        'auth_callback'     => 'nnt_user_can_edit',
        'default'           => false,
    ) );

    // Deal badge text.
    register_post_meta( 'nnt_collection', 'nnt_deal_badge', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    // Deal last checked timestamp.
    register_post_meta( 'nnt_collection', 'nnt_deal_last_checked', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    // Deal expiration date.
    register_post_meta( 'nnt_collection', 'nnt_deal_expires_at', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    // Deal original price.
    register_post_meta( 'nnt_collection', 'nnt_deal_original_price', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );

    // Deal sale price.
    register_post_meta( 'nnt_collection', 'nnt_deal_sale_price', array(
        'type'              => 'string',
        'single'            => true,
        'show_in_rest'      => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => 'nnt_user_can_edit',
    ) );
}
add_action( 'init', 'nnt_register_meta_fields' );

/**
 * Sanitize affiliate disclosure style.
 *
 * @param mixed $value Value to sanitize.
 * @return string
 */
function nnt_sanitize_disclosure_style( $value ): string {
    $allowed = array( 'inline', 'block' );
    return in_array( $value, $allowed, true ) ? $value : 'inline';
}

