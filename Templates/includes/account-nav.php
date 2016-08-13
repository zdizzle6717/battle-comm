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
<div class="profilenav" onclick="toggle_visibility('account-nav');"><img src="/uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/{{logged_in_player_full.data[0].user_icon}}" width="37" alt=""/>
    <div id="account-nav">
    	<div class="account_name"><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></div>
        <ul class="accountnav no_bullets">
        	<li><a href="/players/index.php"><span class="glyphicon glyphicon-home"></span> Player Home</a></li>
            <li><a href="/players/liveProfile.php"><span class="glyphicon glyphicon-user"></span> My Public Profile</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messages</a></li>
            <li><a href="/players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>"><span class="glyphicon glyphicon-cog"></span> Account Settings</a></li>
            <li><a href="/logout.php">Logout <span class="glyphicon glyphicon-log-out"></span></a></li>
        </ul>
    </div>
</div>
