<?php
/**
 * FAQ block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$question = isset( $attributes['question'] ) ? $attributes['question'] : '';
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-faq' ) );
?>
<div <?php echo $wrapper_attributes; ?> itemscope itemtype="https://schema.org/Question">
    <h4 class="nnt-faq__question" itemprop="name"><?php echo esc_html( $question ); ?></h4>
    <div class="nnt-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text">
            <?php echo $content; ?>
        </div>
    </div>
</div>

