<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BattleComm | App</title>
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="description" content="Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers.">
	<meta property="og:title" content="Battle-Comm | App"/>
	<meta property="og:url" content="http://www.beta.battle-comm.net/News/"/>
	<meta property="og:image" content="http://www.beta.battle-comm.net/images/meta-image.jpg"/>
	<meta property="og:site_name" content="Battle-Comm"/>
	<meta property="og:description" content="Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers."/>

    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
</head>
<?php $pathToFile = $_SERVER['DOCUMENT_ROOT']; ?>
<body>
    <!-- HEADER -->
    <div class="nav placeholder center" id="returnhome"></div>
    <div class="nav row center">
		<div account-nav></div>
        <div class="mobilenav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation-mobile.php"); ?>
        </div>
        <div class="uppernav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation.php"); ?>
        </div>
    </div>
    <div class="site_bg"></div>
    <div class="header row center">
        <div class="logo"><a href="/"><img src="/images/BC_Web_Logo.png" alt="BattleComm"></a></div>
        <div class="mobile-logo"><a href="/"><img src="/images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
            <?php include ($pathToFile. "/Templates/includes/mobile-buttons.php"); ?>
        </div>
    </div>
	<?php include ($pathToFile. "/Templates/parts/container-top.php"); ?>
		<div class="full_width view-container">
			<div user-nav></div>
			<div ui-view class="view-frame"></div>
			<div loading></div>
			<div notification></div>

			<!-- /.container -->
		</div>
	<?php include ($pathToFile. "/Templates/parts/container-bottom.php"); ?>
<?php include ($pathToFile. "/Templates/parts/footer.php"); ?>
<script src="js/app.js"></script>
