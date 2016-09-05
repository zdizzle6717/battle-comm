<?php $pathToFile = $_SERVER['DOCUMENT_ROOT']; ?>
  <script type="text/javascript">
<!--
	function toggle_visibility(id) {
	   var e = document.getElementById(id);
	   if(e.style.display == 'block')
		  e.style.display = 'none';
	   else
		  e.style.display = 'block';
	}
//-->
</script>
<div class="profilenav" onclick="toggle_visibility('account-nav');">
<!-- <img src="/uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/{{logged_in_player_full.data[0].user_icon}}" width="37" alt=""/> -->
<img src="/images/profile_image_small.png" width="37" alt=""/>
    <div id="account-nav">
    	<div class="account_name"><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></div>
        <ul class="accountnav no_bullets">
            <li><a href="/Players/#/dashboard/"><span class="fa fa-user"></span> My Dashboard</a></li>
            <li><a href="/Players/#/profile/"><span class="fa fa-user"></span> My Public Profile</a></li>
            <li><a href="/Players/#/dashboard/"><span class="fa fa-envelope"></span> Messages</a></li>
            <!-- <li><a href="/players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>"><span class="fa fa-cog"></span> Account Settings</a></li> -->
            <li><a href="/logout.php"><span class="fa fa-sign-out"></span>Logout</a></li>
        </ul>
    </div>
</div>
