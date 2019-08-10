<template>
    <div class="action-menu">
        <button class="action-btn"
        @click="showActionPanel = !showActionPanel"
        ><img src="https://img.icons8.com/material/24/000000/more--v1.png"></button>
        <ul v-if="showActionPanel" class="action-panel">
            <li><a href="#" class="response-item"
            @click.prevent="editComment()"
            :text="responseText"
            >{{ responseText }}</a>
            </li>
            <li>
                <form>
                    <input type="hidden" :value="csrfToken" name="_token"/>
                    <a @click.prevent="deleteComment()" href="#" class="response-item">Delete</a>
                </form>
            </li>
        </ul>
    </div>
</template>

<script>
export default {

    props: ['comment', 'doning'],

    data() {
        return {
            showActionPanel: false,
            csrfToken: '',
            responseText: "Edit",
            commentID: this.comment
        }
    },

    methods: {
        editComment() {
            
            if( this.responseText == "Edit") {
                this.$root.$emit('editing', { val: true, id: this.commentID })
                this.responseText = "Cancel"
            } else if( this.responseText == "Cancel") {
                this.$root.$emit('editing', { val: false, id: this.commentID })
                this.responseText = 'Edit'
            }
        },

        deleteComment() {
            let comment = {
                csrf: this.csrfToken,
                id: this.commentID
            }

            axios.delete('/comments/' + this.commentID, comment)
            this.$root.$emit('commentDeleted')
            this.showActionPanel = false
        }
    },
    
    mounted() {
        this.$root.$on('editDone', () => { this.showActionPanel = false
        this.responseText = 'Edit'
        })
    }
    
    }

</script>

<style lang="scss" scoped>
 .action-menu {
        display: inline-block;
        position: relative;
        
    }

    .action-panel {
        position: absolute;
        width: 8rem;
        top: -68px;
        left: 0;
        background-color: rgb(248, 236, 236);
        box-shadow: 0 0 2px 0px #000;
    }
    
    .action-btn {
        background-color: transparent;
        border: none;
        padding: 0.5rem 0;
        outline: none;
        position: relative
    }

</style>
