<script setup>
import StreamLayout from '../Layouts/StreamLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />
    <h1>Home</h1>
</template>

<script>
export default {
    props: {
        canLogin: Boolean,
        canRegister: Boolean
    },
    layout: StreamLayout
}</script>