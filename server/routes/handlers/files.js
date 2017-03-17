'use strict';

import fs from 'fs-extra';
import env from '../../../envVariables.js';
import im from 'imagemagick-stream';

// Product Route Configs
let files = {
  create: (request, reply) => {
    let data = request.payload;
    let name = Date.now() + '-' + data.file.hapi.filename;
    let path = __dirname + '/../../..' + env.uploadPath + request.params.path + '/' + name;
    let successResponse = {
      'filename': name,
      'headers': data.file.hapi.headers,
      'status': 200,
      'statusText': 'File uploaded successfully!'
    };

    if (data.file) {
      if (path.indexOf('playerIcon') === -1) {
        fs.ensureFile(path, (err) => {
          let file = fs.createWriteStream(path);
          file.on('error', (err) => {
            reply().code(404);
          });
          data.file.pipe(file);
          data.file.on('end', (err) => {
            reply(JSON.stringify(successResponse));
          });
        });
      } else {
        let thumbPath = __dirname + '/../../..' + env.uploadPath + request.params.path + '/thumbs/' + name;
        fs.ensureFile(path, (err) => {
          let file = fs.createWriteStream(path);
          const resize = im().resize('100x100').quality(90);
          file.on('error', (err) => {
            reply().code(404);
          });
          data.file.pipe(file);
          data.file.on('end', (err) => {
            fs.ensureFile(thumbPath, (err) => {
              let read = fs.createReadStream(path);
              let thumb = fs.createWriteStream(thumbPath);
              file.on('error', (err) => {
                reply().code(404);
              });
              read.pipe(resize).pipe(thumb);
              read.on('end', (err) => {
                reply(JSON.stringify(successResponse));
              });
            });
          });
        });
      }
    } else {
      let errorResponse = {
        'filename': data.file.hapi.filename,
        'headers': data.file.hapi.headers,
        'status': 400,
        'statusText': 'There was an error uploading your file. Max sure the dimensions are 800px by 530px.'
      };
      reply(JSON.stringify(errorResponse));
    }
  }
};

export default files;
