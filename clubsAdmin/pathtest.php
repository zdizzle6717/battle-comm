<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php echo((isset($_SERVER["DOCUMENT_ROOT"]))?$_SERVER["DOCUMENT_ROOT"]:"") ?>

test of echo II
Document Root: <strong> <? echo $_SERVER['DOCUMENT_ROOT']; ?></strong>
</body>
</html>