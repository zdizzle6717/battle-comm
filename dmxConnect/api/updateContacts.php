<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/players/mydashboard.php",
      "linkedForm": "edit-user-contact"
    },
    "$_POST": [
      {
        "name": "email",
        "type": "var"
      },
      {
        "name": "user_main_phone",
        "type": "var"
      },
      {
        "name": "user_street_address",
        "type": "var"
      },
      {
        "name": "user_city",
        "type": "var"
      },
      {
        "name": "user_state",
        "type": "var"
      },
      {
        "name": "user_zip",
        "type": "var"
      },
      {
        "name": "contact_user_id",
        "type": "var"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/xampp_local",
      {
        "name": "socialUpdate",
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
                "column": "email",
                "value": "{{$_POST.email}}"
              },
              {
                "table": "user_login",
                "column": "user_main_phone",
                "value": "{{$_POST.user_main_phone}}"
              },
              {
                "table": "user_login",
                "column": "user_street_address",
                "value": "{{$_POST.user_street_address}}"
              },
              {
                "table": "user_login",
                "column": "user_city",
                "value": "{{$_POST.user_city}}"
              },
              {
                "table": "user_login",
                "column": "user_state",
                "value": "{{$_POST.user_state}}"
              },
              {
                "table": "user_login",
                "column": "user_zip",
                "value": "{{$_POST.user_zip}}"
              }
            ],
            "wheres": [
              {
                "table": "user_login",
                "column": "id",
                "bool": "and",
                "operator": "=",
                "value": "{{$_POST.contact_user_id}}"
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