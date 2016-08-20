/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const browserify = require("browserify");
const stringify = require("stringify");
const sass = require('node-sass');
const autoPrefixer = require('autoprefixer');
const autoPrefix = require('postcss')([autoPrefixer]);

/* Compile JS for News Admin */
browserify("App-Admin/app.js")
.transform(stringify, {
      appliesTo: { includeExtensions: ['.html', '.php'] }
    })
.transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("admin/js/app.js"));

/* Compile JS for News Admin */
browserify("App-News/app.js")
.transform(stringify, {
      appliesTo: { includeExtensions: ['.html', '.php'] }
    })
.transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("js/app.js"));

/* Compile SCSS for News and News Admin */
let options = {
    file: 'App-News/Styles/app.scss',
    outputStyle: 'compressed'
};

sass.render(options, (err, result) => {
    if (err) {
        console.log(err);
        return;
    }

    autoPrefix.process(result.css.toString())
    .then((result) => {
        let dataString = result.css.toString();
        let kbs = Buffer.byteLength(dataString) / 1000;

        result.warnings().forEach(function (warn) {
            console.warn(warn.toString());
        });
        fs.writeFileSync('css/app.css', dataString, 'utf8');
    });
});
