<?php
/**
 * Template Name: Contact Page
 * 
 * Contact page template with form handling.
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get form messages.
$success_message = get_transient( 'nnt_contact_success' );
$error_message   = get_transient( 'nnt_contact_error' );

// Clear transients after reading.
if ( $success_message ) {
    delete_transient( 'nnt_contact_success' );
}
if ( $error_message ) {
    delete_transient( 'nnt_contact_error' );
}
?>

<!-- HERO SECTION -->
<header class="nnt-page-hero nnt-page-hero--contact">
    <div class="nnt-page-hero__bg"></div>
    
    <div class="nnt-container">
        <div class="nnt-page-hero__content">
            <h1 class="nnt-page-hero__title"><?php esc_html_e( 'Contact Us', 'nestnthrive' ); ?></h1>
            <p class="nnt-page-hero__subtitle">
                <?php esc_html_e( 'Have a question, suggestion, or correction? We value clear communication and would love to hear from you.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</header>

<main class="nnt-page-content">
    <section class="nnt-section nnt-section--contact">
        <div class="nnt-container">
            <div class="nnt-contact-grid">
                
                <!-- Left Column: Context & Info -->
                <div class="nnt-contact-info">
                    <div class="nnt-contact-info__main">
                        <h2 class="nnt-contact-info__title"><?php esc_html_e( 'How can we help?', 'nestnthrive' ); ?></h2>
                        <p class="nnt-contact-info__text">
                            <?php esc_html_e( 'We read every message. To ensure we can help you efficiently, here are the topics we are best equipped to address:', 'nestnthrive' ); ?>
                        </p>
                        
                        <ul class="nnt-contact-info__list">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?php esc_html_e( 'Questions about specific guides or products', 'nestnthrive' ); ?></span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?php esc_html_e( 'Corrections or updates to existing content', 'nestnthrive' ); ?></span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?php esc_html_e( 'Suggestions for future topics', 'nestnthrive' ); ?></span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                <span><?php esc_html_e( 'General feedback on the site experience', 'nestnthrive' ); ?></span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="nnt-contact-info__email">
                        <h3><?php esc_html_e( 'Email Direct', 'nestnthrive' ); ?></h3>
                        <a href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>">
                            <?php echo esc_html( get_option( 'admin_email' ) ); ?>
                        </a>
                    </div>
                </div>

                <!-- Right Column: The Form -->
                <div class="nnt-contact-form-wrap">
                    <div class="nnt-contact-form-card">
                        <?php if ( $success_message ) : ?>
                            <div class="nnt-contact-message nnt-contact-message--success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                <p><?php echo esc_html( $success_message ); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ( $error_message ) : ?>
                            <div class="nnt-contact-message nnt-contact-message--error">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                <p><?php echo esc_html( $error_message ); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo esc_url( get_permalink() ); ?>" method="POST" class="nnt-contact-form">
                            <?php wp_nonce_field( 'nnt_contact_form', 'nnt_contact_nonce' ); ?>
                            
                            <div class="nnt-contact-form__row">
                                <div class="nnt-contact-form__field">
                                    <label for="nnt_name"><?php esc_html_e( 'Name', 'nestnthrive' ); ?></label>
                                    <input 
                                        type="text" 
                                        id="nnt_name" 
                                        name="nnt_name" 
                                        required 
                                        placeholder="<?php esc_attr_e( 'Jane Doe', 'nestnthrive' ); ?>"
                                    >
                                </div>
                                <div class="nnt-contact-form__field">
                                    <label for="nnt_email"><?php esc_html_e( 'Email', 'nestnthrive' ); ?></label>
                                    <input 
                                        type="email" 
                                        id="nnt_email" 
                                        name="nnt_email" 
                                        required 
                                        placeholder="<?php esc_attr_e( 'jane@example.com', 'nestnthrive' ); ?>"
                                    >
                                </div>
                            </div>
                            
                            <div class="nnt-contact-form__field">
                                <label for="nnt_message"><?php esc_html_e( 'Message', 'nestnthrive' ); ?></label>
                                <textarea 
                                    id="nnt_message" 
                                    name="nnt_message" 
                                    rows="6" 
                                    required 
                                    placeholder="<?php esc_attr_e( 'How can we help you today?', 'nestnthrive' ); ?>"
                                ></textarea>
                            </div>
                            
                            <div class="nnt-contact-form__footer">
                                <button type="submit" class="nnt-button nnt-button--primary nnt-button--large">
                                    <?php esc_html_e( 'Send Message', 'nestnthrive' ); ?>
                                </button>
                                
                                <p class="nnt-contact-form__note">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    <?php esc_html_e( 'We typically respond within 2-3 business days.', 'nestnthrive' ); ?>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
