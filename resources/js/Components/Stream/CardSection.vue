<template>
    <section class="card-section">
        <h2>{{ title }}</h2>
        <div class="cards" :class="{multirow: rows > 1}">
            <slot/>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        title: String,
        rows: Number
    }
}
</script>

<style>
section.card-section {
    display: flex;
    flex-direction: column;
    gap: 1em;
}

section.card-section > h2 {
    font-size: 1.35rem;
    font-weight: bold;
    color: #ffdf7f;
}

section.card-section div.cards {
    display: grid;
    --rows: 1;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-template-rows: repeat(var(--rows), minmax(0, 1fr));
    grid-auto-rows: 0;
    overflow: hidden;
    grid-column-gap: 1em;
}

section.card-section div.cards.multirow {
    grid-row-gap: 1em;
}
</style>