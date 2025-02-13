<script setup>
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';
import Layout from '@/Layouts/Layout.vue';

const props = defineProps({
    config: {
        type: Object,
        default: {},
    } 
});

const config = Object.entries(props.config);

const form = useForm({
    name: "",
    port: "25000",
});

const submit = () => {
    axios.post("/spawn", {
        name: form.name,
        port: form.port,
    });
}

const addRow = () => {
    const serverList = document.getElementById("server-list");
    const row = document.createElement("div");
    row.classList.add("grid", "grid-cols-2", "gap-4", "p-3", "border-b", "border-gray-700");
    row.innerHTML = `
        <div>Nouveau Serveur</div>
        <div>0</div>
    `;
    serverList.appendChild(row);
}

console.log();
</script>

<template>
    <Head title="Spawn" />
    <Layout>
    <h2 class="text-3xl font-bold text-center my-6">Informations sur le serveur Docker</h2>
    <section class="mt-10 text-center">
        <p class="text-gray-300 text-center max-w-2xl mx-auto animate-fade-in">Nos serveurs Minecraft sont déployés dans des conteneurs Docker sécurisés et optimisés. Voici un aperçu des paramètres clés utilisés pour la configuration des serveurs.</p>
        <p class="text-gray-400 max-w-2xl mx-auto fade-in">Pour en savoir plus sur Docker et la gestion des conteneurs, consultez les ressources suivantes :</p>
        <ul class="text-green-400 mt-4 fade-in">
            <li><a href="https://docs.docker.com/" class="hover:underline">Documentation officielle de Docker</a></li>
            <li><a href="https://hub.docker.com/" class="hover:underline">Docker Hub</a></li>
            <li><a href="https://github.com/anulax1225/minecraft.anulax.ch" class="hover:underline">Code source du projet</a></li>
        </ul>
    </section>
    <div class="max-w-3xl max-h-96 mb-10 overflow-y-auto mx-auto bg-gray-800 p-6 rounded-lg shadow-lg mt-6 animate-slide-up">
        <div class="grid grid-cols-2 gap-4 p-3 border-b border-gray-700 font-bold">
            <div>Paramètre</div>
            <div>Valeur</div>
        </div>
        <div v-for="(conf, index) in config" class="grid grid-cols-2 gap-4 p-3 border-b border-gray-700">
            <p class="font-medium">{{ conf[0] }}</p>
            <p class="">{{ Array.isArray(conf[1]) || typeof conf[1] === 'object' ? "Object | Array" : conf[1] }}</p>
        </div>

    </div>
    </Layout>
</template>