/**
 * WordPress dependencies
 */
import { useBlockProps,
	InspectorControls,
} from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import {
	PanelBody,
	RangeControl,
} from '@wordpress/components';
import { __ } from '@wordpress/i18n';

/**
 * Edit function for the Pixel Art block.
 *
 * This function is responsible for rendering the block in the block editor.
 * It provides UI controls for adjusting the block's attributes.
 *
 * @param {Object}   props               - The properties passed to the component.
 * @param {Object}   props.attributes    - The attributes of the block.
 * @param {Function} props.setAttributes - Function to update the block's attributes.
 * @return {JSX.Element} The rendered block editor UI.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { size } = attributes;
	const blockProps = useBlockProps();

	return (
		<div { ...blockProps }>
			<InspectorControls>
				<PanelBody title={ __( 'Pixel Art Settings', 'rbl-pixel-art' ) }>
					<RangeControl
						label="Size"
						value={ size }
						onChange={ ( newSize ) => setAttributes( { size: newSize } ) }
						min={ 64 }
						max={ 512 }
					/>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block="rbl/pixel-art" attributes={ { size } } />
		</div>
	);
}
