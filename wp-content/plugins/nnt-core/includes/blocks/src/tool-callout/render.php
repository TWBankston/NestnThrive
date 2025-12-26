<?php
/**
 * Tool Callout block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$tool_name = isset( $attributes['toolName'] ) ? $attributes['toolName'] : '';
$tool_url = isset( $attributes['toolUrl'] ) ? $attributes['toolUrl'] : '';
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-tool-callout' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $tool_name ) : ?>
        <h4 class="nnt-tool-callout__name">
            <?php if ( $tool_url ) : ?>
                <a href="<?php echo esc_url( $tool_url ); ?>" target="_blank" rel="noopener">
                    <?php echo esc_html( $tool_name ); ?>
                </a>
            <?php else : ?>
                <?php echo esc_html( $tool_name ); ?>
            <?php endif; ?>
        </h4>
    <?php endif; ?>
    <div class="nnt-tool-callout__description">
        <?php echo $content; ?>
    </div>
</div>

