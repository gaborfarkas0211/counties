import hu from './i18n/hu.json';

const trans = function (key, i18n) {
    const keys = key.split('.');
    let value = i18n;
    keys.forEach(k => {
        value = value[k];
    });
    return value ?? key;
};
const messages = {
    hu: hu,
};

export {messages, trans}
