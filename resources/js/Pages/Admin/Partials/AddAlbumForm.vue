<script setup>
import { ref, watch } from "vue";
import { useForm, usePage, router } from '@inertiajs/vue3';
import AdminSection from '@/Components/Admin/AdminSection.vue';
import AdminForm from "@/Components/Admin/AdminForm.vue";

const user = usePage().props.auth.user;

const form = useForm({
    title: "",
    genre: "",
    released: "",
    artist_id: ""
});
</script>

<template>
    <AdminSection title="Add New Album">
        <AdminForm @submit.prevent="form.put(route('album.new'))">
            <label for="album-title">
                Title:
                <input type="text" id="album-title" v-model="form.title"/>
            </label>
            <label for="album-genre">
                Genre:
                <input type="text" id="album-genre" v-model="form.genre"/>
            </label>
            <label for="album-released">
                Released:
                <input type="date" id="album-released" v-model="form.released"/>
            </label>
            <label for="album-artist">
                Artist:
                <input list="album-artist" v-model="form.artist_id" v-on:keypress="getArtists"/>
                <datalist id="album-artist">
                    <option v-for="artist of artists" :key="artist.id" :value="artist.id">{{ artist.name }}</option>
                </datalist>
            </label>
            <input type="submit" :disabled="form.processing || !form.isDirty" value="Add"/>
            <p>{{ form }}</p>
            <p v-if="form.recentlySuccessful">Saved.</p>
        </AdminForm>
    </AdminSection>
</template>

<script>
export default {
    data(){
        return {
            artists: {}
        }
    },
    methods: {
        getArtists(e){
            const query = e.target.value;
            console.log(query);

            axios.get(route('artists.api', {
                name: query
            }))
            .then((res) => {
                this.artists = res.data.artists;
            })
        }
    }
}
</script>