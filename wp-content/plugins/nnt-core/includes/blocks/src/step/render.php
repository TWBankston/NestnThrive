<?php
/**
 * Step block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$step_number = isset( $attributes['stepNumber'] ) ? $attributes['stepNumber'] : 1;
$title = isset( $attributes['title'] ) ? $attributes['title'] : '';
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-step' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="nnt-step__number"><?php echo esc_html( $step_number ); ?></div>
    <div class="nnt-step__content">
        <?php if ( $title ) : ?>
            <h4 class="nnt-step__title"><?php echo esc_html( $title ); ?></h4>
        <?php endif; ?>
        <div class="nnt-step__body">
            <?php echo $content; ?>
        </div>
    </div>
</div>

