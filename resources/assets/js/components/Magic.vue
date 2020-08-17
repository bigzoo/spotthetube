<template>
    <div class="container">
        <div class="card">
            <div class="card-header text-dark text-center">Welcome to the Playlist Creator</div>
            <div class="card-body m-3">
                <label>Paste Youtube/Spotify playlist link here</label>
                <div class="input-group" :class="{ 'form-group--error': $v.link.$error}">
                    <input @keyup.enter="submit" v-model.trim="link" class="form-control form-control-lg" type="url" placeholder="http://..." required>
                    <span><button @click="submit" class="btn btn-lg btn-light btn-outline-dark">Go!</button></span>
                </div>
                <div class="py-4">
                    <playlist v-if="showPlaylist" :playlist="playlist" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    'use strict';
    import { required, url } from 'vuelidate/lib/validators'
    import Api from '../api/axios'
    import Playlist from './Playlist'
    export default {
        components: {
            Playlist
        },
        data: function(){
            return {
                link: 'https://open.spotify.com/user/315hivothulerhv64u6dozylif3i/playlist/4qcbspFEPfoPVjDhujCtwY?si=3HH9pJ5yR1GLh1aOvkiUsQ',
                showPlaylist: false,
                playlist: {},
            }
        },
        methods: {
            submit: async function() {
                const params = {
                    session: this.session,
                    link: this.link
                };
                this.playlist = (await (new Api).get('search', params)).data.data;
                this.showPlaylist = true
            },
            validate: function (val) {
                return val.replace(/\s/g,'')
            }
        },
        props: ['session'],
        validations: {
            link: {
                required,
                url
            }
        },
        watch: {
            link (val) {
                this.link = this.validate(val)
            }
        },
    }
</script>
