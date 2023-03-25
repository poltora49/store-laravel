import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',

                "resources/js/admin/app.js",
                "resources/css/admin/classic.css",
                "resources/css/admin/modern.css",
            ],
            refresh: true,
        }),
    ],
});
