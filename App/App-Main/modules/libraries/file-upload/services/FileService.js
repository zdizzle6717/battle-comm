'use strict';

FileService.$inject = ['$http', 'API_ROUTES', 'Upload'];
function FileService($http, API_ROUTES, Upload) {
    let service = this;
    let routes = API_ROUTES;
    service.saveFile = saveFile;

    function saveFile(file, directoryFolders) {
		let path = '';
		for (let i in directoryFolders) {
			path += directoryFolders[i];
			if (i < directoryFolders.length - 1) {
				path += '/';
			}
		}
        let args = {
            method: 'POST',
            url: routes.files.create + path,
            file: file
        };

        return Upload.upload(args)
            .then((response) => {
                let file = response.data;
                return file;
            });
    }
}

module.exports = FileService;
