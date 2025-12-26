<?php
/**
 * Gutenberg blocks setup.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue block editor assets.
 */
function nnt_enqueue_block_editor_assets() {
    $asset_file = NNT_CORE_PLUGIN_DIR . 'includes/blocks/build/index.asset.php';
    
    // Use default values if asset file doesn't exist yet.
    $asset = file_exists( $asset_file )
        ? require $asset_file
        : array(
            'dependencies' => array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
            'version'      => NNT_CORE_VERSION,
        );

    $script_path = NNT_CORE_PLUGIN_DIR . 'includes/blocks/build/index.js';
    
    // Only enqueue if build file exists.
    if ( file_exists( $script_path ) ) {
        wp_enqueue_script(
            'nnt-blocks-editor',
            NNT_CORE_PLUGIN_URL . 'includes/blocks/build/index.js',
            $asset['dependencies'],
            $asset['version'],
            true
        );
    }

    $style_path = NNT_CORE_PLUGIN_DIR . 'includes/blocks/build/index.css';
    
    if ( file_exists( $style_path ) ) {
        wp_enqueue_style(
            'nnt-blocks-editor-style',
            NNT_CORE_PLUGIN_URL . 'includes/blocks/build/index.css',
            array(),
            $asset['version']
        );
    }
}
add_action( 'enqueue_block_editor_assets', 'nnt_enqueue_block_editor_assets' );

/**
 * Enqueue block frontend assets.
 */
function nnt_enqueue_block_assets() {
    $style_path = NNT_CORE_PLUGIN_DIR . 'includes/blocks/build/style-index.css';
    
    if ( file_exists( $style_path ) ) {
        wp_enqueue_style(
            'nnt-blocks-style',
            NNT_CORE_PLUGIN_URL . 'includes/blocks/build/style-index.css',
            array(),
            NNT_CORE_VERSION
        );
    }
}
add_action( 'enqueue_block_assets', 'nnt_enqueue_block_assets' );

/**
 * Add NNT block category.
 *
 * @param array $categories Existing block categories.
 * @return array
 */
function nnt_register_block_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug'  => 'nnt-blocks',
                'title' => __( 'Nest N Thrive', 'nnt-core' ),
                'icon'  => 'admin-home',
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories_all', 'nnt_register_block_category', 10, 1 );

