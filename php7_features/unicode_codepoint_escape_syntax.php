<?php
$x=<<<EOF
//codepoint is a character. 1 million unicode 0-10FFFF
echo "\u\{2764}";
echo "\u\{002764}";
echo "\u\{260F}";
echo "\u\{1F600}";    
EOF;

echo nl2br($x);
echo '<br/>';
echo "\u{2764}";
echo '<br/>';
echo "\u{002764}";
echo '<br/>';
echo "\u{260F}";
echo '<br/>';
echo "\u{1F600}";    

        
        