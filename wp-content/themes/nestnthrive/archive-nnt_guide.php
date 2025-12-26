<?php
/**
 * Guide Archive Template
 *
 * @package NestNThrive
 */

get_header();
?>

<!-- Hero Section -->
<section class="nnt-section nnt-section--hero nnt-archive-hero">
    <div class="nnt-container">
        <div class="nnt-archive-hero__content">
            <h1 class="nnt-archive-hero__title"><?php esc_html_e( 'Guides', 'nestnthrive' ); ?></h1>
            <p class="nnt-archive-hero__subtitle">
                <?php esc_html_e( 'In-depth guides to help you make informed decisions about your home.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- Filter by Room/Goal (optional enhancement) -->
<?php
$room_terms = get_terms( array( 'taxonomy' => 'nnt_room_tax', 'hide_empty' => true ) );
$goal_terms = get_terms( array( 'taxonomy' => 'nnt_goal_tax', 'hide_empty' => true ) );
?>
<?php if ( ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) || ( ! is_wp_error( $goal_terms ) && ! empty( $goal_terms ) ) ) : ?>
<section class="nnt-section nnt-section--alt nnt-archive-filters">
    <div class="nnt-container">
        <div class="nnt-filter-bar">
            <?php if ( ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ) : ?>
                <div class="nnt-filter-group">
                    <span class="nnt-filter-group__label"><?php esc_html_e( 'By Room:', 'nestnthrive' ); ?></span>
                    <div class="nnt-filter-group__items">
                        <?php foreach ( $room_terms as $term ) : ?>
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="nnt-filter-tag">
                                <?php echo esc_html( $term->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ( ! is_wp_error( $goal_terms ) && ! empty( $goal_terms ) ) : ?>
                <div class="nnt-filter-group">
                    <span class="nnt-filter-group__label"><?php esc_html_e( 'By Goal:', 'nestnthrive' ); ?></span>
                    <div class="nnt-filter-group__items">
                        <?php foreach ( $goal_terms as $term ) : ?>
                            <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="nnt-filter-tag">
                                <?php echo esc_html( $term->name ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Guides Grid -->
<section class="nnt-section">
    <div class="nnt-container">
        <?php if ( have_posts() ) : ?>
            <div class="nnt-card-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/components/card', null, array(
                        'post' => get_post(),
                        'type' => 'nnt_guide',
                    ) );
                endwhile;
                ?>
            </div>

            <div class="nnt-pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '← Previous', 'nestnthrive' ),
                    'next_text' => __( 'Next →', 'nestnthrive' ),
                ) );
                ?>
            </div>
        <?php else : ?>
            <p class="nnt-no-content"><?php esc_html_e( 'No guides found.', 'nestnthrive' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
/* Archive-specific styles */
.nnt-archive-hero {
    background: var(--wp--preset--color--near-black);
    padding: 4rem 0;
}

.nnt-archive-hero__title {
    font-size: clamp(2rem, 5vw, 3rem);
    color: var(--wp--preset--color--off-white);
    margin-bottom: 0.5rem;
}

.nnt-archive-hero__subtitle {
    font-size: 1.125rem;
    color: var(--wp--preset--color--light-gold);
    max-width: 600px;
}

.nnt-archive-filters {
    padding: 1.5rem 0;
}

.nnt-filter-bar {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.nnt-filter-group {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.75rem;
}

.nnt-filter-group__label {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--wp--preset--color--warm-brown);
}

.nnt-filter-group__items {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.nnt-filter-tag {
    display: inline-block;
    padding: 0.375rem 0.875rem;
    background-color: var(--wp--preset--color--white);
    border: 1px solid var(--wp--preset--color--warm-gold);
    border-radius: 20px;
    font-size: 0.8125rem;
    color: var(--wp--preset--color--warm-brown);
    text-decoration: none;
    transition: all 0.2s ease;
}

.nnt-filter-tag:hover {
    background-color: var(--wp--preset--color--warm-gold);
    color: var(--wp--preset--color--near-black);
}

.nnt-pagination {
    margin-top: 3rem;
    text-align: center;
}

.nnt-pagination .nav-links {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
}

.nnt-pagination a,
.nnt-pagination span {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-size: 0.9375rem;
}

.nnt-pagination a {
    background-color: var(--wp--preset--color--white);
    color: var(--wp--preset--color--charcoal);
    text-decoration: none;
    border: 1px solid #ddd;
}

.nnt-pagination a:hover {
    background-color: var(--wp--preset--color--warm-gold);
    border-color: var(--wp--preset--color--warm-gold);
    color: var(--wp--preset--color--near-black);
}

.nnt-pagination .current {
    background-color: var(--wp--preset--color--warm-gold);
    color: var(--wp--preset--color--near-black);
}

.nnt-no-content {
    text-align: center;
    padding: 3rem;
    color: var(--wp--preset--color--warm-brown);
}
</style>

<?php
get_footer();

