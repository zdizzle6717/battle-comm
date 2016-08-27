<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/players/mydashboard.php",
      "linkedForm": "edit-user-bio"
    },
    "$_POST": [
      {
        "name": "userID",
        "type": "var"
      },
      {
        "name": "userBio",
        "type": "var"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/xampp_local",
      {
        "name": "updateBio",
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
                "column": "user_bio",
                "value": "{{$_POST.userBio}}"
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