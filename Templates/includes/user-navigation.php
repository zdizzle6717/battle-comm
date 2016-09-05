<!-- Begin User Level Navigation -->
	<div class="user-nav">
		<a class="nav-item" href="/Players/#/dashboard/">My Dashboard</a>
		<a class="nav-item" href="/Players/#/profile/">My Public Profile</a>
        <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
        <a class="nav-item" href="/tool/index.php">Tournament Admin</a>
          <?php } // End Show Region ?>
        <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
        <a class="nav-item" href="/clubsAdmin/index.php">Club Admin</a>
        <?php } // End Show Region ?>
		<?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
          <a class="nav-item" href="/admin/index.php"> System Admin</a>
          <?php } // End Show Region ?>
		<?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
		<a class="nav-item" href="/Admin/#/orderList">System Admin (New)</a>
		 <?php } // End Show Region ?>
    </div>
<!-- End User Level Navigation -->
