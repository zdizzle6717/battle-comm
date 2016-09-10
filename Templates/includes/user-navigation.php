<!-- Begin User Level Navigation -->
	<div class="user-nav">
		<a class="nav-item" href="/Players/#/dashboard/">My Dashboard</a>
		<a class="nav-item" href="/Players/#/profile/">My Public Profile</a>
		<?php if(WA_Auth_RulePasses("venueAdmin")){ // Begin Show Region ?>
		<a class="nav-item" href="/Admin-Venue/#/">Venue Admin</a>
		 <?php } // End Show Region ?>
		<?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
		<a class="nav-item" href="/Admin/#/orderList">System Admin</a>
		 <?php } // End Show Region ?>
    </div>
<!-- End User Level Navigation -->
