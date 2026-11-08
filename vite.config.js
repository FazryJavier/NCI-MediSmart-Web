import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
    // Relative base for builds: fonts/images referenced from CSS resolve next to the CSS file,
    // so they still load when the app is served from a sub-path (e.g. /public/ or a subfolder).
    base: command === 'build' ? './' : undefined,
    server: {
        // Vite >= 4.5.6 only allows localhost origins by default. Local sites served by
        // Herd/Valet/Laragon (e.g. https://nci-medismart.test) load scripts and fonts from this
        // dev server cross-origin, so allow those local dev domains explicitly.
        cors: {
            origin: [
                /^https?:\/\/(?:(?:[^:]+\.)?localhost|127\.0\.0\.1|\[::1\])(?::\d+)?$/,
                /^https?:\/\/[^/:]+\.test(?::\d+)?$/,
            ],
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
}));
