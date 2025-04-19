import './input.css';
import '@formkit/themes/genesis';
import { plugin, defaultConfig} from '@formkit/vue';
import config from './../formkit.config';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import "./assets/tailwind.css";

const app = createApp(App);

app.use(router);
app.use(plugin, defaultConfig(config));

app.mount("#app");