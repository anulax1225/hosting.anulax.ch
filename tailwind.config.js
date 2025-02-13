import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                roboto: ["Roboto"]
            },
            colors: {
                gray: {
                    100: '#f5f5f5', // Gris très clair
                    200: '#e5e5e5', // Un peu plus foncé
                    300: '#d4d4d4',
                    400: '#a3a3a3',
                    500: '#737373', // Milieu de la palette
                    600: '#525252',
                    700: '#404040',
                    800: '#262626',
                    900: '#171717', // Gris très foncé
                },
                textColor: {
                    100: '#ffffff', // Blanc pur pour texte sur fond très foncé
                    200: '#f5f5f5', // Presque blanc, lisible sur gris foncé
                    300: '#e5e5e5',
                    400: '#cccccc', // Lisible sur gris moyen
                    500: '#a3a3a3', // Texte équilibré sur fond gris 700-900
                    600: '#737373', // Neutre, polyvalent
                    700: '#525252', // Parfait pour du texte contrasté sur gris clair
                    800: '#404040', // Bonne lisibilité sur fonds très clairs
                    900: '#171717', // Noir profond, lisible sur gris pâle
                },
            },
        },
    },
    plugins: [forms],
};
