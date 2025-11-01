import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: '.',
  base: '/dignet/',
  build: {
    outDir: 'dist',
    assetsDir: 'assets',
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/js/app.js'),
        styles: resolve(__dirname, 'src/scss/app.scss')
      },
      output: {
        entryFileNames: 'assets/[name].[hash].js',
        chunkFileNames: 'assets/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]'
      }
    }
  },
  server: {
    port: 3000,
    proxy: {
      '/dignet': {
        target: 'http://localhost',
        changeOrigin: true
      }
    }
  }
});
