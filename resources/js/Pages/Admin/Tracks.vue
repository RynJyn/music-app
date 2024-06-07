<script setup>
import Paginated from '@/Components/ui/Paginated.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Container from '@/Components/Container.vue';
import Timestamp from '@/Components/ui/Timestamp.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="`Tracks | Page ${tracks.current_page}`"/>
    <div id="tracks">
        <div class="track-details" v-for="track of tracks.data" :key="track.id">
            <Container>
                <p>{{ track.id }}</p>
                <p>{{ track.title }}</p>
                <p class="track-duration"><Timestamp :seconds="track.duration"></Timestamp></p>
                <Link :href="route('track.edit', track)">Edit</Link>
            </Container>
        </div>

        <Container>
            <Paginated :links="tracks.links"/>
        </Container>
    </div>
</template>

<script>
export default {
    layout: AdminLayout,
    props: {
        tracks: Object
    }
}
</script>

<style>
div#tracks {
    display: flex;
    flex-direction: column;
    gap: 1em;
}

div.track-details div {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 1em;
    background: #333;
    font-weight: 600;
    color: #eee;
    border: 1px solid #ffdf7f;
    border-radius: 0.3em;
}

div.track-details p.track-duration {
    text-align: right;
}

div.track-details div a {
    font-weight: 600;
    text-decoration: underline;
    color: #ffdf7f;
    text-align: right;
}
</style>