require('./bootstrap');

//import { InertiaApp } from '@inertiajs/inertia-vue'
import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import Vuetify from 'vuetify'; 

require('@/plugins/registerComponents')

Vue.use(Vuetify);

//Vue.use(InertiaApp)

Vue.use(plugin)


const el = document.getElementById('app')

new Vue({
    vuetify: new Vuetify(),
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)