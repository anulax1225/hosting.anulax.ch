<script setup>
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { computed } from 'vue';

const props = defineProps({
    services: {
        type: Object,
        default: []
    }
});

const form = useForm({
    name: "",
    service: props.services[0].uuid,
    port: "",
});

const formatPort = computed(() => {
    let result = "port";
    let nb = props.services.find(s => form.service == s.uuid).ports.split("|").length;
    for(let i = 1; i < nb; i++) result = result + "|port";
    result += ")"
    return result;
});

const submit = () => {
    form.post(route("servers.store"));
}

console.log();
</script>

<template>
    <Head title="Spawn" />
    <Layout>
            <!-- Création de Serveur -->
            <section class="py-20 px-6 text-center">
        <h2 class="text-3xl font-bold mb-10 fade-in">Créer Votre Serveur Gratuitement</h2>
        <p class="text-gray-300 max-w-3xl mx-auto fade-in">Nos serveurs sont isolés via Docker et offrent un stockage limité à 10Go. Pour économiser les ressources, un serveur inactif pendant une période prolongée sera automatiquement arrêté.</p>
        <form @submit.prevent="submit" class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg slide-up mt-6">
            <div class="mb-3">
                <InputLabel class="block text-left text-gray-300 mb-2" for="name">Name</InputLabel>
                <TextInput v-model="form.name" type="text" class="w-full p-3 rounded bg-gray-700 text-white" placeholder="Server name"></TextInput>
                <InputError :message="form.errors.name" class="text-left mt-1"></InputError>
            </div>
            <div class="mb-10">
                <InputLabel class="block text-left text-gray-300 mb-2" for="service">Service</InputLabel>
                <select @change="e => form.service = e.target.value" 
                class="w-full p-3 rounded bg-gray-700 text-white border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option v-for="service in props.services" :value="service.uuid">{{ service.name }}</option>

                </select>
            </div>
            <InputError :message="form.errors.service" class="text-left mt-1"></InputError>
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg shadow-md scale-hover">Créer le Serveur</button>
        </form>
    </section>
    </Layout>
</template>