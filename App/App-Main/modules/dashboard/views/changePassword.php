<div class="full_width">
	<div class="card">
		<form name="accountUpdateForm" ng-submit="Dashboard.changePassword()" novalidate>
			<h2 class="push-bottom-2x">CHANGE PASSWORD</h2>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">First Name</label>
					<input type="text" ng-model="Dashboard.currentUser.firstName" maxlength="50" disabled/>
				</div>
				<div class="two_column_1">
					<label class="required">Last Name</label>
					<input type="text" ng-model="Dashboard.currentUser.lastName" maxlength="50" disabled/>
				</div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">Email</label>
					<input type="email" ng-model="Dashboard.currentUser.email" maxlength="50" disabled required/>
				</div>
				<div class="two_column_1">
					<label class="required">Current Password</label>
					<input type="password" ng-model="Dashboard.currentUser.password" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
				</div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
					<label class="required">New Password</label>
					<input type="password" ng-model="Dashboard.currentUser.newPassword" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
				</div>
				<div class="two_column_1">
					<label class="required">Repeat New Password</label>
					<input type="password" ng-model="Dashboard.newPasswordRepeat" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
				</div>
			</div>
			<div class="form-group text-right">
				<button class="button button-primary" type="submit" ng-disabled="accountUpdateForm.$invalid || !Dashboard.checkPasswords()">Submit</button>
			</div>
			<div class="form-group text-center">
				<p class="required" ng-if="Dashboard.invalidUsername">User handle is already in use.</p>
				<p class="required" ng-if="Dashboard.invalidEmail">There is already an account with the entered email address.</p>
				<p class="required" ng-if="Dashboard.invalidPassword">Passwords do not match!</p>
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
<div class="full_width text-right push-top-2x">
	<a ng-click="Dashboard.logout()">Logout?</a>
</div>
