<template>
    <input type="range" class="slider" v-on:input="onInput" :min="min" :max="max" :step="step" :value="value"/>
</template>

<script>
export default {
    props: {
        onInput: Function,
        model: Number,
        min: String,
        max: String,
        step: String,
        value: Number|String
    }
}
</script>

<style>
input.slider {
    appearance: none;
    background: #fff;
    border-radius: 25px;
}

input.slider::-webkit-slider-thumb {
    appearance: none;
    cursor: pointer;
    background: burlywood;
    height: 20px;
    width: 20px;
    border-radius: 50%;
}

input.slider::-moz-range-thumb { 
    appearance: none;
    cursor: pointer;
    background: burlywood;
    height: 20px;
    width: 20px;
    border-radius: 50%;
}
</style>