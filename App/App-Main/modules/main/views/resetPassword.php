<div class="full_width">
	<div class="card">
		<form name="resetPasswordForm" ng-submit="Reset.setNewPassword()" novalidate>
			<h2 class="push-bottom-2x">RESET PASSWORD</h2>
			<h3 class="text-center">Enter your new password to update the account with e-mail {{Reset.credentials.email}}</h3>
			<div class="form-group flex-col-center">
				<div class="two_column_1">
					<label>New Password</label>
					<input type="password" ng-model="Reset.credentials.password" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
				</div>
			</div>
			<div class="form-group flex-col-center">
				<div class="two_column_1">
					<label>Repeat New Password</label>
					<input type="password" ng-model="Reset.passwordRepeat" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
				</div>
			</div>
			<div class="form-group text-center">
				<button class="button button-primary" type="submit" ng-disabled="resetPasswordForm.$invalid || !Reset.checkPasswords()">Submit</button>
			</div>
			<div class="form-group text-center">
				<p class="required" ng-if="Reset.invalidPassword">Passwords do not match!</p>
				<h5 class="required" >Passwords Requirements:</h5>
				<ul>
					<li>Minimum of 8 characters</li>
					<li>At least one lowercase letter</li>
					<li>At least one uppercase letter</li>
					<li>At least one symbol/special character !@#$%^&_-+=</li>
				</ul>
			</div>
		</form>
	</div>
</div>
