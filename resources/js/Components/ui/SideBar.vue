<template>
    <aside>
        <slot></slot>
    </aside>
</template>

<script>
export default {
    props: {
        anchor: {
            type: String,
            default: "left"
        }
    }
}
</script>