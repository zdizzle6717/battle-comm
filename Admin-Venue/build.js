/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const browserify = require("browserify");
const stringify = require("stringify");

/* Compile JS for News Admin */
browserify("App-Venue/app.js")
.transform(stringify, {
      appliesTo: { includeExtensions: ['.html', '.php'] }
    })
.transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("js/app.js"));
