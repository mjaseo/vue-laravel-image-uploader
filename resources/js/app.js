import './bootstrap';

import {createApp} from 'vue';
import App from './components/App.vue';
import Assignment from "./components/Assignment.vue";

createApp(App).mount('#app');
createApp(Assignment).mount('#assignment');
