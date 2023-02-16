import {createApp} from 'vue';
import {createI18n} from 'vue-i18n';
import HomeComponent from './components/HomeComponent.vue';
import messages from './messages'

const i18n = createI18n({
    legacy: false,
    locale: 'hu',
    messages,
});

const app = createApp(HomeComponent);

app.config.globalProperties.$t = (key, ...params) => {
    const keys = key.split('.');
    let value = i18n;
    keys.forEach(k => {
        value = value[k];
    });
    return value ?? key;
};

app.use(i18n);

app.mount('#app');
