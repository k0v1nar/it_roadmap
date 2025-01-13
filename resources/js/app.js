require('./bootstrap')
import { createApp } from 'vue';
import courseGraph from './components/course-graph.vue';
const app = createApp({
});
app.component('course-graph', courseGraph);
app.mount('#app');