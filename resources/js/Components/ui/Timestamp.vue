<template>
    {{ formatted }}
</template>

<script>
export default {
    props:{
        seconds: Number|String
    },
    data(){
        return {
            formatted: 0
        }
    },
    beforeMount(){
        this.formatted = this.formatTime(this.seconds);
    },
    updated(){
        this.formatted = this.formatTime(this.seconds);
    },
    methods:{
        formatTime(duration) {
            const hours = String(Math.floor(duration / 3600)).padStart(2, '0');
            const minutes = String(Math.floor(duration % 3600 / 60)).padStart(2, '0');
            const seconds = String(Math.floor(duration % 3600 % 60)).padStart(2, '0');
            return `${hours !== "00" ? hours + ':' : ''}${minutes}:${seconds}`;
        }
    }
}
</script>