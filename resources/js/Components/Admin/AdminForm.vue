<template>
    <form class="admin-form">
        <slot />
    </form>
</template>

<style>
.admin-form {
    /*color: #eee;*/
    display: flex;
    flex-direction: column;
    margin: auto;
    align-items: center;
    gap: 2em;
}

.admin-form label {
    display: flex;
    gap: 1em;
    flex-direction: column;
    align-items: center;
    font-weight: 600;
    color: #555;
}

.admin-form input:not([type="submit"]) {
    color: #555;
    border: 1px solid #ffdf7f;
    border-radius: 1em;
    background: #fff;
}

.admin-form input[type="submit"]{
    background: #ffdf7f;
    font-weight: 600;
    color: #333;
    border-radius: 0.3em;
    padding: 0.5em 1.5em;
    cursor: pointer;
}

.admin-form input[type="submit"]:disabled{
    background-color: #333;
    color: #999;
    cursor: not-allowed;
}

.admin-form p {
    color: #555;
    text-align: center;
}
</style>