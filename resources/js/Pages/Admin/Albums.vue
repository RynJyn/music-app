<script setup>
import Paginated from '@/Components/ui/Paginated.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Container from '@/Components/Container.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head :title="`Albums | Page ${albums.current_page}`"/>
    <div id="albums">
        <div class="album-details" v-for="album of albums.data" :key="album.id">
            <Container>
                <p>{{ album.id }}</p>
                <p>{{ album.title }}</p>
                <Link :href="route('album.edit', album)">Edit</Link>
            </Container>
        </div>

        <Container>
            <Paginated :links="albums.links"/>
        </Container>
    </div>
</template>

<script>
export default {
    layout: AdminLayout,
    props: {
        albums: Object
    }
}
</script>

<style>
div#albums {
    display: flex;
    flex-direction: column;
    gap: 1em;
}

div.album-details div {
    display: flex;
    justify-content: space-between;
    padding: 1em;
    background: #333;
    font-weight: 600;
    color: #eee;
    border: 1px solid #ffdf7f;
    border-radius: 0.3em;
}

div.album-details div a {
    font-weight: 600;
    text-decoration: underline;
    color: #ffdf7f;
}
</style>