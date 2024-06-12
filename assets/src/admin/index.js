/**
 * WordPress dependencies
 */
import { createRoot, useState, useCallback, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';
import { __, sprintf } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { colors, usePixelArtData } from '../../util';
import './admin.css';

/**
 * Admin component for managing pixel art.
 */
const PixelArtAdmin = () => {
	const [ selectedColor, setSelectedColor ] = useState( colors[ 0 ] );
	const { pixelArtData, pixelArtDataError } = usePixelArtData();
	const [ pixels, setPixels ] = useState( Array( 16 * 16 ).fill( 'transparent' ) );
	const [ isSaved, setIsSaved ] = useState( true );
	const [ isNotification, setIsNotification ] = useState( false );

	// State for drawing mode
	const [ isDrawing, setIsDrawing ] = useState( false );

	// Callback function to handle clicking on a pixel
	const handlePixelClick = useCallback( ( index ) => {
		const newPixels = [ ...pixels ];
		newPixels[ index ] = selectedColor;
		setPixels( newPixels );
		setIsSaved( false );
	}, [ selectedColor, pixels ] );

	// Effect hook to handle loading pixel data from the server
	useEffect( () => {
		if ( pixelArtData ) {
			const parsedData = JSON.parse( pixelArtData );
			setPixels( parsedData );
		}

		if ( pixelArtDataError ) {
			setIsNotification( pixelArtDataError?.message );
		}
	}, [ pixelArtData, pixelArtDataError ] );

	// Function to handle saving pixel data to the server
	const handleSave = async () => {
		const query = {
			option: JSON.stringify( pixels ),
		};

		try {
			await apiFetch( {
				path: addQueryArgs( 'pad/v1/pixel-art', query ),
				method: 'POST',
			} );
			setIsSaved( true );
		} catch ( error ) {
			setIsNotification( error?.message );
		}
	};

	// Callback function to handle dragging over pixels
	const handlePixelDrag = useCallback( ( index ) => {
		if ( isDrawing ) {
			handlePixelClick( index );
		}
	}, [ isDrawing, handlePixelClick ] );

	// Callback function to handle mouse down event
	const handleMouseDown = useCallback( () => {
		setIsDrawing( true );
	}, [] );

	// Callback function to handle mouse up event
	const handleMouseUp = useCallback( () => {
		setIsDrawing( false );
	}, [] );

	// Effect hook to handle mouse up event outside the grid
	useEffect( () => {
		const handleMouseUpOutsideGrid = () => {
			setIsDrawing( false );
		};

		document.addEventListener( 'mouseup', handleMouseUpOutsideGrid );

		return () => {
			document.removeEventListener( 'mouseup', handleMouseUpOutsideGrid );
		};
	}, [] );

	// Render the component
	return (
		<div className="pixel-art-container">
			<h3>{ __( 'Pixel Art Drawing', 'rbl-pixel-art' ) }</h3>
			<span>{ __( 'Choose the color below and start the drawing!', 'rbl-pixel-art' ) }</span>
			<div className="pixel-art-colors">
				{ colors.map( ( color, index ) => (
					<button
						key={ index }
						style={ { backgroundColor: color } }
						className={ color === selectedColor ? 'selected' : '' }
						onClick={ () => setSelectedColor( color ) }
						aria-label={ sprintf(
						/* translators: 1: Color name;*/
							__(
								'Select color %1$s',
								'rbl-pixel-art',
							),
							color,
						) }
					/>
				) ) }
			</div>
			<div className="pixel-art-grid" onMouseDown={ handleMouseDown } onMouseUp={ handleMouseUp }>
				{ pixels.map( ( color, index ) => (
					<div
						key={ index }
						className="pixel-art-pixel"
						style={ { backgroundColor: color } }
						onClick={ () => handlePixelClick( index ) }
						onMouseEnter={ () => handlePixelDrag( index ) }
						onKeyDown={ ( e ) => {
							if ( e.key === 'Enter' || e.key === ' ' ) {
								handlePixelClick( index );
							}
						} }
						onContextMenu={ ( e ) => {
							e.preventDefault();
							setSelectedColor( color );
						} }
						role="button"
						tabIndex={ 0 }
						aria-label={ sprintf(
						/* translators: 1: Pixel offset; 2: Color name;*/
							__(
								'Pixel %1$s color %2$s',
								'rbl-pixel-art',
							),
							index,
							color,
						) }
					/>
				) ) }
			</div>
			<button onClick={ handleSave } disabled={ isSaved }>{ __( 'Save', 'rbl-pixel-art' ) }</button>
			{ isNotification && (
				<div className="pixel-art-notification">
					{ isNotification }
				</div>
			) }
		</div>
	);
};

// Create a root for rendering the component
const root = createRoot( document.getElementById( 'pixel-art-admin-app' ) );
root.render( <PixelArtAdmin /> );
