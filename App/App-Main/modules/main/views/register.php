<div class="full_width">
	<div class="card side-by-side">
		<form name="loginForm" ng-submit="Register.register(Register.credentials)" novalidate>
			<h2 class="push-bottom-2x">REGISTER</h2>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">Email</label>
					<input type="email" ng-model="Register.credentials.email" maxlength="50" required/>
				</div>
				<div class="two_column_1">
					<label class="required">User Handle</label>
					<input type="text" ng-model="Register.credentials.username" ng-minlength="4" maxlength="50" required/>
				</div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">First Name</label>
					<input type="text" ng-model="Register.credentials.firstName" ng-minlength="4" maxlength="50" required/>
				</div>
				<div class="two_column_1">
					<label class="required">Last Name</label>
					<input type="text" ng-model="Register.credentials.lastName" ng-minlength="4" maxlength="50" required/>
				</div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">Password</label>
					<input type="password" ng-model="Register.credentials.password" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/" required/>
				</div>
				<div class="two_column_1">
					<label class="required">Repeat Password</label>
					<input type="password" ng-model="Register.passwordRepeat" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=]).*$/" required/>
				</div>
			</div>
			<div class="form-group text-right">
				<a ui-sref="login">Login?</a>
			</div>
			<div class="form-group text-right">
				<button class="button button-primary" type="submit" ng-disabled="loginForm.$invalid || !Register.checkPasswords()">Register</button>
			</div>
			<div class="form-group text-center">
				<p class="required" ng-if="Register.invalidUsername">User handle is already in use.</p>
				<p class="required" ng-if="Register.invalidEmail">There is already an account with the entered email address.</p>
				<p class="required" ng-if="Register.invalidPassword">Passwords do not match!</p>
				<h5 class="required" >Passwords Requirements:</h5>
				<ul>
					<li>Minimum of 8 characters</li>
					<li>At least one lowercase letter</li>
					<li>At least one uppercase letter</li>
					<li>At least one symbol/special character @#$%^&+=</li>
				</ul>
			</div>
		</form>
	</div>
</div>
