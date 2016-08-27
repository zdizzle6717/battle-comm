<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "flgsDetails" */
       jQuery.dmxDataSet(
         {"id": "flgsDetails", "url": "dmxDatabaseSources/flgs_details.php", "data": {"locga": "{{$URL.locga}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "flgsDetails" */
</script>
</head>
<body>
{{flgsDetails.data[0].venue_Name}}
</body>
</html>