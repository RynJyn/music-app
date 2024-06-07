<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import AdminSection from '@/Components/Admin/AdminSection.vue';
import AdminForm from '@/Components/Admin/AdminForm.vue';

const user = usePage().props.auth.user;

const form = useForm({
    name: "",
    genre: "",
    //photo: null
});
</script>

<template>
    <AdminSection title="Add New Artist">
        <!--<header>
            <h2>Add New Artist</h2>
        </header>-->

        <AdminForm @submit.prevent="form.put(route('artist.new'))">
            <label for="artist-name">
                Artist Name:
                <input id="artist-name" type="text" v-model="form.name" required/>
            </label>
            <label for="artist-genre">
                Genre:
                <input id="artist-genre" type="text" v-model="form.genre" required/>
            </label>
            <!--<label for="artist-photo">
                Photo:
                <input id="artist-photo" type="file" v-on:change="form.photo = $event.target.files[0]" required/>
            </label>-->
            <input type="submit" :disabled="form.processing || !form.isDirty" value="Add"/>
            <p>{{ form }}</p>
            <p v-if="form.recentlySuccessful">Saved.</p>
        </AdminForm>
    </AdminSection>
</template>

<script>
export default {

}
</script>