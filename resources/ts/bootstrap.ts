// @ts-ignore
window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

// @ts-ignore
window.axios = require('axios');
// @ts-ignore
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
