<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "bc_news", "columns": [{"table": "bc_news", "column": "news_title", "alias": "", "sortable": false}, {"table": "bc_news", "column": "featured_image", "alias": "", "sortable": false}, {"table": "bc_news", "column": "news_callout", "alias": "", "sortable": false}, {"table": "bc_news", "column": "news_date_published", "alias": "", "sortable": true}], "wheres": [], "orders": [{"table": "bc_news", "column": "news_date_published", "direction": "ASC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>