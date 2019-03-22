
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

// Algolia
const index = algolia.initIndex('characters');

$('#global-search').autocomplete({debug: true}, [
    {
        source: $.fn.autocomplete.sources.hits(index, {hitsPerPage: 5}),
        displayKey: 'name',
        templates: {
            suggestion: data => {

                return `
                    <div style="display: flex;">
                        <div style="margin-right: 4px; padding-top: 3px;">
                            <i class="sprite sprite-item sprite-item-${data.slug}"></i>
                        </div>
                        <div style="flex-grow: 1;">
                            ${data._highlightResult.name.value}
                        </div>
                        <div class="text-muted">
                            Character
                        </div>
                    </div>
                `;

                let template = '';

                // Icon
                template += `<i class="sprite sprite-item sprite-item-${data.slug}"></i>`;

                // Name
                template += data._highlightResult.name.value;

                // Type
                template += `<span class="float-right text-muted">Character</span>`;

                return template;
            }
        }
    }
]).on('autocomplete:selected', (event, suggestion, dataset, context) => {
    console.log(event, suggestion, dataset, context);
});
