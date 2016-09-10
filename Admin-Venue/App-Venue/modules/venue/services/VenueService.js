'use strict';

PlayerService.$inject = ['API_ROUTES', '$http'];
function PlayerService(API_ROUTES, $http) {
    let service = {
        assignPoints: assign
    };

    let routes = API_ROUTES.venue;

    return service;

    ///////////////////////

    function assign(venueEvent, players) {
        let args = {
            method: 'POST',
            url: routes.assign,
			data: {
				venueEvent: venueEvent,
				players: players
			}
        };

        return $http(args)
        .then(function(response) {
            return response.data;
        });
    }

    function cleanData(obj) {
        let newData = angular.copy(obj);
        delete newData.id;
        delete newData.createdAt;
        delete newData.updatedAt;
        return newData;
    }

}

module.exports = PlayerService;
