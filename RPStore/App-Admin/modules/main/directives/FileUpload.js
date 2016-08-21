'use strict';

fileUpload.$inject = ['FileService'];
function fileUpload(FileService) {
    return {
        name: 'fileUpload',
        scope: {

        },
        replace: true,
        template: require('./templates/fileUpload.html'),
        link: function(scope) {
            scope.addFile = addFile;
            scope.config = {
                pattern: 'image/*',
                size: {
                    max: '20MB'
                },
                height: {
                    min: 790,
                    max: 810
                },
                width: {
                    min: 520,
                    max: 540
                }
            };

            function addFile(file) {
                FileService.saveFile(file)
                .then(function(response) {
                    console.log('success: ');
                    console.log(response);
                })
                .catch(function(response) {
                    console.log('error:');
                    console.log(response);
                });
            }

        }
    };
}

module.exports = fileUpload;
