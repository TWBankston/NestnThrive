<?php
/**
 * Takeaways block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Key Takeaways', 'nnt-core' );
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-takeaways' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <h3 class="nnt-takeaways__title"><?php echo esc_html( $title ); ?></h3>
    <div class="nnt-takeaways__content">
        <?php echo $content; ?>
    </div>
</div>

