import './bootstrap';
import {createApp} from 'vue';
import router from './router.js'
/* import axios from 'axios' */

/* import { URL_API } from './configs/apiUrl.js'

axios.defaults.baseURL = URL_API */

import App from './pages/app.vue'
createApp(App)
    .use(router)
    .mount('#app');
