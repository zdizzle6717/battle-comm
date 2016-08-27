<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tiebreakers" */
       jQuery.dmxDataSet(
         {"id": "tiebreakers", "url": "dmxDatabaseSources/tiebreakerMenu.php", "data": {"limit": "4"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakers" */
</script>
</head>

<body>
<p>&nbsp;</p><form name="form1" method="post" action="#">
<table width="90%" border="1">
  <tr>
    <th scope="col">Tiebreaker</th>
    <th scope="col">Point Value</th>
    <th scope="col">Checkbox</th>
  </tr>
  <tr data-binding-repeat="{{tiebreakers.data}}" data-binding-id="repeat1">
    <td>{{tiebreaker_name}}</td>
    <td>{{point_value}}</td>
    <td><input name="tiebreaker[]" type="checkbox" id="checkbox" value="{{point_value}}"></td>
  </tr>
  <tr>
    <td><input name="submit" type="submit" id="submit" formaction="#" formmethod="POST" value="Submit"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
	$tiebreakerTotal = 0;
	$tiepoints=0;
	if(isset($_POST['submit'])){
		if(!empty($_POST['tiebreaker'])){
			foreach($_POST['tiebreaker'] as $tiepoints){
				$tiebreakerTotal += $tiepoints;}	
			
		}
		
		
	}
		echo $tiebreakerTotal;
?>
</form>

</body>
</html>