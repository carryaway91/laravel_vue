<template>
    <div>
        <p v-if="li == 1 ">{{li}} like</p>    
        <p v-else>{{li}} likes</p>    
    </div>
</template>

<script>
export default {

    name: 'LikeCounter',

    props:['totallikes'],

    data() {
        return {
            li: 0
        }
    },
  
    mounted() {
        this.$root.$on('counting', (e) => this.li = e)
    }
}
</script>

<style>

</style>
