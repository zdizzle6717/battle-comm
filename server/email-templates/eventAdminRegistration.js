'use strict';

function buildTemplate(data) {
	return `
		<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">
			<div style="text-align:center;">
				<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">Welcome to Battle-Comm!</h1>
				<h2 style="font-size:28px">...your new account is pending approval.  Expect an update within the next few days.</h2>
				<h2 style="font-size:24px">Username: ${data.username}</h2>
			</div>

			<h4 style="font-size="18px">Welcome to the Community for Table-Top Games,</h4>

			<p style="font-size:14px">Find access to a worldwide community of dedicated table-top gamers and hobbyists.  Battle-Comm is a platform to
			connect with other players and earn Reward Points that can be applied toward new products and discounts at your friendly local gaming stores.
			The site is an ever evolving application, that seeks to make your experience better with new features and functionality.  During these early stages,
			don't hesitate to drop us a line if you have recommendations for the application as we begin to move from beta to production.</p>

			<h4 style="font-size:16px;text-align:center;">Name: ${data.lastName}, ${data.firstName} | Username: ${data.username} | Email: ${data.email} | Role: Event Admin</h4>

			<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">
				<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">
			</div>
		</div>
	`;
}

export default buildTemplate;
