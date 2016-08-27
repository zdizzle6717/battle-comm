<?php
require('../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "options": {
      "linkedFile": "/tbc2/admin/store/uploadPicture.php",
      "linkedForm": "addImage"
    },
    "$_GET": [
      {
        "type": "text",
        "name": "pid"
      }
    ],
    "$_POST": [
      {
        "type": "text",
        "fieldName": "imageName",
        "name": "imageName"
      },
      {
        "type": "text",
        "fieldName": "input",
        "name": "input"
      },
      {
        "type": "file",
        "fieldName": "file",
        "name": "file",
        "sub": [
          {
            "name": "name",
            "type": "text"
          },
          {
            "name": "type",
            "type": "text"
          },
          {
            "name": "size",
            "type": "number"
          },
          {
            "name": "error",
            "type": "text"
          }
        ],
        "outputType": "file"
      },
      {
        "type": "text",
        "fieldName": "fileType",
        "name": "fileType"
      },
      {
        "type": "text",
        "fieldName": "size_h",
        "name": "size_h"
      },
      {
        "type": "text",
        "fieldName": "size_b",
        "name": "size_b"
      },
      {
        "type": "text",
        "fieldName": "productID",
        "name": "productID"
      },
      {
        "type": "text",
        "fieldName": "textarea",
        "multiple": true,
        "name": "textarea"
      },
      {
        "type": "text",
        "name": "prod_image_alt"
      },
      {
        "type": "text",
        "fieldName": "altText",
        "name": "altText"
      },
      {
        "type": "text",
        "fieldName": "description",
        "name": "description"
      },
      {
        "type": "text",
        "fieldName": "tags",
        "name": "tags"
      },
      {
        "type": "number",
        "name": "prod_image_h"
      }
    ]
  },
  "exec": {
    "steps": [
      "Connections/tbc",
      {
        "name": "productUpload",
        "module": "upload",
        "action": "upload",
        "options": {
          "path": "/uploads/store/product",
          "fields": "{{$_POST.file}}{{$_POST.file}}{{$_POST}}",
          "template": "{name}{_n}{guid}.{ext}"
        },
        "meta": [],
        "outputType": "array"
      },
      {
        "name": "insert_Image_db",
        "module": "dbupdater",
        "action": "insert",
        "options": {
          "connection": "tbc",
          "sql": {
            "type": "insert",
            "table": "products_images",
            "values": [
              {
                "table": "products_images",
                "column": "prod_id",
                "value": "{{$_POST.productID}}",
                "type": "number"
              },
              {
                "table": "products_images",
                "column": "prod_image_name",
                "value": "{{$_POST.imageName}}",
                "type": "text"
              },
              {
                "table": "products_images",
                "column": "prod_image_alt",
                "value": "{{$_POST.prod_image_alt}}",
                "type": "text"
              },
              {
                "table": "products_images",
                "column": "prod_image_caption",
                "value": "{{$_POST.description}}",
                "type": "text"
              },
              {
                "table": "products_images",
                "column": "prod_image_type",
                "value": "{{$_POST.file.type}}",
                "type": "text"
              },
              {
                "table": "products_images",
                "column": "prod_image_h",
                "value": "{{$_POST.prod_image_h}}",
                "type": "number"
              },
              {
                "table": "products_images",
                "column": "Image_file_name",
                "value": "{{$_POST.file.name}}",
                "type": "text"
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