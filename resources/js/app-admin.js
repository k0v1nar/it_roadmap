require('./bootstrap')
import { createApp } from 'vue';
import stepSelector from './components/step-selector.vue';
const app = createApp({
});
app.component('step-selector', stepSelector);
app.mount('#app');