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
<link rel="stylesheet" type="text/css" href="../../bootstrap/3/css/dmxBootstrap3Forms.css" />
<script type="text/javascript" src="../../bootstrap/3/js/dmxBootstrap3Forms.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxServerAction.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Battle-Comm Product Admin</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Upload Image for [Product Name]</h2>
      <p>
      <div id="formWrapper" class="formWrapper">
        <form id="addImage" method="post" role="form">
          <div class="form-group">
            <label for="imageName" class="control-label">Image Name</label>
            <input type="text" class="form-control input-lg" name="imageName" id="imageName" placeholder="Text">
          </div>
          <div class="form-group">
            <label for="altText" class="control-label">Alt Text</label>
            <input type="text" class="form-control" name="altText" id="altText" placeholder="Text">
          </div>
          <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="tags" class="control-label">Tags</label>
            <textarea class="form-control" name="tags" id="tags" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="file" class="control-label">File</label>
            <input type="file" class="filestyle" name="file" id="file">
          </div>
          &nbsp;
        <input type="hidden" name="fileType" id="fileType">
        <input type="hidden" name="size_h" id="size_h">
        <input type="hidden" name="size_b" id="size_b">
        <input name="productID" type="hidden" id="productID" value="{{$URL.pid}}">
        </form>
      	
      
      </div>
      </p>
    </div>
  </div>
</div>
<script type="text/javascript">
/* dmxServerAction name "uploadImage" */
       jQuery.dmxServerAction(
         {"id": "uploadImage", "url": "../../dmxConnect/api/addImage.php", "method": "GET", "form": "#addImage", "data": {}}
       );
  /* END dmxServerAction name "uploadImage" */
/* dmxServerAction name "productDetails" */
       jQuery.dmxServerAction(
         {"id": "productDetails", "url": "../../dmxConnect/api/productDetail.php", "method": "GET", "sendOnSubmit": false, "sendOnReady": true, "data": {"pid": "{{$URL.pid}}"}}
       );
  /* END dmxServerAction name "productDetails" */
</script>
</body>
</html>