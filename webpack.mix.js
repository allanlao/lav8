const mix = require('laravel-mix');
const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin')
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.js('resources/js/app.js', 'public/js')
  .sourceMaps()
  .sass('resources/sass/app.scss', 'public/css')
  .webpackConfig({

    output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
    resolve: {
      alias: {
        'vue$': 'vue/dist/vue.runtime.esm.js',
        '@shared': path.resolve('resources/js/Components/Shared'),
        '@': path.resolve('resources/js'),
      },
    },
  })
mix.extend('vuetify', new class {
  webpackConfig(config) {
    config.plugins.push(new VuetifyLoaderPlugin())
  }
})
mix.vuetify()