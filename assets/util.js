/**
 * WordPress dependencies
 */
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const usePixelArtData = () => {
	const [ pixelArtData, setPixelArtData ] = useState( null );
	const [ pixelArtDataLoading, setPixelArtDataLoading ] = useState( false );
	const [ pixelArtDataError, setPixelArtDataError ] = useState( null );

	useEffect( () => {
		const fetchPixelArtData = async () => {
			setPixelArtDataLoading( true );
			try {
				const response = await apiFetch( { path: 'pad/v1/pixel-art' } );
				setPixelArtData( response );
			} catch ( pixelArtDataError ) {
				setPixelArtDataError( pixelArtDataError );
			} finally {
				setPixelArtDataLoading( false );
			}
		};

		fetchPixelArtData();
	}, [] );
	return { pixelArtData, pixelArtDataLoading, pixelArtDataError };
};

export default usePixelArtData;
