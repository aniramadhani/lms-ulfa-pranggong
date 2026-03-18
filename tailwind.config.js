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
            colors: {
                'islami': {
                    light: '#ecfdf5', // Hijau sangat muda untuk background
                    DEFAULT: '#10b981', // Hijau khas Madrasah
                    dark: '#065f46', // Hijau tua untuk sidebar/header
                },
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans], // Font bersih & profesional
            },
        },
    },

    plugins: [forms],
};