<template>

</template>

<script>
    export default {
        props: ['comment-data'],
        data() {
            return {
                editing: false,
                newText: '',
                oldText: ''
            }
        },

        mounted() {
           this.oldText = this.newText = this.commentData.text
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
                this.$root.$emit('flash', 'Comment updated');
                this.oldText = this.newText;
            },

            startEditing() {
                this.selectText();
                this.editing = true;

            },

            resetText() {
                this.editing = false;
                this.$refs.input.innerText = this.oldText;
            },

           /* deleteComment() {
                axios.delete('/comments/' + this.commentData.id);
                this.$el.remove();
            },*/

            // funkcia na vyznacenie tetu pri editovani
            selectText() {
                setTimeout(() => {
                    let p = this.$refs.input,
                        s = window.getSelection(),
                        r = document.createRange();
                    r.setStart(p, 0);
                    r.setEnd(p, 1);
                    s.removeAllRanges();
                    s.addRange(r);
                    p.focus();
                }, 0)
            }
        }
    }
</script>

<style lang="scss" scoped>
    [contenteditable='true'] {
        box-shadow: 0 2px 0 #ffce67;
        outline: none;
    }
</style>
