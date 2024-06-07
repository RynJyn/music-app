<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteButton from '@/Components/Admin/DeleteButton.vue';
import AdminForm from '@/Components/Admin/AdminForm.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

let props = defineProps({
    artist: {}
});

const form = useForm({
    name: props.artist.name,
    genre: props.artist.genre,
    //photo: artist.photo
});
</script>

<template>
    <Head :title="form.name"/>
    <AdminForm @submit.prevent="form.patch(route('artist.edit', props.artist))">
        <label>
            Name:
            <input type="text" v-model="form.name">
        </label>
        <label>
            Genre:
            <input type="text" v-model="form.genre">
        </label>
        <!--<label>
            Image:
            <input type="file">
        </label>-->
        <input type="submit" :disabled="!form.isDirty" value="Save"/>
        <p>{{ form }}</p>
    </AdminForm>
    <DeleteButton v-on:click="form.delete(route('artist.delete', artist))"/>
    
</template>

<script>
export default {
    layout: AdminLayout,
    methods: {
        deleteArtist(artist){
            form.delete(route("artist.delete", artist));
        }
    }
}
</script>