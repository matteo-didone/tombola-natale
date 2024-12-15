import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import './style.css';

// Create Vue app
const app = createApp(App);

// Initialize Pinia store
const pinia = createPinia();
app.use(pinia);

// Mount app
app.mount('#app');