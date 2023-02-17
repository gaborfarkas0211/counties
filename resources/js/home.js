import {createApp} from 'vue';
import {createI18n} from 'vue-i18n';
import HomeComponent from './components/HomeComponent.vue';
import {messages, trans} from './messages'

const i18n = createI18n({
    legacy: false,
    locale: 'hu',
    messages,
});

const app = createApp(HomeComponent);

app.config.globalProperties.$t = (key) => trans(key, i18n)

app.use(i18n);

app.mount('#app');
