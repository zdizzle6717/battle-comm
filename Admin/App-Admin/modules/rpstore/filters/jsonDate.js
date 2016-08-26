/*jshint esversion: 6 */
'use strict';

function jsonDate() {
    return function(input) {
        if (input !== undefined) {
            input = new Date(input).toISOString();
        }
        return input;
    };
}

module.exports = jsonDate;
