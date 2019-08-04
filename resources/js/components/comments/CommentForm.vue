<template>
<div>
    <form @submit.prevent="submitComment">
        <input type="hidden" :value="csrfToken" name="_token"/>
        <textarea v-model="text" name="text" id="" cols="30" rows="10">
        </textarea>
        
        <input type="hidden" name="post_id" :value="postData.id">
        <button>Add comment</button>

    </form>
</div>
</template>

<script>

export default {
    
    props: ['post-data'],

    data() {
        return {
            text: '',
            csrfToken: null
        }
    },

    methods: {
        submitComment() {
            let newUser = {
                csrf: this.csrfToken,
                text: this.text,
                post_id: this.postData.id
            }
            axios.post('/comments', newUser)
            this.text = ''
            this.$root.$emit('commentAdded')
     
        }
    },
    created() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]').content

    }
}
</script>

<style>

</style>
