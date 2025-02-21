import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Chemin correct vers app.css
                'resources/js/app.js',  // Chemin correct vers app.js
            ],
            refresh: true,
        }),
    ],
});