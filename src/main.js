import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import loader from "vue-ui-preloader";
import Notifications from '@kyvg/vue3-notification'
import { appAxios } from "@/utils/appAxios"
import 'bootstrap/dist/css/bootstrap.min.css'
import Navbar from './components/header/navbar.vue'
import 'vue-universal-modal/dist/index.css'

import VueUniversalModal from 'vue-universal-modal'


const app = createApp(App);

app.component('Navbar',Navbar)

app.use(store)
app.use(router)
app.use(loader)
app.use(Notifications)
app.config.globalProperties.$appAxios = appAxios;
app.use(VueUniversalModal, {
  teleportTarget: '#modals',
  modalComponent: 'Modal',
})
app.mount('#app')
