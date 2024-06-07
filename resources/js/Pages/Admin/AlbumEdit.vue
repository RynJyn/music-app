<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteButton from '@/Components/Admin/DeleteButton.vue';
import AdminSection from '@/Components/Admin/AdminSection.vue';
import AdminForm from '@/Components/Admin/AdminForm.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

let props = defineProps({
    album: {}
});

const form = useForm({
    title: props.album.title,
    genre: props.album.genre,
    released: props.album.released,
    artist_id: props.album.artist_id
    //photo: artist.photo
});
</script>

<template>
    <Head title="Edit Album"/>
    <AdminSection title="Edit Album">
        <AdminForm @submit.prevent="form.patch(route('album.edit', props.album))">
            <label>
                Name:
                <input type="text" v-model="form.title">
            </label>
            <label>
                Genre:
                <input type="text" v-model="form.genre">
            </label>
            <label>
                Released:
                <input type="date" v-model="form.released">
            </label>
            <label>
                Artist:
                <input type="text" v-model="form.artist_id">
            </label>
            <!--<label>
                Image:
                <input type="file">
            </label>-->
            <input type="submit" :disabled="!form.isDirty" value="Save"/>
            <p>{{ form }}</p>
        </AdminForm>
    </AdminSection>

    <DeleteButton v-on:click="form.delete(route('album.delete', album))"/>
    
</template>

<script>
export default {
    layout: AdminLayout,
    methods: {
        deleteTrack(album){
            form.delete(route("album.delete", album));
        }
    }
}
</script>