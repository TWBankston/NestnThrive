/**
 * FAQ Block
 */
import { registerBlockType } from '@wordpress/blocks';
import { RichText, InnerBlocks, useBlockProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

registerBlockType( 'nnt/faq', {
    edit: ( { attributes, setAttributes } ) => {
        const { question } = attributes;
        const blockProps = useBlockProps( {
            className: 'nnt-faq',
        } );

        return (
            <div { ...blockProps }>
                <RichText
                    tagName="h4"
                    className="nnt-faq__question"
                    value={ question }
                    onChange={ ( value ) => setAttributes( { question: value } ) }
                    placeholder={ __( 'Enter the question...', 'nnt-core' ) }
                />
                <div className="nnt-faq__answer">
                    <InnerBlocks
                        allowedBlocks={ [ 'core/paragraph', 'core/list' ] }
                        template={ [ [ 'core/paragraph', { placeholder: __( 'Enter the answer...', 'nnt-core' ) } ] ] }
                    />
                </div>
            </div>
        );
    },

    save: ( { attributes } ) => {
        const { question } = attributes;
        const blockProps = useBlockProps.save();

        return (
            <div { ...blockProps }>
                <RichText.Content tagName="h4" className="nnt-faq__question" value={ question } />
                <div className="nnt-faq__answer">
                    <InnerBlocks.Content />
                </div>
            </div>
        );
    },
} );

