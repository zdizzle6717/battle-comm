'use strict';

function buildTemplate(data) {
	return `
		<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">
			<div style="text-align:center;">
				<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">Welcome to Battle-Comm, subscriber!</h1>
				<h2 style="font-size:28px">...your new account is pending activation. Purchasing a subscription will activate your account and grant access to the BC Store and more.</h2>
				<h2 style="font-size:24px">Username: ${data.username}</h2>
			</div>

			<h4 style="font-size="18px">Welcome to the Community for Table-Top Games,</h4>

			<p style="font-size:14px">Find access to a worldwide community of dedicated table-top gamers and hobbyists.  Battle-Comm is a platform to
			connect with other players and earn Reward Points that can be applied toward new products and discounts at your friendly local gaming stores.
			As a subscriber you gain access to more features and the Battle-Comm store. Thanks for helping support our development as the go-to source for table-top player ranking.</p>

			<h4 style="font-size:16px;text-align:center;">Name: ${data.lastName}, ${data.firstName} | Username: ${data.username} | Email: ${data.email} | Role: Subscriber</h4>

			<div style="text-align:center;">
				<b>Follow the link to complete your subscription and login.</b>
			</div>

			<div style="text-align:center;margin:20px 0;">
				<a style="padding: 6px 12px;font-size: 20px;line-height: 1.42857143;border-radius: 3px;background: #278ECA;color: white;text-decoration: none;" href="https://www.battle-comm.net/subscribe">Subscribe</a>
			</div>

			<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">
				<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">
			</div>
		</div>
	`;
}

export default buildTemplate;
