<template>
    <transition name='fade'>
        <div class="notification is-success" v-show="visible">
            <button class="delete" @click="hide()"></button>
            {{ message }}
        </div>
    </transition>
</template>

<script>
export default {

    name: 'CommentFlashMessage',

    props:  ['text'],

    data() {
        return {
            visible: false,
            message: this.text
        }
    },

    created() {
        this.show();
    },

    methods: {
        show() {
            if (this.text)
            this.visible = true
            setTimeout(() => this.hide(), 3000);
        },

        hide() {
            this.visible = false
        }

    }
}
</script>

<style lang="scss" scoped> 
    .fade-enter-active, .fade-leave-active {
        transition: opacity .35s;
    }
    
    .fade-enter, .fade-leave-to {
        opacity: 0;
    }

    .notification {
        position: fixed;
        bottom: 2rem;
        right: 2rem
    }

</style>
