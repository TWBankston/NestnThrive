<?php
/**
 * Site Header Template Part
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<header class="nnt-header" role="banner">
    <a class="skip-link screen-reader-text" href="#main-content">
        <?php esc_html_e( 'Skip to content', 'nestnthrive' ); ?>
    </a>
    
    <nav class="nnt-header__nav-wrapper">
        <div class="nnt-container">
            <div class="nnt-header__inner">
                <!-- Logo / Site Title -->
                <div class="nnt-header__brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nnt-header__logo" rel="home">
                        <div class="nnt-header__logo-icon">
                            <span class="nnt-header__logo-letter">N</span>
                        </div>
                        <span class="nnt-header__site-title"><?php bloginfo( 'name' ); ?></span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="nnt-header__menu-desktop">
                    <?php if ( has_nav_menu( 'primary' ) ) : ?>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'nnt-header__menu',
                            'container'      => false,
                            'depth'          => 2,
                            'fallback_cb'    => false,
                        ) );
                        ?>
                    <?php else : ?>
                        <ul class="nnt-header__menu">
                            <li><a href="<?php echo esc_url( home_url( '/room/' ) ); ?>"><?php esc_html_e( 'Shop by Room', 'nestnthrive' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/goal/' ) ); ?>"><?php esc_html_e( 'Shop by Goal', 'nestnthrive' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>"><?php esc_html_e( 'Guides', 'nestnthrive' ); ?></a></li>
                            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'nestnthrive' ); ?></a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- CTA Button -->
                <div class="nnt-header__cta">
                    <a href="#newsletter" class="nnt-header__cta-button">
                        <?php esc_html_e( 'Join the List', 'nestnthrive' ); ?>
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="nnt-header__menu-toggle" aria-controls="mobile-navigation" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'nestnthrive' ); ?>">
                    <span class="nnt-header__hamburger" aria-hidden="true">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    <nav class="nnt-header__mobile-nav" id="mobile-navigation" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'nestnthrive' ); ?>">
        <div class="nnt-container">
            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nnt-header__mobile-menu',
                    'container'      => false,
                    'depth'          => 2,
                    'fallback_cb'    => false,
                ) );
                ?>
            <?php else : ?>
                <ul class="nnt-header__mobile-menu">
                    <li><a href="<?php echo esc_url( home_url( '/room/' ) ); ?>"><?php esc_html_e( 'Shop by Room', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/goal/' ) ); ?>"><?php esc_html_e( 'Shop by Goal', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>"><?php esc_html_e( 'Guides', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'nestnthrive' ); ?></a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
</header>

<script>
(function() {
    const toggle = document.querySelector('.nnt-header__menu-toggle');
    const mobileNav = document.querySelector('.nnt-header__mobile-nav');
    
    if (toggle && mobileNav) {
        toggle.addEventListener('click', function() {
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', !isExpanded);
            mobileNav.classList.toggle('is-open');
            document.body.classList.toggle('nnt-mobile-menu-open');
        });
    }
})();
</script>
