<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
  <Head title="Spawn" />
  <Layout>
      <!-- En-tête -->
  <header class="my-10 text-center">
    <h1 class="text-4xl font-bold flex items-center justify-center gap-2 fade-in">
      Dashboard - Détails du Serveur
    </h1>
    <p class="text-gray-300 mt-4 fade-in">
      Gérez et visualisez les informations clés de votre serveur en un coup d'œil.
    </p>
  </header>

  <!-- Cartes d'information -->
  <main class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 slide-up">
    <!-- Carte : Informations Générales -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-semibold border-b border-gray-700 pb-2 mb-4 flex items-center gap-2">
        <img src="/icons/server-icon.svg" alt="Général" class="w-6 h-6 rotate-on-hover glow-on-hover invert">
        Informations Générales
      </h2>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between">
          <span class="font-medium">Nom</span>
          <span class="text-green-400 font-bold">Mon Serveur Minecraft</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Type de jeu</span>
          <span>Minecraft</span>
        </div>
        <div class="flex flex-col gap-2">
          <div class="flex justify-between items-center mb-1">
            <div class="flex items-center gap-2">
              <span class="font-medium">Lien d'accès</span>
            </div>
            <div class="flex items-center gap-2">
              <a href="http://hosting.anulax.ch:25005" class="text-green-400 hover:underline">
                hosting.anulax.ch:25005
              </a>
              <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-1 rounded-lg shadow-lg glow-on-hover flex items-center">
                <img src="/icons/copy-icon.svg" alt="Copier" class="w-5 h-5 invert">
              </button>
            </div>
          </div>

        </div>
      </div>
    </div>
    
    <!-- Carte : Activité -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-semibold border-b border-gray-700 pb-2 mb-4 flex items-center gap-2">
        <img src="/icons/stats-icon.svg" alt="Activité" class="w-6 h-6 rotate-on-hover glow-on-hover invert">
        Activité
      </h2>
      <div class="space-y-3 text-sm mb-4">
        <div class="flex justify-between">
          <span class="font-medium">Statut</span>
          <span class="text-green-400 font-bold">Running</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Dernier lancement :</span>
          <span class="text-green-400 font-bold">2024-02-15 10:00</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Dernier arrêt :</span>
          <span class="text-red-400 font-bold">2024-02-15 09:00</span>
        </div>
      </div>
      <div class="flex gap-3">
        <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/start-icon.svg" alt="Start" class="w-5 h-5 invert">
        </a>
        <a href="#" class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/stop-icon.svg" alt="Stop" class="w-5 h-5 invert">
        </a>
      </div>
    </div>
    
    <!-- Carte : Hardware -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-semibold border-b border-gray-700 pb-2 mb-4 flex items-center gap-2">
        <img src="/icons/hardware-icon.svg" alt="Hardware" class="w-6 h-6 rotate-on-hover glow-on-hover invert">
        Hardware
      </h2>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between">
          <span class="font-medium">CPU :</span>
          <span>Intel Xeon E5</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">RAM :</span>
          <span>16GB</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Stockage :</span>
          <span>10GB SSD</span>
        </div>
      </div>
    </div>
  </main>
  <!-- Section Actions en haut -->
  <section class="max-w-6xl mx-auto mb-6 fade-in">
    <div class="flex justify-between items-center bg-gray-800 p-4 rounded-lg shadow-lg">
      <div class="flex gap-3">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center">
          <img src="/icons/share-icon.svg" alt="Partager" class="w-5 h-5 invert">
        </button>
      </div>
      <!-- Actions de gestion -->
      <div class="flex gap-3">
        <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/edit-icon.svg" alt="Edit" class="w-5 h-5 invert">
        </a>
        <button class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center">
          <img src="/icons/public-icon.svg" alt="Rendre public" class="w-5 h-5 invert">
        </button>
        <a href="#" class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/delete-icon.svg" alt="Delete" class="w-5 h-5 invert">
        </a>
      </div>
    </div>
  </section>
  </Layout>
</template>