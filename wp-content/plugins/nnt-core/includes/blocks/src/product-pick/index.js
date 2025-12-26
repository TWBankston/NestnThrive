/**
 * Product Pick Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { PanelBody, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/product-pick', {
    edit: ( { attributes, setAttributes } ) => {
        const { productName, productUrl, badge, imageUrl, imageId } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-product-pick',
        } );

        const onSelectImage = ( media ) => {
            setAttributes( {
                imageUrl: media.url,
                imageId: media.id,
            } );
        };

        const onRemoveImage = () => {
            setAttributes( {
                imageUrl: '',
                imageId: undefined,
            } );
        };

        return (
            <>
                <InspectorControls>
                    <PanelBody title={ __( 'Product Settings', 'nnt-core' ) }>
                        <TextControl
                            label={ __( 'Product Name', 'nnt-core' ) }
                            value={ productName }
                            onChange={ ( value ) => setAttributes( { productName: value } ) }
                        />
                        <TextControl
                            label={ __( 'Product URL', 'nnt-core' ) }
                            value={ productUrl }
                            onChange={ ( value ) => setAttributes( { productUrl: value } ) }
                            type="url"
                        />
                        <TextControl
                            label={ __( 'Badge (e.g., "Best Value")', 'nnt-core' ) }
                            value={ badge }
                            onChange={ ( value ) => setAttributes( { badge: value } ) }
                        />
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={ onSelectImage }
                                allowedTypes={ [ 'image' ] }
                                value={ imageId }
                                render={ ( { open } ) => (
                                    <div>
                                        { imageUrl ? (
                                            <>
                                                <img src={ imageUrl } alt="" style={ { maxWidth: '100%', marginBottom: '10px' } } />
                                                <Button onClick={ onRemoveImage } isDestructive>
                                                    { __( 'Remove Image', 'nnt-core' ) }
                                                </Button>
                                            </>
                                        ) : (
                                            <Button onClick={ open } variant="secondary">
                                                { __( 'Select Image', 'nnt-core' ) }
                                            </Button>
                                        ) }
                                    </div>
                                ) }
                            />
                        </MediaUploadCheck>
                    </PanelBody>
                </InspectorControls>
                <div { ...blockProps }>
                    { badge && <span className="nnt-product-pick__badge">{ badge }</span> }
                    { imageUrl && (
                        <div className="nnt-product-pick__image">
                            <img src={ imageUrl } alt={ productName } />
                        </div>
                    ) }
                    <h4 className="nnt-product-pick__name">
                        { productName || __( 'Product Name', 'nnt-core' ) }
                    </h4>
                    <div className="nnt-product-pick__description">
                        <InnerBlocks
                            allowedBlocks={ [ 'core/paragraph' ] }
                            template={ [ [ 'core/paragraph', { placeholder: __( 'Describe this product...', 'nnt-core' ) } ] ] }
                        />
                    </div>
                </div>
            </>
        );
    },

    save: () => {
        return (
            <div { ...useBlockProps.save() }>
                <InnerBlocks.Content />
            </div>
        );
    },
} );

