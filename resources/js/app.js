

require('./bootstrap');

window.Vue = require('vue');


Vue.component(
    'flash-message',
    require('./components/FlashMessage.vue').default);

Vue.component(
    "comment-component",
    require("./components/CommentComponent.vue").default
);


const app = new Vue({
    el: '#app',


});
