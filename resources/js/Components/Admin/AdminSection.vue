<script setup>
import Container from '@/Components/Container.vue';
</script>

<template>
    <Container>
        <section class="admin-section">
            <header>
                <h2>{{ title }}</h2>
            </header>
            <slot/>
        </section>
    </Container>
</template>

<style>
section.admin-section {
    margin: 1em auto;
    background: #eee;
    border-radius: 1em;
    padding: 1em;
    display: flex;
    flex-direction: column;
    gap: 1em;
}

section.admin-section header h2{
    text-align: center;
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
}
</style>

<script>
export default {
    props: {
        title: String
    }
}
</script>