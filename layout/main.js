import './scss/main.scss';
import 'highlight.js/styles/default.css';
import 'highlight.js/styles/color-brewer.css';

import hljs from 'highlight.js/lib/highlight';
import hljsPhp from 'highlight.js/lib/languages/php';
import hljsJs from 'highlight.js/lib/languages/javascript';
import hljsCss from 'highlight.js/lib/languages/css';
import hljsXml from 'highlight.js/lib/languages/xml';
hljs.registerLanguage('php', hljsPhp);
hljs.registerLanguage('javascript', hljsJs);
hljs.registerLanguage('css', hljsCss);
hljs.registerLanguage('xml', hljsXml);

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
