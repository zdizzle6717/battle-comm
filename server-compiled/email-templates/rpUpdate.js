'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
function buildTemplate(data) {
	return '\n\t\t<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">\n\t\t\t<div style="text-align:center;">\n\t\t\t\t<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">Your Reward Points Have Changed!</h1>\n\t\t\t\t<h2 style="font-size:28px">Either an admin has added points to your account, or you have made a recent purchase.</h2>\n\n\t\t\t\t<h2 style="font-size:28px; text-align:center">Remaining Total: ' + data.rewardPoints + ' Reward Points</h2>\n\t\t\t</div>\n\n\t\t\t<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">\n\t\t\t\t<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">\n\t\t\t</div>\n\t\t</div>\n\t';
}

exports.default = buildTemplate;