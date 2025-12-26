<?php
/**
 * Single Guide Template - V2 Aura
 *
 * @package NestNThrive
 */

get_header();

$post_id      = get_the_ID();
$title        = get_the_title();
$excerpt      = get_the_excerpt();
$image_id     = get_post_thumbnail_id();
$updated_date = get_the_modified_date( 'F j, Y' );
$content      = get_the_content();
$read_time    = function_exists( 'nnt_get_reading_time' ) ? nnt_get_reading_time( $content ) : '5 min read';
$room_terms   = wp_get_post_terms( $post_id, 'nnt_room_tax' );
$room_name    = ! is_wp_error( $room_terms ) && ! empty( $room_terms ) ? $room_terms[0]->name : '';
$related      = nnt_get_related_content( $post_id, 4 );
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
                        array( 'label' => __( 'Guides', 'nestnthrive' ), 'url' => get_post_type_archive_link( 'nnt_guide' ) ),
                        array( 'label' => $title ),
                    ),
                ) );
                ?>
                
                <?php if ( $room_name ) : ?>
                <div class="nnt-hero__badge"><?php echo esc_html( $room_name ); ?></div>
                <?php endif; ?>
                
                <h1 class="nnt-hero__title"><?php echo esc_html( $title ); ?></h1>
                
                <?php if ( $excerpt ) : ?>
                <p class="nnt-hero__desc"><?php echo esc_html( $excerpt ); ?></p>
                <?php endif; ?>
                
                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-top: 1.5rem; font-size: 0.875rem; color: var(--nnt-stone-500);">
                    <span>
                        <i data-lucide="calendar" style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;"></i>
                        <?php echo esc_html( $updated_date ); ?>
                    </span>
                    <span>
                        <i data-lucide="clock" style="width: 1rem; height: 1rem; display: inline-block; vertical-align: middle; margin-right: 0.25rem;"></i>
                        <?php echo esc_html( $read_time ); ?>
                    </span>
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

<!-- CONTENT -->
<section class="nnt-section nnt-section--white">
    <div class="nnt-container nnt-container--narrow">
        <div class="nnt-content nnt-reveal">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<!-- RELATED CONTENT -->
<?php if ( ! empty( $related ) ) : ?>
<section class="nnt-section nnt-section--stone">
    <div class="nnt-container">
        <div class="nnt-section__header nnt-reveal">
            <h2 class="nnt-section__title"><?php esc_html_e( 'Keep Reading', 'nestnthrive' ); ?></h2>
        </div>

        <div class="nnt-grid nnt-grid--4 nnt-reveal nnt-delay-100">
            <?php foreach ( $related as $item ) : ?>
                <?php 
                if ( get_post_type( $item ) === 'nnt_guide' ) {
                    get_template_part( 'template-parts/components/card-guide', null, array( 'post' => $item ) );
                } else {
                    get_template_part( 'template-parts/components/card-review', null, array( 'post' => $item ) );
                }
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<?php get_template_part( 'template-parts/components/newsletter-v2' ); ?>

<?php get_footer(); ?>
