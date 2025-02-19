<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import ServerElement from './Server/Paritals/ServerElement.vue';

const props = defineProps({
    services: {
        type: Array,
        default: []
    },
    servers: {
        type: Array,
        default: []
    }
});

</script>

<template>
    <Head title="Welcome" />
    <Layout>
    <header class="text-center my-10">
        <h1 class="text-4xl font-bold fade-in flex justify-center items-center gap-2">
            <img src="/icons/server-icon.svg" alt="Serveur" class="md:block hidden w-12 h-12 invert"> Bienvenue sur Hosting
        </h1>
        <p class="text-gray-300 max-w-3xl mx-auto mt-4 fade-in">Un service gratuit permettant d'héberger facilement vos serveurs dans des conteneurs Docker sécurisés et performants.</p>
    </header>
    <p class="text-center text-2xl font-bold mb-4 fade-in">Nos Services</p>
    <section class="flex md:flex-row flex-col items-center md:justify-center justify-between mx-auto mb-10 slide-up">
        <div v-for="service in props.services" class="relative flex items-center justify-center h-72 max-w-52 overflow-x-hidden bg-black w-full rounded-lg my-2 mx-5">
            <img :src="service.image" class="object-cover h-full">
            <!-- <p class="absolute bottom-0 right-0 left-0 p-1 text-center bg-gray-950/60 font-extrabold text-gray-300 text-2xl">{{ service.name }}</p> -->
        </div>
    </section>
    
    <section class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg slide-up">
        <h2 class="text-2xl font-bold mb-4 flex items-center gap-2">
            <img src="/icons/security-icon.svg" alt="Sécurité" class="w-6 h-6 invert">Comment fonctionne notre hébergement ?
        </h2>
        <ul class="list-disc list-inside text-gray-300">
            <li>Infrastructure basée sur Docker pour une isolation et une sécurité optimales.</li>
            <li>Stockage limité à 10 Go par serveur pour éviter toute surcharge.</li>
            <li>Extinction automatique après 30 minutes d'inactivité pour économiser les ressources.</li>
            <li>Accès Open Source – consultez notre code sur <a href="https://github.com/anulax1225/minecraft.anulax.ch" class="text-green-400 hover:underline">GitHub</a>.</li>
        </ul>
    </section>
    
    <section class="mt-10 text-center">
        <h2 class="text-2xl font-bold mb-4 fade-in flex justify-center items-center gap-2">
            <img src="/icons/process-icon.svg" alt="Processus" class="w-7 h-7 invert">Démarche à sur suivre ?
        </h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 slide-up">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center">
                <img src="/icons/start-icon.svg" alt="Créer" class="w-14 h-14 mb-2 invert">
                <h3 class="text-xl font-semibold">1. Créez votre serveur</h3>
                <p class="text-gray-300">Remplissez un simple formulaire pour générer votre serveur.</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center">
                <img src="/icons/play-icon.svg" alt="Lancer" class="w-14 h-14 mb-2 invert">
                <h3 class="text-xl font-semibold">2. Lancez et jouez</h3>
                <p class="text-gray-300">Votre serveur est déployé instantanément et prêt à être rejoint.</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg flex flex-col items-center">
                <img src="/icons/auto-icon.svg" alt="Auto-gestion" class="w-14 h-14 mb-2 invert">
                <h3 class="text-xl font-semibold">3. Auto-gestion</h3>
                <p class="text-gray-300">Le serveur s'éteint automatiquement après inactivité pour économiser les ressources.</p>
            </div>
        </div>
    </section>
    
    <section class="mt-10 text-center mb-10">
        <h2 class="text-2xl font-bold mb-4 fade-in flex justify-center items-center gap-2">
            <img src="/icons/rocket-icon.svg" alt="Démarrer" class="w-7 h-7 invert"> Commencez dès maintenant !
            
        </h2>
        <p class="text-gray-300 mt-4 fade-in">Des performances optimales pour des parties sans lag. Commencez dès maintenant !</p>
        <Link :href="route('servers.create')" class="mt-6 w-fit mx-auto items-center fade-in flex bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md scale-hover">
            <img src="/icons/arrow-icon.svg" alt="Créer" class="w-5 h-5 rotate-180 invert mr-2 object-cover"> Créer un serveur
        </Link>
    </section>
    <section class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2  gap-6 my-10">
        <ServerElement v-for="server in props.servers" :server="server" :editable="false"/>
    </section>
    </Layout>
</template>
