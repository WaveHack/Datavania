let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/assets/app/js')
    .sass('resources/assets/sass/app.scss', 'public/assets/app/css')
    .sourceMaps()
    .version();
