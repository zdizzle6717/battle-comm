<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/players/mydashboard.php",
      "linkedForm": "edit-user-social"
    },
    "$_POST": [
      {
        "name": "user_facebook",
        "type": "var"
      },
      {
        "name": "user_twitter",
        "type": "var"
      },
      {
        "name": "user_instagram",
        "type": "var"
      },
      {
        "name": "user_google_plus",
        "type": "var"
      },
      {
        "name": "user_youtube",
        "type": "var"
      },
      {
        "name": "user_twitch",
        "type": "var"
      },
      {
        "name": "user_website",
        "type": "var"
      },
      {
        "name": "socialuserid",
        "type": "var"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/xampp_local",
      {
        "name": "social_update",
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
                "column": "user_facebook",
                "value": "{{$_POST.user_facebook}}"
              },
              {
                "table": "user_login",
                "column": "user_twitter",
                "value": "{{$_POST.user_twitter}}"
              },
              {
                "table": "user_login",
                "column": "user_instagram",
                "value": "{{$_POST.user_instagram}}"
              },
              {
                "table": "user_login",
                "column": "user_google_plus",
                "value": "{{$_POST.user_google_plus}}"
              },
              {
                "table": "user_login",
                "column": "user_youtube",
                "value": "{{$_POST.user_youtube}}"
              },
              {
                "table": "user_login",
                "column": "user_twitch",
                "value": "{{$_POST.user_twitch}}"
              },
              {
                "table": "user_login",
                "column": "user_website",
                "value": "{{$_POST.user_website}}"
              }
            ],
            "wheres": [
              {
                "table": "user_login",
                "column": "id",
                "bool": "and",
                "operator": "=",
                "value": "{{$_POST.socialuserid}}"
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