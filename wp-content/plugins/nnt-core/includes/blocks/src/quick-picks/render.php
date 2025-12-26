<?php
/**
 * Quick Picks block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Quick Picks', 'nnt-core' );
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-quick-picks' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <h3 class="nnt-quick-picks__title"><?php echo esc_html( $title ); ?></h3>
    <div class="nnt-quick-picks__grid">
        <?php echo $content; ?>
    </div>
</div>

