<script>
export default {

    methods: {
        update(comment) {
            axios.put('comments/' + comment.id)
        }
    }
}
</script>

<style>

</style>
