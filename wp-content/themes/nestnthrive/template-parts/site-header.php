<?php
/**
 * Site Header - V2 Aura Design
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<nav class="nnt-header">
    <div class="nnt-container">
        <div class="nnt-header__inner">
            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nnt-header__logo">
                <div class="nnt-header__logo-icon">
                    <i data-lucide="bird" style="width: 1.25rem; height: 1.25rem;"></i>
                </div>
                <span class="nnt-header__logo-text"><?php bloginfo( 'name' ); ?></span>
            </a>

            <!-- Desktop Navigation -->
            <div class="nnt-header__nav">
                <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_collection' ) ); ?>" class="nnt-header__nav-link">Reviews</a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_room' ) ); ?>" class="nnt-header__nav-link">Spaces</a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_goal' ) ); ?>" class="nnt-header__nav-link">Goals</a>
                <a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_guide' ) ); ?>" class="nnt-header__nav-link">Guides</a>
                <?php
                $deals_page = get_page_by_path( 'deals' );
                if ( $deals_page ) :
                ?>
                <a href="<?php echo esc_url( get_permalink( $deals_page ) ); ?>" class="nnt-header__nav-link">Deals</a>
                <?php endif; ?>
            </div>

            <!-- Actions -->
            <div class="nnt-header__actions">
                <button class="nnt-header__search" aria-label="<?php esc_attr_e( 'Search', 'nestnthrive' ); ?>">
                    <i data-lucide="search" style="width: 1.25rem; height: 1.25rem;"></i>
                </button>
                <a href="#newsletter" class="nnt-header__cta">
                    <?php esc_html_e( 'Subscribe', 'nestnthrive' ); ?>
                </a>
            </div>
        </div>
    </div>
</nav>
