const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Inter var",
                    ...defaultTheme.fontFamily.sans,
                    "sans-serif",
                ],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
    safelist: [
        {
            pattern:
                /(bg|text|ring|ring-offset)-(green|red|yellow|blue)-(50|100|500|600|800|)/,
        },
        {
            pattern:
                /col-span-3/,
        }
    ],
};
