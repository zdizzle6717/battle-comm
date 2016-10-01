<div class="two_column_1">
	<div class="card side-by-side">
		<form name="loginForm" ng-submit="Login.login(Login.credentials)" novalidate>
			<h2 class="push-bottom-2x">LOGIN</h2>
			<div class="form-group">
				<label class="required">Email/Handle</label>
				<input type="text" ng-model="Login.credentials.username" required/>
			</div>
			<div class="form-group">
				<label class="required">Password</label>
				<input type="password" ng-model="Login.credentials.password" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/" required/>
			</div>
			<div class="form-group text-right">
				<a ng-href="#">Forgot password?</a>
			</div>
			<div class="form-group text-left">
				<input type="checkbox" name="rememberLogin" ng-model="Login.credentials.rememberLogin" value="true"> Remember my information<br>
			</div>
			<div class="form-group text-left">
				<input type="checkbox" name="loginAuto" ng-model="Login.credentials.loginAuto" value="true"> Log me in automatically<br>
			</div>
			<div class="form-group text-right">
				<button class="button button-primary" type="submit" ng-disabled="loginForm.$invalid">Log in</button>
			</div>
			<div class="form-group text-center">
				<p class="required" ng-if="Login.incorrectUsername">Incorrect user handle or email.</p>
				<p class="required" ng-if="Login.incorrectPassword">Incorrect password.</p>
			</div>
		</form>
	</div>
</div>
<div class="two_column_1">
	<div class="card side-by-side">
		<h2>REGISTER</h2>
		<h4>WELCOME TO BATTLE-COMM...the portal to find all levels of friendly, local, table-top gaming. With a long running list of supported table-top
			gaming systems, Battle-comm is a community of individuals making connections through competition.<br><br>  Schedule a tournament, record
			stats, match up with local players, and compete at the national level.  You'll also have the opportunity to earn ranking, achievements,
			and BC Reward Points to trade-in for related products!
		</h4>
		<h3 class="text-right"><a href="#test-popup" class="open-popup-link">→Supported Platforms</a></h3>
		<h2>Sign Up</h2>
		<h5><a ui-sref="register">→Player Registration</a></h5>
	</div>
</div>
