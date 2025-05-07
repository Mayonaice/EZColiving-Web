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
                raleway: ['Raleway', 'sans-serif'],
                ss3: ['Source Sans 3', 'sans-serif'],
                ptsans: ['PT Sans', 'sans-serif'],
                onest: ['Onest', 'sans-serif'],
                rubik: ['Rubik', 'sans-serif'],
                poppins: ['Poppins', 'sans-serif'],
            },
        },

        screens: {
            sm: '640px',

            md: '768px',

            lg: '1024px',

            xl: '1280px',

            '2xl': '1536px',
            
            'xsm' : '360px',
        }
    },

    plugins: [forms],
};
