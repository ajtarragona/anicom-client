let mix = require('laravel-mix');

mix.js('src/resources/assets/js/anicom.js', 'src/public/js')
   .sass('src/resources/assets/sass/anicom.scss', 'src/public/css');