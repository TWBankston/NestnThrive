<?php
/**
 * Comparison Table block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Product Comparison', 'nnt-core' );
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-comparison-table' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $title ) : ?>
        <h3 class="nnt-comparison-table__title"><?php echo esc_html( $title ); ?></h3>
    <?php endif; ?>
    <div class="nnt-comparison-table__wrapper">
        <?php echo $content; ?>
    </div>
</div>

