<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off
@session_start();
?>
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/admin/playerRP.php",
      "linkedForm": "pointSubmit"
    },
    "$_POST": [
      {
        "name": "userID",
        "type": "var"
      },
      {
        "name": "pointAdjust",
        "type": "var"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/xampp_local",
      {
        "name": "rpModification",
        "module": "dbupdater",
        "action": "update",
        "options": {
          "connection": "xampp_local",
          "sql": {
            "type": "update",
            "table": "user_login",
            "values": [
              {
                "table": "user_login",
                "column": "user_points",
                "value": "{{$_POST.pointAdjust}}"
              }
            ],
            "wheres": [
              {
                "table": "user_login",
                "column": "id",
                "bool": "and",
                "operator": "=",
                "value": "{{$_POST.userID}}"
              }
            ]
          }
        },
        "meta": [
          "affected"
        ]
      }
    ]
  }
}
JSON
);
?>
