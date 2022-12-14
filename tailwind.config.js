const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                zhp: {
                    100: '#a6ce39',
                    200: '#a6ce39',
                    300: '#a6ce39',
                    400: '#a6ce39',
                    500: '#78a22f',
                    600: '#78a22f',
                    700: '#78a22f',
                    800: '#78a22f',
                    900: '#78a22f',
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
