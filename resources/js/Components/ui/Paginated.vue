<script setup>
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <div class="paginated">
        <component v-for="link of links" :key="link.label" :is="link.url && !link.active ? Link : 'span'" :href="link.url" v-html="link.label"></component>
    </div>
</template>

<script>
export default {
    props: {
        links: Object
    }
}
</script>

<style>
.paginated {
    display: flex;
    gap: 1em;
    color: #eee;
}

.paginated a{
    text-decoration: underline;
    font-weight: 600;
    color: #ffdf7f;
}

/*.paginated span {
    text-decoration: underline;
}*/
</style>