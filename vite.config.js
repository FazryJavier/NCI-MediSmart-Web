import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => ({
    // Relative base for builds: fonts/images referenced from CSS resolve next to the CSS file,
    // so they still load when the app is served from a sub-path (e.g. /public/ or a subfolder).
    base: command === 'build' ? './' : undefined,
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
}));
