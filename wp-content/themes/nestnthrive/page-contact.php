<?php
/**
 * Template Name: Contact Page
 * 
 * Contact Page Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$title = get_the_title();

// Handle form submission
$form_submitted = false;
$form_success   = false;
$form_error     = '';

if ( isset( $_POST['nnt_contact_submit'] ) && wp_verify_nonce( $_POST['nnt_contact_nonce'], 'nnt_contact_form' ) ) {
    $name    = sanitize_text_field( $_POST['nnt_name'] ?? '' );
    $email   = sanitize_email( $_POST['nnt_email'] ?? '' );
    $message = sanitize_textarea_field( $_POST['nnt_message'] ?? '' );
    
    // Simple honeypot check
    if ( ! empty( $_POST['nnt_website'] ) ) {
        // Likely spam, silently fail
        $form_submitted = true;
        $form_success   = true;
    } elseif ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        $form_submitted = true;
        $form_error     = __( 'Please fill in all required fields.', 'nestnthrive' );
    } elseif ( ! is_email( $email ) ) {
        $form_submitted = true;
        $form_error     = __( 'Please enter a valid email address.', 'nestnthrive' );
    } else {
        $to      = get_option( 'admin_email' );
        $subject = sprintf( __( '[Nest N Thrive] Contact from %s', 'nestnthrive' ), $name );
        $body    = sprintf(
            __( "Name: %s\nEmail: %s\n\nMessage:\n%s", 'nestnthrive' ),
            $name,
            $email,
            $message
        );
        $headers = array(
            'From: ' . $name . ' <' . $email . '>',
            'Reply-To: ' . $email,
        );
        
        $sent = wp_mail( $to, $subject, $body, $headers );
        
        $form_submitted = true;
        $form_success   = $sent;
        
        if ( ! $sent ) {
            $form_error = __( 'There was a problem sending your message. Please try again later.', 'nestnthrive' );
        }
    }
}
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-reveal" style="text-align: center; max-width: 48rem; margin: 0 auto;">
            <?php
            get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                'items' => array(
                    array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                    array( 'label' => __( 'Contact', 'nestnthrive' ) ),
                ),
            ) );
            ?>
            
            <h1 class="nnt-hero__title" style="margin-top: 1rem;"><?php echo esc_html( $title ); ?></h1>
            
            <p class="nnt-hero__desc" style="max-width: 36rem; margin: 1rem auto;">
                <?php esc_html_e( 'Have a question, suggestion, or just want to say hi? We\'d love to hear from you.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- CONTACT FORM -->
<section class="nnt-section nnt-section--white">
    <div class="nnt-container" style="max-width: 42rem;">
        <?php if ( $form_submitted && $form_success ) : ?>
            <div class="nnt-reveal" style="text-align: center; padding: 3rem 2rem; background: var(--nnt-stone-50); border-radius: 1rem;">
                <div style="width: 4rem; height: 4rem; background: var(--nnt-forest); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i data-lucide="check" style="width: 2rem; height: 2rem; color: #fff;"></i>
                </div>
                <h2 style="font-size: 1.5rem; color: var(--nnt-stone-900); margin-bottom: 0.75rem;"><?php esc_html_e( 'Message Sent!', 'nestnthrive' ); ?></h2>
                <p style="color: var(--nnt-stone-600);"><?php esc_html_e( 'Thanks for reaching out. We\'ll get back to you as soon as we can.', 'nestnthrive' ); ?></p>
            </div>
        <?php else : ?>
            <div class="nnt-reveal">
                <?php if ( $form_error ) : ?>
                    <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1.5rem; color: #dc2626;">
                        <?php echo esc_html( $form_error ); ?>
                    </div>
                <?php endif; ?>

                <form method="post" class="nnt-contact-form" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <?php wp_nonce_field( 'nnt_contact_form', 'nnt_contact_nonce' ); ?>
                    
                    <!-- Honeypot -->
                    <div style="position: absolute; left: -9999px;">
                        <label for="nnt_website">Website</label>
                        <input type="text" name="nnt_website" id="nnt_website" tabindex="-1" autocomplete="off">
                    </div>

                    <div>
                        <label for="nnt_name" style="display: block; font-weight: 500; color: var(--nnt-stone-700); margin-bottom: 0.5rem;">
                            <?php esc_html_e( 'Your Name', 'nestnthrive' ); ?> <span style="color: var(--nnt-forest);">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="nnt_name" 
                            id="nnt_name" 
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--nnt-stone-300); border-radius: 0.5rem; font-size: 1rem; transition: border-color 0.2s;"
                            value="<?php echo esc_attr( $_POST['nnt_name'] ?? '' ); ?>"
                        >
                    </div>

                    <div>
                        <label for="nnt_email" style="display: block; font-weight: 500; color: var(--nnt-stone-700); margin-bottom: 0.5rem;">
                            <?php esc_html_e( 'Email Address', 'nestnthrive' ); ?> <span style="color: var(--nnt-forest);">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="nnt_email" 
                            id="nnt_email" 
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--nnt-stone-300); border-radius: 0.5rem; font-size: 1rem; transition: border-color 0.2s;"
                            value="<?php echo esc_attr( $_POST['nnt_email'] ?? '' ); ?>"
                        >
                    </div>

                    <div>
                        <label for="nnt_message" style="display: block; font-weight: 500; color: var(--nnt-stone-700); margin-bottom: 0.5rem;">
                            <?php esc_html_e( 'Message', 'nestnthrive' ); ?> <span style="color: var(--nnt-forest);">*</span>
                        </label>
                        <textarea 
                            name="nnt_message" 
                            id="nnt_message" 
                            rows="6" 
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid var(--nnt-stone-300); border-radius: 0.5rem; font-size: 1rem; resize: vertical; transition: border-color 0.2s;"
                        ><?php echo esc_textarea( $_POST['nnt_message'] ?? '' ); ?></textarea>
                    </div>

                    <button type="submit" name="nnt_contact_submit" class="nnt-btn nnt-btn--primary" style="align-self: flex-start;">
                        <?php esc_html_e( 'Send Message', 'nestnthrive' ); ?>
                        <i data-lucide="send" style="width: 1rem; height: 1rem; margin-left: 0.5rem;"></i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- EDITORIAL POLICY -->
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container" style="max-width: 42rem;">
        <div class="nnt-reveal" style="background: #fff; padding: 2rem; border-radius: 1rem;">
            <h2 style="font-size: 1.25rem; color: var(--nnt-stone-900); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <i data-lucide="shield" style="width: 1.25rem; height: 1.25rem; color: var(--nnt-forest);"></i>
                <?php esc_html_e( 'Anti-Spam & Editorial Policy', 'nestnthrive' ); ?>
            </h2>
            <div style="color: var(--nnt-stone-600); font-size: 0.9375rem; line-height: 1.7;">
                <p style="margin-bottom: 1rem;">
                    <?php esc_html_e( 'We don\'t accept unsolicited guest posts, link insertion requests, or paid promotional content. Our editorial is independent and based on our own testing.', 'nestnthrive' ); ?>
                </p>
                <p>
                    <?php esc_html_e( 'If you\'re a brand with a product you think we should review, please include detailed product information. We cannot guarantee coverage, but we do read every message.', 'nestnthrive' ); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
