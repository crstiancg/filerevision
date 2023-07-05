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
        ? 'bg-gray-400 dark:bg-gray-500'
        : ''
);

</script>

<template>
    <Link :href="href" :class="classes" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white  dark:hover:bg-gray-700">
        <slot />
    </Link>
</template>
