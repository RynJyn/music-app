<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import DeleteButton from '@/Components/Admin/DeleteButton.vue';
import AdminSection from '@/Components/Admin/AdminSection.vue';
import AdminForm from '@/Components/Admin/AdminForm.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

let props = defineProps({
    track: {}
});

const form = useForm({
    title: props.track.title,
    duration: props.track.duration,
    filename: props.track.filename,
    album_id: props.track.album_id
    //photo: artist.photo
});
</script>

<template>
    <Head title="Edit Track"/>
    <AdminSection title="Edit Track">
        <AdminForm @submit.prevent="form.patch(route('track.edit', props.track))">
            <label>
                Name:
                <input type="text" v-model="form.title">
            </label>
            <label>
                Duration:
                <input type="text" v-model="form.duration">
            </label>
            <label>
                Filename:
                <input type="text" v-model="form.filename">
            </label>
            <label>
                Album:
                <input type="text" v-model="form.album_id">
            </label>
            <!--<label>
                Image:
                <input type="file">
            </label>-->
            <input type="submit" :disabled="!form.isDirty" value="Save"/>
            <p>{{ form }}</p>
        </AdminForm>
    </AdminSection>
    
    <DeleteButton v-on:click="form.delete(route('track.delete', track))"/>
    
</template>

<script>
export default {
    layout: AdminLayout,
    methods: {
        deleteTrack(track){
            form.delete(route("track.delete", track));
        }
    }
}
</script>