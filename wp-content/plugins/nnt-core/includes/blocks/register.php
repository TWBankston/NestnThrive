<?php
/**
 * Register Gutenberg blocks.
 *
 * @package NNT_Core
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register all NNT blocks.
 */
function nnt_register_blocks() {
    $blocks = array(
        'takeaways',
        'step',
        'tool-callout',
        'common-mistakes',
        'faq',
        'quick-picks',
        'product-pick',
        'comparison-table',
    );

    foreach ( $blocks as $block ) {
        $block_path = NNT_CORE_PLUGIN_DIR . 'includes/blocks/src/' . $block;
        
        if ( file_exists( $block_path . '/block.json' ) ) {
            register_block_type( $block_path );
        }
    }
}
add_action( 'init', 'nnt_register_blocks' );

/**
 * Server-side render callback for takeaways block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_takeaways_block( $attributes, $content ) {
    $title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Key Takeaways', 'nnt-core' );
    
    ob_start();
    ?>
    <div class="nnt-takeaways">
        <h3 class="nnt-takeaways__title"><?php echo esc_html( $title ); ?></h3>
        <div class="nnt-takeaways__content">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for step block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_step_block( $attributes, $content ) {
    $step_number = isset( $attributes['stepNumber'] ) ? $attributes['stepNumber'] : 1;
    $title       = isset( $attributes['title'] ) ? $attributes['title'] : '';
    
    ob_start();
    ?>
    <div class="nnt-step">
        <div class="nnt-step__number"><?php echo esc_html( $step_number ); ?></div>
        <div class="nnt-step__content">
            <?php if ( $title ) : ?>
                <h4 class="nnt-step__title"><?php echo esc_html( $title ); ?></h4>
            <?php endif; ?>
            <div class="nnt-step__body">
                <?php echo wp_kses_post( $content ); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for tool-callout block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_tool_callout_block( $attributes, $content ) {
    $tool_name = isset( $attributes['toolName'] ) ? $attributes['toolName'] : '';
    $tool_url  = isset( $attributes['toolUrl'] ) ? $attributes['toolUrl'] : '';
    
    ob_start();
    ?>
    <div class="nnt-tool-callout">
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
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for common-mistakes block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_common_mistakes_block( $attributes, $content ) {
    $title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Common Mistakes to Avoid', 'nnt-core' );
    
    ob_start();
    ?>
    <div class="nnt-common-mistakes">
        <h3 class="nnt-common-mistakes__title"><?php echo esc_html( $title ); ?></h3>
        <div class="nnt-common-mistakes__content">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for faq block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_faq_block( $attributes, $content ) {
    $question = isset( $attributes['question'] ) ? $attributes['question'] : '';
    
    ob_start();
    ?>
    <div class="nnt-faq" itemscope itemtype="https://schema.org/Question">
        <h4 class="nnt-faq__question" itemprop="name"><?php echo esc_html( $question ); ?></h4>
        <div class="nnt-faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <div itemprop="text">
                <?php echo wp_kses_post( $content ); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for quick-picks block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_quick_picks_block( $attributes, $content ) {
    $title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Quick Picks', 'nnt-core' );
    
    ob_start();
    ?>
    <div class="nnt-quick-picks">
        <h3 class="nnt-quick-picks__title"><?php echo esc_html( $title ); ?></h3>
        <div class="nnt-quick-picks__grid">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for product-pick block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_product_pick_block( $attributes, $content ) {
    $product_name = isset( $attributes['productName'] ) ? $attributes['productName'] : '';
    $product_url  = isset( $attributes['productUrl'] ) ? $attributes['productUrl'] : '';
    $badge        = isset( $attributes['badge'] ) ? $attributes['badge'] : '';
    $image_url    = isset( $attributes['imageUrl'] ) ? $attributes['imageUrl'] : '';
    
    ob_start();
    ?>
    <div class="nnt-product-pick">
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
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Server-side render callback for comparison-table block.
 *
 * @param array  $attributes Block attributes.
 * @param string $content    Block content.
 * @return string
 */
function nnt_render_comparison_table_block( $attributes, $content ) {
    $title = isset( $attributes['title'] ) ? $attributes['title'] : __( 'Product Comparison', 'nnt-core' );
    
    ob_start();
    ?>
    <div class="nnt-comparison-table">
        <?php if ( $title ) : ?>
            <h3 class="nnt-comparison-table__title"><?php echo esc_html( $title ); ?></h3>
        <?php endif; ?>
        <div class="nnt-comparison-table__wrapper">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

