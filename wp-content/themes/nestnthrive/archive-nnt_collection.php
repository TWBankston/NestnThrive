<?php
/**
 * Collection Archive Template
 *
 * @package NestNThrive
 */

get_header();
?>

<!-- Hero Section -->
<section class="nnt-section nnt-section--hero nnt-archive-hero">
    <div class="nnt-container">
        <div class="nnt-archive-hero__content">
            <h1 class="nnt-archive-hero__title"><?php esc_html_e( 'Collections', 'nestnthrive' ); ?></h1>
            <p class="nnt-archive-hero__subtitle">
                <?php esc_html_e( 'Curated product roundups to simplify your shopping and help you find the best options.', 'nestnthrive' ); ?>
            </p>
        </div>
    </div>
</section>

<!-- Filter by Room/Goal -->
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

<!-- Collections Grid -->
<section class="nnt-section">
    <div class="nnt-container">
        <?php if ( have_posts() ) : ?>
            <div class="nnt-card-grid nnt-card-grid--3">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/components/card', null, array(
                        'post' => get_post(),
                        'type' => 'nnt_collection',
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
            <p class="nnt-no-content"><?php esc_html_e( 'No collections found.', 'nestnthrive' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();

