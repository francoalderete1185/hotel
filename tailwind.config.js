import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans:  ['Inter', ...defaultTheme.fontFamily.sans],
                serif: ['"Source Serif 4"', 'Georgia', 'serif'],
            },
            colors: {
                navy: {
                    50:  '#f0f3f9',
                    100: '#dbe2ee',
                    200: '#b7c5dd',
                    500: '#3d5582',
                    700: '#1a2845',
                    900: '#0e1729',
                },
                cream: {
                    50:  '#fdfbf6',
                    100: '#f9f3e4',
                    200: '#f5efe1',
                },
                bordeaux: {
                    500: '#7a2e2e',
                    700: '#5a2222',
                },
            },
        },
    },
    plugins: [],
};
