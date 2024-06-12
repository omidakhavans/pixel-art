# Pixel Art WordPress Plugin

This WordPress plugin allows users to draw and display pixel art on their website.

## Installation

1. **Clone Repository:** Clone this repository to your local machine:

    ```bash
    git clone https://github.com/omidakhavans/pixel-art.git
    ```

2. **Navigate to Plugin Directory:** Navigate to the plugin directory:

    ```bash
    cd pixel-art-plugin
    ```

3. **Install PHP Dependencies:** Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. **Install JavaScript Dependencies:** Install JavaScript dependencies using npm:

    ```bash
    npm install
    ```

5. **Build Assets:** Build the JavaScript and CSS assets:

    ```bash
    npm run build
    ```

## Usage

Once the plugin is installed and activated in your WordPress admin area, users can access the Pixel Art feature in the following ways:

### Admin Interface

Navigate to the "Pixel Art" page in the WordPress admin area. Here, users can draw pixel art using the provided grid and color palette. Clicking a pixel changes its color to the selected color. Right-clicking a pixel copies its color to the selected color. Users can also click and drag to draw continuously. Once the artwork is complete, users can click the "Save" button to save the pixel data to the database.

### Block

Users can also add the Pixel Art block to their posts or pages using the WordPress block editor. Simply search for the "Pixel Art" block and add it to the editor. The block allows users to display their pixel art on the front-end of the site. Users can customize the size of the pixel art using the block settings.

## License

This plugin is licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).
