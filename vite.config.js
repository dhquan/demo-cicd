import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // --- THÊM CẤU HÌNH SERVER NÀY ---
    server: {
        host: '0.0.0.0', // Cho phép kết nối từ bên ngoài container
        port: 5173,      // Cố định cổng
        hmr: {
            host: 'localhost', // Bảo trình duyệt Windows: "Hãy tìm Vite ở localhost của mày"
        },
        watch: {
            usePolling: true, // Bắt buộc khi chạy trên Docker (đặc biệt là Windows/WSL) để nhận diện thay đổi file
        },
    },
});
