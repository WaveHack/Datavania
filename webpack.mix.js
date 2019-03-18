let mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/assets')
    .sass('resources/sass/app.scss', 'public/assets')
    .sourceMaps()
    .version();
