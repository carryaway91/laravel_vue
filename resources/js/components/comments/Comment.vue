<template>
    <article>
        <p class="comment-text" v-if="!userEditing">{{ comment.text }}</p>
       
        <form v-else @submit.prevent="storeUpdated">
            <input type="hidden" :value="csrfToken" name="_token"/>
            <input class="editCommentInput" type="text" v-model="comment.text">
            <input type="hidden" name="id" :value="comment.id">
        </form>

        <div class="commenter-details">
            <strong>{{comment.user.name}}</strong>
            <time>{{ comment.updated_at }}</time>
        </div>
       
        <div class="likeCounterPanel">
            <span>{{ comment.likes }}</span>
        </div>
       
       <interactionPanel 
        v-on:showCommentsEvent="showComments"
        :commentId="comment.id"
        :likes="comment.likes"
        ></interactionPanel>


        <!-- do comment sekcie posleme len komentare, ktore maju dane comment_id pre dany komentar-->
        <comment-section
        v-show="showCommentSection"
        :commentId="comment.id"
        :author="comment.user.id"
        :postId="comment.post_id"
        :csrfToken="csrfToken"
        ></comment-section>
    </article>
</template>

<script>
    import interactionPanel from "./InteractionPanel"
    import commentSection from "./CommentSection"

    export default {
        name: 'Comment',

        props: ['comment'],

        components: { interactionPanel, commentSection },
        
        data() {
            return {
                showMenu: true,
                commentText: '',
                userEditing: false,
                commentSection: false,
                csrfToken: '',
                
                userEditing: false,
                commentID: this.comment.id,

                showCommentSection: false,

                replies: []
            }
        },

        methods: {
             storeUpdated() {
                let updatedComment = {
                    text: this.comment.text,
                    csrf: this.csrfToken,
                }
                axios.patch('/comments/' + this.comment.id, updatedComment)
                
                this.userEditing = false
                this.$emit('commentUpdated')
                this.$root.$emit('done', true) 
            },
         

             showComments() {
                this.showCommentSection = true
            },
        },

        created() {
            this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
            this.commentText = this.comment.text
        },

        mounted() {
            this.$root.$on('editing', (data) => {
                if( data.val && data.id == this.comment.id) {
                    this.userEditing = true
                } else {
                    this.userEditing = false
            }})
            this.replies.push(this.comment.comment_id)
        }
    }
    </script>

<style lang="scss" scoped>
    
  
    .comment-text, 
    .commenter-details,
    .likeCounter
     {
        text-align: left;
    }
    
    .commenter-details {
        position: relative;
        padding: .5rem 0;
    }

    .editCommentInput {
        width: 100%;
        height: auto;
        border: 1px solid pink;
        padding: .5rem 1rem;
        border-radius: 3rem;
        background-color: #f5e9eb;
        outline: none;
    }

      .editCommentInput {
        width: 100%;
        height: auto;
        border: 1px solid pink;
        padding: .5rem 1rem;
        border-radius: 3rem;
        background-color: #f5e9eb;
        outline: none;
    }
</style>
