<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import { onMounted, onUpdated, ref, watch } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const user = usePage().props.auth.user;
const banner = usePage().props.banner;
const message = ref(usePage().props.errors.message);
const error = ref(usePage().props.errors.error);

const isFocus = ref(false);

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
    <nav class="fixed top-0 right-0 left-0 h-16 w-full z-50 bg-gray-950/45">
        <div class="w-full h-full flex items-center justify-between lg:px-[10%] md:px-[5%]">
            
            <div class="flex text-lg text-textColor-100 items-center font-medium h-full">
                <Link :href="route('home')" class="md:mr-2"><img src="/img/logo.png" class="md:h-[6.8rem] h-[6.3rem]"></Link>
                <NavLink :href="route('home')" :active="route().current('home')" class="mr-5 h-full md:flex items-center hidden">Home</NavLink>
                <NavLink :href="route('servers.create')" :active="route().current('servers.create')" class="mr-5 h-full md:flex items-center hidden">Spawn server</NavLink>
                <NavLink v-if="user" 
                :href="route('servers.index')" :active="route().current('servers.index') || route().current('servers.show')" 
                class="h-full md:flex items-center hidden">Management</NavLink>
            </div>
            <div v-if="!user" class="md:flex hidden text-lg text-textColor-300 items-center font-medium md:mr-5 mr-1 h-full">
                <NavLink :href="route('login')" :active="route().current('login')" class="mr-5 md:flex items-center hidden h-full">Log in</NavLink>
            </div>
            <div v-else class="md:flex hidden text-lg text-textColor-300 items-center font-medium md:mr-5 mr-1 h-full">
                <NavLink :href="route('logout')" :active="route().current('logout')" class="mr-5 h-full md:flex items-center hidden">Log out</NavLink>
            </div>
            <button @click="isFocus = !isFocus" class="md:hidden">
                <img src="/icons/menu.svg" class="h-12 invert mr-1">
            </button>
        </div>
    </nav>
    <div v-show="isFocus" class="md:hidden fixed top-0 right-0 left-0 bottom-0 pt-16 w-full z-40 bg-gray-800">
        <div class="flex flex-col gap-1">
            <ResponsiveNavLink :href="route('home')" :active="route().current('home')" class="mr-5">Home</ResponsiveNavLink>
            <ResponsiveNavLink :href="route('servers.create')" :active="route().current('servers.create')" class="mr-5">Spawn server</ResponsiveNavLink>
            <ResponsiveNavLink v-if="user" :href="route('servers.index')" :active="route().current('servers.index') || route().current('servers.show')">Management</ResponsiveNavLink>
            <ResponsiveNavLink v-if="!user" :href="route('login')" :active="route().current('login')" class="items-center">Log in</ResponsiveNavLink>
            <ResponsiveNavLink v-else :href="route('logout')" :active="route().current('logout')" class="items-center">Log out</ResponsiveNavLink>
        </div>
    </div>
    <main class="w-full max-h-full overflow-y-auto text-white">
        <div v-if="banner" class="w-full md:h-80 flex items-center justify-between overflow-hidden">
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