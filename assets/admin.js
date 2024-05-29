import { createRoot, useState, useCallback, useEffect } from '@wordpress/element';
import usePixelArtData from './util';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';

const colors = ['#000000', '#FFFFFF', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', 'transparent'];

const PixelArtAdmin = () => {
    const [selectedColor, setSelectedColor] = useState(colors[0]);
    const { pixelArtData, isLoading, isError } = usePixelArtData();
    const [pixels, setPixels] = useState(Array(16 * 16).fill('transparent'));
    const [isSaved, setIsSaved] = useState(true);

    const handlePixelClick = useCallback((index) => {
      const newPixels = [...pixels];
      newPixels[index] = selectedColor;
      setPixels(newPixels);
      setIsSaved(false);
  }, [selectedColor, pixels]);

  useEffect(() => {
    if (pixelArtData) {
      const parsedData = JSON.parse(pixelArtData);
      console.log(parsedData);
        setPixels(parsedData);
    }
}, [pixelArtData]);

    const handleSave = async (e) => {
      console.log(pixels);
      const query = {
        option: JSON.stringify(pixels),
      };

      try {
          const responseData = await apiFetch({
            path: addQueryArgs( 'pad/v1/pixel-art' , query),
            method: 'POST',
          });
          setIsSaved(true);
      } catch (error) {
          console.log(error);
      }
  };

    return (
        <div className="pixel-art-container">
            <div className="pixel-art-colors">
                {colors.map((color, index) => (
                    <button
                        key={index}
                        style={{ backgroundColor: color }}
                        className={color === selectedColor ? 'selected' : ''}
                        onClick={() => setSelectedColor(color)}
                        aria-label={`Select color ${color}`}
                    />
                ))}
            </div>
            <div className="pixel-art-grid">
                {pixels.map((color, index) => (
                  <>
                    {console.log(pixels)}
                    <div
                        key={index}
                        className="pixel-art-pixel"
                        style={{ backgroundColor: color }}
                        onClick={() => handlePixelClick(index)}
                        onContextMenu={(e) => {
                            e.preventDefault();
                            setSelectedColor(color);
                        }}
                        role="button"
                        tabIndex={0}
                        aria-label={`Pixel ${index + 1} color ${color}`}
                    />
                                      </>

                ))}
            </div>
            <button onClick={handleSave} disabled={isSaved}>Save</button>
          </div>
    );
};

const root = createRoot( document.getElementById('pixel-art-admin-app') );
root.render(<PixelArtAdmin />);
