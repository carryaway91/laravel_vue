<template>
<div class="comment-section">
    <form @submit.prevent="submitReply">
        <input type="hidden" name="_token" :value="csrfToken">
        <input type="text" v-model="replyContent">
        <input type="hidden" name="post_id" :value="postId">
    </form>


</div>
</template>

<script>
export default {

    props: ['commentId', 'csrfToken', 'author', 'postId'],

    data() {
        return {
            // pod ktory komentar to patri
            commentID: this.commentId,
            replyContent: ''

        }
    },

    methods: {
        submitReply() {
            let reply = {
                text: this.replyContent,
                csrf: this.csrfToken,
                post_id: this.postId,
                comment_id: this.commentID,
            }
        axios.post('/comments', reply)
        }
    }
}
</script>

<style>

</style>
