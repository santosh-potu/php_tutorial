<?php

$x =<<<EOF

session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
       
        
EOF;

echo nl2br($x);

session_start([
    'cache_limiter' => 'private',
    'read_and_close' => true,
]);
?>
