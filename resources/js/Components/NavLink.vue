<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center px-1 pt-1 border-b-2 border-blue-400 text-md font-bold leading-5' + 
        ' text-textColor-50 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
        : 'flex items-center px-1 pt-1 border-b-2 border-transparent text-md font-medium ' +
        'leading-5 text-textColor-200 hover:text-textColor-100 hover:border-blue-500 focus:outline-none ' +
        'focus:text-textColor-700 focus:border-gray-300 transition duration-150 ease-in-out',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
