<!doctype html>
<html>
<head>
	<title>Battle-Comm | App</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="description" content="Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers.">
	<meta name="keyword" content="battle-comm, table-top, table, games, battle, app, warhammer 40k, worldwide, community, hobbyist, player, reward point, gaming, point, battlecomm, match, friendly, tournament, event, magic the gathering, star wars, warhammer">
	<meta property="og:title" content="Battle-Comm | App"/>
	<meta property="og:url" content="https://www.battle-comm.net/News/"/>
	<meta property="og:image" content="https://www.battle-comm.net/images/meta-image.jpg"/>
	<meta property="og:site_name" content="Battle-Comm"/>
	<meta property="og:description" content="Find access to a worldwide community of dedicated table-top gamers and hobbyists as well as tools to promote your store, events, and gaming space to a worldwide community of dedicated table-top players. Earn system packs and a reward point vault for your future customers."/>

    <link rel="stylesheet" type="text/css" media="screen, print" href="../styles/global.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../Scripts/jquery.magnificant-popup.js"></script>
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
			<span access-level="['systemAdmin', 'venueAdmin']">
				<div user-nav></div>
			</span>
			<div ui-view class="view-frame"></div>
			<div chat-box></div>
			<div loading></div>
			<div notification></div>

			<!-- /.container -->
		</div>
	<?php include ($pathToFile. "/Templates/parts/container-bottom.php"); ?>
<?php include ($pathToFile. "/Templates/parts/footer.php"); ?>
<script src="https://52.26.195.10:3001/socket.io/socket.io.js"></script>
<script src="js/app.js"></script>
