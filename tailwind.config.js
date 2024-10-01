import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // 다크 모드를 클래스 기반으로 설정
    darkMode: 'class',

    theme: {
        content: [
            "./src/**/*.{js,ts,jsx,tsx}",
        ],
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                bookmark_gray: 'url("./image/Book_Mark_Black.svg")',
                bookmark_black: 'url("./image/Book_Mark_Gray.svg")',
            }
        },
    },

    plugins: [forms, typography],
};