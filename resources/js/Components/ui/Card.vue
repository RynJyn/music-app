<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <component class="card" :is="link ? Link : 'div'" :href="link">
        <img v-if="!!img" width="200" height="200" :src="img.src" :style="{height: img.height + 'px', width: img.width + 'px'}"/>
        <span>{{ title }}</span>
    </component>
</template>

<script>
export default {
    props: {
        link: String,
        img: {
            src: String,
            height: {
                type: String|Number,
                default: 200
            },
            width: {
                type: String|Number, 
                default: 200
            }
        },
        title: String
    }
}
</script>

<style>
</style>