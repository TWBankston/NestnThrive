<?php
/**
 * Breadcrumbs Component - V2 Aura
 *
 * @package NestNThrive
 * 
 * @param array $items Array of breadcrumb items with 'label' and optional 'url'.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = $args['items'] ?? array();

if ( empty( $items ) ) {
    // Build default breadcrumbs
    $items[] = array(
        'label' => __( 'Home', 'nestnthrive' ),
        'url'   => home_url( '/' ),
    );
    
    if ( is_singular() ) {
        $post_type = get_post_type();
        $post_type_obj = get_post_type_object( $post_type );
        
        if ( $post_type_obj && $post_type !== 'page' ) {
            $items[] = array(
                'label' => $post_type_obj->labels->name,
                'url'   => get_post_type_archive_link( $post_type ),
            );
        }
        
        $items[] = array(
            'label' => get_the_title(),
        );
    } elseif ( is_post_type_archive() ) {
        $post_type_obj = get_queried_object();
        if ( $post_type_obj ) {
            $items[] = array(
                'label' => $post_type_obj->labels->name,
            );
        }
    }
}
?>
<nav class="nnt-breadcrumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'nestnthrive' ); ?>">
    <?php foreach ( $items as $index => $item ) : ?>
        <?php if ( $index > 0 ) : ?>
            <i data-lucide="chevron-right" style="width: 0.75rem; height: 0.75rem;"></i>
        <?php endif; ?>
        
        <?php if ( isset( $item['url'] ) && $item['url'] ) : ?>
            <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
        <?php else : ?>
            <span class="nnt-breadcrumbs__current"><?php echo esc_html( $item['label'] ); ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</nav>

