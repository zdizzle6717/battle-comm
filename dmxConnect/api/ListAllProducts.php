<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {}
  },
  "exec": {
    "steps": [
      "Connections/tbc",
      {
        "name": "tbc_allProducts",
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
                "column": "id",
                "value": "{{$_POST.id}}",
                "type": "number"
              },
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
              },
              {
                "table": "products",
                "column": "price",
                "value": "{{$_POST.price}}",
                "type": "number"
              },
              {
                "table": "products",
                "column": "manufacturerId",
                "value": "{{$_POST.manufacturerId}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "gameSystem",
                "value": "{{$_POST.gameSystem}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "category",
                "value": "{{$_POST.category}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "inStock",
                "value": "{{$_POST.inStock}}",
                "type": "number"
              },
              {
                "table": "products",
                "column": "filterVal",
                "value": "{{$_POST.filterVal}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "displayStatus",
                "value": "{{$_POST.displayStatus}}",
                "type": "number"
              },
              {
                "table": "products",
                "column": "featured",
                "value": "{{$_POST.featured}}",
                "type": "number"
              },
              {
                "table": "products",
                "column": "new",
                "value": "{{$_POST.new}}",
                "type": "number"
              },
              {
                "table": "products",
                "column": "onSale",
                "value": "{{$_POST.onSale}}",
                "type": "number"
              }
            ],
            "wheres": [],
            "orders": [],
            "joins": []
          }
        },
        "output": true,
        "meta": [
          {
            "name": "id",
            "type": "text"
          },
          {
            "name": "SKU",
            "type": "text"
          },
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "price",
            "type": "text"
          },
          {
            "name": "manufacturerId",
            "type": "text"
          },
          {
            "name": "gameSystem",
            "type": "text"
          },
          {
            "name": "category",
            "type": "text"
          },
          {
            "name": "inStock",
            "type": "text"
          },
          {
            "name": "filterVal",
            "type": "text"
          },
          {
            "name": "displayStatus",
            "type": "text"
          },
          {
            "name": "featured",
            "type": "text"
          },
          {
            "name": "new",
            "type": "text"
          },
          {
            "name": "onSale",
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