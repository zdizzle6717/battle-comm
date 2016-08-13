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
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="../../images/profile_image_small.png" alt=""/></a>
    <div id="account-nav">
    	<div class="account_name">[Username]</div>
        <ul class="accountnav no_bullets">
            <li>
                <a href="../user/profile-edit.php">Edit Profile</a>
            </li>
            <li><a href="">Ranking</a></li>
            <li><a href="">Groups</a></li>
            <li><a href="">Account</a></li>
            <li><a href="../../index.php">Logout</a></li>
        </ul>
    </div>
</div>