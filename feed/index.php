<?php

require_once('inc/db.inc.php');
require_once('inc/rss_factory.inc.php');

$sSiteUrl = 'http://testbattlecomm.com/feed/';
$sRssIcon = 'http://testbattlecomm.com/images/BC_Web_Logo.png';

$aStoriesRSS = array();

$sSQL = "SELECT * FROM `tableUpdates` ORDER BY `id` DESC";
$aStories = $GLOBALS['MySQL']->getAll($sSQL);
foreach ($aStories as $iID => $aStoryInfo) {
    $iStoryID = (int)$aStoryInfo['id'];

    $aStoriesRSS[$iID]['Guid'] = $iStoryID;
    $aStoriesRSS[$iID]['Title'] = $aStoryInfo['title'];
    $aStoriesRSS[$iID]['Link'] = $sSiteUrl . 'view.php?id=' . $iStoryID;
    $aStoriesRSS[$iID]['Desc'] = $aStoryInfo['description'];
    $aStoriesRSS[$iID]['DateTime'] = $aStoryInfo['when'];
}

$oRssFactory = new RssFactory();

header('Content-Type: text/xml; charset=utf-8');
echo $oRssFactory->GenRssByData($aStoriesRSS, 'BattleComm Feed', $sSiteUrl . 'index.php', $sRssIcon);

?>