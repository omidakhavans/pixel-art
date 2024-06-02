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
						onChange={ ( size ) => setAttributes( { size } ) }
						min={ 64 }
						max={ 512 }
					/>
				</PanelBody>
			</InspectorControls>
			<ServerSideRender block="rbl/pixel-art" attributes={ { size } } />
		</div>
	);
}
