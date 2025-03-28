import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: ['./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php', './vendor/laravel/jetstream/**/*.blade.php', './storage/framework/views/*.php', './resources/views/**/*.blade.php', './resources/js/**/*.vue'],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Adele Sans', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                primary: '#537CBC',
                secondary: '#6E9BC2',
                tertiary: '#A8C6E5',
                quaternary: '#9E9E9E',
                quinary: '#D8D8D8',
                senary: '#F4F4F4'
            },
            backgroundImage: {
                network: "url('../../public/images/network.png')",
                main: "url('../../public/images/main_2.png')"
            }
        }
    },

    plugins: [forms, typography]
};
