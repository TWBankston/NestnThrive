<?php
/**
 * Site Footer Template Part
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="nnt-footer" role="contentinfo">
    <div class="nnt-container">
        <div class="nnt-footer__grid">
            <!-- Brand Column -->
            <div class="nnt-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nnt-footer__logo">
                    <img 
                        src="<?php echo esc_url( get_theme_file_uri( 'assets/images/nestnthrive_logo_75px.png' ) ); ?>" 
                        srcset="<?php echo esc_url( get_theme_file_uri( 'assets/images/nestnthrive_logo_75px.png' ) ); ?> 1x, 
                                <?php echo esc_url( get_theme_file_uri( 'assets/images/nestnthrive_logo_120px.png' ) ); ?> 2x"
                        alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" 
                        class="nnt-footer__logo-img"
                        width="75"
                        height="auto"
                    >
                </a>
                <p class="nnt-footer__tagline">
                    <?php esc_html_e( 'Helping you transform everyday homes into calm, functional spaces.', 'nestnthrive' ); ?>
                </p>
            </div>

            <!-- Explore Column -->
            <div class="nnt-footer__column">
                <h4 class="nnt-footer__heading"><?php esc_html_e( 'Explore', 'nestnthrive' ); ?></h4>
                <ul class="nnt-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/room/' ) ); ?>"><?php esc_html_e( 'Shop by Room', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/goal/' ) ); ?>"><?php esc_html_e( 'Shop by Goal', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/guides/' ) ); ?>"><?php esc_html_e( 'Latest Guides', 'nestnthrive' ); ?></a></li>
                </ul>
            </div>

            <!-- Company Column -->
            <div class="nnt-footer__column">
                <h4 class="nnt-footer__heading"><?php esc_html_e( 'Company', 'nestnthrive' ); ?></h4>
                <ul class="nnt-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'nestnthrive' ); ?></a></li>
                </ul>
            </div>

            <!-- Social Column -->
            <div class="nnt-footer__column">
                <h4 class="nnt-footer__heading"><?php esc_html_e( 'Follow', 'nestnthrive' ); ?></h4>
                <div class="nnt-footer__social">
                    <a href="#" aria-label="<?php esc_attr_e( 'Instagram', 'nestnthrive' ); ?>" class="nnt-footer__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="#" aria-label="<?php esc_attr_e( 'Twitter', 'nestnthrive' ); ?>" class="nnt-footer__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                    </a>
                    <a href="#" aria-label="<?php esc_attr_e( 'Facebook', 'nestnthrive' ); ?>" class="nnt-footer__social-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="nnt-footer__bottom">
            <p class="nnt-footer__copyright">
                <?php
                printf(
                    /* translators: %1$s: Current year, %2$s: Site name */
                    esc_html__( '© %1$s %2$s. All rights reserved.', 'nestnthrive' ),
                    date_i18n( 'Y' ),
                    get_bloginfo( 'name' )
                );
                ?>
            </p>
            <p class="nnt-footer__disclosure">
                <?php esc_html_e( 'As an Amazon Associate, we may earn from qualifying purchases. This supports our work at no extra cost to you.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</footer>
