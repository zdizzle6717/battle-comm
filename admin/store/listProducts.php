<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../../css/storeAdmin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../../bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxServerAction.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Battle-comm Store Admin</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>List All Products</h2>
      <p class="text-center">&nbsp;<a href="insertproduct.php" class="btn btn-info" type="button">Add New Item</a>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>SKU</th>
              <th>Name</th>
              <th>Price</th>
              <th>Manufacturer</th>
              <th>Game system</th>
              <th>Category</th>
              <th>In stock</th>
              <th>Filter val</th>
              <th>Featured</th>
              <th>New</th>
              <th>On sale</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody data-binding-repeat-children="{{listAllProducts.data.tbc_allProducts}}" data-binding-id="tableRepeat">
            <tr>
              <td>{{SKU}}
              <input name="productID" type="hidden" id="productID" value="{{id}}"></td>
              <td>{{name}}</td>
              <td>{{price}}</td>
              <td>{{manufacturerId}}</td>
              <td>{{gameSystem}}</td>
              <td>{{category}}</td>
              <td>{{inStock}}</td>
              <td>{{filterVal}}</td>
              <td>{{featured}}</td>
              <td>{{new}}</td>
              <td>{{onSale}}</td>
              <td>edit | Delete | <a href="uploadPicture.php?pid={{id}}">Add Picture</a></td>
            </tr>
          </tbody>
        </table>
      </div>
      </p>
    </div>
  </div>
</div>
<script type="text/javascript">
/* dmxServerAction name "listAllProducts" */
       jQuery.dmxServerAction(
         {"id": "listAllProducts", "url": "../../dmxConnect/api/ListAllProducts.php", "method": "GET", "sendOnSubmit": false, "sendOnReady": true, "data": {}}
       );
  /* END dmxServerAction name "listAllProducts" */
</script>
</body>
</html>