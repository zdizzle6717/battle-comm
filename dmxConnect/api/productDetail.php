<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {},
    "$_GET": [
      {
        "type": "text",
        "name": "pid"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/tbc",
      {
        "name": "tbc_product_detail",
        "module": "dbconnector",
        "action": "select",
        "options": {
          "connection": "tbc",
          "sql": {
            "type": "select",
            "table": "products",
            "columns": [
              {
                "table": "products",
                "column": "SKU",
                "value": "{{$_POST.SKU}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "name",
                "value": "{{$_POST.name}}",
                "type": "text"
              }
            ],
            "wheres": [
              {
                "table": "products",
                "column": "id",
                "bool": "and",
                "operator": "=",
                "value": "{{$_GET.pid}}",
                "type": "number"
              }
            ],
            "orders": [],
            "joins": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "SKU",
            "type": "text"
          },
          {
            "name": "name",
            "type": "text"
          }
        ],
        "outputType": "array"
      }
    ]
  }
}
JSON
);
?>