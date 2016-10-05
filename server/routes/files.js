'use strict';

let fs = require('fs-extra');
let Boom = require('boom');
let env = require('../config/environmentVariables.js');
let im = require('imagemagick-stream');

// Product Route Configs
let files = {
    create: function(request, reply) {
		let data = request.payload;
		let name = Date.now() + '-' + data.file.hapi.filename;
		let path = env.uploadPath + request.params.path + '/' + name;
		let successResponse = {
			filename: name,
			headers: data.file.hapi.headers,
			status: 200,
			statusText: 'File uploaded successfully!'
		};

		if (data.file) {
			if (path.indexOf('playerIcon') === -1) {
				fs.ensureFile(path, function(err) {
					let file = fs.createWriteStream(path);
					file.on('error', function(err) {
						reply().code(404);
					});
					data.file.pipe(file);
					data.file.on('end', function(err) {
						reply(JSON.stringify(successResponse));
					});
				});
			} else {
	            let thumbPath = env.uploadPath + request.params.path + '/thumbs/' + name;
	            fs.ensureFile(path, function(err) {
	                let file = fs.createWriteStream(path);
					const resize = im().resize('100x100').quality(90);
	                file.on('error', function(err) {
	                    reply().code(404);
	                });
	                data.file.pipe(file);
	                data.file.on('end', function(err) {
						fs.ensureFile(thumbPath, function(err) {
							let read = fs.createReadStream(path);
							let thumb = fs.createWriteStream(thumbPath);
							file.on('error', function(err) {
			                    reply().code(404);
			                });
							read.pipe(resize).pipe(thumb);
							read.on('end', function(err) {
								reply(JSON.stringify(successResponse));
							});
						});
	                });
	            });
	        }
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
