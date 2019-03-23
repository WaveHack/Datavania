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
const searchIndex = algolia.initIndex('search');

$('#global-search').autocomplete({debug: true}, [{

    source: $.fn.autocomplete.sources.hits(searchIndex, {hitsPerPage: 10}),

    displayKey: 'name',

    templates: {

        suggestion: data => `
                <div style="display: flex;">
                    <div style="margin-right: 4px; padding-top: 3px;">
                        <i class="${data.iconClass}"></i>
                    </div>
                    <div style="flex-grow: 1;">
                        ${data._highlightResult.name.value}
                    </div>
                    <div class="text-muted">
                        ${data._highlightResult.type.value}
                    </div>
                </div>
            `,

        footer: `
            <div class="autocomplete-footer" style="border-top: 1px solid #999; padding: 5px 4px;">
                <div class="autocomplete-footer-branding text-center">
                    <small class="text-muted">
                        Powered by
                        <a href="https://www.algolia.com" target="_blank" class="algolia-powered-by-link" title="Algolia">
                            <img class="algolia-logo" src="https://www.algolia.com/assets/algolia128x40.png" alt="Algolia" style="height: 1em;">                       
                        </a>                
                    </small>        
                </div>
            </span>
        `,

    },

}]).on('autocomplete:selected', (event, suggestion, dataset, context) => {
    const url = `/db/${suggestion.typeSlug}/${suggestion.slug}`;
    $(location).attr('href', url);
});
