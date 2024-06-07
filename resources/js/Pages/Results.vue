<script setup>
import StreamLayout from '@/Layouts/StreamLayout.vue';
import CardSection from '@/Components/Stream/CardSection.vue';
import Card from '@/Components/ui/Card.vue';
import TrackListing from '@/Components/Stream/TrackListing.vue';

import { Head } from '@inertiajs/vue3';

const imgStore = import.meta.env.VITE_LOCAL_IMAGE_STORE;

</script>

<template>
    <Head title="Search"/>
    <div class="card-sections">
        <CardSection v-if="results.artists.length > 1" title="Artists">
            <Card v-for="artist of results.artists" 
            :key="artist.id" 
            :link="route('artist', {id: artist.id})"
            :img="{src: artist.photo.search('http') != -1 ? artist.photo : (imgStore + artist.photo)}" 
            :title="artist.name"></Card>
        </CardSection>

        <CardSection v-if="results.albums.length > 1" title="Albums">
            <Card v-for="album of results.albums" 
            :key="album.id" 
            :link="route('album', {id: album.id})"
            :img="{src: album.art.search('http') != -1 ? album.art : (imgStore + album.art)}" 
            :title="album.title"></Card>
        </CardSection>

        <section class="result-section" v-if="results.trackSearch?.tracks.length > 1">
            <h2>Tracks</h2>
            <TrackListing :info="results.trackSearch"/>
        </section>
    </div>
</template>

<script>
export default {
    layout: StreamLayout,
    props: {
        results: Object
    }
}
</script>

<style>
div.card-sections {
    display: flex;
    flex-direction: column;
    gap: 2em;
}

section.result-section > h2{
    font-size: 1.35rem;
    font-weight: bold;
    color: #ffdf7f;
}
</style>