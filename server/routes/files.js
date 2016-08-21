'use strict';

let fs = require('fs-extra');

// Product Route Configs
let files = {
    create: function(req, res) {
        let data = req.payload;
        if (data.file) {
            console.log(data.file);
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
                    headers: data.file.hapi.headers,
                    status: 200,
                    statusText: 'File uploaded successfully!'
                };
                res(JSON.stringify(ret));
            });
        }
        else {
            let ret = {
                filename: data.file.hapi.filename,
                headers: data.file.hapi.headers,
                status: 400,
                statusText: 'There was an error uploading your file. Max sure the dimensions are 800px by 530px.'
            };
            res(JSON.stringify(ret));
        }
    }
};

module.exports = files;
