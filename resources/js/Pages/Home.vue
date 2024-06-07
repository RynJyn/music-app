<script setup>
import StreamLayout from '../Layouts/StreamLayout.vue';
import CardSection from '@/Components/Stream/CardSection.vue';
import Card from '@/Components/ui/Card.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />
    <div class="card-sections">
        <CardSection title="Latest Albums">
            <Card v-for="album in albums" 
            :key="album.id"
            :link="route('album', {id: album.id})"
            :img="{src: album.art}"
            :title="album.title">
            </Card>
        </CardSection>
    </div>
</template>

<script>
export default {
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        albums: Object
    },
    layout: StreamLayout
}</script>