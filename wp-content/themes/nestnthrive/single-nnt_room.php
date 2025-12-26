<?php
/**
 * Single Room Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$post_id        = get_the_ID();
$title          = get_the_title();
$excerpt        = get_the_excerpt();
$image_id       = get_post_thumbnail_id();
$featured_cols  = nnt_get_featured_items( $post_id, 'nnt_featured_collections', 'nnt_collection' );
$featured_guides = nnt_get_featured_items( $post_id, 'nnt_featured_guides', 'nnt_guide' );
$featured_goals = nnt_get_featured_terms( $post_id, 'nnt_featured_goals', 'nnt_goal_tax' );
$all_guides     = nnt_get_guides_for_room( get_post(), 4 );
$other_rooms    = nnt_get_other_rooms( $post_id, 4 );
?>

<!-- HERO -->
<section class="nnt-section nnt-section--hero" style="overflow: hidden;">
    <div class="nnt-container">
        <div class="nnt-hero">
            <div class="nnt-hero__content nnt-reveal">
                <?php
                get_template_part( 'template-parts/components/breadcrumbs-v2', null, array(
                    'items' => array(
                        array( 'label' => __( 'Home', 'nestnthrive' ), 'url' => home_url( '/' ) ),
                        array( 'label' => __( 'Spaces', 'nestnthrive' ), 'url' => get_post_type_archive_link( 'nnt_room' ) ),
                        array( 'label' => $title ),
                    ),
                ) );
                ?>
                
                <h1 class="nnt-hero__title"><?php echo esc_html( sprintf( __( 'The %s', 'nestnthrive' ), $title ) ); ?></h1>
                
                <?php if ( $excerpt ) : ?>
                <p class="nnt-hero__desc"><?php echo esc_html( $excerpt ); ?></p>
                <?php endif; ?>
                
                <div class="nnt-hero__actions">
                    <a href="#reviews" class="nnt-btn nnt-btn--primary">
                        <?php esc_html_e( 'Browse Reviews', 'nestnthrive' ); ?>
                    </a>
                    <a href="#guides" class="nnt-btn nnt-btn--secondary">
                        <?php esc_html_e( 'See Setup Guides', 'nestnthrive' ); ?>
                    </a>
                </div>
            </div>

            <div class="nnt-hero__image nnt-reveal nnt-delay-200 group">
                <?php if ( $image_id ) : ?>
                    <?php echo wp_get_attachment_image( $image_id, 'nnt-hero', false, array( 'class' => 'nnt-img-zoom' ) ); ?>
                <?php else : ?>
                    <div style="width: 100%; height: 100%; background: var(--nnt-stone-200);"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ESSENTIAL UPGRADES -->
<?php if ( ! empty( $featured_cols ) ) : ?>
<section id="reviews" class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-reveal">
            <h2 class="nnt-section__title"><?php echo esc_html( sprintf( __( 'Essential Upgrades for the %s', 'nestnthrive' ), $title ) ); ?></h2>
            <p class="nnt-section__subtitle nnt-mb-12"><?php esc_html_e( 'The foundational gear we\'ve tested and rely on daily.', 'nestnthrive' ); ?></p>
        </div>

        <div class="nnt-grid nnt-grid--3">
            <?php foreach ( $featured_cols as $col ) : ?>
                <div class="nnt-reveal nnt-delay-100">
                    <?php get_template_part( 'template-parts/components/card-review', null, array( 'post' => $col ) ); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- IMPROVE BY GOAL -->
<?php if ( ! empty( $featured_goals ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Improve This Room by Goal', 'nestnthrive' ); ?></h2>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $featured_goals as $goal_term ) : 
                // Find matching goal post
                $goal_posts = get_posts( array(
                    'post_type'      => 'nnt_goal',
                    'name'           => $goal_term->slug,
                    'posts_per_page' => 1,
                ) );
                if ( ! empty( $goal_posts ) ) :
            ?>
                <?php get_template_part( 'template-parts/components/card-goal', null, array( 'post' => $goal_posts[0] ) ); ?>
            <?php 
                endif;
            endforeach; 
            ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- GUIDES TO GET IT RIGHT -->
<?php if ( ! empty( $featured_guides ) ) : ?>
<section id="guides" class="nnt-section nnt-section--white">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Guides to Get It Right', 'nestnthrive' ); ?></h2>
            <a href="#all-guides" class="nnt-section__link"><?php esc_html_e( 'See all guides', 'nestnthrive' ); ?></a>
        </div>

        <div class="nnt-grid nnt-grid--3 nnt-reveal nnt-delay-100">
            <?php foreach ( $featured_guides as $guide ) : ?>
                <?php get_template_part( 'template-parts/components/card-guide', null, array( 'post' => $guide ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ALL GUIDES -->
<?php if ( ! empty( $all_guides ) ) : ?>
<section id="all-guides" class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-reveal" style="border-bottom: 1px solid var(--nnt-stone-200); padding-bottom: 1rem; margin-bottom: 3rem;">
            <h2 class="nnt-section__title"><?php echo esc_html( sprintf( __( 'All %s Guides', 'nestnthrive' ), $title ) ); ?></h2>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $all_guides as $guide ) : ?>
                <a href="<?php echo esc_url( get_permalink( $guide ) ); ?>" class="group" style="text-decoration: none;">
                    <div style="aspect-ratio: 3/2; border-radius: 0.75rem; overflow: hidden; background: var(--nnt-stone-200); margin-bottom: 0.75rem;" class="nnt-img-zoom-container">
                        <?php echo get_the_post_thumbnail( $guide, 'nnt-card', array( 'class' => 'nnt-img-zoom', 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
                    </div>
                    <div style="font-size: 0.625rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--nnt-stone-400); margin-bottom: 0.25rem;">
                        <?php echo esc_html( $title ); ?>
                    </div>
                    <h3 style="font-size: 1rem; font-weight: 500; color: var(--nnt-stone-900); transition: color 0.2s;"><?php echo esc_html( get_the_title( $guide ) ); ?></h3>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- EXPLORE OTHER SPACES -->
<?php if ( ! empty( $other_rooms ) ) : ?>
<section class="nnt-section nnt-section--white" style="border-top: 1px solid var(--nnt-stone-100);">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <div>
                <h2 class="nnt-section__title"><?php esc_html_e( 'Explore Other Spaces', 'nestnthrive' ); ?></h2>
                <p class="nnt-section__subtitle"><?php esc_html_e( "Inspiration doesn't stop at the office.", 'nestnthrive' ); ?></p>
            </div>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $other_rooms as $room ) : ?>
                <?php get_template_part( 'template-parts/components/card-space', null, array( 'post' => $room, 'size' => 'small' ) ); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- TRUST BLOCK -->
<?php get_template_part( 'template-parts/components/trust-block' ); ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
