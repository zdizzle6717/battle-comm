/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const browserify = require("browserify");
const stringify = require("stringify");
const sass = require('node-sass');
const autoPrefixer = require('autoprefixer');
const autoPrefix = require('postcss')([autoPrefixer]);

/* Compile JS Main Site */
browserify("App/App-Main/app.js")
    .transform(stringify, {
        appliesTo: {
            includeExtensions: ['.html', '.php']
        }
    })
    .transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("Login/js/app.js"));

/* Compile JS for News */
browserify("News/App-News/app.js")
    .transform(stringify, {
        appliesTo: {
            includeExtensions: ['.html', '.php']
        }
    })
    .transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("News/js/app.js"));

// Compile global SCSS
sass.render({
    file: 'scss/app.scss',
    outputStyle: 'compressed'
}, (err, result) => {
    if (err) {
        console.log(err);
        return;
    }

    autoPrefix.process(result.css.toString())
        .then((result) => {
            let dataString = result.css.toString();
            let kbs = Buffer.byteLength(dataString) / 1000;

            result.warnings().forEach(function(warn) {
                console.warn(warn.toString());
            });
            fs.writeFileSync('styles/global.css', dataString, 'utf8');
        });
});
