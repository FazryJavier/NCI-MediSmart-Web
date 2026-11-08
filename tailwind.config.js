/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/UserPage/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        // Explicit order so the custom `nav` breakpoint (mobile menu cut-off) sorts between lg and xl.
        screens: {
            sm: '640px',
            md: '768px',
            lg: '1024px',
            nav: '1151px',
            xl: '1280px',
            '2xl': '1536px',
        },
        extend: {
            colors: {
                brand: {
                    DEFAULT: '#1bad4b',
                    dark: '#015028',
                    link: '#079d48',
                },
                ink: '#242424',
                muted: '#707070',
                mist: '#f1f5f9',
            },
            fontFamily: {
                sans: ['"Be Vietnam Pro"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
