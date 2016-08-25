/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const browserify = require("browserify");
const stringify = require("stringify");
const sass = require('node-sass');
const autoPrefixer = require('autoprefixer');
const autoPrefix = require('postcss')([autoPrefixer]);

/* Compile JS for Store Admin */
browserify("RPStore/App-Admin/app.js")
    .transform(stringify, {
        appliesTo: {
            includeExtensions: ['.html', '.php']
        }
    })
    .transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("RPStore/admin/js/app.js"));

/* Compile JS for Store Admin */
browserify("RPStore/App-Store/app.js")
    .transform(stringify, {
        appliesTo: {
            includeExtensions: ['.html', '.php']
        }
    })
    .transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("RPStore/js/app.js"));

/* Compile JS for Store Admin */
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

/* Compile SCSS for Store and Store Admin */
sass.render({
    file: 'RPStore/App-Store/Styles/app.scss',
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
            fs.writeFileSync('RPStore/css/app.css', dataString, 'utf8');
        });
});

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
            fs.writeFileSync('Styles/global.css', dataString, 'utf8');
        });
});
