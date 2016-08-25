'use strict';

let fs = require('fs-extra');
let env = require('../config/environmentVariables.js');

// Product Route Configs
let files = {
    create: function(request, reply) {
        let data = request.payload;
        if (data.file) {
            let name = data.file.hapi.filename;
            let path = env.uploadPath + request.params.path + '/' + name;
            console.log(path);
            let file = fs.createWriteStream(path);

            file.on('error', function(err) {
                console.error(err);
            });

            data.file.pipe(file);

            data.file.on('end', function(err) {
                let response = {
                    filename: data.file.hapi.filename,
                    headers: data.file.hapi.headers,
                    status: 200,
                    statusText: 'File uploaded successfully!'
                };
                reply(JSON.stringify(response));
            });
        }
        else {
            let response = {
                filename: data.file.hapi.filename,
                headers: data.file.hapi.headers,
                status: 400,
                statusText: 'There was an error uploading your file. Max sure the dimensions are 800px by 530px.'
            };
            reply(JSON.stringify(response));
        }
    }
};

module.exports = files;
