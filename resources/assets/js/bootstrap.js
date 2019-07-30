window._ = require('lodash');

window.$ = window.jQuery = require('jquery');

require('bootstrap-sass');

window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'f818cfb99b84f0a4753d',
    cluster: 'us2',
    encrypted: true
});
