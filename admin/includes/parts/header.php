    <body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome">
        </div>
        <div class="nav row center">
        	<?php include '../includes/account-nav.php'; ?>
            <div class="mobilenav">
                <?php include '../includes/top-navigation.php'; ?>
            </div>
            <div class="uppernav">
                <?php include '../includes/top-navigation.php'; ?>
            </div>
           	<script type="text/javascript">
				$('.scrollDown').click(function(){
					$('html, body').animate({
						scrollTop: $( $(this).attr('href') ).offset().top
					}, 800);
					return false;
				});
			</script>
		</div>
        <div class="site_bg"></div>
        <div class="header row center">
            <div class="logo"><a href="../../../SiteAdmin/index.php"><img src="../../images/BC_Web_Logo.png" alt="BattleComm"></a></div>
            <div class="mobile-logo"><a href="../../../index.php"><img src="../../images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
                <div class="mobile-buttons">
                    <div class="my-profile-button"><a href="../../../admin/user/profile-edit.php"><img src="../../images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="../../../match.php"><img src="../../images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
                </div>
            </div>
        </div>
        
        
        <!-- Middle -->
        <div class="mids">