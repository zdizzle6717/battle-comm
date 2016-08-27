<?php
$dmxSecurityProviderBase = realpath(dirname(__FILE__)) . '/';
require_once($dmxSecurityProviderBase.'../ScriptLibrary/dmxSecurityProvider/dmxSecurityProvider.php');

$cfgSecurityProvider = <<<JSON
{"secret": "FA31CEB929196EA51ACE816448ADB", "domain": "testbattlecom.com/tourneytool/", "provider": "Static", "users": {"bhaarer": "letmein1234!!", "bnelson": "p@ssw0rd!", "gdanke": "p@ssw0rd!", "jrossow": "p@ssw0rd!", "zanselm": "p@ssw0rd!", "rrobbins": "p@ssw0rd!", "fgiampapa": "p@ssw0rd!", "": ""}, "permissions": {}}
JSON;

$dmxSecurityProvider = new SecurityProvider($cfgSecurityProvider);
?>