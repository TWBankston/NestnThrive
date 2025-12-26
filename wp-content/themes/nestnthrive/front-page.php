<?php
/**
 * Front Page Template (Homepage)
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

// Get content for various sections.
$rooms       = nnt_get_all_rooms( 6 );
$goals       = nnt_get_all_goals( 6 );
$guides      = nnt_get_latest_guides( 6 );
$collections = nnt_get_latest_collections( 3 );

// Hero image (can be replaced with customizer option).
$hero_image = get_theme_mod( 'nnt_home_hero_image', 'https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?auto=format&fit=crop&q=80&w=1600' );
?>

<!-- HERO SECTION -->
<section class="nnt-hero">
    <div class="nnt-hero__bg-elements">
        <div class="nnt-hero__glow nnt-hero__glow--1"></div>
        <div class="nnt-hero__glow nnt-hero__glow--2"></div>
    </div>
    
    <div class="nnt-container">
        <div class="nnt-hero__grid">
            <!-- Text Content -->
            <div class="nnt-hero__content">
                <h1 class="nnt-hero__title">
                    <?php esc_html_e( 'Make your home a nest.', 'nestnthrive' ); ?><br>
                    <span class="nnt-hero__title-accent"><?php esc_html_e( 'Then thrive.', 'nestnthrive' ); ?></span>
                </h1>
                
                <p class="nnt-hero__subtitle">
                    <?php esc_html_e( 'Calm, functional upgrades—curated by room and explained with clarity. Transform everyday spaces into sanctuaries.', 'nestnthrive' ); ?>
                </p>
                
                <div class="nnt-hero__actions">
                    <?php
                    get_template_part( 'template-parts/components/cta-button', null, array(
                        'text'  => __( 'Shop by Room', 'nestnthrive' ),
                        'url'   => home_url( '/room/' ),
                        'style' => 'primary',
                        'arrow' => true,
                    ) );
                    
                    get_template_part( 'template-parts/components/cta-button', null, array(
                        'text'  => __( 'Browse Guides', 'nestnthrive' ),
                        'url'   => home_url( '/guides/' ),
                        'style' => 'outline',
                    ) );
                    ?>
                </div>
                
                <p class="nnt-hero__tagline">
                    <?php esc_html_e( 'Curated guides. No fluff. Just what works.', 'nestnthrive' ); ?>
                </p>
                
                <!-- Value Props -->
                <div class="nnt-hero__props">
                    <div class="nnt-hero__prop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span><?php esc_html_e( 'Curated picks, not endless lists', 'nestnthrive' ); ?></span>
                    </div>
                    <div class="nnt-hero__prop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <span><?php esc_html_e( 'Practical upgrades that feel premium', 'nestnthrive' ); ?></span>
                    </div>
                    <div class="nnt-hero__prop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span><?php esc_html_e( 'By room, by goal, by real life', 'nestnthrive' ); ?></span>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="nnt-hero__image-wrap">
                <div class="nnt-hero__image">
                    <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Calm lived-in living room with natural light', 'nestnthrive' ); ?>" loading="eager">
                    <div class="nnt-hero__image-overlay"></div>
                    <div class="nnt-hero__quote">
                        <p><?php esc_html_e( '"A home that feels organized is a mind that feels clear."', 'nestnthrive' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SHOP BY ROOM -->
<?php if ( ! empty( $rooms ) ) : ?>
<section class="nnt-section nnt-section--rooms">
    <div class="nnt-container">
        <header class="nnt-section__header nnt-section__header--centered">
            <span class="nnt-section__kicker"><?php esc_html_e( 'Hub Pages', 'nestnthrive' ); ?></span>
            <h2 class="nnt-section__title"><?php esc_html_e( 'Shop by Room', 'nestnthrive' ); ?></h2>
            <p class="nnt-section__subtitle"><?php esc_html_e( 'Start where you live—each room has unique needs and rhythms.', 'nestnthrive' ); ?></p>
        </header>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $rooms as $room ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $room,
                    'type'         => 'room',
                    'style'        => 'minimal',
                    'show_excerpt' => true,
                    'image_size'   => 'nnt-card',
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- SHOP BY GOAL -->
<?php if ( ! empty( $goals ) ) : ?>
<section class="nnt-section nnt-section--white nnt-section--goals">
    <div class="nnt-container">
        <header class="nnt-section__header">
            <div class="nnt-section__header-left">
                <h2 class="nnt-section__title"><?php esc_html_e( 'Shop by Goal', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( 'Choose the outcome you want—we\'ll guide you to the right setup and products.', 'nestnthrive' ); ?></p>
            </div>
            <a href="<?php echo esc_url( home_url( '/goal/' ) ); ?>" class="nnt-section__link">
                <?php esc_html_e( 'View all goals', 'nestnthrive' ); ?>
            </a>
        </header>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $goals as $goal ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $goal,
                    'type'         => 'goal',
                    'style'        => 'goal-tile',
                    'show_excerpt' => true,
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FEATURED GUIDES -->
<?php if ( ! empty( $guides ) ) : ?>
<section class="nnt-section nnt-section--guides">
    <div class="nnt-container">
        <h2 class="nnt-section__title nnt-section__title--bordered"><?php esc_html_e( 'Popular Right Now', 'nestnthrive' ); ?></h2>
        
        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $guides as $guide ) : ?>
                <?php
                get_template_part( 'template-parts/components/card', null, array(
                    'item'         => $guide,
                    'type'         => 'guide',
                    'style'        => 'default',
                    'show_meta'    => true,
                    'show_excerpt' => true,
                    'image_size'   => 'nnt-featured',
                ) );
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- BRAND PHILOSOPHY -->
<section class="nnt-section nnt-section--dark nnt-section--philosophy">
    <div class="nnt-container">
        <div class="nnt-philosophy">
            <div class="nnt-philosophy__content">
                <h2 class="nnt-philosophy__title">
                    <?php esc_html_e( 'Thoughtful picks.', 'nestnthrive' ); ?><br>
                    <?php esc_html_e( 'Clear guidance.', 'nestnthrive' ); ?>
                </h2>
                <p class="nnt-philosophy__text">
                    <?php esc_html_e( 'The internet is noisy. We filter out the junk and focus on products that actually improve your daily routines. We believe a home should serve you, not the other way around.', 'nestnthrive' ); ?>
                </p>
                <p class="nnt-philosophy__accent">
                    <?php esc_html_e( 'Every guide is built to help you decide faster—and live better.', 'nestnthrive' ); ?>
                </p>
            </div>
            
            <div class="nnt-philosophy__values">
                <div class="nnt-philosophy__value">
                    <div class="nnt-philosophy__value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.7 7.7a2.5 2.5 0 1 1 1.8 4.3H2"></path><path d="M9.6 4.6A2 2 0 1 1 11 8H2"></path><path d="M12.6 19.4A2 2 0 1 0 14 16H2"></path></svg>
                    </div>
                    <div>
                        <h4 class="nnt-philosophy__value-title"><?php esc_html_e( 'Calm', 'nestnthrive' ); ?></h4>
                        <p class="nnt-philosophy__value-text"><?php esc_html_e( 'We prioritize designs that reduce visual clutter. Clean lines, neutral tones, and hidden organization.', 'nestnthrive' ); ?></p>
                    </div>
                </div>
                
                <div class="nnt-philosophy__value">
                    <div class="nnt-philosophy__value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                    </div>
                    <div>
                        <h4 class="nnt-philosophy__value-title"><?php esc_html_e( 'Function', 'nestnthrive' ); ?></h4>
                        <p class="nnt-philosophy__value-text"><?php esc_html_e( 'It has to work. We look for items that solve specific problems without adding unnecessary complexity.', 'nestnthrive' ); ?></p>
                    </div>
                </div>
                
                <div class="nnt-philosophy__value">
                    <div class="nnt-philosophy__value-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    </div>
                    <div>
                        <h4 class="nnt-philosophy__value-title"><?php esc_html_e( 'Quality', 'nestnthrive' ); ?></h4>
                        <p class="nnt-philosophy__value-text"><?php esc_html_e( 'Buy once, enjoy longer. We favor materials that age well and brands that stand behind their work.', 'nestnthrive' ); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RESET CTA -->
<section class="nnt-section nnt-section--alt nnt-section--cta">
    <div class="nnt-container">
        <div class="nnt-cta-strip">
            <span class="nnt-cta-strip__badge"><?php esc_html_e( 'New Feature', 'nestnthrive' ); ?></span>
            <h2 class="nnt-cta-strip__title"><?php esc_html_e( 'Moving? Resetting your space?', 'nestnthrive' ); ?></h2>
            <p class="nnt-cta-strip__text"><?php esc_html_e( 'We\'re building step-by-step checklists for every room—so you can set up a home that feels good from day one, without the overwhelm.', 'nestnthrive' ); ?></p>
            <?php
            get_template_part( 'template-parts/components/cta-button', null, array(
                'text'  => __( 'Get the Checklist', 'nestnthrive' ),
                'url'   => '#newsletter',
                'style' => 'secondary',
                'size'  => 'large',
            ) );
            ?>
        </div>
    </div>
</section>

<!-- EMAIL SIGNUP -->
<section class="nnt-section nnt-section--white nnt-section--newsletter">
    <div class="nnt-container nnt-container--narrow">
        <?php
        get_template_part( 'template-parts/components/newsletter-form', null, array(
            'style'      => 'centered',
            'title'      => __( 'A calmer home—one upgrade at a time.', 'nestnthrive' ),
            'subtitle'   => __( 'Occasional guides, room resets, and curated finds. No spam, ever.', 'nestnthrive' ),
        ) );
        ?>
    </div>
</section>

<?php
get_footer();
