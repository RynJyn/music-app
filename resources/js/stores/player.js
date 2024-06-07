import { defineStore } from "pinia";

export const usePlayerStore = defineStore('player', {
    state: () => ({
        __player: false,
        __currentTrack: {
            id: 0,
            title: "",
            filename: "",
            artist: {
                id: 0,
                name: ""
            },
            album: {
                id: 0,
                title: "",
                art: ""
            },
            playlist: {
                id: 0
            }
        },
        __isPlaying: false,
        __currentTime: 0,
        __duration: 0,
        __seek: 0,
        __volume: 100,
        __isMuted: false
    }),
    getters: {
        currentTime: (state) => state.__currentTime,
        duration: (state) => state.__duration,
        currentTrack: (state) => state.__currentTrack,
        seek: (state) => state.__seek,
        isPlaying: (state) => state.__isPlaying,
        volume: (state) => state.__volume * 100,
        isMuted: (state) => state.__isMuted
    },
    actions: {
        init(){
            if(!this.__player){
                this.__player = new Audio();
                this.__player.addEventListener('loadedmetadata', (e) => {
                    this.__duration = e.target.duration;
                    this.__loaded = true;
                })
                this.__player.addEventListener('timeupdate', (e) => {
                    this.__currentTime = e.target.currentTime;
                    this.__seek = (e.target.currentTime / e.target.duration) * 100;
                });

                this.__player.addEventListener('play', (e) => {
                    this.__isPlaying = true;
                });

                this.__player.addEventListener('pause', (e) =>{
                    this.__isPlaying = false;
                });

                this.__player.addEventListener('volumechange', (e) => {
                    this.__isMuted = e.target.muted;
                    this.__volume = e.target.volume;
                });
            }
        },
        toggle(){
            if(!this.__isPlaying){
                this.__player.play();
            } else {
                this.__player.pause();
            }
        },
        setCurrentTrack(track){
            let opts = {
                id: 0,
                title: "",
                filename: "",
                artist: {
                id: 0,
                name: "",
                },
                album: {
                    id: 0,
                    name: ""
                },
                playlist: {
                    id: 5
                }
            };

            opts = {...opts, ...track};
            if(JSON.stringify(this.__currentTrack) !== JSON.stringify(opts)){
                this.__currentTrack = opts;
                this.__player.src = this.__currentTrack.filename;
                this.__isPlaying = false;
            }
        },
        setCurrentTime(time){
            this.__player.currentTime = time;
        },
        setVolume(vol){
            if(this.__player.muted) {
                this.__player.muted = false;
            }
            this.__player.volume = vol / 100;
        },
        setSeek(value){
            this.__player.currentTime = this.__player.duration * (value / 100);
        },
        toggleMute(){
            this.__player.muted = !this.__player.muted;
        }
    }
})