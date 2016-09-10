<div class="full_width">
	<form class="" style="margin:0 auto;" name="pointAssignmentForm" novalidate>
		<h2 class="push-bottom-2x">Point Assignment</h2>
		<h3>Venue Details:</h3>
		<div class="form-group">
			<div class="three_column_1">
				<label for="venueName" class="sublabel required">Venue Name:</label>
				<input id="venueName" name="venueName" ng-model="Points.venueEvent.venueName" type="text" class="formTextfield_Large" placeholder="Enter the full venue name.." required>
			</div>
			<div class="three_column_1">
				<label for="eventName" class="sublabel required">Event Name:</label>
				<input id="eventName" name="eventName" ng-model="Points.venueEvent.eventName" type="text" class="formTextfield_Large" placeholder="Enter the specific name of the event..." required>
			</div>
			<div class="three_column_1">
				<label for="venueAdmin" class="sublabel required">Your Full Name:</label>
				<input id="venueAdmin" name="venueAdmin" ng-model="Points.venueEvent.venueAdmin" type="text" class="formTextfield_Large" placeholder="Enter the name of the venue/event administrator..." required>
			</div>
		</div>
		<div class="form-group">
			<div class="two_column_1">
				<label for="eventDate" class="sublabel required">Date:</label>
				<input id="eventDate" name="eventDate" ng-model="Points.venueEvent.eventDate" type="text" class="formTextfield_Large" placeholder="Enter the day of the event..." required>
			</div>
			<div class="two_column_1">
				<label for="returnEmail" class="sublabel required">Return E-mail:</label>
				<input id="returnEmail" name="returnEmail" ng-model="Points.venueEvent.returnEmail" type="text" class="formTextfield_Large" placeholder="Please enter a return e-mail.." required>
			</div>
		</div>
		<hr>
		<h3>Players:</h3>
		<fieldset ng-repeat="player in Points.players track by $index">
			<legend>Player 1</legend>
			<div class="form-group">
				<div class="three_column_1">
					<label for="fullName" class="sublabel required">Full Name:</label>
					<input id="fullName" name="fullName" ng-model="player.fullName" type="text" class="formTextfield_Large" placeholder="Player full name..." required>
				</div>
				<div class="three_column_1">
					<label for="email" class="sublabel required">E-mail:</label>
					<input id="email" name="email" ng-model="player.email" type="email" class="formTextfield_Large" placeholder="Player E-mail..." required>
				</div>
				<div class="three_column_1">
					<label for="pointsEarned" class="sublabel required">Points Earned:</label>
					<input id="pointsEarned" name="pointsEarned" ng-model="player.pointsEarned" type="number" class="formTextfield_Large" placeholder="Total Points Earned..." required>
				</div>
			</div>
			<button class="button button-danger right" ng-click="Points.removePlayer($index)"><span class="fa fa-minus"></span></button>
		</fieldset>
		<div class="form-group text-right">
			<button ng-click="Points.addPlayer()" class="button button-primary" type="button"><span class="fa fa-plus"></span> Add Player</button>
		</div>
		<hr>
		<div class="form-group text-right push-top-2x">
			<button ng-click="Points.submitPoints()" class="button button-full button-primary" type="button" ng-disabled="pointAssignmentForm.$invalid">Submit</button>
		</div>
	</form>
</div>
