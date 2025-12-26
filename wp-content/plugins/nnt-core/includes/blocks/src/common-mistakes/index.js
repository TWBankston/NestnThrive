/**
 * Common Mistakes Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/common-mistakes', {
    edit: ( { attributes, setAttributes } ) => {
        const { title } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-common-mistakes',
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
                    <h3 className="nnt-common-mistakes__title">{ title }</h3>
                    <div className="nnt-common-mistakes__content">
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

