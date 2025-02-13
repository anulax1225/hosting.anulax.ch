<script setup>
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

const form = useForm({
    name: "",
    port: "25000",
});

const submit = () => {
    form.post("/spawn");
}

console.log();
</script>

<template>
    <Head title="Spawn" />
    <Layout>
            <!-- Création de Serveur -->
            <section class="py-20 px-6 text-center">
        <h2 class="text-3xl font-bold mb-10 fade-in">Créer Votre Serveur Minecraft Gratuitement</h2>
        <p class="text-gray-300 max-w-3xl mx-auto fade-in">Nos serveurs sont isolés via Docker et offrent un stockage limité à 10Go. Pour économiser les ressources, un serveur inactif pendant une période prolongée sera automatiquement arrêté.</p>
        <form @submit.prevent="submit" class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg slide-up mt-6">
            <div class="mb-6">
                <InputLabel class="block text-left text-gray-300 mb-2" for="name">Name</InputLabel>
                <TextInput v-model="form.name" type="text" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Server name"></TextInput>
                <InputError :message="form.errors.name"></InputError>
            </div>
            <div class="mb-6">
                <InputLabel class="block text-left text-gray-300 mb-2" for="port">Port</InputLabel>
                <TextInput v-model="form.port" type="text" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Port (ex: 25000)"></TextInput>
                <InputError :message="form.errors.port"></InputError>
            </div>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md scale-hover">Créer le Serveur</button>
        </form>
    </section>
    </Layout>
</template>