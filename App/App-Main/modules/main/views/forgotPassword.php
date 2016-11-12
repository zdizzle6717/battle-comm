<div class="full_width">
	<div class="card">
		<form name="loginForm" ng-submit="Forgot.resetPassword(Forgot.email)" novalidate>
			<h2 class="push-bottom-2x">RESET PASSWORD</h2>
			<h3 class="text-center">Enter your e-mail addresss to reset you password. Follow the link in the e-mail to confirm and enter a new password.</h3>
			<div class="form-group flex-col-center">
				<div class="two_column_1">
					<input type="email" ng-model="Forgot.email" maxlength="50" required/>
				</div>
			</div>
			<div class="form-group text-right">
				<button class="button button-primary" type="submit" ng-disabled="loginForm.$invalid">Submit</button>
			</div>
			<h3 ng-if="Forgot.showSuccessMessage" class="text-center">{{Forgot.resetMessage}}</h3>
		</form>
	</div>
</div>
