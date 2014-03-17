<?php
$myFile = $_SERVER['DOCUMENT_ROOT']."/tmp/testFile.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 5);
fclose($fh);
print $theData;
?>