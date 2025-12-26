<?php
/**
 * Site Footer - V2 Aura Design
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$about_page   = get_page_by_path( 'about' );
$contact_page = get_page_by_path( 'contact' );
$deals_page   = get_page_by_path( 'deals' );
?>
<footer class="nnt-footer">
    <div class="nnt-container">
        <div class="nnt-footer__grid">
            <!-- Brand Column -->
            <div class="nnt-footer__brand">
                <div class="nnt-footer__brand-logo">
                    <div class="nnt-footer__brand-icon">
                        <i data-lucide="bird" style="width: 0.75rem; height: 0.75rem;"></i>
                    </div>
                    <span class="nnt-footer__brand-name"><?php bloginfo( 'name' ); ?></span>
                </div>
                <p class="nnt-footer__brand-desc">
                    <?php esc_html_e( 'Making home life simpler through honest reviews and practical guides.', 'nestnthrive' ); ?>
                </p>
                <div class="nnt-footer__social">
                    <a href="#" class="nnt-footer__social-link" aria-label="Instagram">
                        <i data-lucide="instagram" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                    <a href="#" class="nnt-footer__social-link" aria-label="Twitter">
                        <i data-lucide="twitter" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                    <a href="#" class="nnt-footer__social-link" aria-label="Pinterest">
                        <i data-lucide="pinterest" style="width: 1.25rem; height: 1.25rem;"></i>
                    </a>
                </div>
            </div>

            <!-- Explore Column -->
            <div>
                <h4 class="nnt-footer__column-title"><?php esc_html_e( 'Explore', 'nestnthrive' ); ?></h4>
                <ul class="nnt-footer__links">
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_collection' ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Reviews', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_room' ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Spaces', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_goal' ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Goals', 'nestnthrive' ); ?></a></li>
                    <li><a href="<?php echo esc_url( get_post_type_archive_link( 'nnt_guide' ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Guides', 'nestnthrive' ); ?></a></li>
                    <?php if ( $deals_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $deals_page ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Deals', 'nestnthrive' ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Company Column -->
            <div>
                <h4 class="nnt-footer__column-title"><?php esc_html_e( 'Company', 'nestnthrive' ); ?></h4>
                <ul class="nnt-footer__links">
                    <?php if ( $about_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $about_page ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'About Us', 'nestnthrive' ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $contact_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $contact_page ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Contact', 'nestnthrive' ); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Legal Column -->
            <div>
                <h4 class="nnt-footer__column-title"><?php esc_html_e( 'Legal', 'nestnthrive' ); ?></h4>
                <ul class="nnt-footer__links">
                    <?php
                    $privacy_page = get_page_by_path( 'privacy' );
                    $terms_page   = get_page_by_path( 'terms' );
                    ?>
                    <?php if ( $privacy_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $privacy_page ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Privacy', 'nestnthrive' ); ?></a></li>
                    <?php endif; ?>
                    <?php if ( $terms_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink( $terms_page ) ); ?>" class="nnt-footer__link"><?php esc_html_e( 'Terms', 'nestnthrive' ); ?></a></li>
                    <?php endif; ?>
                    <li><a href="#" class="nnt-footer__link"><?php esc_html_e( 'Affiliate Disclosure', 'nestnthrive' ); ?></a></li>
                </ul>
            </div>
        </div>

        <div class="nnt-footer__bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'nestnthrive' ); ?></p>
            <p class="nnt-footer__disclosure">
                <?php esc_html_e( 'As an Amazon Associate, we may earn from qualifying purchases. This helps support our independent testing.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</footer>
