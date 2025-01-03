import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '0.0.0.0', // Permite escuchar todas las conexiones
        port: 5173,      // Cambia el puerto si es necesario
        hmr: {
            host: '192.168.110.182', // Cambia la IP si es necesario
            port: 5173
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js', 
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
