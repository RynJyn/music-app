<script setup>
import { ref, watch, isProxy, toRaw} from "vue";
import { useForm, usePage, router } from '@inertiajs/vue3';
import AdminSection from "@/Components/Admin/AdminSection.vue";
import AdminForm from "@/Components/Admin/AdminForm.vue";

const user = usePage().props.auth.user;

const form = useForm({
    title: "",
    duration: "",
    file: "",
    album_id: ""
});
</script>

<template>
    <AdminSection title="Add New Track">
        <AdminForm @submit.prevent="form.put(route('track.new'))">
            <label for="track-title">
                Title:
                <input type="text" id="track-title" v-model="form.title"/>
            </label>
            <label for="duration">
                Duration (seconds):
                <input type="text" id="track-duration" v-model="form.duration"/>
            </label>
            <label for="file">
                Filename:
                <input type="text" id="track-file" v-model="form.file"/>
            </label>
            <label for="track-album">
                Album:
                <input list="track-album" v-model="form.album_id" v-on:keypress="getAlbums"/>
                <datalist id="track-album">
                    <option v-for="album of albums" :key="album.id" :value="album.id">{{ `${album.title} by ${album.artist.name}` }}</option>
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
            albums: null
        }
    },
    methods: {
        getAlbums(input){
            const query = input.target.value;
            console.log(query);

            axios.get(route('albums.api', {
                title: query
            }))
            .then((res) => {
                this.albums = res.data.albums;
            })
        }
    }
}
</script>