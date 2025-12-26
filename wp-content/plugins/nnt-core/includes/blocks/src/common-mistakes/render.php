<?php
/**
 * Common Mistakes block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Common Mistakes to Avoid', 'nnt-core' );
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-common-mistakes' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <h3 class="nnt-common-mistakes__title"><?php echo esc_html( $title ); ?></h3>
    <div class="nnt-common-mistakes__content">
        <?php echo $content; ?>
    </div>
</div>

