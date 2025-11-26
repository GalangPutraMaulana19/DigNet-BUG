import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: '.',
  base: './',  // Use relative paths for font assets
  
  // Build optimization
  build: {
    outDir: 'dist',
    assetsDir: 'assets',
    manifest: true,
    minify: 'terser',
    sourcemap: false,
    
    // Performance optimization
    chunkSizeWarningLimit: 500,
    
    // Tree-shaking and dead code elimination
    terserOptions: {
      compress: {
        drop_console: true,
        drop_debugger: true,
        pure_funcs: ['console.log', 'console.info']
      },
      mangle: true,
      format: {
        comments: false
      }
    },
    
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/js/app.js'),
        styles: resolve(__dirname, 'src/scss/app.scss')
      },
      output: {
        // Code splitting for better caching
        manualChunks: {
          vendor: ['bootstrap', '@popperjs/core'],
          charts: ['chart.js']
        },
        entryFileNames: 'assets/[name].[hash].js',
        chunkFileNames: 'assets/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]'
      }
    },
    
    // CSS optimization
    cssCodeSplit: true
  },
  
  // CSS preprocessing options
  css: {
    devSourcemap: true,
    preprocessorOptions: {
      scss: {
        // Silence deprecation warnings for Bootstrap
        silenceDeprecations: ['import', 'global-builtin', 'legacy-js-api', 'color-functions'],
        quietDeps: true
      }
    }
  },
  
  // Performance optimizations
  optimizeDeps: {
    include: ['bootstrap', '@popperjs/core', 'chart.js']
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
