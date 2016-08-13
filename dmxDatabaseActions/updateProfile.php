<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "user_profile", "values": [{"table": "user_profile", "column": "userID", "value": {"from": "form", "value": "userID", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_handle", "value": {"from": "form", "value": "user_handle", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_main_phone", "value": {"from": "form", "value": "user_main_phone", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_mobile_phone", "value": {"from": "form", "value": "user_mobile_phone", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_work_phone", "value": {"from": "form", "value": "user_work_phone", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_street_address", "value": {"from": "form", "value": "user_street_address", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_apt_suite", "value": {"from": "form", "value": "user_apt_suite", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_city", "value": {"from": "form", "value": "user_city", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_zip", "value": {"from": "form", "value": "user_zip", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_dateJoined", "value": {"from": "form", "value": "user_dateJoined", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_birthday", "value": {"from": "form", "value": "user_birthday", "required": false, "default": ""}}, {"table": "user_profile", "column": "user_bio", "value": {"from": "form", "value": "user_bio", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>