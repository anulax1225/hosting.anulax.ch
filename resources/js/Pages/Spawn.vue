<script setup>
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import axios from 'axios';

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
</script>

<template>
    <Head title="Spawn" />
    <form @submit.prevent="submit" class="flex flex-col w-full items-center">
        <TextInput v-model="form.name" type="text" class="w-96 my-2"></TextInput>
        <TextInput v-model="form.port" type="text" class="w-36 mb-2"></TextInput>
        <PrimaryButton type="submit">submit</PrimaryButton>
    </form>
    <p>coucou</p>
</template>