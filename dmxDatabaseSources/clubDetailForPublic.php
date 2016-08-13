<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "club", "columns": [{"table": "club", "column": "club_name", "alias": "", "sortable": false}, {"table": "club", "column": "logo_w", "alias": "", "sortable": false}, {"table": "club", "column": "logo_h", "alias": "", "sortable": false}, {"table": "club", "column": "clubDescription", "alias": "", "sortable": false}, {"table": "club", "column": "FLGS_affiliation", "alias": "", "sortable": false}, {"table": "club", "column": "club_street", "alias": "", "sortable": false}, {"table": "club", "column": "club_city", "alias": "", "sortable": false}, {"table": "club", "column": "club_state", "alias": "", "sortable": false}, {"table": "club", "column": "club_zip", "alias": "", "sortable": false}, {"table": "club", "column": "club_email", "alias": "", "sortable": false}, {"table": "club", "column": "club_contact_name", "alias": "", "sortable": false}, {"table": "club", "column": "club_admin_name", "alias": "", "sortable": false}, {"table": "club", "column": "club_editor_name", "alias": "", "sortable": false}, {"table": "club", "column": "club_moderator_name", "alias": "", "sortable": false}, {"table": "club", "column": "club_Member_name", "alias": "", "sortable": false}, {"table": "club", "column": "club_facebook", "alias": "", "sortable": false}, {"table": "club", "column": "club_twitter", "alias": "", "sortable": false}, {"table": "club", "column": "club_website", "alias": "", "sortable": false}, {"table": "club", "column": "club_display_Members", "alias": "", "sortable": false}, {"table": "club", "column": "club_logo", "alias": "", "sortable": false}, {"table": "venue", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "club", "column": "club_key", "bool": "and", "operator": "=", "value": {"from": "url", "value": "ck", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "venue", "clauses": [{"table": "venue", "column": "venue_id", "bool": "and", "operator": "=", "value": {"table": "club", "column": "club_key"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>