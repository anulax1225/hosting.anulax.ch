<script setup>
import { Link, useForm } from '@inertiajs/vue3';


const props = defineProps({
    server: {
        type: Object,
        required: true
    },
    editable: {
        type: Boolean,
        default: true
    }
});
if(props.editable) {

}
const form = useForm();

const start = (uuid) => {
  form.post(route("servers.start", uuid), {
    onSuccess: () => {
      vm.$forceUpdate()
    }
  });
} 

const stop = (uuid) => {
  form.post(route("servers.stop", uuid));
} 

</script>

<template>
    <!-- Carte Serveur -->
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 slide-up relative">
      <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold flex items-center gap-2">
          <img src="/icons/server-icon.svg" alt="Serveur" class="w-6 h-6 rotate-on-hover invert">
          Serveur {{ props.server.name }}
        </h2>
        <span v-if="props.server.status.id < 3" class="px-3 py-1 text-sm font-bold rounded-lg bg-green-500 text-white">{{ props.server.status.title }}</span>
        <span v-else class="px-3 py-1 text-sm font-bold rounded-lg bg-red-500 text-white">{{ props.server.status.title }}</span>
      </div>
      
      <div class="mt-4 space-y-2 text-sm">
        <p><span class="font-medium">Type </span> {{ props.server.service.name }}</p>
        <p v-if="props.editable" ><span class="font-medium">Dernier démarrage </span> {{ props.server.start ? props.server.start : "aucun" }}</p>
        <p class="flex gap-2">
          <span class="font-medium">Lien :</span> 
          <p class="text-green-400 hover:underline">
            {{ props.server.ports.length && props.server.status.id < 3 ? "hosting.anulax.ch:" + props.server.ports[0] : "Indisponible" }}
          </p>
        </p>
      </div>
      
      <!-- Actions -->
      <div v-if="props.editable" class="mt-4 flex gap-2 w-full justify-end">
        <div v-if="props.server.status.id >= 3" @click="start(props.server.uuid)" class="bg-green-500 hover:bg-green-600 text-white f
          glow-on-hover font-bold p-2 rounded-lg shadow-lg flex items-center gap-2">
          <img src="/icons/start-icon.svg" alt="Start" class="w-5 h-5 invert">
        </div>
        <div v-else @click="stop(props.server.uuid)" class="bg-red-500 hover:bg-red-600 text-white 
        glow-on-hover font-bold p-2 rounded-lg shadow-lg flex items-center gap-2">
          <img src="/icons/stop-icon.svg" alt="Stop" class="w-5 h-5 invert">
        </div>
        <Link :href="route('servers.show', props.server.uuid)" class="bg-blue-500 hover:bg-blue-600 text-white 
        glow-on-hover font-bold p-2 rounded-lg shadow-lg flex items-center gap-2">
          <img src="/icons/details-icon.svg" alt="Détails" class="w-5 h-5 invert">
        </Link>
      </div>
    </div>
</template>