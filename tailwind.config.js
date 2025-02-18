import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: { // This is where you add your custom colors
                primary: '#1E40AF',
                secondary: '#9333EA',
                // Add more colors here as needed
                accent: '#FACC15', // Example
                'light-gray': '#EEEEEE', // Example with hyphen
            },
        },
    },

    plugins: [forms],
};