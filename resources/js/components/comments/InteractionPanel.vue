<template>
    <ul class="response-panel">
        <li><a href="#" class="response-item" 
        @click.prevent="likedComment()">{{ like }}</a>
        </li>
        <li
        v-if="parentData">
            <button class="action-btn"
            @click="showActionPanel = !showActionPanel"
            >...</button>
                <ul v-if="showActionPanel" class="action-panel">
                    <li><a href="#" class="response-item"
                    @click.prevent="editComment()"
                    :text="responseText"
                    >{{ responseText }}</a>
                    </li>
                    <li><a href="#" class="response-item">X</a></li>
                </ul>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'InteractionPanel',
        
        props: ['totallikes', 'data', 'parent-data'],

        data() {
            return {
                liked: false,
                userLike: 0,
                like: 'Like',
                likeCounter: 0,
                text: this.data,
                permission: true,

                responseText: "Edit",
                showActionPanel: false,
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
            },

            //ked klikneme na edit/cancel button
            editComment() {
                if( this.responseText == "Edit") {
                    this.$emit('editing', true);
                    this.responseText = "Cancel"
                } else if( this.responseText == "Cancel") {
                    this.$emit('editing', false)
                    this.responseText = 'Edit'
                }
            }
        },

        mounted() {
            this.$root.$on('editDone', (v) => this.responseText = "Edit")
        }
    }
</script>
<style lang="scss" scoped>

    .response-panel {
        display: flex;

        li {
            margin-right: 1.5rem
        }
    }

    .action-btn {
        position: relative;
        display:inline-block

        .action-panel {
            position: absolute;

        }
        
    }
</style>
