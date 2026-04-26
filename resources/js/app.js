import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import App from './components/App.vue';
import MemoList from './components/MemoList.vue';
import MemoForm from './components/MemoForm.vue';

const routes = [
    { path: '/', component: MemoList },
    { path: '/create', component: MemoForm },
    { path: '/edit/:id', component: MemoForm, props: true },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);
app.use(router);
app.mount('#app');

