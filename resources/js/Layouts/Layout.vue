<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <nav class="fixed top-0 right-0 left-0 h-16 w-full z-40 bg-gray-950/25">
        <div class="w-full h-full flex items-center justify-between px-[10%]">
            <div class="flex text-lg text-textColor-100 items-center font-medium">
                <Link :href="route('home')" class="mr-2"><img src="/img/logo.png" class="h-[6.8rem]"></Link>
                <Link :href="route('home')" class="mr-5">Home</Link>
                <Link :href="route('servers.create')" class="mr-5">Spawn server</Link>
                <Link :href="'/servers'">Management</Link>
            </div>
            <div class="flex text-lg text-textColor-300 items-center font-medium">
                <Link :href="route('login')" class=""><img src="/icons/user.svg" class="h-8 invert"></Link>
            </div>
        </div>
    </nav>
    <main class="w-full max-h-full overflow-y-auto text-white">
        <div class="w-full h-80 flex items-center justify-between overflow-hidden">
            <img src="/img/banner.jpg" class="w-full pb-96">
        </div>
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
</template>