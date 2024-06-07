<script setup>
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { usePlayerStore } from '@/stores/player';
import PlayerBar from '@/Components/Stream/PlayerBar.vue';
import SideBar from '@/Components/ui/SideBar.vue';
import Logo from '@/Components/Logo.vue';

const search = ref("");

watch(search, function(val){
    router.visit(route('results', {query: val.toLowerCase()}), {
        method: 'get', 
        replace: true,
        preserveState: true
    });
});

const player = usePlayerStore();

player.init();

</script>

<template>
    <SideBar class="nav-sidebar">
        <Logo/>
        <nav>
            <Link :href="route('home')">Home</Link>
            <Link :href="route('search')">Search</Link>
        </nav>
    </SideBar>
    <div id="main-wrapper">
        <header id="main-header">
            <input type="text" v-model="search" placeholder="Search...">
            <div v-if="!$page.props.auth.user && (route().has('login') || route().has('register'))" class="login-buttons">
                <Link v-if="route().has('login')" :href="route('login')">Log in</Link>
                <Link v-if="route().has('register')" :href="route('register')">Sign up</Link>
            </div>
            <Link v-else :href="route('profile.edit')" class="profile-icon">
                <span>{{ $page.props.auth.user.name[0] }}</span>
            </Link>
        </header>
        <main id="main-content">
            <slot></slot>
        </main>
    </div>
    <PlayerBar/>
</template>

<style>
html,body {
    height: 100%;
}

h1, h2, h3, p, span {
    color: #eee;
}

div#app {
    height: 100%;
    display: flex;
}

div#main-wrapper { 
    display: flex;
    flex-direction: column;
    width: 100%;
    overflow-y: auto;
    padding: 1em;
    padding-bottom: 10em;
    background-color: #131a24;
    gap: 1em;
}

div.login-buttons{
    color: #eee;
    display: flex;
    gap: 1em;
}

.nav-sidebar {
    background: #202b3d;
    height: 100%;
    width: 90%;
    max-width: 300px;
    color: #eee;
    position: relative;
    left: 0;
    padding: 1em;
    display: flex;
    flex-direction: column;
    gap: 1em;
}

.nav-sidebar nav {
    display: flex;
    flex-direction: column;
    gap: 0.5em;
}

.nav-sidebar p#app-logo {
    font-weight: 900;
}

.nav-sidebar nav a {
    font-size: 1.1rem;
    font-weight: 600;
}

header#main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header#main-header input{
    background: none;
    color: #eee;
    border: 2px solid #998959;
    border-radius: 25px;
}

.profile-icon {
    background: purple;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-icon span {
    font-weight: 600;
}

h1{
    color: #eee;
}
</style>