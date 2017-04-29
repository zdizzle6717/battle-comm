'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
function buildTemplate(data) {
	var playerList = data.players;
	var playerTable = '';
	var totalEventRP = 0;

	playerList.forEach(function (player, index) {
		if (index === 0 || index % 2 === 0) {
			playerTable += '\n\t\t\t<tr style="background-color: #e8e8e8;">\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.fullName + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.email + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.pointsEarned + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.gameSystem + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + (player.faction || 'N/A') + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.totalWins + '/' + player.totalLosses + '/' + player.totalDraws + '</td>\n\t\t\t</tr>\n\t\t\t';
		} else {
			playerTable += '\n\t\t\t<tr>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.fullName + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.email + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.pointsEarned + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.gameSystem + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + (player.faction || 'N/A') + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + player.totalWins + '/' + player.totalLosses + '/' + player.totalDraws + '</td>\n\t\t\t</tr>\n\t\t\t';
		}

		totalEventRP += player.pointsEarned;
	});

	return '\n\t\t<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">\n\t\t\t<div style="text-align:center;">\n\t\t\t\t<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">New Reward Point Assignment!</h1>\n\t\t\t\t<h2 style="font-size:28px">...from ' + data.venueEvent.eventName + ' on ' + data.venueEvent.eventDate + '.</h2>\n\n\t\t\t\t<b>The return address for ' + data.venueEvent.venueAdmin + ' is ' + data.venueEvent.returnEmail + '</b>\n\t\t\t</div>\n\n\t\t\t<h3 style="font-size="24px">' + data.venueEvent.venueName + '</h3>\n\n\t\t\t<table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">\n\t\t\t  <tr>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Player Name</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">E-mail</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Points Earned</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Game System</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Faction</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">W/L/D</th>\n\t\t\t  </tr>\n\t\t\t  ' + playerTable + '\n\t\t\t</table>\n\n\t\t\t<h2 style="font-size:28px;text-align:center;">Total Event RP: ' + totalEventRP + ' Reward Points</h2>\n\n\t\t\t<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">\n\t\t\t\t<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">\n\t\t\t</div>\n\t\t</div>\n\t';
}

exports.default = buildTemplate;