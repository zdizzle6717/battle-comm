'use strict';

let models = require('../models');

// Product Route Configs
let userLogins = {
    // get: function(req, res) {
    //     models.UserLogin.find({
    //             where: {
    //                 id: req.params.id
    //             }
    //         })
    //         .then(function(userLogin) {
    //             if (userLogin) {
    //                 res(userLogin).code(200);
    //             }
    //             else {
    //                 res().code(404);
    //             }
    //
    //         });
    // },
    // getAll: function(req, res) {
    //     models.UserLogin.findAll()
    //         .then(function(products) {
    //             res(products).code(200);
    //         });
    // },
    // create: function(req, res) {
    //     models.UserLogin.create({
    //         })
    //         .then(function(userLogin) {
    //             res(userLogin).code(200);
    //         });
    // },
    updatePartial: function(req, res) {
        models.user_login.find({
                where: {
                    id: req.params.id
                }
            })
            .then(function(userLogin) {
                if (userLogin) {
                    userLogin.updateAttributes({
                        // email: req.payload.email,
                        // password: req.payload.password,
                        // activation_key: req.payload.activation_key,
                        // activation_state: req.payload.activation_state,
                        // firstName: req.payload.firstName,
                        // lastName: req.payload.lastName,
                        // join_date: req.payload.join_date,
                        // tourneyAdmin: req.payload.tourneyAdmin,
                        // EventAdmin: req.payload.EventAdmin,
                        // NewsContributor: req.payload.NewsContributor,
                        // venueAdmin: req.payload.venueAdmin,
                        // clubAdmin: req.payload.clubAdmin,
                        // siteAdmin: req.payload.siteAdmin,
                        // user_handle: req.payload.user_handle,
                        // user_club: req.payload.user_club,
                        // user_main_phone: req.payload.user_main_phone,
                        // user_mobile_phone: req.payload.user_mobile_phone,
                        // user_work_phone: req.payload.user_work_phone,
                        // user_street_address: req.payload.user_street_address,
                        // user_apt_suite: req.payload.user_apt_suite,
                        // user_city: req.payload.user_city,
                        // user_state: req.payload.user_state,
                        // user_zip: req.payload.user_zip,
                        // user_Date_of_Birth: req.payload.user_Date_of_Birth,
                        // user_bio: req.payload.user_bio,
                        // user_facebook: req.payload.user_facebook,
                        // user_twitter: req.payload.user_twitter,
                        // user_instagram: req.payload.user_instagram,
                        // user_google_plus: req.payload.user_google_plus,
                        // user_youtube: req.payload.user_youtube,
                        // user_twitch: req.payload.user_twitch,
                        // user_website: req.payload.user_website,
                        user_points: req.payload.user_points
                        // user_visibility: req.payload.user_visibility,
                        // user_share_contact: req.payload.user_share_contact,
                        // user_share_name: req.payload.user_share_name,
                        // user_share_status: req.payload.user_share_status,
                        // user_newsletter: req.payload.user_newsletter,
                        // user_marketing: req.payload.user_marketing,
                        // user_sms: req.payload.user_sms,
                        // user_allow_play: req.payload.user_allow_play,
                        // user_icon: req.payload.user_icon,
                        // totalWins: req.payload.totalWins,
                        // totalLoss: req.payload.totalLoss,
                        // totalDraw: req.payload.totalDraw,
                        // totalPoints: req.payload.totalPoints,
                        // accountActive: req.payload.accountActive
                    }).then(function(userLogin) {
                        res(userLogin).code(200);
                    });
                }
                else {
                    res().code(404);
                }
            });
    },
    // delete: function(req, res) {
    //     models.UserLogin.destroy({
    //             where: {
    //                 id: req.params.id
    //             }
    //         })
    //         .then(function(userLogin) {
    //             if (userLogin) {
    //                 res().code(200);
    //             }
    //             else {
    //                 res().code(404);
    //             }
    //         });
    // }
};


module.exports = userLogins;
