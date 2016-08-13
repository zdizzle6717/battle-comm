<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../../bootstrap/3/css/bootstrap.css" />
<link href="../../css/storeAdmin.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<link rel="stylesheet" type="text/css" href="../../bootstrap/3/css/dmxBootstrap3Forms.css" />
<script type="text/javascript" src="../../bootstrap/3/js/dmxBootstrap3Forms.js"></script>
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
      <h2>Insert New Product to Store</h2>
      <p>
      <div id="formWrapper" class="formWrapper">
        <form class="form-horizontal" id="insertProduct" method="post" role="form">
          <div class="form-group">
            <label for="SKU" class="col-md-2 control-label">Sku</label>
            <div class="col-md-10">
              <input type="text" class="form-control input-lg" name="SKU" id="SKU" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="name" class="col-md-2 control-label">Name</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" id="name" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="price" class="col-md-2 control-label">Price</label>
            <div class="col-md-10">
              <input type="number" class="form-control input-sm" name="price" id="price" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="description" class="col-md-2 control-label">Description</label>
            <div class="col-md-10">
              <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="manufacturerId" class="col-md-2 control-label">Manufacturer</label>
            <div class="col-md-10">
              <input type="text" class="form-control input-lg" name="manufacturerId" id="manufacturerId" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="gameSystem" class="col-md-2 control-label">Game system</label>
            <div class="col-md-10">
              <input type="text" class="form-control input-lg" name="gameSystem" id="gameSystem" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="color" class="col-md-2 control-label">Color</label>
            <div class="col-md-10">
              <input type="text" class="form-control input-sm" name="color" id="color" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="tag" class="col-md-2 control-label">Tags</label>
            <div class="col-md-10">
              <textarea class="form-control" name="tag" id="tag" rows="3"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="category" class="col-md-2 control-label">Category</label>
            <div class="col-md-10">
              <input type="text" class="form-control input-lg" name="category" id="category" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="stockQty" class="col-md-2 control-label">Stock qty</label>
            <div class="col-md-10">
              <input type="number" class="form-control input-sm" name="stockQty" id="stockQty" value="">
            </div>
          </div>
<div class="form-group">
            <label for="select" class="col-md-2 control-label">In Stock</label>
            <div class="col-md-10">
              <select class="form-control" name="select" id="select">
                <option value="1" selected="selected">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="filterVal" class="col-md-2 control-label">Filter value</label>
            <div class="col-md-10">
              <select class="form-control" name="filterVal" id="filterVal" data-binding-value="">
                <option value="showit" selected="selected">Show It</option>
                <option value="hideit">Hide It</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <div class="checkbox">
                <input type="checkbox" name="displayStatus" id="displayStatus" value="1">
                <label for="displayStatus">Display status</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <div class="checkbox">
                <input type="checkbox" name="featured" id="featured" value="1">
                <label for="featured">Featured</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <div class="checkbox">
                <input type="checkbox" name="new" id="new" value="1">
                <label for="new">New</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <div class="checkbox">
                <input type="checkbox" name="onSale" id="onSale" value="1">
                <label for="onSale">On sale</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <button type="submit" class="btn btn-primary">Insert Product</button>
            </div>
          </div>
        </form>
       
       
       
       </div>
      
      
      
      </p>
    </div>
  </div>
</div>
<script type="text/javascript">
/* dmxServerAction name "insertNewProduct" */
       jQuery.dmxServerAction(
         {"id": "insertNewProduct", "url": "../../dmxConnect/api/insertProduct.php", "form": "#insertProduct", "data": {}}
       );
  /* END dmxServerAction name "insertNewProduct" */
</script>
</body>
</html>