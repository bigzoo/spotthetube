<template>
    <div>
        <h5 class="card-title"><a href="{{ playlist.link }}">{{ playlist.name }}</a> by <small class="mute">{{ playlist.author }}</small></h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</template>

<script>
export default {
    props: {
        playlist: {
            required: true,
            type: Object
        }
    }
}
</script>
