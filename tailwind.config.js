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
            animation: {
                movedown: 'movedown 2s',
                fadein: 'fadein 1s',
                fadeout: 'fadeout 1s',
            },
            keyframes: {
                movedown: {
                    '0%': {
                        transform: 'translateY(-100%)',
                    },
                    '40%': {
                        transform: 'translateY(calc(40%))'
                    }
                },
                fadein: {
                    '0%': {
                        opacity: '0',
                    },
                    '100%': {
                        opacity: '1',
                    }
                },
                fadeout: {
                    '0%': {
                        opacity: '1',
                    },
                    '100%': {
                        opacity: '0',
                    }
                }

            },
            width: {
                '4': '4%',
                '5/100': '5%',
                'sidebar': '20%',
                '80': '80%',
                '90': '90%',
                '1/15': '5%',
                '30': '30%'
            },
            height: {
                '2/100': '2%',
            },
            colors: {
                'custom-light-purple': '#912197',
                'custom-purple': '#5E053A',
                'custom-blue': '#182946'
            },
            margin: {
                '5/100': '5%',

            },
            spacing: {
                '18': '18px',
                '4r': '4rem',
                '42/100': '42%',
                '50/100': '50%',
                '4r5': '4.3rem',
                '17r': '17.3rem',
                '10': '10%',

            },
            zIndex: {
                '9999': '9999',
            }
        },

        plugins: [forms]
    }
};
