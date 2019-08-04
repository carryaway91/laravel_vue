<template>
    <ul class="comment-list">
        
        <li class="commnent-item" v-for="comment in comments" :key="comment.id">
            <comment :comment="comment" v-on:commentUpdated="loadComments"></comment>
        </li>
    </ul>
</template>

<script>

import comment from './Comment'

export default {
    name: 'CommentList',

    props: ['slug'],

    components: { comment },

    data() {
        return {
            comments: [],
        }
    },

    methods: {
        loadComments() {
            this.$root.$on('commentUpdated', () => 
            console.log('Bez console logu to nefunguje wuT?!'),
            axios.get('/posts/' + this.slug + '/comments')
            .then( res => this.comments = res.data[0].comments,
            ))
            this.$root.$emit('editDone', true)
        }
    },
    
    created() {
        axios.get('/posts/' + this.slug + '/comments')
        .then( res => this.comments = res.data[0].comments)
    },

    mounted() {
        this.$root.$on('commentAdded', () => 
            axios.get('/posts/' + this.slug + '/comments')
            .then( res => this.comments = res.data[0].comments))
        }
    } 
</script>

<style lang="scss" scoped>
    .comment-list {
        margin-top: 2rem;

        .commnent-item {
            margin-top: 1rem
        }
    }
</style>