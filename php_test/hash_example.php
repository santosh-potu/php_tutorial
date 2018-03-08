<?php
$md5_str = hash('md5', 'The quick brown fox jumped over the lazy dog.');
echo "$md5_str - length ". strlen($md5_str);
echo "<br/>";
$sha256_str = hash('sha256', 'The quick brown fox jumped over the lazy dog.');
echo "$sha256_str - length ". strlen($sha256_str);

echo "<br/>";
$sha1_str = hash('sha1', 'The quick brown fox jumped over the lazy dog.');
echo "$sha1_str - length ". strlen($sha1_str);
