let mix = require('laravel-mix');

// mix.setPublicPath('public');

const vendorDirs = {
    //
};

for (const dir in vendorDirs) {
    mix.copyDirectory(dir, vendorDirs[dir]);
}

// mix.copy('app/resources/images', 'public/assets/images');

mix.js('resources/js/app.js', 'public/assets')
    .sass('resources/sass/app.scss', 'public/assets');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps();
}
