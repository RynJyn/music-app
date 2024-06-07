<script setup>
const imgStore = import.meta.env.VITE_LOCAL_IMAGE_STORE;
</script>

<template>
    <div class="album-info">
        <div class="album-details-wrapper">
            <img :src="album.art.search('http') !== -1 ? album.art : (imgStore + album.art)" height="200" width="200"/>
            <div class="album-details">
                <h2>{{ album.title }}</h2>
                <p>Released {{ new Date(album.released).toLocaleDateString(undefined, {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) }}</p>
                <p v-if="trackCount">{{ `${trackCount} ${trackCount === 1 ? 'track' : 'tracks'}` }}</p>
                <p v-if="artist">{{ `by ${artist.name}` }}</p>
            </div>
        </div>
        <slot/>
    </div>
</template>

<script>
export default {
    props: {
        album: Object,
        trackCount: Number,
        artist: {
            type: Object,
            required: false
        }
    }
}
</script>

<style>
.album-details-wrapper, .album-details{
    display: flex;
    gap: 1em;
}

.album-details{
    flex-direction: column;
    color: #eee;
}

.album-details h2{
    font-weight: bold;
    font-size: 2rem;
    text-transform: uppercase;
}
</style>