<template>
    <article @mouseenter="showMenu = true" @mouseleave="showMenuMethod()">
        <p v-if="!commenting">{{ comment.text }}</p>
        
        <form v-else @submit.prevent="storeUpdated">
            <input type="hidden" :value="csrfToken" name="_token"/>
            <input type="text" v-model="commentText">
            <input type="hidden" name="id" :value="comment.id">
        </form>
        <div>
            <strong>{{comment.user.name}}</strong>
            <time>{{ comment.updated_at }}</time>
        <interactionPanel 
        v-on:editing="editingComment"
        :parent-data="showMenu"
        ></interactionPanel>
        </div>
       
    </article>
</template>

<script>

    import interactionPanel from "./InteractionPanel"

    export default {
        name: 'Comment',

        props: ['comment'],

        components: { interactionPanel },
        
        data() {
            return {
                commenting: false,
                showMenu: false,
                commentText: '',
                csrfToken: '',
                userEditing: false
            }
        },

        methods: {
            showMenuMethod() {
                if(!this.userEditing)
                this.showMenu = false
            },
        //zobrazi bud text alebo input
            editingComment(data) {
                if( data ) {
                    this.commenting = data
                    this.userEditing = data
                }
                else {
                    this.commenting = data
                    this.userEditing = data
}
            },

            storeUpdated() {
                let updatedComment = {
                    text: this.commentText,
                    csrf: this.csrfToken,
                }
                axios.patch('/comments/' + this.comment.id, updatedComment)
                .then( res => console.log(res))
                .catch( err => console.log(err))
                this.commenting = false
                this.$emit('commentUpdated')
            }
        },

        created() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
            this.commentText = this.comment.text
        },

        mounted() {
        
        }
    }
    </script>

<style>

</style>
