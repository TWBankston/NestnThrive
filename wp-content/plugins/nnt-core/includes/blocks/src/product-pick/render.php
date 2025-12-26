<?php
/**
 * Product Pick block render template.
 *
 * @package NNT_Core
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

$product_name = isset( $attributes['productName'] ) ? $attributes['productName'] : '';
$product_url = isset( $attributes['productUrl'] ) ? $attributes['productUrl'] : '';
$badge = isset( $attributes['badge'] ) ? $attributes['badge'] : '';
$image_url = isset( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : '';
$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'nnt-product-pick' ) );
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php if ( $badge ) : ?>
        <span class="nnt-product-pick__badge"><?php echo esc_html( $badge ); ?></span>
    <?php endif; ?>
    
    <?php if ( $image_url ) : ?>
        <div class="nnt-product-pick__image">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product_name ); ?>" loading="lazy" />
        </div>
    <?php endif; ?>
    
    <h4 class="nnt-product-pick__name">
        <?php if ( $product_url ) : ?>
            <a href="<?php echo esc_url( $product_url ); ?>" target="_blank" rel="noopener sponsored">
                <?php echo esc_html( $product_name ); ?>
            </a>
        <?php else : ?>
            <?php echo esc_html( $product_name ); ?>
        <?php endif; ?>
    </h4>
    
    <div class="nnt-product-pick__description">
        <?php echo $content; ?>
    </div>
</div>

