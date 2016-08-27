<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/players/PlayerImageUpload.php",
      "linkedForm": "iconUpload"
    },
    "$_POST": [
      {
        "type": "file",
        "fieldName": "uploadIcon",
        "name": "uploadIcon"
      },
      {
        "type": "text",
        "fieldName": "userID",
        "name": "userID"
      },
      {
        "type": "text",
        "fieldName": "playerID",
        "name": "playerID"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/xampp_local",
      {
        "name": "updateIcon",
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
                "column": "user_icon",
                "value": "{{$_POST.uploadIcon}}",
                "type": "text"
              }
            ],
            "wheres": [
              {
                "table": "user_login",
                "column": "id",
                "bool": "and",
                "operator": "=",
                "value": "{{$_POST.playerID}}",
                "type": "text"
              }
            ]
          }
        },
        "meta": [
          "affected"
        ]
      },
      {
        "name": "playerIconUpload",
        "module": "upload",
        "action": "upload",
        "options": {
          "fields": "{{$_POST.uploadIcon}}",
          "path": "/uploads/player/{{$_SESSION.SecurityAssist_id}}",
          "throwErrors": true
        },
        "meta": []
      }
    ]
  }
}
JSON
);
?>