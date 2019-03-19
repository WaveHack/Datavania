let mix = require('laravel-mix');

// mix.setPublicPath('public');

const vendorDirs = {
    //
};

for (const dir in vendorDirs) {
    mix.copyDirectory(dir, vendorDirs[dir]);
}

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
