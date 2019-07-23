import './scss/main.scss';
import 'highlight.js/styles/default.css';
import 'highlight.js/styles/color-brewer.css';
import hljs from 'highlight.js';

//import Vue from './node_modules/vue/dist/vue.js';
//import hello from './components/hello.vue';
//import formInput from './components/form/input.vue';
//import commentForm from './components/commentForm.vue';
/*
const app = new Vue({
    el: '#app',
    components: {
        //hello: hello,
        formInput: formInput,
        commentForm: commentForm
    }
});*/

addEventListener('DOMContentLoaded', function() {
    hljs.initHighlightingOnLoad();
});
