/**
 * Comparison Table Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/comparison-table', {
    edit: ( { attributes, setAttributes } ) => {
        const { title } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-comparison-table',
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
                    { title && <h3 className="nnt-comparison-table__title">{ title }</h3> }
                    <div className="nnt-comparison-table__wrapper">
                        <InnerBlocks
                            allowedBlocks={ [ 'core/table' ] }
                            template={ [ [ 'core/table' ] ] }
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

