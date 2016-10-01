'use strict';

PostController.$inject = ['$rootScope', '$state', '$stateParams', 'NewsService', 'manufacturers'];
function PostController($rootScope, $state, $stateParams, NewsService, manufacturers) {
    let controller = this;

    controller.readOnly = true;
    controller.editPost = editPost;
    controller.savePost = savePost;
    controller.removePost = removePost;
    controller.setMNU = setMNU;
    controller.currentMNU = {};
    controller.selectedMNU = {};
    controller.manufacturers = manufacturers;
    controller.manufacturer = manufacturers[0];
    controller.showDeleteModal = showDeleteModal;
    controller.hideDeleteModal = hideDeleteModal;

    init();

    ///////////////////////////////////////////

    function init() {
        if ($stateParams.id) {NewsService.getPost($stateParams.id)
            .then(function(response) {
                controller.currentPost = response;
                controller.currentPost.published = response.published === true ? 'true' : 'false';
                controller.currentPost.featured = response.featured === true ? 'true' : 'false';
                controller.readOnly = true;
                controller.isNew = false;
            });
        } else {
            controller.currentPost = {
                userLoginId: 2,
                featured: 'false',
                published: 'false'
            };
            controller.readOnly = false;
            controller.isNew = true;
        }
    }

    function setMNU(manufacturer) {
        controller.currentMNU = manufacturer;
    }

    // $rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams, options) {
    //     if ($state)
    // });

    function editPost() {
        controller.readOnly = false;
    }

    function savePost(data, images) {
        data.manufacturerId = data.manufacturer ? data.manufacturer.id : data.manufacturerId;
        delete data.manufacturer;
        if ($stateParams.id) {
            controller.readOnly = true;
            NewsService.updatePost($stateParams.id, data)
            .then(function(response) {
                controller.currentPost = response;
                controller.currentPost.displayStatus = response.displayStatus === true ? 'true' : 'false';
                controller.currentPost.new = response.new === true ? 'true' : 'false';
                controller.currentPost.featured = response.featured === true ? 'true' : 'false';
                controller.currentPost.onSale = response.onSale === true ? 'true' : 'false';
                showAlert({
                    type: 'success',
                    message: 'This post was successfully updated.'
                });
            });
        }
        else {
            NewsService.createPost(data)
            .then(function(response) {
                showAlert({
                    type: 'success',
                    message: 'A new post was successfully created.'
                });
                $state.go('post', {id: response.id});
            });
        }
    }

    function removePost(id) {
        NewsService.removePost(id)
        .then(function() {
            showAlert({
                type: 'success',
                message: 'Post was successfully deleted.'
            });
            $state.go('newsList');
        });
    }

    function showDeleteModal(id) {
        $rootScope.$broadcast('show:modal', {
            id: id,
            toggle: true
        });
    }

    function hideDeleteModal() {
        $rootScope.$broadcast('show:modal', { toggle: false });
    }

    function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }
}

module.exports = PostController;
