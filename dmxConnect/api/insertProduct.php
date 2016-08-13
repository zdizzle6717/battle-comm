<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/tbc2/admin/store/insertproduct.php",
      "linkedForm": "insertProduct"
    },
    "$_POST": [
      {
        "type": "text",
        "name": "SKU"
      },
      {
        "type": "text",
        "name": "name"
      },
      {
        "type": "number",
        "name": "price"
      },
      {
        "type": "text",
        "name": "description"
      },
      {
        "type": "text",
        "name": "manufacturerId"
      },
      {
        "type": "text",
        "name": "gameSystem"
      },
      {
        "type": "text",
        "name": "color"
      },
      {
        "type": "text",
        "name": "tag"
      },
      {
        "type": "text",
        "name": "category"
      },
      {
        "type": "number",
        "name": "stockQty"
      },
      {
        "type": "number",
        "name": "inStock"
      },
      {
        "type": "text",
        "name": "filterVal"
      },
      {
        "type": "number",
        "name": "displayStatus"
      },
      {
        "type": "number",
        "name": "featured"
      },
      {
        "type": "number",
        "name": "new"
      },
      {
        "type": "number",
        "name": "onSale"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/tbc",
      {
        "name": "tbc_insert",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "tbc",
          "sql": {
            "type": "insert",
            "table": "products",
            "values": [
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
                "column": "description",
                "value": "{{$_POST.description}}",
                "type": "text"
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
                "column": "color",
                "value": "{{$_POST.color}}",
                "type": "text"
              },
              {
                "table": "products",
                "column": "tag",
                "value": "{{$_POST.tag}}",
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
                "column": "stockQty",
                "value": "{{$_POST.stockQty}}",
                "type": "number"
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
            "wheres": []
          }
        },
        "meta": [
          {
            "name": "identity",
            "type": "text"
          },
          {
            "name": "affected",
            "type": "number"
          }
        ]
      }
    ]
  }
}
JSON
);
?>