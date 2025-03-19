import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/tiny-screen.css',
                'resources/js/app.js',
                'resources/js/responsive-helpers.js',
                'resources/js/tiny-screen-slider.js'
            ],
            refresh: true,
        }),
    ],
});
