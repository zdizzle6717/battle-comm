'use strict';

let fs = require('fs-extra');
let Boom = require('boom');
let env = require('../config/environmentVariables.js');

// Product Route Configs
let files = {
    create: function(request, reply) {
        let data = request.payload;
        if (data.file) {
            let name = Date.now() + '-' + data.file.hapi.filename;
            let path = env.uploadPath + request.params.path + '/' + name;
            let successResponse = {
                filename: name,
                headers: data.file.hapi.headers,
                status: 200,
                statusText: 'File uploaded successfully!'
            };
            fs.ensureFile(path, function(err) {
                let file = fs.createWriteStream(path);
                file.on('error', function(err) {
                    reply().code(404);
                });
                data.file.pipe(file);
                data.file.on('end', function(err) {
                    let response = {
                        filename: name,
                        headers: data.file.hapi.headers,
                        status: 200,
                        statusText: 'File uploaded successfully!'
                    };
                    reply(JSON.stringify(response));
                });
            });
        } else {
            let errorResponse = {
                filename: data.file.hapi.filename,
                headers: data.file.hapi.headers,
                status: 400,
                statusText: 'There was an error uploading your file. Max sure the dimensions are 800px by 530px.'
            };
            reply(JSON.stringify(errorResponse));
        }
    }
};

module.exports = files;
