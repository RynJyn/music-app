<script setup>
import StreamLayout from '../Layouts/StreamLayout.vue';
import AlbumInfo from '@/Components/Stream/AlbumInfo.vue';
import TrackListing from '@/Components/Stream/TrackListing.vue';

import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="album.title"/>
    <AlbumInfo :artist="artist" :album="album" :trackCount="Object.keys(tracks).length">
        <TrackListing :info="$props"/>
    </AlbumInfo>
</template>

<script>
export default {
    layout: StreamLayout,
    props: {
        artist: Object,
        album: Object,
        tracks: Object
    }
}
</script>