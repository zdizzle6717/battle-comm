'use strict';

let fs = require('fs-extra');

// Product Route Configs
let files = {
    create: function(req, res) {
        let data = req.payload;
        if (data.file) {
            let name = data.file.hapi.filename;
            let path = '/var/www/html/staging/server/uploads/' + name;
            let file = fs.createWriteStream(path);

            file.on('error', function(err) {
                console.error(err);
            });

            data.file.pipe(file);

            data.file.on('end', function(err) {
                let ret = {
                    filename: data.file.hapi.filename,
                    headers: data.file.hapi.headers
                };
                res(JSON.stringify(ret));
            });
        }
        else {
            res().code(404);
        }
    }
};

module.exports = files;
