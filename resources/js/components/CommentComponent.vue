<template>

</template>

<script>
    export default {
        props: ['comment-data'],
        data() {
            return {
                editing: false,
                newText: ''
            }
        },

        mounted() {
            this.newText = this.commentData.text
        },

        methods: {
            textChanged() {
                this.newText = this.$refs.input.innerText; // odkaz cez ref na text
            },
            updateComment() {
                this.editing = false;

                axios.patch('/comments/' + this.commentData.id, {
                    text: this.newText
                });

            },

           /* deleteComment() {
                axios.delete('/comments/' + this.commentData.id);
                this.$el.remove();
            },*/
        }
    }
</script>

<style lang="scss" scoped>
    [contenteditable='true'] {
        box-shadow: 0 2px 0 #ffce67;
        outline: none;
    }
</style>
