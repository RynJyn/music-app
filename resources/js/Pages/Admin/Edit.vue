<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';
import AddArtistForm from './Partials/AddArtistForm.vue';
import AddAlbumForm from './Partials/AddAlbumForm.vue';
import AddTrackForm from './Partials/AddTrackForm.vue';
</script>

<template>
    <Head title="Admin"/>
    <h1>Admin</h1>

    <AddArtistForm/>

    <AddAlbumForm/>

    <AddTrackForm/>
</template>

<script>
export default {
    layout: AdminLayout
}
</script>