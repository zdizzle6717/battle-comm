/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const browserify = require("browserify");
const stringify = require("stringify");
const sass = require('node-sass');
const autoPrefixer = require('autoprefixer');
const autoPrefix = require('postcss')([autoPrefixer]);

/* Compile JS for News Admin */
browserify("App-Main/app.js")
.transform(stringify, {
      appliesTo: { includeExtensions: ['.html', '.php'] }
    })
.transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("js/app.js"));
