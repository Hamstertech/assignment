import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';


// New code. Been updated to manage designated env variables.
export default ({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };

    return defineConfig({
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js'
                ],
                refresh: true,
            }),
        ],
        server: {
            host: process.env.VITE_APP_URL
        }
    });
}