<?php $pathToFile = $_SERVER['DOCUMENT_ROOT']; require_once($pathToFile. "/webassist/security_assist/helper_php.php" ); ?>
<body>
    <!-- HEADER -->
    <div class="nav placeholder center" id="returnhome"></div>
    <div class="nav row center">
        <?php if(WA_Auth_RulePasses("verifiedUser")){ // Begin Show Region ?>
            <?php include ($pathToFile. "/Templates/includes/account-nav.php"); ?>
        <?php } // End Show Region ?>
        <div class="mobilenav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation-mobile.php"); ?>
        </div>
        <div class="uppernav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation.php"); ?>
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
        <div class="logo"><a href="/"><img src="/images/BC_Web_Logo.png" alt="BattleComm"></a></div>
        <div class="mobile-logo"><a href="/"><img src="/images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
            <!-- <?php if(WA_Auth_RulePasses("verifiedUser")){ // Begin Show Region ?>
                <?php include ($pathToFile. "/Templates/includes/mobile-buttons.php"); ?>
            <?php } // End Show Region ?> -->
        </div>
    </div>
