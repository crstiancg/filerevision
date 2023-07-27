<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 ">
        <div>
            <Link href="/">
                <div class="text-4xl font-bold text-indigo-500">Trabajos 2</div>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden shadow-2xl shadow-blue-300 rounded-xl"
        >
            <slot />
        </div>
    </div>
</template>
