<script setup>
/***TODO
 * Investigate computed components (may be good for duration variable)
 * Investigate watchers
 */
</script>

<template>
    <div id="player-bar">
        <audio id="audio" ref="audio" controls v-on:loadedmetadata="updateAudioInfo" v-on:timeupdate="setCurrentTime" style="display:none;">
            <source src="example.mp3" type="audio/mpeg" >
        </audio>
        <button type="button" v-on:click="setIsPlaying">{{ audioState.isPlaying ? "Pause" : "Play" }}</button>
        <div id="track-progress">
            <div id="current-time" class="track-info">{{ formatTime(currentTime) }}</div>
            <input type="range" id="seek" v-on:input="setSeek" v-model="audioState.seek" min="0" max="100" step="1"/>
            <div id="track-duration" class="track-info">{{ formatTime(duration) }}</div>
        </div>
        <div id="volume-controls">
            <button id="mute" type="button" v-on:click="()=>{audioState.isMuted = !audioState.isMuted}">{{ audioState.isMuted ? "Unmute" : "Mute" }}</button>
            <input type="range" id="volume" min="0" max="100" step="1" v-on:input="setVolume" v-model="volume"/>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        audioState: {
            trackId: String,
            volume: Number,
            isMuted: Boolean,
            //currentTime: Number,
            seek: Number,
            isPlaying: Boolean
        }
    },
    data() {
        return {
            currentTime: 0,
            duration: 0,
            volume: 100
        }
    },
    mounted() {
        this.audioEl = document.querySelector('audio#audio');
    },
    methods: {
        setCurrentTime(e){
            this.currentTime = e.target.currentTime;
            this.audioState.seek = ((this.currentTime / this.duration) * 100);
            return true;
        },
        setSeek(e){
            this.audioEl.currentTime = this.audioEl.duration * (e.target.value/100);
        },
        setIsPlaying(){
            this.audioState.isPlaying = !this.audioState.isPlaying;
            if(this.audioEl.paused) {
                this.audioEl.play();
            } else {
                this.audioEl.pause();
            }
        },
        updateAudioInfo(e){
            this.currentTime = e.target.currentTime;
            this.duration = e.target.duration;
        },
        setVolume(e){
            this.volume = e.target.value;
            this.audioEl.volume = (this.volume/100);
        },
        formatTime(duration) {
            const hours = String(Math.floor(duration / 3600)).padStart(2, '0');
            const minutes = String(Math.floor(duration % 3600 / 60)).padStart(2, '0');
            const seconds = String(Math.floor(duration % 3600 % 60)).padStart(2, '0');
            return `${hours !== "00" ? hours + ':' : ''}${minutes}:${seconds}`;
        }
    }
}
</script>

<style>
div#player-bar {
    background: #000;
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 1em 0.5em;
    display: flex;
    justify-content: space-between;
}

div#track-progress {
    display: flex;
    align-items: center;
    gap: 0.3em;
}

div.track-info {
    color: #fff;
}

input#seek {
    appearance: none;
    height: 15px;
    width: 300px;
    background: #fff;
    border-radius: 25px;
}

input#seek::-webkit-slider-thumb {
    appearance: none;
    cursor: pointer;
    background: burlywood;
    height: 20px;
    width: 20px;
    border-radius: 50%;
}

input#seek::-moz-range-thumb { 
    appearance: none;
    cursor: pointer;
    background: blue;
    height: 20px;
    width: 20px;
    border-radius: 50%;
}

div#player-bar button {
    background: #fff;
}
</style>