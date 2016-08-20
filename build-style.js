/* Run with NPM to compile the app */
'use strict';

const fs = require("fs-extra");
const sass = require('node-sass');
const autoPrefixer = require('autoprefixer');
const autoPrefix = require('postcss')([autoPrefixer]);

/* Compile SCSS global file */
let options = {
    file: 'scss/app.scss',
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
        fs.writeFileSync('Styles/global.css', dataString, 'utf8');
    });
});
