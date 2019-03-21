
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

$(window).keydown(function (e) {
    // Focus global search on forward slash
    if ((e.which === 191) && ($('input:focus').length === 0)) {
        e.preventDefault();
        $('#global-search').focus();
    }
});


/*$('#global-search').easyAutocomplete({
    url: query => `/api/search?q=${query}`,

    getValue: 'name',

    template: {
        type: 'custom',
        method: (value, item) => {
            let template = '';

            // Icon
            if (item.icon) {
                template += `<img src="/images/${item.icon}" alt="todo icon">`;
            }

            // Name
            template += value;

            // Type indicator
            template += `<span class="float-right text-muted">${item.type}</span>`;

            return template;
        },
    },

    list: {
        onChooseEvent: () => {
            alert('todo :)');
            const data = $('#global-search').getSelectedItemData();
            console.log(data);
            // redirect to slug
        },
        showAnimation: {
            type: 'fade',
            time: 400,
        },
        hideAnimation: {
            type: 'fade',
            time: 400,
        },
    },

    requestDelay: 500,
});*/
