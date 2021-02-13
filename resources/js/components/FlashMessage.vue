<template>
    <transition name="fade">
        <div class="alert alert-success" v-show="visible" role="alert">
            {{text}}
            <i class="fa fa-times close-message" @click="hide"></i>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['text'],
       data() {
           return {
               visible: false
       }
       },

       created() {
            if( this.text ) {
                this.show();
            }

       },

       methods: {
            show() {
               this.visible = true;
                setTimeout( () => this.hide(), 4000)
            },
            hide() {
                this.visible = false
            }
       }
    }
</script>

<style lang="scss">
    .alert-success {

        font-size: 1.2rem;
        position: fixed;
        right: 2rem;
        bottom: 2rem;
        border: none;


        .close-message {
            font-size: .8rem;
            cursor: pointer;
            position: absolute;
            right: .5rem;
            top: .3rem;
            color: #c3e6cb;

        }
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .35s;
    }
    .fade-enter, .fade-leave-to  {
        opacity: 0;
    }
</style>
