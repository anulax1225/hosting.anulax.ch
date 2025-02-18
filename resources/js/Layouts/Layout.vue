<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { onMounted, onUpdated, ref, watch } from 'vue';

const user = usePage().props.auth.user;
const banner = usePage().props.banner;
const message = ref(usePage().props.errors.message);
const error = ref(usePage().props.errors.error);

onUpdated(() => {
    if(message.value != usePage().props.errors.message) {
        message.value = usePage().props.errors.message;
        setTimeout(() => {
            usePage().props.errors.message = null;
            message.value = null;
        }, 6000);
    }
    if(error.value != usePage().props.errors.error) {
        error.value = usePage().props.errors.error;
        setTimeout(() => {
            usePage().props.errors.error = null;
            error.value = null;
        }, 6000);
    }
});

message.value = usePage().props.errors.message;
error.value = usePage().props.errors.error;
usePage().props.errors.message = null;
usePage().props.errors.error = null;
</script>

<template>
    <nav class="fixed top-0 right-0 left-0 h-16 w-full z-40 bg-gray-950/45">
        <div class="w-full h-full flex items-center justify-between px-[10%]">
            <div class="flex text-lg text-textColor-100 items-center font-medium">
                <Link :href="route('home')" class="mr-2"><img src="/img/logo.png" class="h-[6.8rem]"></Link>
                <Link :href="route('home')" class="mr-5">Home</Link>
                <Link :href="route('servers.create')" class="mr-5">Spawn server</Link>
                <Link v-if="user" :href="'/servers'">Management</Link>
            </div>
            <div v-if="!user" class="flex text-lg text-textColor-300 items-center font-medium">
                <Link :href="route('login')" class=""><img src="/icons/user.svg" class="h-8 invert"></Link>
            </div>
            <div v-else class="flex text-lg text-textColor-300 items-center font-medium">
                <Link :href="route('logout')"><img src="/icons/logout.svg" class="h-8 invert"></Link>
            </div>
        </div>
    </nav>
    <main class="w-full max-h-full overflow-y-auto text-white">
        <div v-if="banner" class="w-full h-80 flex items-center justify-between overflow-hidden">
            <img :src="banner" class="w-full pb-20">
        </div>
        <div v-else class="pt-20"></div>
        <slot />
    </main>
        <!-- Footer -->
    <section id="tech" class="py-20 px-6 text-center bg-gray-800 text-white">
        <h2 class="text-3xl font-bold mb-10 fade-in">Notre Technologie</h2>
        <p class="text-gray-300 max-w-3xl mx-auto">Tous nos serveurs fonctionnent dans des environnements Docker sécurisés. Ils disposent de 10Go de stockage maximum et s'éteignent automatiquement après une longue période d'inactivité pour garantir des performances optimales.</p>
        <p class="text-gray-400 mt-4">Code source disponible sur <a href="https://github.com/anulax1225/minecraft.anulax.ch" class="text-green-400 hover:underline">GitHub</a></p>
    </section>
    <footer class="bg-gray-800 text-center py-6">
        <p class="text-gray-400">&copy; 2024 Hosting - Tous droits réservés</p>
    </footer>
    <div v-if="message" class="fixed bottom-0 left-0 right-0 h-16 bg-green-600">
        <div class="relative w-full h-full flex items-center justify-center">
            <div class="absolute top-0 bottom-0 right-0 left-0">
                <div class="h-full bg-green-500 grow"></div>
            </div>
            <p class="text-white text-2xl font-bold z-10">{{ message }}</p>
        </div>        
    </div>
    <div v-if="error" class="fixed bottom-0 left-0 right-0 h-16 bg-red-600">
        <div class="relative w-full h-full flex items-center justify-center">
            <div class="absolute top-0 bottom-0 right-0 left-0">
                <div class="h-full bg-red-500 grow"></div>
            </div>
            <p class="text-white text-2xl font-bold z-10">{{ error }}</p>
        </div>        
    </div>
</template>