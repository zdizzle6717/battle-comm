/* Run with NPM to compile the app */
'use strict';

var fs = require("fs");
var browserify = require("browserify");
var stringify = require("stringify");

/* Build Main Store App*/
browserify("App-Admin/app.js")
.transform(stringify, {
      appliesTo: { includeExtensions: ['.html', '.php'] }
    })
.transform("babelify", {
        presets: ["es2015"]
    })
    .bundle()
    .pipe(fs.createWriteStream("admin/js/app.js"));
