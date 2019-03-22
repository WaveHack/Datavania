const mix = require('laravel-mix');
const Spritesmith = require('webpack-spritesmith');

mix.webpackConfig({
    plugins: [
        new Spritesmith({
            src: {
                cwd: path.resolve(__dirname, 'resources/images/icons'),
                glob: '**/*.png',
            },
            target: {
                image: path.resolve(__dirname, 'public/images/spritesheets/items.png'),
                css: path.resolve(__dirname, 'resources/build/spritesheet-items.sass'),
            },
            apiOptions: {
                cssImageRef: '/images/spritesheets/items.png',
            }
        })
    ],
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
