<script setup>
import StreamLayout from '@/Layouts/StreamLayout.vue';
import AlbumInfo from '@/Components/Stream/AlbumInfo.vue';
import TrackListing from '@/Components/Stream/TrackListing.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="artist.name" />
    <img :src="artist.photo"/>
    <h1 id="artist-name">{{ artist.name }}</h1>
    <h3 id="artist-albums">Albums</h3>
    <AlbumInfo v-for="album of results" :key="album.id" :album="album" :trackCount="album.tracks.length">
        <TrackListing :info="{artist: artist, album: album, tracks: album.tracks}"/>
    </AlbumInfo>
</template>

<script>
export default {
    layout: StreamLayout,
    props: {
        'artist': Object,
        'results': Object
    }
}
</script>

<style>
h1#artist-name{
    font-size: 2.5rem;
    font-weight: bold;
    color: #ffdf7f;
}

h3#artist-albums{
    font-size: 1.5rem;
    color: #eee;
}
</style>