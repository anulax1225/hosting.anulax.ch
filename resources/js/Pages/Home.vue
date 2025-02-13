<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';

</script>

<template>
    <Head title="Welcome" />
    <Layout>
    <header class="text-center py-20">
        <h1 class="text-4xl font-bold animate-fade-in">Bienvenue sur Minecraft Hosting</h1>
        <p class="text-gray-300 max-w-3xl mx-auto mt-4 animate-fade-in">Un service gratuit permettant d'héberger facilement vos serveurs Minecraft dans des conteneurs Docker sécurisés et performants.</p>
    </header>
    
    <section class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-lg animate-slide-up">
        <h2 class="text-2xl font-bold mb-4">Pourquoi choisir notre hébergement ?</h2>
        <ul class="list-disc list-inside text-gray-300">
            <li>Infrastructure basée sur Docker pour une isolation et une sécurité optimales.</li>
            <li>Stockage limité à 10 Go par serveur pour éviter toute surcharge.</li>
            <li>Extinction automatique après 30 minutes d'inactivité pour économiser les ressources.</li>
            <li>Accès Open Source – consultez notre code sur <a href="https://github.com/anulax1225/minecraft.anulax.ch" class="text-green-400 hover:underline">GitHub</a>.</li>
        </ul>
    </section>
    
    <section class="mt-10 text-center">
        <h2 class="text-2xl font-bold mb-4 animate-fade-in">Comment ça fonctionne ?</h2>
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 animate-slide-up">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold">1. Créez votre serveur</h3>
                <p class="text-gray-300">Remplissez un simple formulaire pour générer votre serveur.</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold">2. Lancez et jouez</h3>
                <p class="text-gray-300">Votre serveur est déployé instantanément et prêt à être rejoint.</p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold">3. Auto-gestion</h3>
                <p class="text-gray-300">Le serveur s'éteint automatiquement après inactivité pour économiser les ressources.</p>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto text-center bg-cover bg-center fade-in my-10" style="background-image: url('https://source.unsplash.com/1600x900/?minecraft,game');">
        <div class="w-full bg-gray-800 p-10 inline-block rounded-lg slide-up">
            <h2 class="text-4xl font-bold">Hébergez votre serveur Minecraft</h2>
            <p class="text-gray-300 mt-4">Des performances optimales pour des parties sans lag. Commencez dès maintenant !</p>
            <a href="#offres" class="mt-6 inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md scale-hover">Créer un serveur</a>
        </div>
    </section>
    </Layout>
</template>
