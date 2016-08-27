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
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="/uploads/player/profile_image_small.png" width="37" alt=""/></a>
    <div id="account-nav">
    	<div class="account_name"><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></div>
        <ul class="accountnav no_bullets">
        	<li><a href="../index.php">Player Home</a></li>
            <li><a href="../playerProfile/EditProfileA.php">My Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="../../logout.php">Logout</a></li>
        </ul>
    </div>
</div>