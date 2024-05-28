import { createRoot, useState } from '@wordpress/element';

const colors = ['#000000', '#FFFFFF', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', 'transparent'];

const PixelArtAdmin = () => {
    const [selectedColor, setSelectedColor] = useState(colors[0]);

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
        </div>
    );
};

const root = createRoot( document.getElementById('pixel-art-admin-app') );
root.render(<PixelArtAdmin />);
