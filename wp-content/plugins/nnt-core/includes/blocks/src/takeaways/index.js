/**
 * Takeaways Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { RichText, InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/takeaways', {
    edit: ( { attributes, setAttributes } ) => {
        const { title } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-takeaways',
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
                    <h3 className="nnt-takeaways__title">{ title }</h3>
                    <div className="nnt-takeaways__content">
                        <InnerBlocks
                            allowedBlocks={ [ 'core/list', 'core/paragraph' ] }
                            template={ [ [ 'core/list' ] ] }
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

