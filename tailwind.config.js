import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php', // Tous les fichiers Blade
        './resources/views/components/**/*.blade.php', // Composants Blade
        './resources/views/layouts/**/*.blade.php',   // Layouts Blade
        './resources/js/**/*.js', // Fichiers JavaScript (si vous utilisez Tailwind dans du JS)
        './resources/js/**/*.vue', // Si vous utilisez Vue.js
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', 'sans-serif'], // Simplifié
            },
            colors: {
                // ... (couleurs)
            },
        },
    },
    plugins: [forms],
};