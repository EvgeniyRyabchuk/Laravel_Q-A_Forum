const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
.postCss('resources/css/app.css', 'public/css', [
        //
    ]);
// mix.copy('node_modules/summernote/dist/summernote.min.css', 'public/css/summernote.min.css');
// mix.copy('node_modules/summernote/dist/summernote.min.js', 'public/js/summernote.min.js');

mix.copy('resources/ckeditor/build/ckeditor.js', 'public/ckeditor/ckeditor.js');
// mix.copy('resources/js/MyUploadAdapter.js', 'public/js/MyUploadAdapter.js')
mix.js('resources/js/ClassicEditorCreator.js', 'public/js/ClassicEditorCreator.js')
