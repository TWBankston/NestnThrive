<?php
/**
 * Template Name: About Page
 * 
 * About page template.
 *
 * @package NestNThrive
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<!-- HERO SECTION -->
<header class="nnt-page-hero nnt-page-hero--about">
    <div class="nnt-page-hero__bg"></div>
    
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-page-hero__content">
            <h1 class="nnt-page-hero__title"><?php esc_html_e( 'Thoughtful upgrades for homes that are lived in.', 'nestnthrive' ); ?></h1>
            <p class="nnt-page-hero__subtitle">
                <?php esc_html_e( 'Nest N Thrive is a digital publication dedicated to clarity in home design. We filter out the noise to help you build a space that supports your life, not just your aesthetic.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</header>

<main class="nnt-page-content">
    
    <!-- WHY THIS EXISTS -->
    <section class="nnt-section nnt-section--about-purpose">
        <div class="nnt-container nnt-container--narrow">
            <span class="nnt-section__kicker"><?php esc_html_e( 'Our Purpose', 'nestnthrive' ); ?></span>
            <h2 class="nnt-section__title"><?php esc_html_e( 'Why We Built This', 'nestnthrive' ); ?></h2>
            
            <div class="nnt-about-prose">
                <p>
                    <?php esc_html_e( 'Searching for something as simple as a "good desk chair" or "calm lighting" has become surprisingly difficult. The internet is flooded with infinite choices, algorithm-driven trends, and reviews that feel more like sales pitches than genuine advice.', 'nestnthrive' ); ?>
                </p>
                <p>
                    <?php esc_html_e( 'We believed there was a need for a quieter corner of the internet. A place that prioritizes functionality over flashiness, and longevity over the latest fad.', 'nestnthrive' ); ?>
                </p>
                <p>
                    <?php esc_html_e( 'Nest N Thrive exists to solve the paradox of choice in the home space. We don\'t want to show you every option—we want to show you the right ones. Our goal is to help you make one good decision and then get back to living your life.', 'nestnthrive' ); ?>
                </p>
            </div>
            
            <div class="nnt-about-quote">
                <div class="nnt-about-quote__line"></div>
                <p class="nnt-about-quote__text"><?php esc_html_e( '"Your home should support your life—not compete with it."', 'nestnthrive' ); ?></p>
            </div>
        </div>
    </section>

    <!-- HOW WE CURATE -->
    <section class="nnt-section nnt-section--white nnt-section--about-values">
        <div class="nnt-container">
            <div class="nnt-about-values-header">
                <h2 class="nnt-section__title"><?php esc_html_e( 'How We Curate', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( 'We take a research-first approach to every guide and collection.', 'nestnthrive' ); ?></p>
            </div>
            
            <div class="nnt-about-values-grid">
                <div class="nnt-about-value">
                    <div class="nnt-about-value__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    </div>
                    <h3 class="nnt-about-value__title"><?php esc_html_e( 'Function Over Hype', 'nestnthrive' ); ?></h3>
                    <p class="nnt-about-value__text">
                        <?php esc_html_e( 'A product might look good on Instagram, but does it work on a Tuesday morning? We prioritize ergonomics, durability, and practical utility above pure aesthetics.', 'nestnthrive' ); ?>
                    </p>
                </div>
                
                <div class="nnt-about-value">
                    <div class="nnt-about-value__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="3" x2="6" y2="15"></line><circle cx="18" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><path d="M18 9a9 9 0 0 1-9 9"></path></svg>
                    </div>
                    <h3 class="nnt-about-value__title"><?php esc_html_e( 'Fewer, Better Choices', 'nestnthrive' ); ?></h3>
                    <p class="nnt-about-value__text">
                        <?php esc_html_e( 'Decision fatigue is real. Instead of listing "The Top 50 Sofas," we do the heavy lifting to narrow the field down to the few that truly matter for different needs.', 'nestnthrive' ); ?>
                    </p>
                </div>
                
                <div class="nnt-about-value">
                    <div class="nnt-about-value__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <h3 class="nnt-about-value__title"><?php esc_html_e( 'Designed for Longevity', 'nestnthrive' ); ?></h3>
                    <p class="nnt-about-value__text">
                        <?php esc_html_e( 'We favor items and ideas that age gracefully. We look for materials that last and design principles that won\'t feel outdated in six months.', 'nestnthrive' ); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT WE COVER -->
    <section class="nnt-section nnt-section--about-coverage">
        <div class="nnt-container">
            <div class="nnt-about-coverage">
                <div class="nnt-about-coverage__content">
                    <h2 class="nnt-section__title"><?php esc_html_e( 'What You\'ll Find Here', 'nestnthrive' ); ?></h2>
                    <p class="nnt-section__subtitle">
                        <?php esc_html_e( 'Our content is organized to match how you actually think about your home—whether you\'re tackling a specific room or trying to achieve a specific feeling.', 'nestnthrive' ); ?>
                    </p>
                    
                    <ul class="nnt-about-coverage__list">
                        <li>
                            <div class="nnt-about-coverage__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            </div>
                            <div>
                                <h4><?php esc_html_e( 'Room Guides', 'nestnthrive' ); ?></h4>
                                <p><?php esc_html_e( 'Deep dives into equipping specific spaces like Home Offices, Living Rooms, and Entryways.', 'nestnthrive' ); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="nnt-about-coverage__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                            </div>
                            <div>
                                <h4><?php esc_html_e( 'Goal-Based Collections', 'nestnthrive' ); ?></h4>
                                <p><?php esc_html_e( 'Curations centered on outcomes, such as "Improving Focus," "Better Sleep," or "Reducing Clutter."', 'nestnthrive' ); ?></p>
                            </div>
                        </li>
                        <li>
                            <div class="nnt-about-coverage__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            </div>
                            <div>
                                <h4><?php esc_html_e( 'Practical How-Tos', 'nestnthrive' ); ?></h4>
                                <p><?php esc_html_e( 'Step-by-step instructions on setting up ergonomics, lighting, and organization systems.', 'nestnthrive' ); ?></p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="nnt-about-coverage__image">
                    <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&q=80&w=1000" alt="<?php esc_attr_e( 'Calm Interior', 'nestnthrive' ); ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- TRANSPARENCY -->
    <section class="nnt-section nnt-section--dark nnt-section--about-funding">
        <div class="nnt-container nnt-container--narrow">
            <div class="nnt-about-funding">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nnt-about-funding__icon"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10"></polyline></svg>
                <h2 class="nnt-about-funding__title"><?php esc_html_e( 'How We Are Funded', 'nestnthrive' ); ?></h2>
                <div class="nnt-about-funding__content">
                    <p>
                        <?php esc_html_e( 'Transparency is the foundation of our relationship with you. Nest N Thrive is reader-supported. This means that when you purchase something through links on our site, we may earn an affiliate commission.', 'nestnthrive' ); ?>
                    </p>
                    <p>
                        <?php esc_html_e( 'However, our recommendations are never bought. We do not accept payment for favorable reviews, and we do not allow brands to influence our editorial content. If a product is recommended here, it is because we believe it adds genuine value to your home.', 'nestnthrive' ); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PAGE CONTENT (from editor) -->
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if ( get_the_content() ) : ?>
            <section class="nnt-section nnt-section--page-content">
                <div class="nnt-container nnt-container--narrow">
                    <div class="nnt-about-prose entry-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <!-- CLOSING CTA -->
    <section class="nnt-section nnt-section--white nnt-section--newsletter">
        <div class="nnt-container nnt-container--narrow">
            <?php
            get_template_part( 'template-parts/components/newsletter-form', null, array(
                'style'    => 'centered',
                'title'    => __( 'Build a better space, slowly.', 'nestnthrive' ),
                'subtitle' => __( 'Join our newsletter for a bi-weekly dose of calm design inspiration and practical upgrades. No spam, just clarity.', 'nestnthrive' ),
            ) );
            ?>
        </div>
    </section>
    
</main>

<?php
get_footer();
