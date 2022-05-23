<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Spotify Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Spotify Dashboard
            </h2>
        </template>
        <Link :href="route('spotify.auth.redirect')" class="btn btn-blue">
            Button
        </Link>
    </BreezeAuthenticatedLayout>
</template>
