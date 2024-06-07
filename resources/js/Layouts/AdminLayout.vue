<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.user;

</script>

<template>
    <header id="admin-header">
        <nav id="admin-nav">
            <Link href="#">Dashboard</Link>
            <Link :href="route('admin.new')">New Item</Link>
            <Link :href="route('admin.artists')">Artists</Link>
            <Link :href="route('admin.albums')">Albums</Link>
            <Link :href="route('admin.tracks')">Tracks</Link>
        </nav>
    </header>

    <main id="admin-main">
        <slot />
    </main>
</template>

<style>
body {
    background: #131a24;
}

header#admin-header {
    background: #0c1118;
}

nav#admin-nav {
    width: 90%;
    margin: auto;
    max-width: 1400px;
    padding: 1em 0;
    color: #ffdf7f;
    font-weight: 600;
    display: flex;
    gap: 1em;
    font-size: 1.1rem;
}

main#admin-main {
    padding: 1em 0
}
</style>