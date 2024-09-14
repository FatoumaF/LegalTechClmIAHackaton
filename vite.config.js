import { defineConfig } from 'vite';
import symfonyPlugin from 'vite-plugin-symfony';

export default defineConfig({
  plugins: [symfonyPlugin()],
  build: {
    rollupOptions: {
      input: './assets/app.js', // Fichier d'entrée principal
    },
    outDir: 'public/build', // Dossier de sortie pour les fichiers compilés
  },
});
