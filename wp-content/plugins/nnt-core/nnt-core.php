<?php
/**
 * Plugin Name: NNT Core
 * Plugin URI: https://nestnthrive.com
 * Description: Core functionality for Nest N Thrive - Custom Post Types, Taxonomies, Meta Fields, and Gutenberg Blocks.
 * Version: 1.0.0
 * Author: Nest N Thrive
 * Author URI: https://nestnthrive.com
 * Text Domain: nnt-core
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 8.0
 * License: GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Plugin constants.
 */
define( 'NNT_CORE_VERSION', '1.0.0' );
define( 'NNT_CORE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'NNT_CORE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'NNT_CORE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Include required files.
 */
function nnt_core_load_includes() {
    $includes = array(
        'includes/helpers.php',
        'includes/cpt-rooms.php',
        'includes/cpt-goals.php',
        'includes/cpt-guides.php',
        'includes/cpt-collections.php',
        'includes/taxonomies.php',
        'includes/meta.php',
        'includes/admin-metaboxes.php',
        'includes/blocks/blocks.php',
        'includes/blocks/register.php',
        'includes/seeder.php',
    );

    foreach ( $includes as $file ) {
        $filepath = NNT_CORE_PLUGIN_DIR . $file;
        if ( file_exists( $filepath ) ) {
            require_once $filepath;
        }
    }
}
add_action( 'plugins_loaded', 'nnt_core_load_includes' );

/**
 * Activation hook.
 */
function nnt_core_activate() {
    // Ensure CPTs are registered before flushing.
    nnt_core_load_includes();
    
    // Register CPTs.
    if ( function_exists( 'nnt_register_room_cpt' ) ) {
        nnt_register_room_cpt();
    }
    if ( function_exists( 'nnt_register_goal_cpt' ) ) {
        nnt_register_goal_cpt();
    }
    if ( function_exists( 'nnt_register_guide_cpt' ) ) {
        nnt_register_guide_cpt();
    }
    if ( function_exists( 'nnt_register_collection_cpt' ) ) {
        nnt_register_collection_cpt();
    }
    
    // Register taxonomies.
    if ( function_exists( 'nnt_register_taxonomies' ) ) {
        nnt_register_taxonomies();
    }
    
    // Flush rewrite rules.
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'nnt_core_activate' );

/**
 * Deactivation hook.
 */
function nnt_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'nnt_core_deactivate' );

/**
 * Load plugin text domain.
 */
function nnt_core_load_textdomain() {
    load_plugin_textdomain( 'nnt-core', false, dirname( NNT_CORE_PLUGIN_BASENAME ) . '/languages' );
}
add_action( 'init', 'nnt_core_load_textdomain' );

/**
 * Register WP-CLI commands.
 */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'nnt seed', array( 'NNT_Core_Seeder', 'run_seeder_cli' ) );
}

/**
 * Register admin menu for seeder.
 */
function nnt_core_seeder_admin_menu() {
    add_management_page(
        __( 'NNT Site Seeder', 'nnt-core' ),
        __( 'NNT Site Seeder', 'nnt-core' ),
        'manage_options',
        'nnt-seeder',
        'nnt_core_seeder_admin_page_content'
    );
}
add_action( 'admin_menu', 'nnt_core_seeder_admin_menu' );

