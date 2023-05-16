var Encore = require("@symfony/webpack-encore");

Encore.setOutputPath("./public/build/")
    .setPublicPath("/build/")
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableSassLoader()
    .addStyleEntry("app", "./assets/styles/app.css")
    .addEntry('app_js', './assets/app.js')
    .enablePostCssLoader()
    .autoProvidejQuery()
    .enableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();
