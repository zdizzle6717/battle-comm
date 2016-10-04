'use strict';

fileUpload.$inject = ['FileService', '$rootScope', '$timeout'];
function fileUpload(FileService, $rootScope, $timeout) {
    return {
        name: 'fileUpload',
        scope: {
            model: '=',
			params: '=',
			save: '&'
        },
        replace: true,
        template: require('./templates/fileUpload.html'),
        link: function(scope, elem, attrs) {
            scope.addFile = addFile;
			scope.showWarning = false;
			scope.removeWarning = removeWarning;
            scope.config = {
                pattern: 'image/*',
                size: {
                    max: '20MB'
                },
                ratio: attrs.ratio
            };
            scope.validationMessage = 'Max file size: ' + scope.config.size.max + ' | ' +
                                        'File dimensions must have a ratio of: ' + scope.config.ratio;

            let maxFileSize = parseInt(scope.config.size.max) * Math.pow(1024, 2);

            ////////////////////

            function addFile(file) {
                if (file === null) {
                    scope.restrictions = true;
					scope.showWarning = true;
                    return;
                } else if (file.size >= maxFileSize) {
                    showAlert({
                        type: 'error',
                        message: 'File size must be less than ' + scope.config.size.max
                    });
                } else if (file.type !== 'image/jpg' && file.type !== 'image/jpeg' && file.type !== 'image/png') {
                    showAlert({
                        type: 'error',
                        message: 'File type must be jpg, jpeg, or png'
                    });
                } else {
                    FileService.saveFile(file, scope.params)
                    .then(function(response) {
                        scope.model = response.filename;
                        scope.restrictions = false;
                        let text = response.status + ': ' + response.statusText;
						$timeout(() => {
							scope.save();
						});
                        showAlert({
                            type: 'success',
                            message: text
                        });
                    })
                    .catch(function(response) {
                        let text = response.status + ': ' + response.statusText;
                        showAlert({
                            type: 'error',
                            message: text
                        });
                    });
                }
            }

			function removeWarning() {
				scope.showWarning = false;
				console.log(scope.showWarning)
			}

            function showAlert(config) {
                $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
            }
        }
    };
}

module.exports = fileUpload;
