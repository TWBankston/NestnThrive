/**
 * Tool Callout Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/tool-callout', {
    edit: ( { attributes, setAttributes } ) => {
        const { toolName, toolUrl } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-tool-callout',
        } );

        return (
            <>
                <InspectorControls>
                    <PanelBody title={ __( 'Settings', 'nnt-core' ) }>
                        <TextControl
                            label={ __( 'Tool Name', 'nnt-core' ) }
                            value={ toolName }
                            onChange={ ( value ) => setAttributes( { toolName: value } ) }
                        />
                        <TextControl
                            label={ __( 'Tool URL', 'nnt-core' ) }
                            value={ toolUrl }
                            onChange={ ( value ) => setAttributes( { toolUrl: value } ) }
                            type="url"
                        />
                    </PanelBody>
                </InspectorControls>
                <div { ...blockProps }>
                    { toolName && (
                        <h4 className="nnt-tool-callout__name">
                            { toolUrl ? (
                                <a href={ toolUrl } target="_blank" rel="noopener">
                                    { toolName }
                                </a>
                            ) : (
                                toolName
                            ) }
                        </h4>
                    ) }
                    <div className="nnt-tool-callout__description">
                        <InnerBlocks
                            allowedBlocks={ [ 'core/paragraph' ] }
                            template={ [ [ 'core/paragraph', { placeholder: __( 'Describe this tool...', 'nnt-core' ) } ] ] }
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

