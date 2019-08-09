<template>
        <ul class="emoji-panel"
        >
            <li v-for="(v, k, i) in emojis" :key="i" class="emoji-item">
            <a class="emoji-link" :class="k" href="#" @click.prevent="selectEmoji(v, k)">
                <img class="emoji" :src="v"></a>
            </li>
        </ul>
</template>

<script>

    export default {
        name: 'EmojiPanel',

        data() {
            return {
                overPanel: false,

                emojis: {
                    'like' : 'https://img.icons8.com/dusk/64/000000/facebook-like.png',
                    'heart':  'https://img.icons8.com/plasticine/100/000000/like.png',
                    'wow': 'https://img.icons8.com/officel/40/000000/surprised.png',
                    'angry': 'https://img.icons8.com/officel/40/000000/angry.png'
                }
            }
        },
        methods: {
            selectEmoji(key, val) {
                this.$emit('selectedEmoji', {key, val})
            }
        },

    }

</script>

<style lang="scss" scoped>
 

    .emoji-panel {
        position: absolute;
        bottom: -120%
    }

    .emoji-panel {
        padding: .35rem 1rem;
        background-color: #fff;
        border-radius: 3rem;
        display: flex;



        .emoji {
            width: 24px;
            transition: transform .25s ease-in-out
        }

        .emoji:hover {
            transform: scale(1.5)
        }

        .emoji-item {
            margin-right: .75rem;
        }

        .emoji-item:last-child {
            margin-right: 0
        }

    }

    .like, .heart, .wow, .angry {
        font-weight: bold
    }
</style>
