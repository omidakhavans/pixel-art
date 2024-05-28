import { createRoot, useState } from '@wordpress/element';

const colors = ['#000000', '#FFFFFF', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', 'transparent'];

const PixelArtAdmin = () => {
    const [selectedColor, setSelectedColor] = useState(colors[0]);
    const [pixels, setPixels] = useState(Array(16 * 16).fill('transparent'));
    const [isSaved, setIsSaved] = useState(true);

    const handlePixelClick = (index) => {
      const newPixels = [...pixels];
      newPixels[index] = selectedColor;
      setPixels(newPixels);
      setIsSaved(false);
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
                ))}
            </div>
        </div>
    );
};

const root = createRoot( document.getElementById('pixel-art-admin-app') );
root.render(<PixelArtAdmin />);
