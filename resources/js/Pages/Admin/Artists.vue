<script setup>
import Paginated from '@/Components/ui/Paginated.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Container from '@/Components/Container.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="`Artists | Page ${artists.current_page}`"/>
    <div id="artists">
        <div class="artist-details" v-for="artist of artists.data" :key="artist.id">
            <Container>
                <p>{{ artist.id }}</p>
                <p>{{ artist.name }}</p>
                <Link :href="route('artist.edit', artist)">Edit</Link>
            </Container>
        </div>

        <Container>
            <Paginated :links="artists.links"/>
        </Container>
    </div>
</template>

<script>
export default {
    layout: AdminLayout,
    props: {
        artists: Object
    }
}
</script>

<style>
div#artists {
    display: flex;
    flex-direction: column;
    gap: 1em;
}

div.artist-details div {
    display: flex;
    justify-content: space-between;
    padding: 1em;
    background: #333;
    font-weight: 600;
    color: #eee;
    border: 1px solid #ffdf7f;
    border-radius: 0.3em;
}

div.artist-details div a {
    font-weight: 600;
    text-decoration: underline;
    color: #ffdf7f;
}
</style>