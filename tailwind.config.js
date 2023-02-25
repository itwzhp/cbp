const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './node_modules/flowbite/**/*.js'
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
                },
                cbp: {
                    100: 'rgb(25, 64, 147)',
                    200: 'rgb(37, 46, 120)',
                    300: 'rgb(37, 46, 120)',
                    400: 'rgb(37, 46, 120)',
                    500: 'rgb(35, 39, 64)',
                    600: 'rgb(35, 39, 64)',
                    700: 'rgb(35, 39, 64)',
                    800: 'rgb(35, 39, 64)',
                    900: 'rgb(35, 39, 64)',
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('flowbite/plugin')],
};
