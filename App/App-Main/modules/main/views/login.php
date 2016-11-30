<div class="two_column_1">
	<div class="card side-by-side">
		<form name="loginForm" ng-submit="Login.login(Login.credentials)" novalidate>
			<h2 class="push-bottom-2x">LOGIN</h2>
			<div class="form-group">
				<label class="required">Email/Username</label>
				<input type="text" ng-model="Login.credentials.username" required/>
			</div>
			<div class="form-group">
				<label class="required">Password</label>
				<input type="password" ng-model="Login.credentials.password" ng-minlength="8" ng-pattern="/^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[\!@#$%^&\*\_\-+=]).*$/" required/>
			</div>
			<div class="form-group text-right">
				<a ui-sref="forgotPassword">Forgot password?</a>
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
				<p class="required" ng-if="Login.incorrectUsername">Incorrect username or email.</p>
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
		<h3 class="text-right"><a href="#game-list-popup" class="open-popup-link">→Supported Platforms</a></h3>
		<div id="game-list-popup" class="game-list-popup mfp-hide">
			<div class="col-lg-6">
  		    <h2>Full Game Systems List</h2>
  		    <h4>Age of Sigmar<br>
  		  	Armada<br>
  		      Black Powder<br>
  		      BoltAction<br>
  		      Bushido<br>
  		      Call of Cthulhu: The Card Game<br>
  		      Chess<br>
  		      D&amp;D Attack Wing<br>
  		      DarkAge<br>
  		      DeadZone<br>
  		      Dreadball<br>
  		      Drop Zone Commander<br>
  		      Dystopian Legions<br>
  		      Dystopian Wars<br>
  		      Firestorm Armada<br>
  		      Firestorm Planetfall<br>
  		      Flames of War<br>
  		      Game of Thrones the card game<br>
  		      Hail Caeser<br>
  		  	Halo Fleet Battles<br>
  		      Heavy Gear<br>
  		      Hero Clicks<br>
  		      Horus Heresy<br>
  		      Infinity<br>
  		      Kings of War<br>
  		      Magic The Gathering<br>
  		      Malifaux<br>
  		      NetRunner<br>
  		      Pike & Shotte<br>
  		      Relic Knights<br>
  		      Robotech<br>
  		      Saga<br>
  		      Star Wars Imperial Assault<br>
  		      Star Trek Attack Wing<br>
  		      Star Wars the Card Game<br>
  		      W40K Conquest<br>
  		      The Lord of the Rings/The Hobbit<br>
  		      Warhammer 40,000<br>
  		      Warhammer: Invasion<br>
  		      Warmachine<br>
  		  	Hordes<br>
  		      Warpath<br>
  		      Warzone<br>
  		      Wild West Exodus<br>
  		  	Wrath of Kings<br>
  		      X-Wing<br>
  		    </h4>
  		  </div>
		</div>
		<script>
			$('.open-popup-link').magnificPopup({
			  type:'inline',
			  midClick: true
			});
		</script>
		<h2>Sign Up</h2>
		<h5><a ui-sref="register">→Player Registration</a></h5>
	</div>
</div>
