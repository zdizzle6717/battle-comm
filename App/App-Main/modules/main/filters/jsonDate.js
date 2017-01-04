/*jshint esversion: 6 */
'use strict';

function jsonDate() {
    return function(input) {
        if (input !== undefined) {
            input = new Date(input).replace(' ', 'T');
			input = input.split(' ', 4);
			input = input[2] + ' ' + input[1] + ' ' + input[3];
			console.log(input);
        }
        return input;
    };
}

module.exports = jsonDate;
