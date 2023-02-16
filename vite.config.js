import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/home.js',
                'resources/js/components/HomeComponent.vue',
            ],
            refresh: true,
        }),
        vue(),
    ],
});
