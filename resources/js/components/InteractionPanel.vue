<template>
    <div>
        <li><a href="#" class="response-item" 
        @click.prevent="likedComment()">{{ like }}</a></li>
    </div>
</template>

<script>
    export default {

        props: ['totallikes'],

        data() {
            return {
                liked: false,
                userLike: 0,
                like: 'Like',
                likeCounter: 0
            }
        },

        methods: {
            likedComment() {
                if(!this.liked) {
                    this.liked = true
                    this.userLike = 1
                    this.like = 'Unlike'
                    this.likeCounter++
                    this.$root.$emit('counting',this.likeCounter)
                } else {
                    this.liked = false
                    this.userLike = 0
                    this.likeCounter--
                    this.like = 'Like'
                    this.$root.$emit('counting',this.likeCounter)

                }
            }
        }
}
</script>
