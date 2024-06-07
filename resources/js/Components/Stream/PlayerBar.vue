<script setup>
import Timestamp from '../ui/Timestamp.vue';
import PlayPause from '../ui/PlayPause.vue';
import MuteButton from '@/Components/Stream/MuteButton.vue';
import Slider from '../ui/Slider.vue';
import { Link } from '@inertiajs/vue3';
import { usePlayerStore } from '@/stores/player';

const player = usePlayerStore();
const imgStore = import.meta.env.VITE_LOCAL_IMAGE_STORE;
</script>

<template>
    <div id="player-bar">
        <div id="current-track">
            <img :src="player.currentTrack.album.art.search('http') !== -1 ? player.currentTrack.album.art : (imgStore + player.currentTrack.album.art)" height="100" width="100"/>
            <div id="current-track-info">
                <p>{{ player.currentTrack.title }}</p>
                <Link :href="route('artist', {id: player.currentTrack.artist.id})">{{ player.currentTrack.artist.name }}</Link>
            </div>
        </div>
        <div class="track-controls">
            <div class="audio-controls">
                <PlayPause :onClick="player.toggle" :isPlaying="player.isPlaying" id="audio-playpause"/>
            </div>
            <div id="track-progress">
                <div id="current-time" class="track-info"><Timestamp :seconds="player.currentTime"/></div>
                <Slider id="seek" :onInput="function(e){player.setSeek(e.target.value)}" min="0" max="100" step="1" :value="player.seek"></Slider>
                <div id="track-duration" class="track-info"><Timestamp :seconds="player.duration"/></div>
            </div>
        </div>
        <div id="volume-controls">
            <MuteButton :onClick="()=>{player.toggleMute()}" :volume="player.volume" :isMuted="player.isMuted"/>
            <Slider id="volume" :onInput="function(e){player.setVolume(e.target.value)}" :value="player.volume"></Slider>
        </div>
    </div>
</template>

<style>
div#player-bar {
    background: #0c1118;
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 1em 0.5em;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

div#current-track{
    color: #fff;
    display: flex;
    align-items: center;
    gap: 0.5em;
}

div#current-track-info{
    display: flex;
    flex-direction: column;
}

div#current-track-info a:hover{
    text-decoration: underline;
}

div.track-controls{
    display: flex;
    flex-direction: column;
    gap: 1em;
    align-items: center;
}

div#player-bar button#audio-playpause{
    background: transparent;
    height: 24px;
    width: 24px;
}

div#player-bar button#audio-playpause svg{
    height: 100%;
    width: 100%;
    fill: #eee;
}

div#track-progress {
    display: flex;
    align-items: center;
    gap: 0.3em;
}

div.track-info {
    color: #fff;
}

#seek {
    height: 15px;
    width: 300px;
}

#volume {
    height: 15px;
    width: 150px;
}

div#volume-controls {
    display: flex;
    align-items: center;
    gap: 0.3em;
}
</style>