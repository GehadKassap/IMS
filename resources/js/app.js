import { createPinia } from 'pinia'
import { createApp, h } from 'vue'
import { registerPlugins } from '@core/utils/plugins'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/index'

import DefaultLayout from './layouts/default.vue'

// Styles
import '@core-scss/template/index.scss'
import '@styles/styles.scss'

createInertiaApp({
  title: title => `IMS Dashboard - ${title}`,
  resolve: name => {

    const pages = import.meta.glob('./pages/**/*.vue', { eager: true })

    let page = pages[`./pages/${name}.vue`]

    if(!name.includes("login")){
      page.default.layout = page.default.layout || DefaultLayout
    }

    return page

  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    const pinia = createPinia()

    registerPlugins(app)
    app.use(plugin)
    app.use(pinia)
    app.use(ZiggyVue)
    app.mount(el)
  },
  progress: {
    
    color: '#29d',
    showSpinner: true,
  },
})


