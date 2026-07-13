import { defineConfig } from "vite";
import { fileURLToPath } from "node:url";

const resolvePath = (path) => fileURLToPath(new URL(path, import.meta.url));

export default defineConfig({
  server: {
    host: "localhost",
    port: 5173,
    strictPort: true,
    cors: true,
    origin: "http://localhost:5173",
  },
  build: {
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        inicio: resolvePath("./src/assets/js/inicio.js"),
        contacto: resolvePath("./src/assets/js/contacto.js"),
        productos: resolvePath("./src/assets/js/productos.js"),
        producto: resolvePath("./src/assets/js/producto.js"),
        equipo: resolvePath("./src/assets/js/equipo.js"),
        legal: resolvePath("./src/assets/js/legal.js"),
        showroom: resolvePath("./src/assets/js/showroom.js"),
      },
      output: {
        entryFileNames: "assets/[name]-[hash].js",
        chunkFileNames: "assets/[name]-[hash].js",
        assetFileNames: "assets/[name]-[hash][extname]",
      },
    },
  },
});
