<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Layout from '@/Layouts/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    server: {
        type: Object,
        required: true
    }
});

const isFocus = ref(false);
const form = useForm();
const editForm = useForm({ name: props.server.name });

const start = (uuid) => {
  form.post(route("servers.start", uuid));
} 

const stop = (uuid) => {
  form.post(route("servers.stop", uuid));
} 

const del = (uuid) => {
  if(prompt("Entrer le nom du server en confirmation.") == props.server.name) form.delete(route("servers.destroy", uuid));
}

const pub = (uuid) => {
  if(props.server.public) form.post(route("servers.public", uuid));
  else if (prompt("Entrer le nom du server en confirmation.") == props.server.name) form.post(route("servers.public", uuid));
}

const edit = () => {
  console.log(editForm.name);
  editForm.post(route("servers.update", props.server.uuid));
}

const copie = () => {
  navigator.clipboard.writeText('hosting.anulax.ch:' + props.server.ports[0]).then(() => alert("lien de connection copié!"))
}

</script>

<template>
  <Head title="Spawn" />
  <Layout>
      <!-- En-tête -->
  <header class="my-10 text-center">
    <h1 class="text-4xl font-bold flex items-center justify-center gap-2 fade-in">
      Dashboard du Serveur
    </h1>
    <p class="text-gray-300 mt-4 fade-in">
      Gérez et visualisez les informations clés de votre serveur en un coup d'œil.
    </p>
  </header>

  <!-- Cartes d'information -->
  <main class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 slide-up">
    <!-- Carte : Informations Générales -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-semibold border-b border-gray-700 pb-2 mb-4 flex items-center gap-2">
        <img src="/icons/server-icon.svg" alt="Général" class="w-6 h-6 rotate-on-hover invert">
        Informations Générales
      </h2>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between">
          <span class="font-medium">Nom</span>
          <span class="text-green-400 font-bold">{{ props.server.name }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Type de jeu</span>
          <span>{{ props.server.service.name }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Public</span>
          <span>{{ props.server.public ? "Oui" : "Non" }}</span>
        </div>
        <div class="flex flex-col gap-2">
          <div class="flex justify-between items-center mb-1">
            <div class="flex items-center gap-2">
              <span class="font-medium">Lien de connection</span>
            </div>
            <div class="flex items-center gap-2">
              <p class="text-green-400 hover:underline">
                {{ props.server.ports.length && props.server.status.id < 3 ? "hosting.anulax.ch:" + props.server.ports[0] : "Indisponible" }}
              </p>
              <button v-show="props.server.ports.length && props.server.status.id < 3" @click="copie" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-1 rounded-lg shadow-lg glow-on-hover flex items-center">
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
        <img src="/icons/stats-icon.svg" alt="Activité" class="w-6 h-6 rotate-on-hover invert">Activité
      </h2>
      <div class="space-y-3 text-sm mb-4">
        <div class="flex justify-between">
          <span class="font-medium">Statut</span>
          <span class="text-green-400 font-bold">{{ props.server.status.title }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Dernier lancement</span>
          <span class="text-green-400 font-bold">{{ props.server.start ? props.server.start : "Aucun" }}</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Dernier arrêt </span>
          <span class="text-red-400 font-bold">{{ props.server.end ? props.server.end : "Aucun" }}</span>
        </div>
      </div>
      <div class="flex gap-3">
        <div @click="start(props.server.uuid)" v-if="props.server.status.id >= 3" class="bg-green-500 hover:bg-green-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/start-icon.svg" alt="Start" class="w-5 h-5 invert">
        </div>
        <div @click="stop(props.server.uuid)" v-else class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/stop-icon.svg" alt="Stop" class="w-5 h-5 invert">
        </div>
      </div>
    </div>
    
    <!-- Carte : Hardware -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-semibold border-b border-gray-700 pb-2 mb-4 flex items-center gap-2">
        <img src="/icons/hardware-icon.svg" alt="Hardware" class="w-6 h-6 rotate-on-hover invert">
        Hardware(fake)
      </h2>
      <div class="space-y-3 text-sm">
        <div class="flex justify-between">
          <span class="font-medium">CPUs</span>
          <span>1</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Memory</span>
          <span>4GB</span>
        </div>
        <div class="flex justify-between">
          <span class="font-medium">Stockage</span>
          <span>10GB</span>
        </div>
      </div>
    </div>
  </main>
  <!-- Section Actions en haut -->
  <section class="max-w-6xl mx-auto mb-10 fade-in">
    <div class="flex justify-between items-center bg-gray-800 p-4 rounded-lg shadow-lg">
      <div class="flex gap-3">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center">
          <img src="/icons/share-icon.svg" alt="Partager" class="w-5 h-5 invert">
        </button>
      </div>
      <!-- Actions de gestion -->
      <div class="flex gap-3 items-center">
        <form v-show="isFocus" @submit.prevent="edit">
          <TextInput
           v-model="editForm.name"
           type="text"
           class="w-full px-3 py-1 rounded bg-gray-700 text-white"
          />
          <button type="submit"></button>
          <InputError :message="form.errors.name" class="text-left mt-1"></InputError>
        </form>
        <button @click="isFocus = !isFocus" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/edit-icon.svg" alt="Edit" class="w-5 h-5 invert">
        </button>
        <button v-if="props.server.public" @click="pub(props.server.uuid)" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center">
          <img src="/icons/lock.svg" alt="Rendre Privé" class="w-5 h-5 invert">
        </button>
        <button v-else @click="pub(props.server.uuid)" class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center">
          <img src="/icons/public-icon.svg" alt="Rendre public" class="w-5 h-5 invert">
        </button>
        <button @click="del(props.server.uuid)" class="bg-red-500 hover:bg-red-600 text-white font-bold p-2 rounded-lg shadow-lg glow-on-hover flex items-center gap-2">
          <img src="/icons/delete-icon.svg" alt="Delete" class="w-5 h-5 invert">
        </button>
      </div>
    </div>
  </section>
  </Layout>
</template>