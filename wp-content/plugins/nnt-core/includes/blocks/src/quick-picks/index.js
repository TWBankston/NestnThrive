/**
 * Quick Picks Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/quick-picks', {
    edit: ( { attributes, setAttributes } ) => {
        const { title } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-quick-picks',
        } );

        return (
            <>
                <InspectorControls>
                    <PanelBody title={ __( 'Settings', 'nnt-core' ) }>
                        <TextControl
                            label={ __( 'Title', 'nnt-core' ) }
                            value={ title }
                            onChange={ ( value ) => setAttributes( { title: value } ) }
                        />
                    </PanelBody>
                </InspectorControls>
                <div { ...blockProps }>
                    <h3 className="nnt-quick-picks__title">{ title }</h3>
                    <div className="nnt-quick-picks__grid">
                        <InnerBlocks
                            allowedBlocks={ [ 'nnt/product-pick' ] }
                            template={ [ [ 'nnt/product-pick' ], [ 'nnt/product-pick' ], [ 'nnt/product-pick' ] ] }
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

