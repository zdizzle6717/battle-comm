<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "club", "values": [{"table": "club", "column": "club_name", "value": {"from": "form", "value": "club_name", "required": false, "default": ""}}, {"table": "club", "column": "clubDescription", "value": {"from": "form", "value": "clubDescription", "required": false, "default": ""}}, {"table": "club", "column": "FLGS_affiliation", "value": {"from": "form", "value": "FLGS_affiliation", "required": false, "default": ""}}, {"table": "club", "column": "club_email", "value": {"from": "form", "value": "club_email", "required": false, "default": ""}}, {"table": "club", "column": "club_contact_name", "value": {"from": "form", "value": "club_contact_name", "required": false, "default": ""}}, {"table": "club", "column": "club_admin_name", "value": {"from": "form", "value": "club_admin_name", "required": false, "default": ""}}, {"table": "club", "column": "club_editor_name", "value": {"from": "form", "value": "club_editor_name", "required": false, "default": ""}}, {"table": "club", "column": "club_moderator_name", "value": {"from": "form", "value": "club_moderator_name", "required": false, "default": ""}}, {"table": "club", "column": "club_Member_name", "value": {"from": "form", "value": "club_Member_name", "required": false, "default": ""}}, {"table": "club", "column": "club_facebook", "value": {"from": "form", "value": "club_facebook", "required": false, "default": ""}}, {"table": "club", "column": "club_twitter", "value": {"from": "form", "value": "club_twitter", "required": false, "default": ""}}, {"table": "club", "column": "club_website", "value": {"from": "form", "value": "club_website", "required": false, "default": ""}}, {"table": "club", "column": "club_display_Members", "value": {"from": "form", "value": "club_display_Members", "required": false, "default": ""}}, {"table": "club", "column": "club_logo", "value": {"from": "form", "value": "club_logo", "required": false, "default": ""}}, {"table": "club", "column": "clubOwner", "value": {"from": "form", "value": "clubOwner", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>