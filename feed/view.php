<?php

require_once('inc/db.inc.php');

$iStoryID = (int)$_GET['id'];
if ($iStoryID > 0) {
    $aStoryInfo = $GLOBALS['MySQL']->getRow("SELECT * FROM `tableUpdates` WHERE `id`='{$iStoryID}'");

    $sStoryTitle = $aStoryInfo['title'];
    $sStoryDesc = $aStoryInfo['description'];

    echo <<<EOF
<h1>{$sStoryTitle}</h1>
<div>{$sStoryDesc}</div>
<hr />
<div><a href="index.php">Back to RSS</a></div>
EOF;
}

?>