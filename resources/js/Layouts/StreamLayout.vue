<script setup>
import { Link } from '@inertiajs/vue3';
import PlayerBar from '@/Components/Stream/PlayerBar.vue';
import SideBar from '@/Components/ui/SideBar.vue';
</script>

<template>
    <SideBar class="nav-sidebar">
        <nav>
            <Link :href="route('home')">Home</Link>
            <Link :href="route('search')">Search</Link>
        </nav>
    </SideBar>
    <div id="main-wrapper">
        <header id="main-header">
            <input type="text" v-if="route().current('search')" placeholder="Search...">
        </header>
        <main id="main-content">
            <slot></slot>
        </main>
    </div>
    <PlayerBar :audioState="audioState"/>
</template>

<script>
export default {
    data(){
        return {
            audioState: {
                trackId: '',
                volume: 100,
                isMuted: false,
                //currentTime: 0,
                seek: 0,
                isPlaying: false
            }
        }
    }
}
</script>

<style>
html,body {
    height: 100%;
}

div#app {
    height: 100%;
    display: flex;
}

div#main-wrapper { 
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 1em;
}

.nav-sidebar {
    background: #000;
    height: 100%;
    width: 90%;
    max-width: 300px;
    color: #eee;
    position: relative;
    left: 0;
    padding: 1em;
}

.nav-sidebar nav {
    display: flex;
    flex-direction: column;
}
</style>