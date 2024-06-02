/**
 * WordPress dependencies
 */
import { useState, useEffect } from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

const usePixelArtData = () => {
	const [ pixelArtData, setPixelArtData ] = useState( null );
	const [ isLoading, setIsLoading ] = useState( false );
	const [ error, setError ] = useState( null );

	useEffect( () => {
		const fetchPixelArtData = async () => {
			setIsLoading( true );
			try {
				const response = await apiFetch( { path: 'pad/v1/pixel-art' } );
				setPixelArtData( response );
			} catch ( error ) {
				setError( error );
			} finally {
				setIsLoading( false );
			}
		};

		fetchPixelArtData();
	}, [] );
	return { pixelArtData, isLoading, error };
};

export default usePixelArtData;
