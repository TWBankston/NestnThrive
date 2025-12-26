/**
 * Step Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { RichText, InnerBlocks, useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, __experimentalNumberControl as NumberControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/step', {
    edit: ( { attributes, setAttributes } ) => {
        const { stepNumber, title } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-step',
        } );

        return (
            <>
                <InspectorControls>
                    <PanelBody title={ __( 'Settings', 'nnt-core' ) }>
                        <NumberControl
                            label={ __( 'Step Number', 'nnt-core' ) }
                            value={ stepNumber }
                            onChange={ ( value ) => setAttributes( { stepNumber: parseInt( value, 10 ) } ) }
                            min={ 1 }
                        />
                        <TextControl
                            label={ __( 'Title', 'nnt-core' ) }
                            value={ title }
                            onChange={ ( value ) => setAttributes( { title: value } ) }
                        />
                    </PanelBody>
                </InspectorControls>
                <div { ...blockProps }>
                    <div className="nnt-step__number">{ stepNumber }</div>
                    <div className="nnt-step__content">
                        { title && <h4 className="nnt-step__title">{ title }</h4> }
                        <div className="nnt-step__body">
                            <InnerBlocks
                                allowedBlocks={ [ 'core/paragraph', 'core/list', 'core/image' ] }
                                template={ [ [ 'core/paragraph' ] ] }
                            />
                        </div>
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

