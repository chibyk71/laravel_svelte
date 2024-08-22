import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from '@sveltejs/vite-plugin-svelte'
import sveltePreprocess from 'svelte-preprocess'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.postcss', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte({
            preprocess: sveltePreprocess()
        }),
    ],
    build: {
        outDir: 'public/build',  // Ensure this matches your expected output directory
        rollupOptions: {
            input: {
                app: 'resources/js/app.js',
                style: 'resources/css/app.postcss',
            },
        }
    },
});