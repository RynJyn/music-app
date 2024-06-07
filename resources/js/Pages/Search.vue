<script setup>
import StreamLayout from '../Layouts/StreamLayout.vue';
import CardSection from '@/Components/Stream/CardSection.vue';
import Card from '@/Components/ui/Card.vue';
import { Head, Link } from '@inertiajs/vue3';

const imgStore = import.meta.env.VITE_LOCAL_IMAGE_STORE;
</script>

<template>
    <Head title="Search" />
    <div class="card-sections">
        <CardSection title="Artists" :rows="1">
            <Card v-for="artist in artists" 
            :key="artist.id" 
            :link="route('artist', {id: artist.id})"
            :img="{src: artist.photo.search('http') != -1 ? artist.photo : (imgStore + artist.photo)}"
            :title="artist.name">
            </Card>
        </CardSection>
        <CardSection title="Genres" :rows="1">
            <Card v-for="genre in genres" 
            :key="genre.genre" 
            :link="route('genre', {genre: genre.genre.toLowerCase()})"
            :title="genre.genre">
            </Card>
        </CardSection>
    </div>
</template>

<script>
export default {
    layout: StreamLayout,
    props: {
        'artists': Object,
        'genres': Object
    }
}
</script>

<style>
div.card-sections {
    display: flex;
    flex-direction: column;
    gap: 2em;
}

section a{
    color: #eee;
}

div#artist-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 1em;
}

div#artist-cards img {
    max-width: 200px;
    height: 200px;
}
</style>