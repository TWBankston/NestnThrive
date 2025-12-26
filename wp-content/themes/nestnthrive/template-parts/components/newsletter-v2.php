<?php
/**
 * Newsletter Component - V2 Aura
 *
 * @package NestNThrive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<section id="newsletter" class="nnt-section nnt-section--stone" style="border-bottom: 1px solid var(--nnt-stone-200);">
    <div class="nnt-container">
        <div class="nnt-newsletter nnt-reveal">
            <div class="nnt-newsletter__icon">
                <i data-lucide="mail" style="width: 1.75rem; height: 1.75rem;"></i>
            </div>
            <h2 class="nnt-newsletter__title"><?php esc_html_e( 'Join the Inner Circle', 'nestnthrive' ); ?></h2>
            <p class="nnt-newsletter__desc">
                <?php esc_html_e( 'A calm weekly email: one great find, one practical guide. No clutter, just value.', 'nestnthrive' ); ?>
            </p>
            <form class="nnt-newsletter__form" action="#" method="post">
                <input 
                    type="email" 
                    name="email" 
                    class="nnt-newsletter__input" 
                    placeholder="<?php esc_attr_e( 'email@address.com', 'nestnthrive' ); ?>"
                    required
                >
                <button type="submit" class="nnt-newsletter__button">
                    <?php esc_html_e( 'Subscribe', 'nestnthrive' ); ?>
                </button>
            </form>
            <p class="nnt-newsletter__privacy">
                <?php esc_html_e( 'We respect your privacy. Unsubscribe at any time.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

