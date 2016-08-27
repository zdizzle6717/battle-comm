<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/admin/Achievements/index.php",
      "linkedForm": "achieve"
    },
    "$_POST": [
      {
        "name": "input",
        "type": "var"
      },
      {
        "name": "file",
        "type": "object",
        "sub": [
          {
            "name": "isFile",
            "type": "var"
          },
          {
            "name": "name",
            "type": "var"
          },
          {
            "name": "type",
            "type": "var"
          },
          {
            "name": "size",
            "type": "var"
          },
          {
            "name": "error",
            "type": "var"
          }
        ]
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
        "name": "achieve",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "xampp_local",
          "sql": {
            "type": "insert",
            "table": "achievements",
            "values": [
              {
                "table": "achievements",
                "column": "achievementName",
                "value": "{{$_POST.input}}"
              },
              {
                "table": "achievements",
                "column": "achievementDescription",
                "value": "{{$_POST.textarea}}"
              },
              {
                "table": "achievements",
                "column": "achievementIcon",
                "value": "{{$_POST.file.name}}"
              }
            ],
            "wheres": []
          }
        },
        "meta": [
          "identity",
          "affected"
        ]
      }
    ]
  }
}
JSON
);
?>