<?php

$from_stop = isset($_GET['from']) ? $_GET['from'] : '000000';
$to_stop = isset($_GET['to']) ? $_GET['to'] : '000000';

header('Content-type: image/svg+xml; charset=utf-8');

echo '<?xml version="1.0"?>
';

?>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100%">
    <defs>
        <linearGradient id="linear-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#<?php echo $from_stop; ?>" stop-opacity="1"/>
            <stop offset="100%" stop-color="#<?php echo $to_stop; ?>" stop-opacity="1"/>
        </linearGradient>
    </defs>
    <rect width="100%" height="100%" fill="url(#linear-gradient)"/>
</svg>
