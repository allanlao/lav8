require('./bootstrap');

import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import Vuetify from 'vuetify'; 

//import Vuetify from '@/plugins/vuetify'

require('@/plugins/registerComponents')

Vue.use(Vuetify);

Vue.use(InertiaApp)

const app = document.getElementById('app')

new Vue({
   
   vuetify: new Vuetify(),
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(app)