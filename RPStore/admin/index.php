<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Store</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
	<link rel="stylesheet" type="text/css" media="screen, print" href="Styles/app.css">
    <script src="../../ScriptLibrary/AngularJS/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
    <script type="text/javascript">
        /* dmxDataSet name "logged_in_player_full" */
             jQuery.dmxDataSet(
               {"id": "logged_in_player_full", "url": "../../dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
             );
        /* END dmxDataSet name "logged_in_player_full" */
		/* dmxDataSet name "loggedInPlayer" */
			 jQuery.dmxDataSet(
			   {"id": "loggedInPlayer", "url": "../../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
			 );
		/* END dmxDataSet name "loggedInPlayer" */
    </script>
</head>
<?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
include ($pathToFile. "/Templates/parts/header.php"); ?>
	<?php include ($pathToFile. "/Templates/parts/container-top.php"); ?>
		<div class="full_width">
			<div class="product-col-9">
				<a ui-sref="orderList"><img src="../images/BC_RPStore_Logo.png" alt="Reward Point Store" class="store-logo"/></a>
			</div>
			<div class="product-col-3">
				<h2>Admin</h2>
			</div>
		</div>
		<div class="full_width">
			<div class="product-col-4">
				<button class="btn" ui-sref="orderList"><span class="glyphicon glyphicon-credit-card"></span> View All Orders</button>
			</div>
			<div class="product-col-4">
				<button class="btn" ui-sref="productList"><span class="glyphicon glyphicon-list"></span> View All Products</button>
			</div>
			<div class="product-col-4">
				<button class="btn" ui-sref="product({id: undefined})"><span class="glyphicon glyphicon-plus"></span> Add New Products</button>
			</div>
		</div>
		<div class="full_width view-container">
			<hr>
			<br/>
			<div ui-view></div>

			<div class="product-col-12">
				<h1 style="font-size:12px;text-align:center;">Reward Point Store: Admin</h1>
			</div>
			<!-- /.container -->
		</div>
	<?php include ($pathToFile. "/Templates/parts/container-bottom.php"); ?>
<?php include ($pathToFile. "/Templates/parts/footer.php"); ?>
<script src="js/app.js"></script>
