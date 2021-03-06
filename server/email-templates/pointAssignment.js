'use strict';

function buildTemplate(data, rpPool) {
	let playerList = data.players;
	let playerTable = '';
	let playerAchievementsTable = '';
	let totalEventRP = 0;

	playerList.forEach(function(player, index) {
		if (index === 0 || index % 2 === 0) {
			playerTable +=
			`
			<tr style="background-color: #e8e8e8;">
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.fullName}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.email}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.pointsEarned}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.gameSystem}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.faction || 'N/A'}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.totalWins}/${player.totalLosses}/${player.totalDraws}</td>
			</tr>
			`
		} else {
			playerTable +=
			`
			<tr>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.fullName}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.email}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.pointsEarned}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.gameSystem}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.faction || 'N/A'}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.totalWins}/${player.totalLosses}/${player.totalDraws}</td>
			</tr>
			`
		}

		totalEventRP += player.pointsEarned;
	});

	playerList.forEach(function(player, index) {
        if (player.achievementsList) {
            if (index === 0 || index % 2 === 0) {
    			playerAchievementsTable +=
    			`
    			<tr style="background-color: #e8e8e8;">
    			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.fullName}</td>
    			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.achievementsList}</td>
    			</tr>
    			`
    		} else {
    			playerAchievementsTable +=
    			`
    			<tr>
    			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.fullName}</td>
    			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${player.achievementsList}</td>
    			</tr>
    			`
    		}
        }
	});

	return `
		<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">
			<div style="text-align:center;">
				<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">New Reward Point Assignment!</h1>
				<h2 style="font-size:28px">...from ${data.venueEvent.eventName} on ${data.venueEvent.eventDate}.</h2>

				<b>The return address for ${data.venueEvent.venueAdmin} is ${data.venueEvent.returnEmail}</b>
			</div>

			<h3 style="font-size="24px">Venue: ${data.venueEvent.venueName}</h3>

			<table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">
			  <tr>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Player Name</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">E-mail</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Points Earned</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Game System</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Faction</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">W/L/D</th>
			  </tr>
			  ${playerTable}
			</table>

			<h3 style="font-size="24px">Achievements Awarded</h3>

			<table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">
			  <tr>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Player Name</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Achievements</th>
			  </tr>
			  ${playerAchievementsTable}
			</table>

			<h2 style="font-size:28px;text-align:center;">Total Event RP: ${totalEventRP} Reward Points</h2>
			<h2 style="font-size:28px;text-align:center;">Remaining RP Pool: ${rpPool} Reward Points</h2>

			<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">
				<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">
			</div>
		</div>
	`
}

export default buildTemplate;
