<?php
/**
 * Admin metaboxes for featured content selection.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register admin metaboxes.
 */
function nnt_register_admin_metaboxes() {
    // Room metaboxes.
    add_meta_box(
        'nnt_room_featured_content',
        __( 'Featured Content', 'nnt-core' ),
        'nnt_render_room_featured_metabox',
        'nnt_room',
        'normal',
        'high'
    );

    add_meta_box(
        'nnt_room_hero_fields',
        __( 'Hero Section', 'nnt-core' ),
        'nnt_render_room_hero_metabox',
        'nnt_room',
        'normal',
        'high'
    );

    // Goal metaboxes.
    add_meta_box(
        'nnt_goal_featured_content',
        __( 'Featured Content', 'nnt-core' ),
        'nnt_render_goal_featured_metabox',
        'nnt_goal',
        'normal',
        'high'
    );

    add_meta_box(
        'nnt_goal_hero_fields',
        __( 'Hero Section', 'nnt-core' ),
        'nnt_render_goal_hero_metabox',
        'nnt_goal',
        'normal',
        'high'
    );

    // Guide metaboxes.
    add_meta_box(
        'nnt_guide_meta_fields',
        __( 'Guide Settings', 'nnt-core' ),
        'nnt_render_guide_metabox',
        'nnt_guide',
        'normal',
        'high'
    );

    // Collection metaboxes.
    add_meta_box(
        'nnt_collection_meta_fields',
        __( 'Collection Settings', 'nnt-core' ),
        'nnt_render_collection_metabox',
        'nnt_collection',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'nnt_register_admin_metaboxes' );

/**
 * Enqueue admin scripts and styles.
 *
 * @param string $hook Current admin page.
 */
function nnt_admin_enqueue_scripts( $hook ) {
    global $post_type;

    $valid_post_types = array( 'nnt_room', 'nnt_goal', 'nnt_guide', 'nnt_collection' );

    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
        return;
    }

    if ( ! in_array( $post_type, $valid_post_types, true ) ) {
        return;
    }

    wp_enqueue_style(
        'nnt-admin-metaboxes',
        NNT_CORE_PLUGIN_URL . 'assets/admin-metaboxes.css',
        array(),
        NNT_CORE_VERSION
    );

    wp_enqueue_script(
        'nnt-admin-metaboxes',
        NNT_CORE_PLUGIN_URL . 'assets/admin-metaboxes.js',
        array( 'jquery', 'jquery-ui-sortable' ),
        NNT_CORE_VERSION,
        true
    );

    wp_localize_script( 'nnt-admin-metaboxes', 'nntAdmin', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'nnt_admin_nonce' ),
    ) );
}
add_action( 'admin_enqueue_scripts', 'nnt_admin_enqueue_scripts' );

/**
 * Render Room hero metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_room_hero_metabox( $post ) {
    wp_nonce_field( 'nnt_room_hero_nonce', 'nnt_room_hero_nonce_field' );

    $hero_title         = get_post_meta( $post->ID, 'nnt_hero_title', true );
    $hero_subtitle      = get_post_meta( $post->ID, 'nnt_hero_subtitle', true );
    $hero_supporting    = get_post_meta( $post->ID, 'nnt_hero_supporting_line', true );
    ?>
    <div class="nnt-metabox-field">
        <label for="nnt_hero_title"><?php esc_html_e( 'Hero Title', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_hero_title" name="nnt_hero_title" value="<?php echo esc_attr( $hero_title ); ?>" class="widefat" />
        <p class="description"><?php esc_html_e( 'Override title displayed in the hero section.', 'nnt-core' ); ?></p>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_hero_subtitle"><?php esc_html_e( 'Hero Subtitle', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_hero_subtitle" name="nnt_hero_subtitle" value="<?php echo esc_attr( $hero_subtitle ); ?>" class="widefat" />
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_hero_supporting_line"><?php esc_html_e( 'Supporting Line', 'nnt-core' ); ?></label>
        <textarea id="nnt_hero_supporting_line" name="nnt_hero_supporting_line" class="widefat" rows="2"><?php echo esc_textarea( $hero_supporting ); ?></textarea>
    </div>
    <?php
}

/**
 * Render Room featured content metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_room_featured_metabox( $post ) {
    wp_nonce_field( 'nnt_room_featured_nonce', 'nnt_room_featured_nonce_field' );

    $featured_collections = get_post_meta( $post->ID, 'nnt_featured_collections', true ) ?: array();
    $featured_guides      = get_post_meta( $post->ID, 'nnt_featured_guides', true ) ?: array();
    $featured_goals       = get_post_meta( $post->ID, 'nnt_featured_goals', true ) ?: array();

    ?>
    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Collections', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_featured_collections', 'nnt_collection', $featured_collections ); ?>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Guides', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_featured_guides', 'nnt_guide', $featured_guides ); ?>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Goals', 'nnt-core' ); ?></h4>
        <?php nnt_render_term_selector( 'nnt_featured_goals', 'nnt_goal_tax', $featured_goals ); ?>
    </div>
    <?php
}

/**
 * Render Goal hero metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_goal_hero_metabox( $post ) {
    wp_nonce_field( 'nnt_goal_hero_nonce', 'nnt_goal_hero_nonce_field' );

    $hero_subtitle   = get_post_meta( $post->ID, 'nnt_hero_subtitle', true );
    $hero_supporting = get_post_meta( $post->ID, 'nnt_hero_supporting_line', true );
    ?>
    <div class="nnt-metabox-field">
        <label for="nnt_hero_subtitle"><?php esc_html_e( 'Hero Subtitle', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_hero_subtitle" name="nnt_hero_subtitle" value="<?php echo esc_attr( $hero_subtitle ); ?>" class="widefat" />
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_hero_supporting_line"><?php esc_html_e( 'Supporting Line', 'nnt-core' ); ?></label>
        <textarea id="nnt_hero_supporting_line" name="nnt_hero_supporting_line" class="widefat" rows="2"><?php echo esc_textarea( $hero_supporting ); ?></textarea>
    </div>
    <?php
}

/**
 * Render Goal featured content metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_goal_featured_metabox( $post ) {
    wp_nonce_field( 'nnt_goal_featured_nonce', 'nnt_goal_featured_nonce_field' );

    $featured_collections = get_post_meta( $post->ID, 'nnt_featured_collections', true ) ?: array();
    $featured_guides      = get_post_meta( $post->ID, 'nnt_featured_guides', true ) ?: array();
    $featured_rooms       = get_post_meta( $post->ID, 'nnt_featured_rooms', true ) ?: array();

    ?>
    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Collections', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_featured_collections', 'nnt_collection', $featured_collections ); ?>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Guides', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_featured_guides', 'nnt_guide', $featured_guides ); ?>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Featured Rooms', 'nnt-core' ); ?></h4>
        <?php nnt_render_term_selector( 'nnt_featured_rooms', 'nnt_room_tax', $featured_rooms ); ?>
    </div>
    <?php
}

/**
 * Render Guide metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_guide_metabox( $post ) {
    wp_nonce_field( 'nnt_guide_meta_nonce', 'nnt_guide_meta_nonce_field' );

    $kicker           = get_post_meta( $post->ID, 'nnt_guide_kicker', true );
    $summary          = get_post_meta( $post->ID, 'nnt_hero_summary', true );
    $reading_time     = get_post_meta( $post->ID, 'nnt_reading_time', true );
    $date_override    = get_post_meta( $post->ID, 'nnt_updated_date_override', true );
    $email_cta        = get_post_meta( $post->ID, 'nnt_email_cta_toggle', true );
    $related_content  = get_post_meta( $post->ID, 'nnt_related_content_manual', true ) ?: array();

    // Default to true for email CTA.
    if ( $email_cta === '' ) {
        $email_cta = true;
    }
    ?>
    <div class="nnt-metabox-field">
        <label for="nnt_guide_kicker"><?php esc_html_e( 'Kicker', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_guide_kicker" name="nnt_guide_kicker" value="<?php echo esc_attr( $kicker ); ?>" class="widefat" />
        <p class="description"><?php esc_html_e( 'Small text above the title (e.g., "Buying Guide").', 'nnt-core' ); ?></p>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_hero_summary"><?php esc_html_e( 'Hero Summary', 'nnt-core' ); ?></label>
        <textarea id="nnt_hero_summary" name="nnt_hero_summary" class="widefat" rows="3"><?php echo esc_textarea( $summary ); ?></textarea>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_reading_time"><?php esc_html_e( 'Reading Time', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_reading_time" name="nnt_reading_time" value="<?php echo esc_attr( $reading_time ); ?>" class="regular-text" placeholder="<?php esc_attr_e( 'e.g., 5 min read', 'nnt-core' ); ?>" />
        <p class="description"><?php esc_html_e( 'Leave blank to auto-calculate.', 'nnt-core' ); ?></p>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_updated_date_override"><?php esc_html_e( 'Updated Date Override', 'nnt-core' ); ?></label>
        <input type="date" id="nnt_updated_date_override" name="nnt_updated_date_override" value="<?php echo esc_attr( $date_override ); ?>" />
        <p class="description"><?php esc_html_e( 'Override the "Last Updated" date shown on the page.', 'nnt-core' ); ?></p>
    </div>

    <div class="nnt-metabox-field">
        <label>
            <input type="checkbox" name="nnt_email_cta_toggle" value="1" <?php checked( $email_cta, true ); ?> />
            <?php esc_html_e( 'Show Email CTA Section', 'nnt-core' ); ?>
        </label>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Related Content (Manual)', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_related_content_manual', array( 'nnt_guide', 'nnt_collection' ), $related_content ); ?>
    </div>
    <?php
}

/**
 * Render Collection metabox.
 *
 * @param WP_Post $post Current post object.
 */
function nnt_render_collection_metabox( $post ) {
    wp_nonce_field( 'nnt_collection_meta_nonce', 'nnt_collection_meta_nonce_field' );

    $kicker           = get_post_meta( $post->ID, 'nnt_collection_kicker', true );
    $summary          = get_post_meta( $post->ID, 'nnt_intro_summary', true );
    $date_override    = get_post_meta( $post->ID, 'nnt_updated_date_override', true );
    $disclosure_style = get_post_meta( $post->ID, 'nnt_affiliate_disclosure_style', true ) ?: 'inline';
    $related_content  = get_post_meta( $post->ID, 'nnt_related_content_manual', true ) ?: array();

    ?>
    <div class="nnt-metabox-field">
        <label for="nnt_collection_kicker"><?php esc_html_e( 'Kicker', 'nnt-core' ); ?></label>
        <input type="text" id="nnt_collection_kicker" name="nnt_collection_kicker" value="<?php echo esc_attr( $kicker ); ?>" class="widefat" />
        <p class="description"><?php esc_html_e( 'Small text above the title (e.g., "Product Roundup").', 'nnt-core' ); ?></p>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_intro_summary"><?php esc_html_e( 'Intro Summary', 'nnt-core' ); ?></label>
        <textarea id="nnt_intro_summary" name="nnt_intro_summary" class="widefat" rows="3"><?php echo esc_textarea( $summary ); ?></textarea>
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_updated_date_override"><?php esc_html_e( 'Updated Date Override', 'nnt-core' ); ?></label>
        <input type="date" id="nnt_updated_date_override" name="nnt_updated_date_override" value="<?php echo esc_attr( $date_override ); ?>" />
    </div>

    <div class="nnt-metabox-field">
        <label for="nnt_affiliate_disclosure_style"><?php esc_html_e( 'Affiliate Disclosure Style', 'nnt-core' ); ?></label>
        <select id="nnt_affiliate_disclosure_style" name="nnt_affiliate_disclosure_style">
            <option value="inline" <?php selected( $disclosure_style, 'inline' ); ?>><?php esc_html_e( 'Inline', 'nnt-core' ); ?></option>
            <option value="block" <?php selected( $disclosure_style, 'block' ); ?>><?php esc_html_e( 'Block', 'nnt-core' ); ?></option>
        </select>
    </div>

    <div class="nnt-featured-section">
        <h4><?php esc_html_e( 'Related Content (Manual)', 'nnt-core' ); ?></h4>
        <?php nnt_render_post_selector( 'nnt_related_content_manual', array( 'nnt_guide', 'nnt_collection' ), $related_content ); ?>
    </div>
    <?php
}

/**
 * Render a post selector field.
 *
 * @param string       $field_name   Field name for the input.
 * @param string|array $post_type    Post type(s) to query.
 * @param array        $selected_ids Currently selected post IDs.
 */
function nnt_render_post_selector( $field_name, $post_type, $selected_ids = array() ) {
    $posts = get_posts( array(
        'post_type'      => $post_type,
        'posts_per_page' => 100,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ) );
    ?>
    <div class="nnt-post-selector" data-field="<?php echo esc_attr( $field_name ); ?>">
        <div class="nnt-selected-posts" id="<?php echo esc_attr( $field_name ); ?>-selected">
            <?php
            if ( ! empty( $selected_ids ) ) {
                $selected_posts = nnt_get_posts_by_ids( $selected_ids, $post_type );
                foreach ( $selected_posts as $sel_post ) {
                    ?>
                    <div class="nnt-selected-item" data-id="<?php echo esc_attr( $sel_post->ID ); ?>">
                        <span class="nnt-drag-handle">☰</span>
                        <span class="nnt-item-title"><?php echo esc_html( $sel_post->post_title ); ?></span>
                        <button type="button" class="nnt-remove-item button-link">&times;</button>
                        <input type="hidden" name="<?php echo esc_attr( $field_name ); ?>[]" value="<?php echo esc_attr( $sel_post->ID ); ?>" />
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="nnt-add-post">
            <select class="nnt-post-dropdown" data-target="<?php echo esc_attr( $field_name ); ?>">
                <option value=""><?php esc_html_e( '— Select to add —', 'nnt-core' ); ?></option>
                <?php foreach ( $posts as $p ) : ?>
                    <option value="<?php echo esc_attr( $p->ID ); ?>" data-title="<?php echo esc_attr( $p->post_title ); ?>">
                        <?php echo esc_html( $p->post_title ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
}

/**
 * Render a term selector field.
 *
 * @param string $field_name   Field name for the input.
 * @param string $taxonomy     Taxonomy to query.
 * @param array  $selected_ids Currently selected term IDs.
 */
function nnt_render_term_selector( $field_name, $taxonomy, $selected_ids = array() ) {
    $terms = get_terms( array(
        'taxonomy'   => $taxonomy,
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    ) );

    if ( is_wp_error( $terms ) ) {
        $terms = array();
    }
    ?>
    <div class="nnt-term-selector" data-field="<?php echo esc_attr( $field_name ); ?>">
        <div class="nnt-selected-terms" id="<?php echo esc_attr( $field_name ); ?>-selected">
            <?php
            if ( ! empty( $selected_ids ) ) {
                $selected_terms = nnt_get_terms_by_ids( $selected_ids, $taxonomy );
                foreach ( $selected_terms as $sel_term ) {
                    ?>
                    <div class="nnt-selected-item" data-id="<?php echo esc_attr( $sel_term->term_id ); ?>">
                        <span class="nnt-drag-handle">☰</span>
                        <span class="nnt-item-title"><?php echo esc_html( $sel_term->name ); ?></span>
                        <button type="button" class="nnt-remove-item button-link">&times;</button>
                        <input type="hidden" name="<?php echo esc_attr( $field_name ); ?>[]" value="<?php echo esc_attr( $sel_term->term_id ); ?>" />
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="nnt-add-term">
            <select class="nnt-term-dropdown" data-target="<?php echo esc_attr( $field_name ); ?>">
                <option value=""><?php esc_html_e( '— Select to add —', 'nnt-core' ); ?></option>
                <?php foreach ( $terms as $term ) : ?>
                    <option value="<?php echo esc_attr( $term->term_id ); ?>" data-title="<?php echo esc_attr( $term->name ); ?>">
                        <?php echo esc_html( $term->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
}

/**
 * Save Room meta.
 *
 * @param int $post_id Post ID.
 */
function nnt_save_room_meta( $post_id ) {
    // Hero fields.
    if ( ! isset( $_POST['nnt_room_hero_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['nnt_room_hero_nonce_field'], 'nnt_room_hero_nonce' ) ) {
        // Skip saving hero fields if nonce not present.
    } else {
        if ( isset( $_POST['nnt_hero_title'] ) ) {
            update_post_meta( $post_id, 'nnt_hero_title', sanitize_text_field( $_POST['nnt_hero_title'] ) );
        }
        if ( isset( $_POST['nnt_hero_subtitle'] ) ) {
            update_post_meta( $post_id, 'nnt_hero_subtitle', sanitize_text_field( $_POST['nnt_hero_subtitle'] ) );
        }
        if ( isset( $_POST['nnt_hero_supporting_line'] ) ) {
            update_post_meta( $post_id, 'nnt_hero_supporting_line', sanitize_textarea_field( $_POST['nnt_hero_supporting_line'] ) );
        }
    }

    // Featured fields.
    if ( ! isset( $_POST['nnt_room_featured_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['nnt_room_featured_nonce_field'], 'nnt_room_featured_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $collections = isset( $_POST['nnt_featured_collections'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_collections'] ) : array();
    $guides      = isset( $_POST['nnt_featured_guides'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_guides'] ) : array();
    $goals       = isset( $_POST['nnt_featured_goals'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_goals'] ) : array();

    update_post_meta( $post_id, 'nnt_featured_collections', $collections );
    update_post_meta( $post_id, 'nnt_featured_guides', $guides );
    update_post_meta( $post_id, 'nnt_featured_goals', $goals );
}
add_action( 'save_post_nnt_room', 'nnt_save_room_meta' );

/**
 * Save Goal meta.
 *
 * @param int $post_id Post ID.
 */
function nnt_save_goal_meta( $post_id ) {
    // Hero fields.
    if ( isset( $_POST['nnt_goal_hero_nonce_field'] ) &&
         wp_verify_nonce( $_POST['nnt_goal_hero_nonce_field'], 'nnt_goal_hero_nonce' ) ) {
        if ( isset( $_POST['nnt_hero_subtitle'] ) ) {
            update_post_meta( $post_id, 'nnt_hero_subtitle', sanitize_text_field( $_POST['nnt_hero_subtitle'] ) );
        }
        if ( isset( $_POST['nnt_hero_supporting_line'] ) ) {
            update_post_meta( $post_id, 'nnt_hero_supporting_line', sanitize_textarea_field( $_POST['nnt_hero_supporting_line'] ) );
        }
    }

    // Featured fields.
    if ( ! isset( $_POST['nnt_goal_featured_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['nnt_goal_featured_nonce_field'], 'nnt_goal_featured_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $collections = isset( $_POST['nnt_featured_collections'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_collections'] ) : array();
    $guides      = isset( $_POST['nnt_featured_guides'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_guides'] ) : array();
    $rooms       = isset( $_POST['nnt_featured_rooms'] ) ? nnt_sanitize_int_array( $_POST['nnt_featured_rooms'] ) : array();

    update_post_meta( $post_id, 'nnt_featured_collections', $collections );
    update_post_meta( $post_id, 'nnt_featured_guides', $guides );
    update_post_meta( $post_id, 'nnt_featured_rooms', $rooms );
}
add_action( 'save_post_nnt_goal', 'nnt_save_goal_meta' );

/**
 * Save Guide meta.
 *
 * @param int $post_id Post ID.
 */
function nnt_save_guide_meta( $post_id ) {
    if ( ! isset( $_POST['nnt_guide_meta_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['nnt_guide_meta_nonce_field'], 'nnt_guide_meta_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['nnt_guide_kicker'] ) ) {
        update_post_meta( $post_id, 'nnt_guide_kicker', sanitize_text_field( $_POST['nnt_guide_kicker'] ) );
    }
    if ( isset( $_POST['nnt_hero_summary'] ) ) {
        update_post_meta( $post_id, 'nnt_hero_summary', sanitize_textarea_field( $_POST['nnt_hero_summary'] ) );
    }
    if ( isset( $_POST['nnt_reading_time'] ) ) {
        update_post_meta( $post_id, 'nnt_reading_time', sanitize_text_field( $_POST['nnt_reading_time'] ) );
    }
    if ( isset( $_POST['nnt_updated_date_override'] ) ) {
        update_post_meta( $post_id, 'nnt_updated_date_override', sanitize_text_field( $_POST['nnt_updated_date_override'] ) );
    }

    $email_cta = isset( $_POST['nnt_email_cta_toggle'] ) ? true : false;
    update_post_meta( $post_id, 'nnt_email_cta_toggle', $email_cta );

    $related = isset( $_POST['nnt_related_content_manual'] ) ? nnt_sanitize_int_array( $_POST['nnt_related_content_manual'] ) : array();
    update_post_meta( $post_id, 'nnt_related_content_manual', $related );
}
add_action( 'save_post_nnt_guide', 'nnt_save_guide_meta' );

/**
 * Save Collection meta.
 *
 * @param int $post_id Post ID.
 */
function nnt_save_collection_meta( $post_id ) {
    if ( ! isset( $_POST['nnt_collection_meta_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['nnt_collection_meta_nonce_field'], 'nnt_collection_meta_nonce' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['nnt_collection_kicker'] ) ) {
        update_post_meta( $post_id, 'nnt_collection_kicker', sanitize_text_field( $_POST['nnt_collection_kicker'] ) );
    }
    if ( isset( $_POST['nnt_intro_summary'] ) ) {
        update_post_meta( $post_id, 'nnt_intro_summary', sanitize_textarea_field( $_POST['nnt_intro_summary'] ) );
    }
    if ( isset( $_POST['nnt_updated_date_override'] ) ) {
        update_post_meta( $post_id, 'nnt_updated_date_override', sanitize_text_field( $_POST['nnt_updated_date_override'] ) );
    }
    if ( isset( $_POST['nnt_affiliate_disclosure_style'] ) ) {
        update_post_meta( $post_id, 'nnt_affiliate_disclosure_style', nnt_sanitize_disclosure_style( $_POST['nnt_affiliate_disclosure_style'] ) );
    }

    $related = isset( $_POST['nnt_related_content_manual'] ) ? nnt_sanitize_int_array( $_POST['nnt_related_content_manual'] ) : array();
    update_post_meta( $post_id, 'nnt_related_content_manual', $related );
}
add_action( 'save_post_nnt_collection', 'nnt_save_collection_meta' );

