<script setup>
import Layout from '@/Layouts/Layout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ServerElement from './Paritals/ServerElement.vue';

const props = defineProps({
    servers: {
        type: Array,
        default: []
    }
});

</script>

<template>
  <Head title="Spawn" />
  <Layout>
    <!-- En-tête -->
  <header class="max-w-6xl mx-auto my-10 text-center">
    <h1 class="text-3xl font-bold animate-fade-in">Liste des Serveurs</h1>
    <p class="text-gray-400 mt-2">Gérez vos serveurs Minecraft, Ark et plus encore (Minecraft).</p>
  </header>

  <!-- Liste des serveurs -->
  <section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 my-10">
    <ServerElement v-for="server in props.servers" :server="server"/>
  </section>
  </Layout>
</template>