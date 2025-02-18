<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import Layout from '@/Layouts/Layout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Layout>
        <div class="w-full h-screen flex items-center justify-center">
            <div class="w-full max-w-md bg-gray-800 p-8 rounded-lg shadow-lg fade-in">
            <!-- Boutons de bascule -->
            <!-- <div class="flex justify-end mb-6">
                <Link class="rounded-md text-sm text-textColor-600 underline hover:text-textColor-900 
                focus:outline-none">Inscription</Link>
            </div> -->

            <!-- Formulaire de Connexion -->
            <form @submit.prevent="submit" class=" space-y-4 my-2 pt-1">
                <div class="flex items-center rounded-lg">
                    <img src="/icons/user.svg" alt="User" class="w-6 h-6 mr-1">
                    <TextInput
                        id="email"
                        type="email"
                        class="block w-full bg-transparent focus:outline-none"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
                </div>
                <InputError class="mt-2" :message="form.errors.email" />
                <div class="flex items-center">
                    <img src="/icons/lock.svg" alt="Lock" class="w-6 h-6 mr-1">
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full bg-transparent focus:outline-none"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                </div>
                <InputError class="mt-2" :message="form.errors.password" />
                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg shadow-md transition-all">
                    Se connecter
                </button>
                <div class="mt-4 flex items-center justify-between">
                    <label class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ms-2 text-sm text-textColor-600"
                            >Remember me</span
                        >
                    </label>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="rounded-md text-sm text-textColor-600 underline hover:text-textColor-900 
                        focus:outline-none"
                    >
                        Forgot your password?
                    </Link>
                </div>
            </form>
        </div>
        </div>
    </Layout>
</template>
