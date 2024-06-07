<script setup>
import Timestamp from '../ui/Timestamp.vue';

import { usePlayerStore } from '@/stores/player';
</script>

<template>
    <div class="track-list">
        <div class="track-details" :class="{'is-playing': track.id == player.isPlaying}" v-for="track of info.tracks" :key="track.id" v-on:dblclick="prepareTrack(track)">
            <button v-on:click="prepareTrack(track)" type="button">{{ (track.id == player.currentTrack.id) && player.isPlaying ? "Pause" : "Play" }}</button>
            <p>{{ track.title }}</p>
            <p><Timestamp :seconds=track.duration /></p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        info: Object
    },
    data() {
        return{
            player: usePlayerStore(),
            interactedTrack: false
        }
    },
    methods: {
        prepareTrack(track){
            this.interactedTrack = track;
            let options = {
                id: track.id,
                artist: !this.info.artist,
                album: !this.info.album
            };

            this.fetchTrackData(options)
        },
        fetchTrackData(options){
            axios.get(route('track.api', options))
            .then((res) => {
                this.playTrack(res.data);
            })
        },
        playTrack(trackData){
            const trackToPlay = {...trackData, ...this.interactedTrack};
            if(!trackToPlay.album){
                trackToPlay.album = {...this.info.album}
            }
            if(!trackToPlay.artist){
                trackToPlay.artist = {...this.info.artist}
            }

            if(trackToPlay.filename.search('http') === -1){
                trackToPlay.filename = (import.meta.env.VITE_LOCAL_TRACK_STORE + trackToPlay.filename);
            }

            this.player.setCurrentTrack(trackToPlay);
            this.player.toggle();
        }
    }
}
</script>

<style>
.track-list{
    margin: 1em 0;
}

.track-details{
    display: flex;
    gap: 1em;
    justify-content: space-between;
    padding: 1em;
    user-select: none;
    color: #eee;
    font-weight: 600;
}

.track-details:nth-of-type(odd){
    background: #263449
}

.track-details:nth-of-type(odd):hover{
    background: #334561;
}

.track-details:nth-of-type(even){
    background: #99854c;
}

.track-details:nth-of-type(even):hover{
    background: #b29c58;
}
</style>