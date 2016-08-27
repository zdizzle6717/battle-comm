<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/players/serverConnectTriggerTest.php",
      "linkedForm": "bioUpdate"
    },
    "$_POST": [
      {
        "name": "userID",
        "type": "var"
      },
      {
        "name": "textarea",
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
                "value": "{{$_POST.textarea}}"
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