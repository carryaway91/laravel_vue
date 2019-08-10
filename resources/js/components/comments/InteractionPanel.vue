<template>
    <ul class="response-panel">
        <li 
        @mouseenter="overBtn = true"
        @mouseleave="overBtn = false"
        class="response-panel-item emoji-panel-link">
            <form>
                <input type="hidden" :value="csrfToken" name="_token"/>
                <a :class="emojiClass" href="#"  
                @click.prevent="likedComment()">
                <span class="emojiLike"><img :src="emoji" :class="emojiClass"></span> Like</a>
            </form>
            <emoji-panel v-if="overBtn" v-on:selectedEmoji="emoticon($event)"></emoji-panel>
        </li>

        <li class="response-panel-item">
            <a href="#" @click.prevent="$emit('showCommentsEvent')">Comment</a>
        </li>
        <li class="response-panel-item">
            <action-menu :comment="id"></action-menu>
        </li>
    </ul>
</template>

<script>

    import emojiPanel from './EmojiPanel'
    import commentForm from './CommentForm'
    import actionMenu from './ActionMenu'

    import { setTimeout } from 'timers';

    export default {
        name: 'InteractionPanel',
        
        components: { emojiPanel, commentForm, actionMenu },

        props: ['likes', 'commentId'],

        data() {
            return {
                liked: false,
                like: 'Like',
                totalLikes: this.likes,
                id: this.commentId,
                permission: true,
                csrfToken: '',
                emoji: '',
                emojiClass: '',
                overBtn: false,
            }
        },

        methods: {
            likedComment() {
                if(!this.liked) {
                    this.liked = true
                    this.userLike = 1
                    this.like = 'Unlike'
                    this.totalLikes++
                    this.updatedLikes()
                  

                } else {
                    this.liked = false
                    this.totalLikes--
                    this.like = 'Like'
                    this.updatedLikes()

                }
            },

            updatedLikes() {

                let comment = {
                    csrf: this.csrfToken,
                    likes: this.totalLikes
                }
                axios.patch('/comments/' + this.id, comment).then(res => console.log(res.data)).catch(err => console.log(err.response.data.message))
            },

            leavingBtn() {
                setTimeout(() => {
                    this.overBtn = false
                }, 300);
            },

            overPanelHover(data) {
                this.overPanel = data
            },

            deleteComment() {
            },

            // emoticony

            emojiPanelShow() {

                    this.emojiPanelVisible = true
            },

            emojiPanelHide() {
                    this.emojiPanelVisible = false   
                 
            },

            emoticon(data) {
                this.emoji = data.key
                this.emojiClass = data.val
                this.overBtn = false
            }

        },

        mounted() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
        
        }
    }
</script>
<style lang="scss">


    .emoji-panel-link {
        position: relative
    }

    .emojiLike {
        position: absolute;
            left: 27%;
            bottom: 18%;
    }

    .response-panel {
        display: flex;
        justify-content: space-around;
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
        margin-bottom: 1rem;

        .response-panel-item {
            width: 100%;

            a {
                width: 100%;
                height: 100%;
                display: inline-block;
                padding: .5rem 0
            }

            a:hover {
                background-color: pink;
            }
        }
    }
   
    .emojiLike {
        width: 20px
    }

    .like, .heart, .wow, .angry {
        font-weight: bold;
    }

    .like {
        color: blue;
    }
    .heart {
        color: red
    }
    .wow {
        color: yellow
    }
    .angry {
        color: orangered
    }
</style>
