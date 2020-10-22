require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import colors from 'vuetify/lib/util/colors'
import Vue from 'vue'
import Vuetify from 'vuetify';

require('@/plugins/registerComponents')

Vue.use(Vuetify);
Vue.use(plugin)


const options = {
  theme: {
    dark: true,
    themes: {
      light: {
        primary: colors.lightBlue.base,
        secondary: colors.orange.base,
        accent: colors.blue.base,
        error: colors.red.base,
        warning: colors.deepOrange.base,
        info: colors.cyan.base,
        success: colors.green.base
      }
    }
  },
  icons: {
    iconfont: 'md', // default - only for display purposes
  },
}


const el = document.getElementById('app')

new Vue({
  vuetify: new Vuetify(options),
  render: h => h(App, {
    props: {
      initialPage: JSON.parse(el.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(el)