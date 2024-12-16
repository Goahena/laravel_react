import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";
import path from "path";

export default defineConfig({
    plugins: [react()],
    resolve: {
        alias: {
            // eslint-disable-next-line no-undef
            "~": path.resolve(__dirname, "src"),
        },
    },
    
    server: {
        proxy: {
            "/api": "http://laravel-container:9000",
        },
        port: 3000,
    },
});
